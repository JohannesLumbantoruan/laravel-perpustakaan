@extends('layouts.template')

@section('title', 'Tambah Buku')

@section('content')
<body>
    @include('petugas.navigation')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2 class="text-center font-weight-bold">Tambah Buku</h2>
            </div>
            <div class="card-body">
                <a href="{{ route('showBuku') }}" class="btn btn-light btn-outline-dark float-right"><i class="fa fa-arrow-left"></i> Kembali</a>
                <br>

                <form action="{{ route('tambahBukuAksi') }}" method="POST">
                @csrf
                    <div class="form-group">
                        <label for="judul" class="font-weight-bold">Judul Buku</label>
                        <input type="text" name="judul" class="form-control" placeholder="Masukkkan judul buku">
                        <span class="text-danger">@error('judul') {{ $message }} @enderror</span>
                    </div>

                    <div class="form-group">
                        <label for="tahun" class="font-weight-bold">Tahun Terbit</label>
                        <select name="tahun" class="form-control">
                            <option value="">- Pilih Tahun</option>
                            <?php for($tahun=date('Y'); $tahun>=1990; $tahun--) { ?>
                            <option value="<?php echo $tahun; ?>"><?php echo $tahun; ?></option>
                            <?php } ?>
                        </select>
                        <span class="text-danger">@error('tahun') {{ $message }} @enderror</span>
                    </div>

                    <div class="form-group">
                        <label for="penulis" class="font-weight-bold">Penulis Buku</label>
                        <input type="text" name="penulis" class="form-control" placeholder="Masukkan nama penulis">
                        <span class="text-danger">@error('penulis') {{ $message }} @enderror</span>
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