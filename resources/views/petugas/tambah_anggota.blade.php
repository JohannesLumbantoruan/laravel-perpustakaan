@extends('layouts.template')

@section('title', 'Tambah Anggota')

@section('content')
<body>
    @include('petugas.navigation')
    <div class="container">
        <div class="col-lg-6 offset-lg-3">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center font-weight-bold">Tambah Anggota</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('tambahAnggotaAksi') }}" method="POST">
                    @csrf
                        @if (Session::has('error'))
                            <div class="alert alert-danger text-center">
                                {{ Session::get('error')}}
                            </div>
                        @endif

                        <a href="{{ route('showAnggota') }}" class="btn btn-light btn-outline-dark float-right"><i class="fa fa-arrow-left"></i> Kembali</a>
                        <br>

                        <div class="form-group">
                            <label for="nama" class="font-weight-bold">Nama</label>
                            <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Lengkap" value="{{ old('nama') }}">
                            <span class="text-danger">@error('nama') {{ $message }} @enderror</span>
                        </div>

                        <div class="form-group">
                            <label for="nik" class="font-weight-bold">NIK</label>
                            <input type="text" name="nik" class="form-control" placeholder="Masukkkan NIK" value="{{ old('nik') }}">
                            <span class="text-danger">@error('nik') {{ $message }} @enderror</span>
                        </div>

                        <div class="form-group">
                            <label for="alamat" class="font-weight-bold">Alamat</label>
                            <input type="text" name="alamat" class="form-control" placeholder="Masukkan Alamat" value="{{ old('alamat') }}">
                            <span class="text-danger">@error('alamat') {{ $message }} @enderror</span>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary btn-block" value="Tambah">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection