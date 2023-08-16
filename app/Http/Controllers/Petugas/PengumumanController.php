<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengumuman;
use Illuminate\Support\Facades\Validator;

class PengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $data = Pengumuman::all();
       return view('petugas.pengumuman.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $model = new Pengumuman();
        return view('petugas.pengumuman.form',compact('model'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
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
                $feature_image->move(public_path('pengumuman'), $filename);

                // Lakukan hal lain yang diperlukan, seperti menyimpan nama file dalam database
            }else{
                $filename= "";
            }


            $feature = "/pengumuman/".$filename;

            $data = new Pengumuman();
            $data->title = $request->title;
            $data->description = $request->description;
            $data->file = $feature;
            $data->status = 'active';
            $data->save();

            return redirect()
                ->route('pengumuman.index')
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
        $model = Pengumuman::find($id);
        return view('petugas.pengumuman.form',compact('model'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator->errors())
                ->withInput($request->all());
        } else {
            $data = Pengumuman::find($id);

            if ($request->hasFile('file')) {
                $feature_image = $request->file('file');
                $filename = time() . '.' . $feature_image->getClientOriginalExtension();
                $feature_image->move(public_path('pengumuman'), $filename);

                // Lakukan hal lain yang diperlukan, seperti menyimpan nama file dalam database
                $feature = "/pengumuman/".$filename;
            }else{
                $feature= $data->file;
            }





            $data->title = $request->title;
            $data->description = $request->description;
            $data->file = $feature;
            $data->status = 'active';
            $data->save();

            return redirect()
                ->route('pengumuman.index')
                ->with('message', 'Data berhasil disimpan.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Pengumuman::find($id);
        $data->delete();


        return redirect()->back()->with('message', 'data berhasil dihapus');
    }

    public function active(string $id)
    {
        $data = Pengumuman::find($id);

        $data->status = 'active';
        $data->save();


        return redirect()->back()->with('message', 'data berhasil dihapus');
    }

    public function tidakactive(string $id)
    {
        $data = Pengumuman::find($id);

        $data->status = 'tidak-active';
        $data->save();


        return redirect()->back()->with('message', 'data berhasil dihapus');
    }
}
