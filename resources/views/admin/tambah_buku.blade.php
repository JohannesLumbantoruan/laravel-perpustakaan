@extends('layouts.template')

@section('title', 'Tambah Buku')

@section('content')
<body>
    @include('admin.navigation')

    <div class="container">
        <div class="col-md-6 offset-md-3 mt-5">
            <div class="card">
                <div class="card-header">
                    <h2 class="font-weight-bold text-center">TAMBAH BUKU</h2>
                </div>
                <div class="card-body">
                    <a href="{{ route('adminShowBuku') }}" class="btn btn-light btn-outline-dark float-right"><i class="fa fa-arrow-left"></i> Kembali</a>
                    <br><br>

                    <form action="{{ route('adminTambahBukuAksi') }}" method="POST">
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
                            <label for="judul" class="font-weight-bold">Judul Buku</label>
                            <input type="text" name="judul" class="form-control" placeholder="Masukkan Judul Buku" value="{{ old('judul') }}">
                            <span class="text-danger">@error('judul') {{ $message }} @enderror</span>
                        </div>

                        <div class="form-group">
                            <label for="tahun" class="font-weight-bold">Tahun Penerbitan</label>
                            <select name="tahun" class="form-control">
                                <option value="">- Pilih Tahun</option>
                                <?php for ($tahun=date('Y'); $tahun>=1990; $tahun--) { ?>
                                <option value="<?php echo $tahun; ?>"><?php echo $tahun; ?></option>
                                <?php } ?>
                            </select>
                            <span class="text-danger">@error('tahun') {{ $message }} @enderror</span>
                        </div>

                        <div class="form-group">
                            <label for="penulis" class="font-weight-bold">Penulis Buku</label>
                            <input type="text" name="penulis" class="form-control" placeholder="Masukkan Nama Penulis Buku" value="{{ old('penulis') }}">
                            <span class="text-danger">@error('penulis') {{ $message }} @enderror</span>
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