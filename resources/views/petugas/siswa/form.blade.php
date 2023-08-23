@extends('layouts.admin')
@section('title', 'Siswa')
@section('contents')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <section>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <!-- Account details card-->
                    <div class="card mb-4">
                        <div class="card-header">
                            @if ($model->exists)
                                Edit
                            @else
                                Tambah
                            @endif @yield('title')
                        </div>
                        <div class="card-body">
                            @if (count($errors) > 0)
                                <div class="alert with-close alert-danger mb-4">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </div>
                            @endif

                            <form
                                action="@if ($model->exists) {{ route('siswa.update', $model->id) }} @else {{ route('siswa.store') }} @endif"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @method($model->exists ? 'PUT' : 'POST')

                                <div class="form-group">
                                    <label class="small mb-1">nama siswa <span class="text-danger">*</span></label>
                                    <input class="form-control form-control-solid" name="nama_siswa" type="text"
                                        placeholder="nama_siswa" value="{{ old('nama_siswa', $model->nama_siswa) }}" />
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1">Kelas <span class="text-danger">*</span></label>
                                    <select name="kelas_id" id="" class="form-select form-control">
                                        <option value="">Select name of class</option>
                                        @foreach ($kelas as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('kelas_id', $model->kelas_id) == $item->id ? 'selected' : '' }}>
                                                {{ $item->nama_kelas }}-{{ $item->jurusan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1">nis<span class="text-danger">*</span></label>
                                    <input class="form-control form-control-solid" name="nis" type="text"
                                        placeholder="nis" value="{{ old('nis', $model->nis) }}" />
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
                                    <input class="form-control form-control-solid" name="email" type="text"
                                        placeholder="email" value="{{ old('email', $email) }}" />
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1">jenis kelamin<span class="text-danger">*</span></label>
                                    <select name="jenis_kelamin" id="" class="form-select form-control">
                                        <option value="laki-laki"
                                            {{ old('jenis_kelamin', $model->jenis_kelamin) == 'laki-laki' ? 'selected' : '' }}>
                                            laki-laki</option>
                                        <option value="perempuan"
                                            {{ old('jenis_kelamin', $model->jenis_kelamin) == 'perempuan' ? 'selected' : '' }}>
                                            perempuan</option>
                                    </select>
                                </div>
                                @if ($model->exists)
                                    <div class="form-group">
                                        <label class="small mb-1">tanggal lahir</label>
                                        <input class="form-control form-control-solid" name="tgl_lahir" type="date"
                                            placeholder="tgl_lahir" value="{{ old('tgl_lahir', $model->tgl_lahir) }}" />
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1">tempat lahir</label>
                                        <input class="form-control form-control-solid" name="tempat_lahir" type="text"
                                            placeholder="tempat_lahir"
                                            value="{{ old('tempat_lahir', $model->tempat_lahir) }}" />
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1">agama</label>
                                        <input class="form-control form-control-solid" name="agama" type="text"
                                            placeholder="agama" value="{{ old('agama', $model->agama) }}" />
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label class="small mb-1">email orangtua <span class="text-danger">*</span></label>
                                    <input class="form-control form-control-solid" name="email_orangtua" type="text"
                                        placeholder="email_orangtua"
                                        value="{{ old('email_orangtua', $model->email_orangtua) }}" />
                                </div>
                                @if ($model->exists)
                                    <div class="form-group">
                                        <label class="small mb-1">no.telepon</label>
                                        <input class="form-control form-control-solid" name="phone" type="text"
                                            placeholder="phone" value="{{ old('phone', $model->phone) }}" />
                                    </div>
                                    @if ($model->exists)
                                        <div class="form-group">
                                            <img src="{{ $model->foto }}" alt="" style="width: 200px ">
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <label class="small mb-1">foto</label>
                                        <input class="form-control form-control-solid" id="image-input" name="foto"
                                            type="file" placeholder="foto" value="{{ old('foto', $model->foto) }}" />

                                        <img id="image-preview" class="mt-3" style="width: 200px" src="#"
                                            alt="Preview">
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1">alamat</label>
                                        <textarea name="alamat" class="form-control" id="" cols="30" rows="10">
                                    {{ old('alamat', $model->alamat) }}
                                </textarea>
                                @endif
                        </div>
                        <div class="form-group" style="padding-right: 10px; box-sizing: border-box;">
                            <button class="btn btn-primary float-right" type="submit"><i class="far fa-save mr-1"></i>
                                Simpan</button>
                            <a class="btn btn-primary float-right" href="{{ route('siswa.index') }}"
                                style="margin-right: 10px"><svg xmlns="http://www.w3.org/2000/svg" height="1em"
                                    viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                    <style>
                                        svg {
                                            fill: #ffffff
                                        }
                                    </style>
                                    <path
                                        d="M34.52 239.03L228.87 44.69c9.37-9.37 24.57-9.37 33.94 0l22.67 22.67c9.36 9.36 9.37 24.52.04 33.9L131.49 256l154.02 154.75c9.34 9.38 9.32 24.54-.04 33.9l-22.67 22.67c-9.37 9.37-24.57 9.37-33.94 0L34.52 272.97c-9.37-9.37-9.37-24.57 0-33.94z" />
                                </svg>
                                Kembali</a>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            // Mengaktifkan event change pada input file
            $('#image-input').change(function() {
                // Mengecek apakah ada file yang dipilih
                if (this.files && this.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        // Menampilkan pratinjau gambar pada elemen img
                        $('#image-preview').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(this.files[0]);
                }
            });
        });
    </script>
@endsection
