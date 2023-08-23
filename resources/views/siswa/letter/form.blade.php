@extends('layouts.siswa')
@section('title', 'Surat Ijin')
@section('contents')
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
                                action="@if ($model->exists) {{ route('letter.update', $model->id) }} @else {{ route('letter.store') }} @endif"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @method($model->exists ? 'PUT' : 'POST')

                                <div class="form-group">
                                    <label class="small mb-1">Keterangan <span class="text-danger">*</span></label>
                                    <input class="form-control form-control-solid" name="keterangan" type="text"
                                        placeholder="keterangan" value="{{ old('keterangan', $model->keterangan) }}" />
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1">File Surat<span class="text-danger">*</span></label>
                                    <input class="form-control form-control-solid" name="file" type="file"
                                        placeholder="file" value="{{ old('file', $model->file) }}" />
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1">Tanggal Ijin<span class="text-danger">*</span></label>
                                    <input class="form-control form-control-solid" name="date" type="date"
                                        placeholder="date" value="{{ old('date', $model->date) }}" />
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary float-right" type="submit"><i
                                            class="far fa-save mr-1"></i> Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
