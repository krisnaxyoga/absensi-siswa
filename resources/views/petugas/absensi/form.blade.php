@extends('layouts.admin')
@section('title', 'Petugas')
@section('contents')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            @if ($data)
                                @if ($data->status == 1 || $data->status == 2)
                                    <h3 class="text-info">File sudah di konfirmasi</h3>
                                @else
                                    <div class="row">
                                        <div class="col-6">
                                            <h1>{{ $data->siswa->nama_siswa }}</h1>
                                            <ul>
                                                <li>NIS : {{ $data->siswa->nis }}</li>
                                                <li>Keterangan : {{ $data->keterangan }}</li>
                                                <li>Tanggal : {{ $data->date }}</li>
                                                <li>file : <a href="{{ $data->file }}">download</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-6">
                                            <div class="card">
                                                <div class="card-body">
                                                    <form action="{{ route('absensi.konfirmasiletter', $data->id) }}"
                                                        method="get">
                                                        <div class="mb-3">
                                                            <label for="">konfirmasi ijin</label>
                                                            <select name="status" id="" class="form-control">
                                                                <option value="1">disetujui</option>
                                                                <option value="2">tidak disetujui</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="">keterangan ijin</label>
                                                            <input type="text" class="form-control" value=""
                                                                name="keterangan">
                                                        </div>
                                                        <div class="mb-3">
                                                            <button class="btn btn-primary" type="submit">
                                                                <i class="fa fa-save"></i>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @else
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h3>Surat Keterangan Ijin tidak ditemukan</h3>
                                        <a class="btn btn-info" href="{{ url()->previous() }}">Kembali</a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
