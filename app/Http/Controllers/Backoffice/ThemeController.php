<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Theme;
use Illuminate\Http\Request;

class ThemeController extends Controller
{

    public function __construct()
    {
        $this->checkPermissionAnd404('themes');
    }

    public function index()
    {
        $themes = Theme::orderBy('id', 'DESC')->get();
        return view('backoffice.themes.themesList', compact('themes'));
    }

    public function create()
    {
        return view('backoffice.themes.themesCreate');
    }


    public function store(Request $request)
    {
        try {
            Theme::create($request->all());
            $request->session()->flash('alert-success', "Theme {$request->name} created!");
            return redirect()->route('admin.theme.index');
        } catch (\Exception $e) {
            $request->flash();
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect()->route('admin.theme.create');
        }
    }

    public function show(Theme $theme)
    {
        //
    }

    public function edit(Theme $theme)
    {
        return view('backoffice.themes.themesUpdate', compact('theme'));
    }

    public function update(Request $request, Theme $theme)
    {
        try {
            $theme->name = $request->name;
            $theme->code = $request->code;
            $theme->cover_colour = $request->cover_colour;
            $theme->theme_transaction = $request->theme_transaction;
            $theme->status = $request->status;
            $theme->save();
            $request->session()->flash('alert-success', "Theme {$request->name} updated!");
            return redirect()->route('admin.theme.index');
        } catch (\Exception $e) {
            $request->flash();
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect()->route('admin.theme.index');
        }
    }

    public function destroy(Theme $theme, Request $request)
    {
        try {
            $theme->delete();
            $request->session()->flash('alert-success', "Theme {$theme->name} deleted!");
            return redirect()->route('admin.theme.index');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect()->route('admin.theme.index');
        }
    }
}