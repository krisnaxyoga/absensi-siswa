<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Siswa::all();
        return view('petugas.siswa.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $model = new Siswa;
        $kelas = Kelas::all();
        return view('petugas.siswa.form',compact('model','kelas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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
            $data = new User();
            $data->name = $request->nama_siswa;
            $data->email = $request->email;
            $data->password = Hash::make('password123');
            $data->role_id = 2;
            $data->save();

            if ($request->hasFile('foto')) {
                $feature_image = $request->file('foto');
                $filename = time() . '.' . $feature_image->getClientOriginalExtension();
                $feature_image->move(public_path('profile'), $filename);

                // Lakukan hal lain yang diperlukan, seperti menyimpan nama file dalam database
            }else{
                $filename= "";
            }
            // dd($request->description);
            //create post
            $feature = "/profile/".$filename;

            $sis = new Siswa();
            $sis->user_id = $data->id;
            $sis->kelas_id = $request->kelas_id;
            $sis->nama_siswa = $request->nama_siswa;
            $sis->nis = $request->nis;
            $sis->jenis_kelamin = $request->jenis_kelamin;
            $sis->tempat_lahir = $request->tempat_lahir;
            $sis->alamat = $request->alamat;
            $sis->agama = $request->agama;
            $sis->email_orangtua = $request->email_orangtua;
            $sis->phone =$request->phone;
            $sis->foto =$feature;
            $sis->tgl_lahir = $request->tgl_lahir;
            $sis->save();

            return redirect()
                ->route('siswa.index')
                ->with('message', 'Data berhasil disimpan.');
        }

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
        $model = Siswa::find($id);
        $kelas = Kelas::all();
        return view('petugas.siswa.form',compact('model','kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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
                ->route('siswa.index')
                ->with('message', 'Data berhasil disimpan.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sis = Siswa::find($id);
        $data = User::find($sis->user_id);
        $data->delete();
        $sis->delete();
        return redirect()->back()->with('message', 'data berhasil dihapus');
    }
}
