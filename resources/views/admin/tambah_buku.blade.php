@extends('layouts.template')

@section('title', 'Tambah Buku')

@section('content')
<body>
    @include('admin.navigation')

    <div class="container d-flex justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h2 class="font-weight-bold text-center">TAMBAH BUKU</h2>
                </div>
                <div class="card-body">
                    <span class="d-block mb-5">
                        <a href="{{ route('adminShowBuku') }}" class="btn btn-light btn-outline-dark float-right"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </span>
                    <form action="{{ route('adminTambahBukuAksi') }}" method="POST" enctype="multipart/form-data">
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
                            <label for="isbn" class="font-weight-bold">No. ISBN</label>
                            <input type="text" name="isbn" class="form-control" placeholder="Masukkan no. isbn" value="{{ old('isbn') }}">
                            <span class="text-danger">@error('isbn') {{ $message }} @enderror</span>
                        </div>

                        <div class="form-group">
                            <label for="tahun" class="font-weight-bold">Tahun Penerbitan</label>
                            <select name="tahun" class="form-control" value="{{ old('tahun') }}">
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
                            <label for="kategori" class="font-weight-bold">Kategori</label>
                            <select name="kategori" class="form-control">
                                <option value="">-Pilih Kategori-</option>
                                @foreach ($kategori as $k)
                                <option value="{{ $k->kategori_id }}">{{ $k->kategori_nama }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">@error('kategori') {{ $message }} @enderror</span>
                        </div>

                        <div class="form-group">
                            <label for="jumlah" class="font-weight-bold">Jumlah Buku(Stock)</label>
                            <input type="number" name="jumlah" class="form-control" placeholder="Masukkan jumlah buku(stock)" value="{{ old('jumlah') }}">
                            <span class="text-danger">@error('jumlah') {{ $message }} @enderror</span>
                        </div>

                        <div class="form-group">
                            <label for="deskripsi" class="font-weight-bold">Deskripsi/Sinopsis Buku</label>
                            <textarea name="deskripsi" class="form-control" placeholder="Masukkan deskripsi/sinopsis buku" value="{{ old('deskripsi') }}"></textarea>
                            <span class="text-danger">@error('deskripsi') {{ $message }} @enderror</span>
                        </div>

                        <div class="form-group">
                            <label for="penerbit" class="font-weight-bold">Penerbit Buku</label>
                            <input type="text" name="penerbit" class="form-control" placeholder="Masukkan penerbit buku" value="{{ old('penerbit') }}">
                            <span class="text-danger">@error('penerbit') {{ $message }} @enderror</span>
                        </div>

                        <div class="form-group">
                            <label for="cover" class="font-weight-bold">Cover Buku</label>
                            <br><input type="file" name="cover">
                            <br><span class="text-danger">@error('cover') {{ $message }} @enderror</span>
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