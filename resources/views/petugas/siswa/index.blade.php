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
                            <form action="{{ route('siswa.index') }}" method="get">
                                <div class="d-flex mb-3">
                                    <div class="mr-2">

                                        {{-- Untuk mengambil nilai kelas dari URL dan kemudian membuat opsi select dipilih, Anda dapat menggunakan kode berikut: --}}
                                        @php
                                            $class = Request::get('kelas');
                                            
                                            if ($class) {
                                                $option = $class;
                                            } else {
                                                $option = '';
                                            }
                                        @endphp

                                        <select name="kelas" id="" class="form-control">
                                            <option value="all">--pilih--</option>
                                            @foreach ($kelas as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $item->id == $option ? 'selected' : '' }}>
                                                    {{ $item->nama_kelas }}/{{ $item->jurusan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mr-2">
                                        <button type="submit" class="btn btn-success">
                                            <i class="fa fa-search" aria-hidden="true"></i> filter
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nis</th>
                                            <th>Nama</th>
                                            <th>Kelas</th>
                                            <th>action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr>
                                                <td>
                                                    {{ $item->nis }}
                                                </td>
                                                <td>
                                                    {{ $item->nama_siswa }}
                                                </td>
                                                <td>
                                                    {{ $item->kelas->nama_kelas }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('siswa.edit', $item->id) }}"
                                                        class="btn btn-datatable btn-icon btn-transparent-dark mr-2"><i
                                                            data-feather="edit"></i></a>

                                                    <form class="d-inline" action="{{ route('siswa.destroy', $item->id) }}"
                                                        method="POST"
                                                        onSubmit="return confirm('Apakah anda yakin akan menghapus data ini?');">
                                                        @csrf
                                                        @method('delete')

                                                        <button type="submit"
                                                            class="btn btn-datatable btn-icon btn-transparent-dark mr-2">
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
