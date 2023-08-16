<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Absen;
use App\Models\Letter;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class AbsenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelas = Kelas::all();
        $letter = Letter::where('date','=',Carbon::now()->toDateString())->get();
        $data = Absen::whereDate('tanggal', '=', Carbon::now()->toDateString())->get();
        return view('petugas.absensi.index',compact('data','kelas','letter'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $siswa = Siswa::where('kelas_id',$request->kelas)->get();
        foreach($siswa as $item){
            $data = new Absen;
            $data->siswa_id = $item->id;
            $data->tanggal = $request->tanggal;
            $data->save();
        }
        return redirect()
        ->route('absensi.index')
        ->with('message', 'absen berhasil dibuat.');
    }

    public function tidakhadir($id){
        $data = Absen::find($id);
        $data->status = 'tidak hadir';
        $data->save();
        return redirect()
        ->route('absensi.index')
        ->with('message', 'siswa tidak hadir.');
    }

    public function hadir($id){
        $data = Absen::find($id);
        $data->status = 'hadir';
        $data->save();
        return redirect()
        ->route('absensi.index')
        ->with('message', 'siswa hadir.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
