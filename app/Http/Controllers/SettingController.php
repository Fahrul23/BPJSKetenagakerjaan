<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Auth;

use App\Http\Requests\PasswordRequest;
use App\Http\Requests\ProfileRequest;

class SettingController extends Controller
{
    
    public function index() {
        return view('setting');
    }

    public function profile($id) {
        return view('setting_profile', ['user' => User::find($id)]);
    }

    public function profile_update(ProfileRequest $r) {
        $data = (object) $r->validated();
        try {
            $user = User::find(Auth::id());
            if ( !empty($data->username) ) $user->name = $data->username;
            if ( !empty($data->email) ) $user->email = $data->email;
            $user->save();
            $alert = ['success', 'Berhasil mengubah profile!'];
        } catch (Exception $e) {
            $alert = ['danger', 'Gagal mengubah profile!'];
        }
        return back()->with('alert', $alert);
    }

    public function password($id) {
        return view('setting_password', ['user' => User::find($id)]);
    }

    public function password_update(PasswordRequest $r) {
        $data = (object) $r->validated();
        $pass = Auth::user()->password;
        try {
            if ( ! Hash::check($data->pass_new, $pass) ) {
                $user = User::find(Auth::id());
                $user->password = Hash::make($data->pass_new);
                $user->save();
                $alert = ['success', 'Berhasil mengubah password!'];
            } else {
                $alert = ['danger', 'Password baru harus beda dari password sebelumnya!'];
            }
        } catch (Exception $e) {
            $alert = ['danger', 'Gagal mengubah password!'];
        }
        return back()->with('alert', $alert);
    }

}
