<?php


namespace App\Http\Controllers\General;

use App\General;
use App\User;
use App\Link;
use App\Http\Controllers\Controller;
use App\Links;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $general_id = $user->generals->id;
        $tweet = $user->generals->tweet;
        $links = Link::where('general_id', $general_id)->get();
        return view('general.index', compact('tweet','links', 'user'));
    }


    public function saveLinks(Request $request) {

        try {
            $user = auth()->user();
            $user_id = $user->id;
            $general_id = $user->generals->id;
            $all_request = $request->all();
            
            // Update general
            $tweet = isset($all_request['tweet']) ? $all_request['tweet'] : null;
            General::find($general_id)->update(['tweet' => $tweet]);
            
            // Collection links
            array_shift($all_request['titles']);
            array_shift($all_request['links']);
            array_shift($all_request['social_links']);
            array_shift($all_request['link_id']);
            
            //Find all links and delete if no exist
            $all_links = Link::where('general_id', $general_id)->get()->pluck('id')->toArray();
            if(count($all_links) > 0) {
                foreach($all_links as $key => $links_id) {
                    if(!in_array($links_id, $all_request['link_id'])) {
                        Links::find($links_id)->delete();
                    }
                }
            }

            // Recursive insert link
            if(count($all_request['titles']) > 0) {
                foreach($all_request['titles'] as $key => $value) {
                    $title = $value;
                    $links = $all_request['links'][$key];
                    $links_id = $all_request['link_id'][$key];
                    $social_links = $all_request['social_links'][$key];
                    if($links_id) {
                        Link::find($links_id)->update([
                            'title' => $title,
                            'url' => $links,
                            'type' => $social_links,
                        ]);
                    }else {
                        Link::create(['title' => $title, 'url' => $links, 'type' => $social_links, 'user_id' => $user_id, 'general_id' => $general_id]);
                    }
                }
            }
            
            $request->session()->flash('alert-success', "Berhasil update informasi!");
            return redirect()->route('general');
        } catch (\Exception $e) {
            dd($e->getMessage());
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect()->route('general');
        }
      
    }
}