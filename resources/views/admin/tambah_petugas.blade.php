@extends('layouts.template')

@section('title', 'Tambah Petugas')

@section('content')
<body>
    @include('admin.navigation')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2 class="font-weight-bold text-center">Tambah Petugas</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('tambahPetugasAksi') }}" method="POST">
                @csrf
                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif

                    @if (Session::has('error'))
                        <div class="alert alert-danger">
                            {{ Session::get('error') }}
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="nama" class="font-weight-bold">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Lengkap" value="{{ old('nama') }}">
                        <span class="text-danger">@error('nama') {{ $message }} @enderror</span>
                    </div>

                    <div class="form-group">
                        <label for="username" class="font-weight-bold">Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Masukkan Username" value="{{ old('username') }}">
                        <span class="text-danger">@error('username') {{ $message }} @enderror</span>
                    </div>

                    <div class="form-group">
                        <label for="password" class="font-weight-bold">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Masukkan Password">
                        <span class="text-danger">@error('password') {{ $message }} @enderror</span>
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary btn-block" value="Tambah">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
@endsection