<?php

namespace App\Http\Controllers;

use App\Okp;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;;

class OkpController extends Controller
{

    public function index(Request $request)
    {
        $okps = Okp::all();
        $success_message = $request->session()->get('alert-success');
        return view('okps.okpList',  ['okps' => $okps, 'success_message' => $success_message]);
    }

    public function create()
    {
        $roles = Role::all();
        return view('okps.okpCreate', ['roles' => $roles]);
    }

    public function store(Request $request)
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'level' => $request->level,
            ]);
            $user->syncRoles($request->level);

            $storage = Storage::putFile('public/okp/photo', $request->file('foto'));
            Okp::create([
                'nama' => $request->nama,
                'bidang' => $request->bidang,
                'alamat' => $request->alamat,
                'no_okp' => $request->no_okp,
                'status' => $request->status,
                'tanggal_daftar' => $request->tanggal_daftar,
                'visi' => $request->visi,
                'misi' => $request->misi,
                'tanggal_berdiri' => $request->tanggal_berdiri,
                'pendiri' => $request->pendiri,
                'latar_belakang' => $request->latar_belakang,
                'long' => $request->langitude,
                'lat' => $request->longitude,
                'foto' => basename($storage),
                'user_id' => $user->id,
            ]);
            $request->session()->flash('alert-success', "Berhasil di buat!");
            return redirect('/okp');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect('/okp/create');
        }
    }

    public function show(okp $okp)
    {
        //
    }

    public function edit(okp $okp)
    {
        $roles = Role::all();
        return view('okps.okpUpdate', ['okp' => $okp, 'roles' => $roles]);
    }

    public function update(Request $request, okp $okp)
    {
        try {
            //
            $okp->nama = $request->nama;
            $okp->bidang = $request->bidang;
            $okp->alamat = $request->alamat;
            $okp->no_okp = $request->no_okp;
            $okp->status = $request->status;
            $okp->tanggal_daftar = $request->tanggal_daftar;
            $okp->visi = $request->visi;
            $okp->misi = $request->misi;
            $okp->tanggal_berdiri = $request->tanggal_berdiri;
            $okp->pendiri = $request->pendiri;
            $okp->latar_belakang = $request->latar_belakang;
            $okp->long = $request->longitude;
            $okp->lat = $request->langitude;

            //delete and update foto
            if ($request->file('foto')) {
                Storage::delete('public/okp/photo/' . $okp->foto);
                $storage = Storage::putFile('public/okp/photo', $request->file('foto'));
                $okp->foto = basename($storage);
            }
            $okp->save();
            $request->session()->flash('alert-success', "Berhasil di update!");
            return redirect('/okp');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            dd($e->getMessage());
            return redirect('/okp/create');
        }
    }

    public function destroy(okp $okp, Request $request)
    {
        try {
            $user_id = $okp->user_id;

            // Delete data okp
            Storage::delete('public/okp/photo/' . $okp->foto);
            $okp->delete();

            // Delete admin okp
            $user = User::find($user_id);
            $user->syncRoles();
            $user->delete();

            $request->session()->flash('alert-success', "Berhasil di hapus!");
            return redirect('/okp');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            dd($e->getMessage());
            return redirect('/okp/create');
        }
    }
}