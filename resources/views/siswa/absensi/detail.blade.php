@extends('layouts.siswa')
@section('title', 'data absen')
@section('contents')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            Data Absen
                        </div>
                        <div class="p-2">
                            <a href="{{ route('siswa.rekapabsensi') }}" class="btn btn-info">Kembali</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nama siswa</th>
                                            <th>Tanggal</th>
                                            <th>kehadiran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr>
                                                <td>{{ $item->siswa->nama_siswa }}</td>
                                                <td>{{ $item->tanggal }}</td>
                                                <td>
                                                    <span
                                                        class="badge @if ($item->status == 'tidak hadir') badge-danger @else badge-success @endif">{{ $item->status }}</span>

                                                    @if ($item->status == 'tidak hadir')
                                                        Keterangan : {{ $item->keterangan }}
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
