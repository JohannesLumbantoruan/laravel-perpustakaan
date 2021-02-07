@extends('layouts.template')

@section('title', 'Tambah Buku')

@section('content')
<body>
    @include('petugas.navigation')
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center font-weight-bold">Tambah Buku</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('tambahBukuAksi') }}" method="POST">
                        @csrf
                            <a href="{{ route('showBuku') }}" class="btn btn-light btn-outline-dark float-right"><i class="fa fa-arrow-left"></i> Kembali</a>
                            <br><br>

                            <div class="form-group row">
                                <label for="judul" class="font-weight-bold col-form-label col-sm-2 text-left">Judul Buku</label>
                                <div class="col-sm-10">
                                    <input type="text" name="judul" class="form-control" placeholder="Masukkkan judul buku">
                                    <span class="text-danger">@error('judul') {{ $message }} @enderror</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tahun" class="font-weight-bold col-form-label col-sm-2 text-left">Tahun Terbit</label>
                                <div class="col-sm-10">
                                    <select name="tahun" class="form-control">
                                        <option value="">- Pilih Tahun</option>
                                        <?php for($tahun=date('Y'); $tahun>=1990; $tahun--) { ?>
                                        <option value="<?php echo $tahun; ?>"><?php echo $tahun; ?></option>
                                        <?php } ?>
                                    </select>
                                    <span class="text-danger">@error('tahun') {{ $message }} @enderror</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="penulis" class="font-weight-bold col-sm-2 col-form-label text-left">Penulis Buku</label>
                                <div class="col-sm-10">
                                    <input type="text" name="penulis" class="form-control" placeholder="Masukkan nama penulis">
                                    <span class="text-danger">@error('penulis') {{ $message }} @enderror</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-primary btn-block" value="Tambah">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="font-weight-bold">Pilih Cover Buku</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="cover" class="font-weight-bold">Pilih cover buku:</label>
                            <input type="file" name="cover">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection