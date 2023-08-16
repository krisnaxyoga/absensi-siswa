@extends('layouts.admin')
@section('title', 'Pengumuman')
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
                        <form action="@if($model->exists) {{ route('pengumuman.update', $model->id) }} @else {{ route('pengumuman.store') }} @endif" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method($model->exists ? 'PUT' : 'POST')

                            <div class="form-group">
                                <label class="small mb-1">Judul</label>
                                <input class="form-control form-control-solid" name="title" type="text" placeholder="title" value="{{ old('title', $model->nama_kelas) }}" />
                            </div>
                            <div class="form-group">
                                <label class="small mb-1">Keterangan</label>
                                <textarea class="form-control" name="description" id="" cols="30" rows="10">
                                    {{old('description',$model->description)}}
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="">file</label>
                                <input type="file" class="form-control" name="file">
                            </div>
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
