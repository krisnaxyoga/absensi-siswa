@extends('layouts.admin')
@section('title', 'Petugas')
@section('contents')
<section>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <!-- Account details card-->
                <div class="card mb-4">
                    <div class="card-header">@if($model->exists) Edit @else Tambah @endif  @yield('title')</div>
                    <div class="card-body">
                        @if (count($errors) > 0)
                            <div class="alert with-close alert-danger mb-4">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </div>
                        @endif
                        <form action="@if($model->exists) {{ route('petugas.update', $model->id) }} @else {{ route('petugas.store') }} @endif" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method($model->exists ? 'PUT' : 'POST')
    
                            <div class="form-group">
                                <label class="small mb-1">Nama Petugas <span class="text-danger">*</span></label>
                                <input class="form-control form-control-solid" name="nama_petugas" type="text" placeholder="nama_petugas" value="{{ old('nama_petugas', $model->nama_petugas) }}" />
                            </div>

                            @php
                            if ($model->user) {
                                $email = $model->user->email;
                              } else {
                                $email = null;
                              }
                              @endphp

                            <div class="form-group">
                                <label class="small mb-1">Email <span class="text-danger">*</span></label>
                                <input class="form-control form-control-solid" name="email" type="text" placeholder="email" value="{{ old('email', $email) }}" />
                            </div>

                            <div class="form-group">
                                <label class="small mb-1">telepon </label>
                                <input class="form-control form-control-solid" name="phone" type="text" placeholder="phone" value="{{ old('phone', $model->phone) }}" />
                            </div>

                            <div class="form-group">
                                <label class="small mb-1">Alamat</label>
                                <input class="form-control form-control-solid" name="alamat" type="text" placeholder="alamat" value="{{ old('alamat', $model->alamat) }}" />
                            </div>
                            @if(!$model->exists)
                                <div class="form-group">
                                    <label class="small mb-1">password</label>
                                    <input class="form-control form-control-solid" name="password" type="password" placeholder="password" value="{{ old('password', $model->password) }}" />
                                </div>
                            @endif
                            <div class="form-group">
                                <button class="btn btn-primary float-right" type="submit"><i class="far fa-save mr-1"></i> Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection