@extends('layouts.admin')
@section('title', 'Petugas')
@section('contents')
    <section>
        <div class="container mt-3">
            <div class="row">
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Siswa</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $siswa }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        absensi</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $absen }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-user fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Kelas</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $kelas }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-home fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <hr>
            <h3>Pengumuman</h3>
            <div class="row">
                @if ($pengumuman->count() != 0)
                    @foreach ($pengumuman as $item)
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header">
                                    <h4>
                                        {{ $item->title }}
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <p>{{ $item->description }}</p>

                                    <p style="font-size: 10px">diunggah : {{ $item->created_at }}</p>
                                </div>
                                <div class="card-footer">
                                    <a href="{{ $item->file }}" class="btn btn-primary"><i
                                            data-feather="download"></i></a>
                                </div>
                            </div>

                        </div>
                    @endforeach
                @else
                    <div class="card">
                        <div class="card-body">
                            Tidak ada pengumuman
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
