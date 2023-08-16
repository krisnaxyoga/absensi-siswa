<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Absen;
use App\Models\Siswa;
use App\Models\Kelas;

use App\Models\Pengumuman;

class DashboardController extends Controller
{
    public function index(){
        $absen = Absen::count();
        $siswa = Siswa::count();
        $kelas = Kelas::count();

        $pengumuman = Pengumuman::where('status','active')->get();
        return view('petugas.index',compact('absen','siswa','kelas','pengumuman'));
    }
}
