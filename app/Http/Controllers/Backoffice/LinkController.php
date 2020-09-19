<?php

namespace App\Http\Controllers\Backoffice;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Link;
use App\User;
use Illuminate\Http\Request;

class LinkController extends Controller
{

    public function __construct()
    {
        $this->checkPermissionAnd404('links');
    }

    public function index()
    {
        $links = Link::orderBy('id', 'DESC')->get();
        return view('backoffice.links.linksList', compact('links'));
    }

    public function create()
    {
        $users = User::whereAccessType('general')->get();
        return view('backoffice.links.linksCreate', compact('users'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $general_id = User::whereId($request->user_id)->firstOrFail()->general->id;
            $request->merge(['general_id' => $general_id]);
            Link::create($request->all());
            DB::commit();
            $request->session()->flash('alert-success', "Link {$request->title} created!");
            return redirect()->route('admin.link.index');
        } catch (\Exception $e) {
            DB::rollback();
            $request->flash();
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect()->route('admin.link.create');
        }
    }

    public function show(Link $link)
    {
        //
    }

    public function edit(Link $link)
    {
        $users = User::whereAccessType('general')->get();
        return view('backoffice.links.linkUpdate', compact('link', 'users'));
    }

    public function update(Request $request, Link $link)
    {
        DB::beginTransaction();
        try {
            $general_id = User::whereId($request->user_id)->firstOrFail()->general->id;
            $link->title = $request->title;
            $link->type = $request->type;
            $link->url = $request->url;
            $link->user_id = $request->user_id;
            $link->general_id = $general_id;
            $link->save();
            DB::commit();
            $request->session()->flash('alert-success', "Link {$request->title} updated!");
            return redirect()->route('admin.link.index');
        } catch (\Exception $e) {
            DB::rollback();
            $request->flash();
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect()->route('admin.link.index');
        }
    }

    public function destroy(Link $link, Request $request)
    {
        DB::beginTransaction();
        try {
            $link->delete();
            DB::commit();
            $request->session()->flash('alert-success', "Link {$request->title} deleted!");
            return redirect()->route('admin.link.index');
        } catch (\Exception $e) {
            DB::rollback();
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect()->route('admin.link.index');
        }
    }
}