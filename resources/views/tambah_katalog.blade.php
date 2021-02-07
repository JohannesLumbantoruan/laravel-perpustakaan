@extends('layouts.template')

@section('title', 'Tambah Katalog Buku')

@section('content')
<body>
    <div class="container d-flex justify-content-center">
        <div class="col-lg-8 mt-5">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">Tambah Katalog Buku</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('tambahKatalogAksi') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                        @if (Session::has('error'))
                            <div class="alert alert-danger text-center">
                                {{ Session::get('error') }}
                            </div>
                        @endif

                        <div class="form-group row">
                            <label for="judul" class="col-form-label col-3 text-left">Judul Buku</label>
                            <div class="col-9">
                                <input type="text" name="judul" class="form-control" placeholder="Masukkan judul buku" value="{{ old('judul') }}">
                                <span class="text-danger">@error('judul') {{ $message }} @enderror</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="deskripsi" class="col-form-label col-3 text-left">Deskripsi Buku</label>
                            <div class="col-9">
                            <textarea name="deskripsi" class="form-control" placeholder="Masukkan deskripsi buku" value="{{ old('deskripsi') }}"></textarea>
                            <span class="text-danger">@error('deskripsi') {{ $message }} @enderror</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tag" class="col-form-label col-3 text-left">Tag Buku</label>
                            <div class="col-9">
                                <input type="text" name="tag" class="form-control" placeholder="Masukkan tag buku" value="{{ old('tag') }}">
                                <span class="text-danger">@error('tag') {{ $message }} @enderror</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cover" class="col-form-label col-3 text-left">Cover Buku</label>
                            <div class="col-9">
                                <input type="file" name="cover"><br>
                                <span class="text-danger">@error('cover') {{ $message }} @enderror</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="penulis" class="col-form-label col-3 text-left">Penulis Buku</label>
                            <div class="col-9">
                                <input type="text" name="penulis" class="form-control" placeholder="Masukkan nama penulis buku" value="{{ old('penulis') }}">
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
    </div>
</body>
@endsection