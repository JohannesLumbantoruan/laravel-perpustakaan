@extends('layouts.template')

@section('title', 'Edit Petugas')

@section('content')
<body>
    @include('admin.navigation')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2 class="font-weight-bold text-center">Edit Petugas</h2>
            </div>
            <div class="card-body">
                <form action="/admin/edit_petugas_aksi/{{ $petugas->id }}" method="POST">
                @csrf
                @method('PUT')
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
                        <label for="nama" class="font-weight-bold">Nama</label>
                        <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Lengkap" value="{{ $petugas->nama }}">
                        <span class="text-danger">@error('nama') {{ $message }} @enderror</span>
                    </div>

                    <div class="form-group">
                        <label for="username" class="font-weight-bold">Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Masukkan Password" value="{{ $petugas->username }}">
                        <span class="text-danger">@error('username') {{ $message }} @enderror</span>
                    </div>

                    <div class="form-group">
                        <label for="password" class="font-weight-bold">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Masukkan Password">
                        <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah password</small>
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary btn-block" value="Simpan">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
@endsection