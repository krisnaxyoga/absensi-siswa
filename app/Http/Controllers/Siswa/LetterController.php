<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Letter;

use App\Models\Siswa;

use Illuminate\Support\Facades\Validator;

class LetterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $iduser = auth()->user()->id;

        $siswa = Siswa::where('user_id',$iduser)->first();
        $data = Letter::where('siswa_id',$siswa->id)->get();
        return view('siswa.letter.index',compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $model = new Letter;
        return view('siswa.letter.form',compact('model'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'keterangan' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator->errors())
                ->withInput($request->all());
        } else {
            if ($request->hasFile('file')) {
                $feature_image = $request->file('file');
                $filename = time() . '.' . $feature_image->getClientOriginalExtension();
                $feature_image->move(public_path('ijin'), $filename);

                // Lakukan hal lain yang diperlukan, seperti menyimpan nama file dalam database
            }else{
                $filename= "";
            }


            $feature = "/ijin/".$filename;

            $iduser = auth()->user()->id;

            $siswa = Siswa::where('user_id',$iduser)->first();

            $data = new Letter();
            $data->siswa_id = $siswa->id;
            $data->keterangan = $request->keterangan;
            $data->date = $request->date;
            $data->file = $feature;
            $data->status = 0;
            $data->save();

            return redirect()
                ->route('letter.index')
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
