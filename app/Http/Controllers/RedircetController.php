<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RedircetController extends Controller
{
    public function cek(Request $request) {
        // dd(auth()->user()->role_id);
        if (auth()->user()->role_id === 1) {
            return redirect('/admin');
        }else{
            return redirect('/siswa');
        }
    }
}
