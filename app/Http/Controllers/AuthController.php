<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

use App\Models\Anggota;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request) {
        return view('auth.login');
    }
    public function dologin(Request $request) {
        // validasi
        // dd($request->pin);
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (auth()->attempt($credentials)) {

            // buat ulang session login
            $request->session()->regenerate();

            if (auth()->user()->role_id === 1) {
                // jika user superadmin
                return redirect()->intended('/admin');
            }else{
                return redirect()->intended('/siswa');
            }
        }

        // jika email atau password salah
        // kirimkan session error
        return back()->with('error', 'email atau password salah');
    }

    public function logout(Request $request) {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function regisform(Request $request){
        return view('auth.registeranggota');
    }


    public function regisanggota(Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator->errors())
                ->withInput($request->all());
        } else {


            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role_id = 3;
            $user->save();

            $data = new Anggota();
            $data->user_id = $user->id;
            $data->name = $request->name;
            $data->phone = $request->phone;
            $data->email = $request->email;
            $data->alamat = $request->alamat;
            $data->birtday = $request->birtday;
            $data->save();

            return redirect()
                ->route('login')
                ->with('message', 'register success');;
        }
    }
}
