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
use Illuminate\Support\Facades\DB;

class AbsenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelas = Kelas::all();
        $letter = Letter::where('date', '=', Carbon::now()->toDateString())->get();
        $data = Absen::whereDate('tanggal', '=', Carbon::now()->toDateString())->whereNull('keterangan')->get();
        return view('petugas.absensi.index', compact('data', 'kelas', 'letter'));
    }
    public function surat_ijin()
    {
        // $kelas = Kelas::all();
        $letter = Letter::where('date', '=', Carbon::now()->toDateString())->get();
        // $data = Absen::whereDate('tanggal', '=', Carbon::now()->toDateString())->get();
        return view('petugas.surat_ijin.index', compact('letter'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if (Absen::whereHas('siswa', function ($query) use ($request) {
            $query->where('kelas_id', $request->get('kelas'));
        })->whereDate(DB::raw('DATE(tanggal)'), $request->get('tanggal'))->count() == 0) {
            $siswa = Siswa::where('kelas_id', $request->kelas)->get();
            foreach ($siswa as $item) {
                $data = new Absen;
                $data->siswa_id = $item->id;
                $data->tanggal = $request->tanggal;
                $data->save();
            }
            return redirect()
                ->route('absensi.index')
                ->with('message', 'absen berhasil dibuat.');
        }
        return redirect()
            ->route('absensi.index')
            ->with('error', 'absen tidak dibuat karna sudah ada.');
    }

    public function cekletter($id)
    {
        $data = Letter::where('siswa_id', $id)->first();
        return view('petugas.absensi.form', compact('data'));
    }

    public function konfirmasiletter(Request $request, $id)
    {
        $data = Letter::find($id);
        $data->status = $request->status;
        $data->save();

        $absen = Absen::where('siswa_id', $data->siswa_id)->where('tanggal', $data->date)->first();
        $absen->letter_id = $id;
        $absen->keterangan = $request->keterangan;
        $absen->save();

        return redirect()
            ->route('absensi.index')
            ->with('message', 'absen berhasil diperbaharui.');
    }

    public function tidakhadir($id)
    {
        $data = Absen::find($id);
        $data->status = 'tidak hadir';
        $data->keterangan = 'alpha';
        $data->save();
        return redirect()
            ->route('absensi.index')
            ->with('message', 'siswa tidak hadir.');
    }

    public function hadir($id)
    {
        $data = Absen::find($id);
        $data->status = 'hadir';
        $data->keterangan = 'hadir';
        $data->save();
        return redirect()
            ->route('absensi.index')
            ->with('message', 'siswa hadir.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function rekapabsen(Request $request)
    {
        if (!$request->all()) {
            $data = [];
            $hadir = 0;
            $ijin = 0;
            $sakit = 0;
            $alpha = 0;
        } else {
            $query = Absen::query();

            if ($request->filled('kelas')) {
                $query->whereHas('siswa', function ($q) use ($request) {
                    $q->where('kelas_id', $request->kelas);
                });
            }

            if ($request->filled('tanggal')) {
                $query->where('tanggal', $request->tanggal);
            }

            $data = $query->get();

            $hadir = $data->filter(function ($item) {
                if ($item->keterangan == 'hadir') return $item;
            })->count();
            $ijin = $data->filter(function ($item) {
                if ($item->keterangan == 'ijin') return $item;
            })->count();
            $sakit = $data->filter(function ($item) {
                if ($item->keterangan == 'sakit') return $item;
            })->count();
            $alpha = $data->filter(function ($item) {
                if ($item->keterangan == 'alpha') return $item;
            })->count();
        }
        $kelas = Kelas::all();
        return view('petugas.rekapabsen.index', compact('data', 'kelas', 'hadir', 'alpha', 'sakit', 'ijin'));
    }

    public function set_tidak_hadir(Absen $absen)
    {
        $absen->keterangan = "tidak hadir";
        $absen->save();

        return redirect()->back()->with('message', 'Keterangan Diubah');
    }

    public function pdf(Request $request)
    {
        // dd($request->all());
        if (!$request->all() || $request->tanggal == null) {
            $data = [];
            $hadir = 0;
            $ijin = 0;
            $sakit = 0;
            $alpha = 0;
        } else {
            $query = Absen::query();

            if ($request->filled('kelas')) {
                $query->whereHas('siswa', function ($q) use ($request) {
                    $q->where('kelas_id', $request->kelas);
                });
            }

            if ($request->filled('tanggal')) {
                $query->where('tanggal', $request->tanggal);
            }

            $data = $query->get();
            $hadir = $data->filter(function ($item) {
                if ($item->keterangan == 'hadir') return $item;
            })->count();
            $ijin = $data->filter(function ($item) {
                if ($item->keterangan == 'ijin') return $item;
            })->count();
            $sakit = $data->filter(function ($item) {
                if ($item->keterangan == 'sakit') return $item;
            })->count();
            $alpha = $data->filter(function ($item) {
                if ($item->keterangan == 'alpha') return $item;
            })->count();
        }
        return view('petugas.rekapabsen.pdf', compact('data', 'hadir', 'alpha', 'sakit', 'ijin'));
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
