<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Siswa;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Absen;
use App\Models\Pengumuman;

use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function index(){
        $pengumuman = Pengumuman::where('status','active')->get();
        return view('siswa.index',compact('pengumuman'));
    }

    public function rekapabsensi(){

        $iduser = auth()->user()->id;

        $siswa = Siswa::where('user_id',$iduser)->first();

        $data = Absen::where('siswa_id',$siswa->id)->get();

        return view('siswa.absensi.index',compact('data'));
    }

    public function myprofile(){

        $iduser = auth()->user()->id;
        $kelas = Kelas::all();
        $model = Siswa::where('user_id',$iduser)->first();
        return view('siswa.profile.index',compact('model','kelas'));
    }

     /**
     * Update the specified resource in storage.
     */
    public function updateprofile(Request $request, string $id)
    {

        $validator = Validator::make($request->all(), [
            'nama_siswa' => 'required',
            'email_orangtua' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator->errors())
                ->withInput($request->all());
        } else {

            $sis = Siswa::find($id);

            if ($request->hasFile('foto')) {
                $feature_image = $request->file('foto');
                $filename = time() . '.' . $feature_image->getClientOriginalExtension();
                $feature_image->move(public_path('profile'), $filename);

                $feature = "/profile/".$filename;
            }else{
                $feature =  $sis->foto;
            }

            $data = User::find($sis->user_id);
            $data->name = $request->nama_siswa;
            $data->email = $request->email;
            $data->save();

            //create post
            $sis->kelas_id = $request->kelas_id;
            $sis->nama_siswa = $request->nama_siswa;
            $sis->nis = $request->nis;
            $sis->jenis_kelamin = $request->jenis_kelamin;
            $sis->tempat_lahir = $request->tempat_lahir;
            $sis->alamat = $request->alamat;
            $sis->agama = $request->agama;
            $sis->email_orangtua = $request->email_orangtua;
            $sis->phone =$request->phone;
            $sis->foto = $feature;
            $sis->tgl_lahir = $request->tgl_lahir;
            $sis->save();

            return redirect()
                ->route('siswa.myprofile')
                ->with('message', 'Data berhasil disimpan.');
        }
    }

}
