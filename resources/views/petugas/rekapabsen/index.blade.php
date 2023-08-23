@extends('layouts.admin')
@section('title', 'Rekap Absensi')
@section('contents')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/printThis/1.15.0/printThis.min.js"></script>


    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @if (session()->has('message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="card mb-3">
                        <div class="card-body">
                            @php
                                $class = Request::get('kelas');
                                $tgl = Request::get('tanggal');
                                if ($class || $tgl) {
                                    $option = $class;
                                    $tanggal = $tgl;
                                } else {
                                    $option = '';
                                    $tanggal = '';
                                }
                            @endphp
                            <form action="{{ route('rekapabsensi.index') }}" method="GET">
                                <div class="row">
                                    <div class="col-lg-4  mb-2">
                                        <select name="kelas" id="" class="form-control">
                                            <option value="">--pilih--</option>
                                            @foreach ($kelas as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $item->id == $option ? 'selected' : '' }}>
                                                    {{ $item->nama_kelas }}/{{ $item->jurusan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-4 mb-2">
                                        <input type="date" class="form-control" name="tanggal"
                                            value="{{ $tanggal }}">
                                    </div>
                                    <div class="col-lg-3  mb-2">
                                        <button class="btn btn-success" type="submit"> <i class="fa fa-search"></i>
                                            search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h2>@yield('title')</h2>

                        </div>
                        <div class="card-body">
                            <a class="btn btn-primary mb-3"
                                href="{{ route('cetakpdf.index', ['kelas' => $class, 'tanggal' => $tanggal]) }}"><i
                                    data-feather="printer"></i> Cetak</a>
                            {{-- <a href="{{ route('absensi.create') }}" class="btn btn-primary mb-2">add absen</a> --}}
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nis</th>
                                            <th>Nama</th>
                                            <th>Kelas</th>
                                            <th>Email Ortu</th>
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
                                                    <a
                                                        href="mailto:{{ $item->siswa->email_orangtua }}">{{ $item->siswa->email_orangtua }}</a>
                                                </td>
                                                <td>
                                                    {{ $item->tanggal }}
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge @if ($item->status == 'tidak hadir') badge-danger @else badge-success @endif">{{ $item->status }}</span>

                                                    @if ($item->status == 'tidak hadir')
                                                        <a href="{{ route('absensi.cekletter', $item->siswa_id) }}"
                                                            class="badge badge-info">cek letter</a>
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
                                            <td colspan="6">Hadir</td>
                                            <td>{{ $hadir }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6">Sakit</td>
                                            <td>{{ $sakit }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6">Ijin</td>
                                            <td>{{ $ijin }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6">Alpha</td>
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
