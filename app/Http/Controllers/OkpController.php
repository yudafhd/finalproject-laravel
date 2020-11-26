<?php

namespace App\Http\Controllers;

use App\Bidang;
use App\Exports\OkpExport;
use App\Okp;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;

class OkpController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $okps = [];
        $success_message = $request->session()->get('alert-success');

        if (auth()->user()->level === 'superadmin' || auth()->user()->level === 'admin_knpi') {
            $okps = Okp::all();
            return view('okps.okpList', ['okps' => $okps, 'success_message' => $success_message]);
        } else {
            $okps = Okp::whereUserId(auth()->user()->id)->get();
            return view('okps.okpDetailForAdminOkp', ['okps' => $okps[0], 'success_message' => $success_message]);
        }
    }

    public function create(Request $request)
    {
        $roles = Role::all();
        $bidangs = Bidang::all();
        $error_message = $request->session()->get('alert-error');
        return view('okps.okpCreate', ['roles' => $roles, 'bidangs' => $bidangs, 'error_message' => $error_message]);
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

            $berkas = null;
            $storage = null;

            if ($request->file('berkas')) {
                $berkas = Storage::putFile('public/okp/file', $request->file('berkas'));
            }
            if ($request->file('foto')) {
                $storage = Storage::putFile('public/okp/file', $request->file('foto'));
            }

            Okp::create([
                'nama' => $request->nama,
                'bidang' => $request->bidang,
                'alamat' => $request->alamat,
                'no_okp' => $request->no_okp,
                // 'telephone' => $request->telephone,
                'status' => $request->status,
                'tanggal_daftar' => $request->tanggal_daftar,
                'visi' => $request->visi,
                'misi' => $request->misi,
                'tanggal_berdiri' => $request->tanggal_berdiri,
                'pendiri' => $request->pendiri,
                'latar_belakang' => $request->latar_belakang,
                'long' => $request->langitude,
                'lat' => $request->longitude,
                'foto' => $storage ? basename($storage) : null,
                'berkas' => $berkas ? basename($berkas) : null,
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
        $bidangs = Bidang::all();
        return view('okps.okpUpdate', ['bidangs' => $bidangs, 'okp' => $okp, 'roles' => $roles]);
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
            $okp->telephone = $request->telephone;
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
            if ($request->file('berkas')) {
                Storage::delete('public/okp/file/' . $okp->berkas);
                $storage = Storage::putFile('public/okp/file', $request->file('berkas'));
                $okp->berkas = basename($storage);
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

    public function downloadReport()
    {
        return Excel::download(new OkpExport(), 'okps.xlsx');
    }
}
