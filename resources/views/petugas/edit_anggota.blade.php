@extends('layouts.template')

@section('title', 'Edit Anggota')

@section('content')
<body>
    @include('petugas.navigation')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2 class="font-weight-bold text-center">Edit Anggota</h2>
            </div>
            <div class="card-body">
                <form action="/petugas/edit_anggota_aksi/{{ $anggota->id }}" method="POST">
                @csrf
                @method('PUT')
                    @if (Session::has('error'))
                        <div class="alert alert-danger text-center">
                            {{ Session::get('error') }}
                        </div>
                    @endif

                    <a href="{{ route('showAnggota') }}" class="btn btn-light btn-outline-dark float-right"><i class="fa fa-arrow-left"></i> Kembali</a>
                    <br>

                    <div class="form-group">
                        <label for="nama" class="font-weight-bold">Nama</label>
                        <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Lengkap" value="{{ $anggota->nama }}">
                        <span class="text-danger">@error('nama') {{ $message }} @enderror</span>
                    </div>

                    <div class="form-group">
                        <label for="nik" class="font-weight-bold">NIK</label>
                        <input type="text" name="nik" class="form-control" placeholder="Masukkan NIK">
                        <span class="text-danger">@error('nik') {{ $message }} @enderror</span>
                    </div>

                    <div class="form-group">
                        <label for="alamat" class="font-weight-bold">Alamat</label>
                        <input type="text" name="alamat" class="form-control" placeholder="Masukkan Alamat" value="{{ $anggota->alamat }}">
                        <span class="text-danger">@error('alamat') {{ $message }} @enderror</span>
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