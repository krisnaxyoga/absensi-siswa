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
                                            <img src="{{$item->siswa->foto}}" alt="" class="img-fluid" style="width: 150px;height:200px">
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
<script>
    window.print();
</script>
@endsection
