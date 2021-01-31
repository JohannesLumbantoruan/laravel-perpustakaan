@extends('layouts.template')

@section('title', 'Ganti Password Admin')

@section('content')
    @include('admin.navigation')
    <div class="container">
        <div class="col-lg-6 offset-lg-3">
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

                        <div class="form-group">
                            <label for="password_baru" class="font-weight-bold">Password Baru</label>
                            <input type="password" name="password_baru" class="form-control" placeholder="Masukkan password baru">
                            <span class="text-danger">@error('password_baru') {{ $message }} @enderror</span>
                        </div>

                        <div class="form-group">
                            <label for="password_ulang" class="font-weight-bold">Ulangi Password</label>
                            <input type="password" name="password_ulang" class="form-control" placeholder="Ulangi Password">
                            <span class="text-danger">@error('password_baru') {{ $message }} @enderror</span>
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