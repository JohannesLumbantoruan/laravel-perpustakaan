@extends('layouts.template')

@section('title', 'Daftar Katalog Buku')

@section('content')
<body class="bg-light">
    <nav class="navbar navbar-expand-lg bg-info">
        <div class="container">
            <a href="{{ route('login') }}" class="navbar-brand" id="brand">
                <h5>SI PERPUSTAKAAN</h5>
            </a>

            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav" id="navbar-left">
                    <li class="nav-item">
                        <a href="{{ route('katalog') }}" class="nav-link"><i class="fa fa-th-list"></i> Katalog</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link"><i class="fa fa-address-card"></i> Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link"><i class="fa fa-address-book"></i> Kontak</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto" id="nav-right">
                    <li class="nav-item">
                        <a href="#" class="nav-link">Register</a>
                    </li>
                    <li class="nav-item">
                        <a href="#login" class="nav-link ml-3">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="container">
        <h1 class="font-weight-bold text-center my-3">KATALOG BUKU</h1>
        <div class="card">
            <div class="card-body">
                <a href="#" class="btn btn-success float-right mb-3" data-toggle="modal" data-target="#tambahKatalog" id="tambahKatalog"><i class="fa fa-plus"></i> Tambah Katalog</a>
                <div class="modal fade" id="tambahKatalog">
                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title font-weight-bold">Tambah Katalog</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                            <form action="{{ route('tambahKatalogAksi') }}" method="POST" enctype="multipart/form-data">
                                @csrf
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
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <br><br><br>
                
                <div class="row">              
                @foreach ($katalog as $k)
                    <div class="col-md-3 mb-3">
                        <img src="{{ ('/gambar/'. $k->foto) }}" alt="cover buku" class="card-img-top" style="height: 150px">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?php if (strlen($k->judul) > 30){$k->judul = substr($k->judul, 0, 30)."...";} ?> {{ $k->judul }}</h5>
                                <p class="card-text"><?php if (strlen($k->deskripsi) > 45){$k->deskripsi = substr($k->deskripsi, 0, 45)."...";} ?>{{ $k->deskripsi }}</p>
                            </div>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">{{"Post on ".date('d/m/Y h:i', strtotime($k->created_at)) }}</small>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</body>
@endsection