@extends('layouts.template')

@section('title', 'Edit Buku')

@section('content')
<body>
    @include('admin.navigation')

    <div class="container">
        <div class="col-md-6 offset-md-3 mt-5">
            <div class="card">
                <div class="card-header">
                    <h2 class="font-weight-bold text-center">EDIT BUKU</h2>
                </div>
                <div class="card-body">
                    <a href="{{ route('adminShowBuku') }}" class="btn btn-light btn-outline-dark float-right"><i class="fa fa-arrow-left"></i> Kembali</a>
                    <br>

                    <form action="/admin/edit_buku_aksi/{{ $buku->id }}" method="POST">
                    @csrf
                    @method('PUT')
                        @if (Session::has('success'))
                            <div class="alert alert-success text-center">
                                {{ Session::get('success') }}
                            </div>
                        @endif

                        @if (Session::has('error'))
                            <div class="alert alert-danger text-cenr">
                                {{ Session::get('error') }}
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="judul" class="font-weight-bold">Judul Buku</label>
                            <input type="text" name="judul" class="form-control" placeholder="Masukkan judul buku" value="{{ $buku->judul }}">
                            <span class="text-danger">@error('judul') {{ $message }} @enderror</span>
                        </div>

                        <div class="form-group">
                            <label for="tahun" class="font-weight-bold">Tahun Terbit</label>
                            <select name="tahun" class="form-control">
                                <option value="">- Pilih Tahun</option>
                                <?php for ($tahun=date('Y'); $tahun>=1990; $tahun--) { ?>
                                <option <?php if ($tahun == $buku->tahun) {echo "selected='selected'";} ?> value="<?php echo $tahun; ?>"><?php echo $tahun; ?></option>
                                <?php } ?>
                            </select>
                            <span class="text-danger">@error('tahun') {{ $message }} @enderror</span>
                        </div>

                        <div class="form-group">
                            <label for="penulis" class="font-weight-bold">Penulis</label>
                            <input type="text" name="penulis" class="form-control" placeholder="Masukkan nama penulis buku" value="{{ $buku->penulis }}">
                            <span class="text-danger">@error('penulis') {{ $message }} @enderror</span>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary btn-block" value="Simpan">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection