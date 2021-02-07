@extends('layouts.template')

@section('title', 'Sistem Informasi Perpustakaan')

@section('content')
<body>
    <img src="{{ asset('assets/header-bg.svg') }}" class="position-absolute" id="bg-home" alt="bg-home">
    <img src="{{ asset('assets/header-vector.svg') }}" class="position-absolute" id="bg-home2" alt="bg-home">

    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a href="{{ route('login') }}" class="navbar-brand">
                <h5>SI PERPUSTAKAAN</h5>
            </a>

            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="{{ route('katalog') }}" class="nav-link nav-left"><i class="fa fa-th-list"></i> Katalog Buku</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link nav-left"><i class="fa fa-address-card"></i> Kontak</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link nav-left"><i class="fa fa-address-book"></i> Kontak</a>
                    </li>
                </ul>

                <ul class="navbar-nav ml-auto" id="nav-right">
                    <li class="nav-item">
                        <a href="#" class="nav-link">Daftar</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link ml-3" data-toggle="modal" data-target="#login">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="modal fade" id="login">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="font-weight-bold">LOGIN</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('loginAksi') }}" method="POST">
                    @csrf
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Masukkan Username">
                            <span class="text-danger">@error('username') {{ $message }} @enderror</span>
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Masukkan Password">
                            <span class="text-danger">@error('password') {{ $message }} @enderror</span>
                        </div>

                        <div class="form-group">
                            <label for="sebagai">Login sebagai: </label>
                            <select name="sebagai" class="form-control">
                                <option value="admin">Admin</option>
                                <option value="petugas">Petugas</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary btn-block" value="Login">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container position-relative">
        <div class="row my-5">
            <div class="col-lg-6">
                <div class="row">
                    <h1 class="bold-1 mt-5 mb-3 h2">
                        Sistem Informasi Perpustakan dibuat dengan Laravel
                    </h1>
                    <p class="max-width-4x bold-0">
                        Meminjam buku menjadi mudah, tidak merepotkan, nyaman dan dapat dilakukan dengan cepat 
                    </p>
                    <div class="d-flex my-4" id="flex">
                        <a href="#" class="btn btn-success p-3 mr-3" data-toggle="modal" data-target="#login">Login</a>
                        <a href="#" class="btn btn-primary p-3">Daftar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container" style="margin-top: 150px;">
        <h1 class="font-weight-bold text-center my-3">KATALOG BUKU</h1>
        <div class="card">
            <div class="card-body">
                <a href="{{ route('tambahKatalog') }}" class="btn btn-success float-right mb-3"><i class="fa fa-plus"></i> Tambah Katalog</a>
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