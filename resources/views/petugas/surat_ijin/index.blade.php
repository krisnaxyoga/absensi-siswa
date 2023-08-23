@extends('layouts.admin')
@section('title', 'Absensi')
@section('contents')

    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @if ($letter)
                        <div class="card mb-3">
                            <div class="card-header">
                                Surat Ijin
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>nis</th>
                                                <th>nama</th>
                                                <th>kelas</th>
                                                <th>keterangan</th>
                                                <th>status</th>
                                                <th>file</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($letter as $item)
                                                <tr>
                                                    <td>{{ $item->siswa->nis }}</td>
                                                    <td>{{ $item->siswa->nama_siswa }}</td>
                                                    <td>{{ $item->siswa->kelas->nama_kelas }}</td>
                                                    <td>{{ $item->keterangan }}</td>
                                                    <td>
                                                        @if ($item->status == 1)
                                                            disetujui
                                                        @elseif ($item->status == 2)
                                                            tidak disetujui
                                                        @else
                                                            diproses
                                                        @endif
                                                    </td>
                                                    <td><a href="{{ $item->file }}">{{ $item->file }}</a></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

@endsection
