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
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTables" width="100%" cellspacing="0">
                                    {{-- <thead>
                                        <tr>
                                            <th>Nama siswa</th>
                                            <th>Tanggal</th>
                                            <th>kehadiran</th>
                                        </tr>
                                    </thead> --}}
                                    {{-- <tbody>
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
                                    </tbody> --}}
                                    <tfoot>
                                        <tr>
                                            <td colspan="2" style="font-weight: 700"><a
                                                    href="{{ route('siswa.rekapabsensi_detail', ['keterangan' => 'hadir']) }}">hadir</a>
                                            </td>
                                            <td>{{ $hadir }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="font-weight: 700"><a
                                                    href="{{ route('siswa.rekapabsensi_detail', ['keterangan' => 'sakit']) }}">sakit</a>
                                            </td>
                                            <td>{{ $sakit }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="font-weight: 700"><a
                                                    href="{{ route('siswa.rekapabsensi_detail', ['keterangan' => 'ijin']) }}">ijin</a>
                                            </td>
                                            <td>{{ $ijin }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="font-weight: 700"><a
                                                    href="{{ route('siswa.rekapabsensi_detail', ['keterangan' => 'alpha']) }}">alpha</a>
                                            </td>
                                            <td>{{ $alpha }}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
