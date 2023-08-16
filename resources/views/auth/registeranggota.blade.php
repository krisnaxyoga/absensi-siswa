@extends('layouts.auth')

@section('contents')
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="card" style="width: 35rem;">
            <div class="card-header text-center">
                Register
            </div>

            @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card-body">
                <form method="post" id="registerform" action="{{ route('doregist') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name"
                            class="form-control @error('name') is-invalid @enderror" id="name">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Address</label>
                        <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror"
                            id="name">
                        @error('alamat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            id="email">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                            id="name">
                        @error('phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Birthday</label>
                        <input type="date" name="birtday" class="form-control @error('birtday') is-invalid @enderror"
                            id="name">
                        @error('birtday')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                            id="password">
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Sign Up</button>
            </div>
            </form>
        </div>
    </div>
    </div>
    <script>
        //     document.getElementById('registerform').addEventListener('submit', function(event) {
        //     event.preventDefault();

        //     var password = document.getElementById('password').value;
        //     var confirmPassword = document.getElementById('confirmPassword').value;

        //     if (password !== confirmPassword) {
        //         alert('Password is not same. plese input again.');
        //         return;
        //     }

        //     // Lakukan sesuatu dengan password yang cocok
        //     // alert('Password cocok. Data dapat diproses.');
        // });
    </script>
@endsection
