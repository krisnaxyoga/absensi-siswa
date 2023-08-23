<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Petugas;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Petugas::all();
        return view('petugas.user.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $model = new Petugas;
        return view('petugas.user.add', compact('model'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_petugas' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator->errors())
                ->withInput($request->all());
        } else {
            $data = new User();
            $data->name = $request->nama_petugas;
            $data->email = $request->email;
            $data->role_id = 1;
            $data->password = Hash::make($request->password);
            $data->save();

            $pet = new Petugas;
            $pet->nama_petugas = $request->nama_petugas;
            $pet->user_id = $data->id;
            $pet->phone = $request->phone;
            $pet->alamat = $request->alamat;
            $pet->save();

            return redirect()
                ->route('petugas.index')
                ->with('message', 'Data berhasil disimpan.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function passwordedit($id)
    {
        return view('petugas.user.edit', compact('id'));
    }

    public function password(Request $request, $id)
    {
        $data = User::find($id);
        $data->password = Hash::make($request->password);
        $data->save();

        return redirect()
            ->route('petugas.index')
            ->with('message', 'Password berhasil disimpan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $model = Petugas::find($id);
        return view('petugas.user.add', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_petugas' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator->errors())
                ->withInput($request->all());
        } else {
            $pet = Petugas::where('id', $id)->exists() ? Petugas::find($id) : new Petugas;
            $pet->nama_petugas = $request->nama_petugas;
            $pet->phone = $request->phone;
            $pet->alamat = $request->alamat;
            $pet->save();
            $data = User::where('id', $pet->user_id)->first();
            $data->name = $request->nama_petugas;
            $data->email = $request->email;
            $data->save();

            return redirect()
                ->route('petugas.index')
                ->with('message', 'Data berhasil disimpan.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sis = Petugas::find($id);
        $data = User::find($sis->user_id);
        $data->delete();
        $sis->delete();
        return redirect()->back()->with('message', 'data berhasil dihapus');
    }
}
