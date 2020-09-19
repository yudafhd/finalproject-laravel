<?php

namespace App\Http\Controllers\General;

use App\General;
use App\Http\Controllers\Controller;
use App\Link;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;

class GeneralController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $general_id = $user->general->id;
        $tweet = $user->general->tweet;
        $message = $request->session()->get('alert');
        $links = Link::where('general_id', $general_id)->get();
        return view('general.index', compact('tweet', 'links', 'user', 'message'));
    }

    public function validEmail($links)
    {
        $error = Validator::make(['email' => $links], [
            'email' => 'email|max:100',
        ]);
        return !$error->fails();
    }

    public function validURL($links)
    {
        if (filter_var($links, FILTER_VALIDATE_URL)) {
            return true;
        } else {
            return false;
        }
    }

    private function saveDecicion($links_id, $links, $title, $social_links, $general_id, $user_id)
    {
        if ($links_id) {
            Link::find($links_id)->update([
                'title' => $title ? $title : '( Judul Kosong )',
                'url' => $links,
                'type' => $social_links
            ]);
        } else {
            Link::create(['title' => $title, 'url' => $links, 'type' => $social_links, 'user_id' => $user_id, 'general_id' => $general_id]);
        }
    }

    public function saveLinks(Request $request)
    {
        try {
            $user = auth()->user();
            $user_id = $user->id;
            $general_id = $user->general->id;
            $all_request = $request->all();
            $general_update = [];
            $error_link = [];

            // Update general
            $tweet = isset($all_request['tweet']) ? $all_request['tweet'] : null;
            $general_update = array_merge($general_update, ['tweet' => $tweet]);

            // Upload image
            $imagename = null;
            if ($request->file('foto')) {

                $ifExist = Storage::exists('public/user/profile/' . $user->general->photo);

                if ($ifExist) {
                    Storage::delete('public/user/profile/' . $user->general->photo);
                }

                // Decode image
                $imagename = date('YmdHis-') . uniqid() . '.jpg';
                $path = '/user/profile/' . $imagename;
                $imagesBatch = Image::make($request->file('foto'))->fit(300, 300)->encode('jpg');

                // Save proccess
                Storage::disk('public')->put($path, $imagesBatch);
            }

            if ($imagename) {
                $general_update = array_merge($general_update, ['photo' => $imagename]);
            }

            General::find($general_id)->update($general_update);

            // Collection links
            array_shift($all_request['titles']);
            array_shift($all_request['links']);
            array_shift($all_request['social_links']);
            array_shift($all_request['link_id']);

            // Collecting to variable
            $counttitles = count($all_request['titles']);
            $countlinks = count($all_request['links']);
            $countsocial_links = count($all_request['social_links']);
            $countlink_id = count($all_request['link_id']);

            if ($counttitles > 7 || $countlinks > 7 || $countsocial_links > 7 || $countlink_id > 7) {
                $request->session()->flash('alert', "Something error in server, hey what are you doing :)");
            } else {
                //Find all links and delete if no exist
                $all_links = Link::where('general_id', $general_id)->get()->pluck('id')->toArray();
                if (count($all_links) > 0) {
                    foreach ($all_links as $key => $links_id) {
                        if (!in_array($links_id, $all_request['link_id'])) {
                            Link::find($links_id)->delete();
                        }
                    }
                }

                // Recursive insert link
                if (count($all_request['titles']) > 0) {
                    foreach ($all_request['titles'] as $key => $value) {
                        $title = $value;
                        $links = $all_request['links'][$key];
                        $links_id = $all_request['link_id'][$key];
                        $social_links = $all_request['social_links'][$key];
                        if ($social_links == 'email') {
                            if ($this->validEmail($links)) {
                                $this->saveDecicion($links_id, $links, $title, $social_links, $general_id, $user_id);
                            } else {
                                array_push($error_link, [
                                    'isEmail' => true,
                                    'link' => $links,
                                ]);
                            }
                        } else {
                            if ($this->validURL($links)) {
                                if (@get_headers($links)) {
                                    $this->saveDecicion($links_id, $links, $title, $social_links, $general_id, $user_id);
                                } else {
                                    array_push($error_link, [
                                        'isEmail' => false,
                                        'link' => $links,
                                    ]);
                                }
                            } else {
                                array_push($error_link, [
                                    'isEmail' => false,
                                    'link' => $links,
                                ]);
                            }
                        }
                    }

                    if (count($error_link) > 0) {
                        if ($error_link[0]['isEmail']) {
                            $request->session()->flash(
                                'alert',
                                'Saya rasa ada beberapa email yg tidak sesuai'
                                    . '<br>Pastikan email anda benar seperti ini'
                                    . '<br><a style="font-weight:bold">pinterlink@gmail.com</a> tanpa tambahan apa-apa'
                                    . '<br>salah satu email anda yang salah<br> <a style="font-weight:bold">' . $error_link[0]['link'] . '</a>'
                            );
                        } else {
                            $request->session()->flash(
                                'alert',
                                'Saya rasa ada beberapa link yg tidak sesuai'
                                    . '<br>Pastikan link anda benar seperti ini'
                                    . '<br><div class="badge badge-light p-l-10 p-r-10"><a style="font-size:20px" href="https://pinter.link">https://pinter.link</a></div>'
                                    . '<br>salah satu url anda yang salah<br> <a class="text-danger">' . $error_link[0]['link'] . '</a>'
                            );
                        }
                    }
                }
            }

            return redirect()->route('general');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect()->route('general');
        }
    }
}