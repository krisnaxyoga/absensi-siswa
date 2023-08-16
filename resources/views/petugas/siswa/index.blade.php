@extends('layouts.admin')
@section('title', 'Siswa')
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
                <div class="card">
                    <div class="card-header">
                        <h2>@yield('title')</h2>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('siswa.create') }}" class="btn btn-primary mb-2">add</a>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>foto</th>
                                        <th>profile</th>
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
                                                <li> <span style="font-weight: bold;">Nama </span>            : {{$item->nama_siswa}}</li>
                                                <li><span style="font-weight: bold;">Nis  </span>             : {{$item->nis}}</li>
                                                <li><span style="font-weight: bold;">Kelas    </span>         : {{$item->kelas->nama_kelas}} / {{$item->kelas->jurusan}}</li>
                                                <li><span style="font-weight: bold;">Telp   </span>           : {{$item->phone}}</li>
                                                <li><span style="font-weight: bold;">Tgl-lahir  </span>       : {{$item->tgl_lahir}}</li>
                                                <li><span style="font-weight: bold;">Agama    </span>         : {{$item->agama}}</li>
                                                <li><span style="font-weight: bold;">Alamat    </span>        : {{$item->alamat}}</li>
                                                <li><span style="font-weight: bold;">Email Orangtua </span>   : <a href="mailto:{{$item->email_orangtua}}">{{$item->email_orangtua}}</a></li>
                                            </ul>
                                        </td>
                                        <td>
                                            <a href="{{ route('siswa.edit',$item->id) }}" class="btn btn-datatable btn-icon btn-transparent-dark mr-2"><i data-feather="edit"></i></a>

                                            <form class="d-inline" action="{{ route('siswa.destroy',$item->id) }}" method="POST" onSubmit="return confirm('Apakah anda yakin akan menghapus data ini?');">
                                                @csrf
                                                @method('delete')

                                                <button type="submit" class="btn btn-datatable btn-icon btn-transparent-dark mr-2">
                                                    <i data-feather="trash-2"></i>
                                                </button>
                                            </form>
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