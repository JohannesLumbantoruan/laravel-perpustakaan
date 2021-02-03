@extends('layouts.template')

@section('title', 'Ganti Password Admin')

@section('content')
    @include('admin.navigation')
    <div class="container d-flex justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center font-weight-bold">Ganti Password</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('adminGantiPasswordAksi') }}" method="POST">
                    @csrf
                    @method('PUT')
                        @if (Session::has('success'))
                            <div class="alert alert-success text-center">
                                {{ Session::get('success') }}
                            </div>
                        @endif

                        @if (Session::has('error'))
                            <div class="alert alert-danger">
                                {{ Session::get('error') }}
                            </div>
                        @endif

                        <div class="form-group row">
                            <label for="password_lama" class="font-weight-bold col-form-label col-3 text-left">Password Lama</label>
                            <div class="col-9">
                                <input type="password" name="password_lama" class="form-control" placeholder="Password Lama">
                                <span class="text-danger">@error('password_lama') {{ $message }} @enderror</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password_baru" class="font-weight-bold col-form-label col-3 text-left">Password Baru</label>
                            <div class="col-9">
                                <input type="password" name="password_baru" class="form-control" placeholder="Masukkan password baru">
                                <span class="text-danger">@error('password_baru') {{ $message }} @enderror</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password_ulang" class="font-weight-bold col-form-label col-3 text-left">Ulangi Password</label>
                            <div class="col-9">
                                <input type="password" name="password_ulang" class="form-control" placeholder="Ulangi Password">
                                <span class="text-danger">@error('password_baru') {{ $message }} @enderror</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary btn-block" value="Ubah Password">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection