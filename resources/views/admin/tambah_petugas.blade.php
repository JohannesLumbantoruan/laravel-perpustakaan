@extends('layouts.template')

@section('title', 'Tambah Petugas')

@section('content')
<body>
    @include('admin.navigation')
    <div class="container d-flex justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h2 class="font-weight-bold text-center">Tambah Petugas</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('tambahPetugasAksi') }}" method="POST" enctype="multipart/form-data">
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

                        <div class="form-group row">
                            <label for="nama" class="font-weight-bold col-form-label col-4 text-left">Nama Lengkap</label>
                            <div class="col-8">
                                <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Lengkap" value="{{ old('nama') }}">
                                <span class="text-danger">@error('nama') {{ $message }} @enderror</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="username" class="font-weight-bold col-form-label col-4 text-left">Username</label>
                            <div class="col-8">
                                <input type="text" name="username" class="form-control" placeholder="Masukkan Username" value="{{ old('username') }}">
                                <span class="text-danger">@error('username') {{ $message }} @enderror</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="font-weight-bold col-form-label col-4 text-left">Password</label>
                            <div class="col-8">
                                <input type="password" name="password" class="form-control" placeholder="Masukkan Password">
                                <span class="text-danger">@error('password') {{ $message }} @enderror</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="no_hp" class="font-weight-bold col-form-label col-4 text-left">No. HP</label>
                            <div class="col-8">
                                <input type="text" name="no_hp" class="form-control" placeholder="Masukkan no. hp" value="{{ old('no_hp') }}">
                                <span class="text-danger">@error('no_hp') {{ $message }} @enderror</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="foto" class="font-weight-bold col-form-label col-4 text-left">Upload Foto Petugas:</label>
                            <div class="col-8">
                                <input type="file" name="foto">
                                <br><span class="text-danger">@error('foto') {{ $message }} @enderror</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary btn-block" value="Tambah">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('admin.footer')
</body>
@endsection