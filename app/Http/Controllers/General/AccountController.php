<?php

namespace App\Http\Controllers\General;

use App\General;
use App\Http\Controllers\Controller;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class AccountController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $membershipName = null;
        $membership = auth()->user()->userPurchaseMapNotExpired()->first();
        if ($membership) {
            $membershipName = Product::findOrFail($membership->product_id)->name;
        }
        $message = $request->session()->get('alert-success');
        $messageError = $request->session()->get('alert-error');
        return view('general.account', compact('user', 'membership', 'membershipName', 'message', 'messageError'));
    }

    public function transaction(Request $request)
    {
        $user = auth()->user();
        $allTransaction = auth()->user()->userPurchaseMap()->get();
        return view('general.transaction', compact('user', 'allTransaction'));
    }

    protected function validatorAccountUsername($request)
    {
        $rules = [
            'username' => 'required|unique:users|min:3',
            'file' => 'mimes:jpeg,jpg,png|max:1000',
        ];

        $customMessages = [
            'required' => ':attribute tidak boleh kosong.',
            'unique' => ':attribute sudah digunakan.',
            'min' => ':attribute minimal 3 karakter.',
        ];

        $this->validate($request, $rules, $customMessages);
    }
    protected function validatorAccountInfo($request)
    {
        $rules = [
            'name' => 'string|max:100',
            'foto' => 'mimes:jpeg,jpg,png|max:1000',
        ];

        $customMessages = [
            'string' => 'Tipe :attribute harus karakter dan number.',
            'required' => ':attribute tidak boleh kosong.',
            'unique' => ':attribute sudah digunakan.',
            'max' => ':attribute mencapai batas maximal.',
            'mimes' => ':attribute harus JPEG, JPG, PNG.',
        ];

        $this->validate($request, $rules, $customMessages);
    }

    protected function beautyBag($allMessages)
    {
        $messages = null;
        if (count($allMessages) >= 1) {
            foreach ($allMessages as $message) {
                $messages = $messages . $message . ' <br>';
            }
        } else {
            $messages = $allMessages[0];
        }
        return $messages;
    }

    public function accountUpdate(Request $request)
    {

        try {

            $this->validatorAccountInfo($request);

            $user = User::find(auth()->user()->id);
            $general = General::whereUser_id(auth()->user()->id)->firstOrFail();

            $imagename = null;
            if ($request->file('foto')) {
                if (!file_exists(public_path() . '/user/profile/')) {
                    mkdir(public_path() . '/user/profile/', 776, true);
                }

                if (file_exists(public_path() . '/user/profile/' . $user->image_url)) {
                    Storage::delete(public_path() . '/user/profile/' . $user->image_url);
                }

                $imagename = date('YmdHis-') . uniqid() . '.jpg';
                $oriPath = public_path() . '/user/profile/' . $imagename;
                Image::make($request->file('foto'))->fit(300, 300)->save($oriPath);
            }

            // assign role to user
            // if ($roles) {
            //     $user->syncRoles([$roles->name]);
            //     $user->access_type = $roles->name;
            // }

            $user->name = $request->name;
            $user->telepon = $request->telepon;

            if ($request->file('foto')) {
                $general->photo = $imagename;
            }

            if ($request->password) {
                $user->password = bcrypt($request->password);
            }

            $user->save();
            $general->save();
            $request->session()->flash('alert-success', "Berhasil di update!");
            return redirect()->route('account');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $this->beautyBag($e->validator->messages()->all()));
            return redirect()->route('account');
        }
    }
    public function accountUsername(Request $request)
    {
        try {

            $this->validatorAccountUsername($request);

            $user = User::find(auth()->user()->id);
            $user->username = $request->username;

            $user->save();
            $request->session()->flash('alert-success', "Berhasil di update!");
            return redirect()->route('account');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $this->beautyBag($e->validator->messages()->all()));
            return redirect()->route('account');
        }
    }

}