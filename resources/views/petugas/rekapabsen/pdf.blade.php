@extends('layouts.admin')
@section('title', 'Rekap Absensi')
@section('contents')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h2>@yield('title')</h2>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nis</th>
                                            <th>Nama</th>
                                            <th>Kelas</th>
                                            <th>Tanggal Absen</th>
                                            <th>Status</th>
                                            <th>action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr>
                                                <td>
                                                    {{ $item->siswa->nis }}
                                                </td>
                                                <td>
                                                    {{ $item->siswa->nama_siswa }}
                                                </td>
                                                <td>
                                                    {{ $item->siswa->kelas->nama_kelas }}
                                                </td>
                                                <td>
                                                    {{ $item->tanggal }}
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge @if ($item->status == 'tidak hadir') badge-danger @else badge-success @endif">{{ $item->status }}</span>

                                                    @if ($item->status == 'tidak hadir')
                                                        {{-- <a href="{{ route('absensi.cekletter',$item->siswa_id) }}" class="badge badge-info">cek letter</a> --}}
                                                        <br>
                                                        Keterangan : {{ $item->keterangan }}
                                                    @endif

                                                </td>
                                                <td>
                                                    @if ($item->status == 'tidak hadir' || $item->status == 'hadir')
                                                        <span class="badge badge-success">sudah absen</span>
                                                    @else
                                                        <a href="{{ route('absensi.hadir', $item->id) }}"
                                                            class="btn btn-datatable btn-icon btn-transparent-dark mr-2"><i
                                                                data-feather="check"></i></a>
                                                        <a href="{{ route('absensi.tidakhadir', $item->id) }}"
                                                            class="btn btn-datatable btn-icon btn-transparent-dark mr-2"><i
                                                                data-feather="x"></i></a>
                                                    @endif

                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="5">Hadir</td>
                                            <td>{{ $hadir }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="5">Sakit</td>
                                            <td>{{ $sakit }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="5">Ijin</td>
                                            <td>{{ $ijin }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="5">Alpha</td>
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
    <script>
        window.print();
    </script>
@endsection
