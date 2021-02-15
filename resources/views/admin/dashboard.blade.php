@extends('layouts.template')

@section('title', 'Dashboard Admin')

@section('content')
<body class="flex-wrapper">
    @include('admin.navigation')
    <div class="container">
        <div class="jumbotron text-center">
            <div class="col-sm-8 mx-auto">
                <h1>Selamat datang!</h1>
                <p><b>WEB ini merupakan Sistem Informasi Perpustakaan yang dibuat menggunakan framework Laravel</b></p>
                <p>Anda telah login sebagai <b>{{ Auth::guard('admin')->user()->username }}</b> [admin]</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h1>
                            <i class="fa fa-book"></i>
                            <div class="float-right">
                                {{ $buku }}
                            </div>
                        </h1>
                        Jumlah Buku
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card bg-danger text-white">
                    <div class="card-body">
                        <h1>
                            <i class="fa fa-users"></i>
                            <div class="float-right">
                                {{ $anggota }}
                            </div>
                        </h1>
                        Jumlah Anggota
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <h1>
                            <i class="fa fa-book"></i>
                            <div class="float-right">
                                {{ $peminjaman }}
                            </div>
                        </h1>
                        Jumlah Peminjaman
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h1>
                            <i class="fa fa-user"></i>
                            <div class="float-right">
                                {{ $petugas }}
                            </div>
                        </h1>
                        Jumlah Petugas
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.footer')
</body>

@endsection