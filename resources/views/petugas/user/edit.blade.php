@extends('layouts.admin')
@section('title', 'Petugas')
@section('contents')
<section>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <!-- Account details card-->
                <div class="card mb-4">
                    <div class="card-header">Ganti Password</div>
                    <div class="card-body">
                        @if (count($errors) > 0)
                            <div class="alert with-close alert-danger mb-4">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </div>
                        @endif
                        <form action="{{ route('password.update', $id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                                <div class="form-group">
                                    <label class="small mb-1">password</label>
                                    <input class="form-control form-control-solid" name="password" type="password" placeholder="password" value="" />
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