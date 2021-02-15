@extends('layouts.template')

@section('title', 'Login Sistem Informasi Perpustakaan')

@section("content")
<body style="background-image: url(/assets/bg-content.svg);">

    <div class="container">
        <div class="judul">
            <h3 class="font-weight-bold text-center">SISTEM INFORMASI</h3>
            <h2 class="font-weight-bold text-center mb-5"><b>PERPUSTAKAAN</b></h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-4" id="login-row">
                <img src="{{ asset('assets/content-vector.svg') }}" alt="" id="bg-login">
            </div>
            <div class="col-md-4" id="login-row">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('loginAksi') }}" method="POST">
                    @csrf
                        @if (Session::has('success'))
                            <div class="alert alert-success text-center">
                                {{ Session::get('success') }}
                            </div>
                        @endif

                        @if (Session::has('error'))
                            <div class="alert alert-danger text-center">
                                {{ Session::get('error') }}
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Masukkan Username">
                            <span class="text-danger">@error('username') {{ $message }} @enderror</span>
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Masukkan Password">
                            <span class="text-danger">@error('password') {{ $message }} @enderror</span>
                        </div>

                        <div class="form-group">
                            <label for="sebagai">Login sebagai: </label>
                            <select name="sebagai" class="form-control">
                                <option value="admin">Admin</option>
                                <option value="petugas">Petugas</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary btn-block" value="Login">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
</body>
@endsection