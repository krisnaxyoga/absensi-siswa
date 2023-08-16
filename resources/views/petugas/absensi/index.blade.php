@extends('layouts.admin')
@section('title', 'Absensi')
@section('contents')
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
                @if($letter)
                <div class="card mb-3">
                    <div class="card-header">
                        Surat Ijin
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>siswa</th>
                                        <th>keterangan</th>
                                        <th>status</th>
                                        <th>file</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($letter as $item)
                                        <tr>
                                            <td>{{$item->siswa->nama_siswa}}</td>
                                            <td>{{$item->keterangan}}</td>
                                            <td>
                                                @if ($item->status == 1)
                                                    disetujui
                                                    @elseif ($item->status == 2)
                                                    tidak disetujui
                                                    @else
                                                    diproses
                                                @endif
                                            </td>
                                            <td><a href="{{$item->file}}">{{$item->file}}</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endif

                <div class="card mb-3">
                    <div class="card-body">
                        <form action="{{route('absensi.create')}}" method="GET">
                            <div class="row">
                                <div class="col-lg-4  mb-2">
                                    <select name="kelas" id="" class="form-control">
                                        <option value="">--pilih--</option>
                                        @foreach ($kelas as $item)
                                            <option value="{{$item->id}}">{{$item->nama_kelas}}/{{$item->jurusan}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-4 mb-2">
                                    <input type="date" class="form-control" name="tanggal" value="">
                                </div>
                                <div class="col-lg-3  mb-2">
                                    <button class="btn btn-success" type="submit">add absen</button>
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

                        {{-- <a href="{{ route('absensi.create') }}" class="btn btn-primary mb-2">add absen</a> --}}
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>foto</th>
                                        <th>profile</th>
                                        <th>Tanggal Absen</th>
                                        <th>Status</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                    <tr>
                                        <td>
                                            <img src="{{$item->foto}}" alt="" class="img-fluid" style="width: 150px;height:200px">
                                        </td>
                                        <td>
                                            <ul>
                                                <li> <span style="font-weight: bold;">Nama </span>            : {{$item->siswa->nama_siswa}}</li>
                                                <li><span style="font-weight: bold;">Nis  </span>             : {{$item->siswa->nis}}</li>
                                                <li><span style="font-weight: bold;">Kelas    </span>         : {{$item->siswa->kelas->nama_kelas}} / {{$item->siswa->kelas->jurusan}}</li>
                                                <li><span style="font-weight: bold;">Telp   </span>           : {{$item->siswa->phone}}</li>
                                                <li><span style="font-weight: bold;">Tgl-lahir  </span>       : {{$item->siswa->tgl_lahir}}</li>
                                                <li><span style="font-weight: bold;">Agama    </span>         : {{$item->siswa->agama}}</li>
                                                <li><span style="font-weight: bold;">Alamat    </span>        : {{$item->siswa->alamat}}</li>
                                                <li><span style="font-weight: bold;">Email Orangtua </span>   : <a href="mailto:{{$item->siswa->email_orangtua}}">{{$item->siswa->email_orangtua}}</a></li>
                                            </ul>
                                        </td>
                                        <td>
                                            {{$item->tanggal}}
                                        </td>
                                        <td>
                                            <span class="badge @if($item->status == 'tidak hadir') badge-danger @else badge-success @endif">{{$item->status}}</span>

                                            @if($item->status == 'tidak hadir')
                                              <a href="{{ route('absensi.cekletter',$item->siswa_id) }}" class="badge badge-info">cek letter</a>
                                              <br>
                                              Keterangan : {{ $item->keterangan }}
                                            @endif

                                        </td>
                                        <td>
                                            @if ($item->status == 'tidak hadir' || $item->status == 'hadir')
                                           <span class="badge badge-success">sudah absen</span>
                                            @else
                                            <a href="{{ route('absensi.hadir',$item->id) }}" class="btn btn-datatable btn-icon btn-transparent-dark mr-2"><i data-feather="check"></i></a>
                                            <a href="{{ route('absensi.tidakhadir',$item->id) }}" class="btn btn-datatable btn-icon btn-transparent-dark mr-2"><i data-feather="x"></i></a>

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
