<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5">
    <div class="container">
        <a href="{{ route('login') }}" class="navbar-brand">SI PERPUSTAKAAN</a>

        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarText">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a href="{{ route('petugasDashboard') }}" class="nav-link"><i class="fa fa-home"></i> Dashboard</a>
                </li>
                <li class="nav-item">
                    <div class="dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-users"></i> Anggota</a>
                        <div class="dropdown-menu">
                            <a href="{{ route('showAnggota') }}" class="dropdown-item"><i class="fa fa-list-alt"></i> Daftar Anggota</a>
                            <a href="{{ route('tambahAnggota') }}" class="dropdown-item"><i class="fa fa-user-plus"></i> Tambah Anggota</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <div class="dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-book"></i> Buku</a>
                        <div class="dropdown-menu">
                            <a href="{{ route('showBuku') }}" class="dropdown-item"><i class="fa fa-list-alt"></i> Daftar Buku</a>
                            <a href="{{ route('tambahBuku') }}" class="dropdown-item"><i class="fa fa-book-open"></i> Tambah Buku</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <div class="dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-book-reader"></i> Peminjaman</a>
                        <div class="dropdown-menu">
                            <a href="{{ route('showPeminjaman') }}" class="dropdown-item"><i class="fa fa-list-alt"></i> Daftar Peminjaman</a>
                            <a href="{{ route('tambahPeminjaman') }}" class="dropdown-item"><i class="fa fa-random"></i> Tambah Peminjaman</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="{{ route('laporanPeminjaman') }}" class="nav-link"><i class="fa fa-file-alt"></i> Laporan Peminjaman</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('katalog') }}" class="nav-link"><i class="fa fa-th-list"></i> Katalog</a>
                </li>
            </ul>

            <div class="dropdown">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    Hai, {{ Auth::guard('petugas')->user()->username }}
                </button>
                <div class="dropdown-menu">
                    <a href="#contoh" class="dropdown-item" data-toggle="modal" data-target="#gantiPassword"><i class="fa fa-lock"></i> Ganti Password</a>
                    <a href="{{ route('petugasLogout') }}" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>
                </div>
                <div class="modal fade" id="gantiPassword">
                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title font-weight-bold">Ganti Password</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                            <form action="{{ route('petugasGantiPasswordAksi') }}" method="POST">
                                @csrf
                                @method('PUT')
                                    <div class="form-group">
                                        <label for="password_lama" class="font-weight-bold">Password Lama</label>
                                        <input type="password" name="password_lama" class="form-control" placeholder="Masukkan password lama">
                                        <span class="text-danger">@error('password') {{ $message }} @enderror</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="password_baru" class="font-weight-bold">Password Baru</label>
                                        <input type="password" name="password_baru" class="form-control" placeholder="Masukkan Password Baru">
                                        <span class="text-danger">@error('password_baru') {{ $message }} @enderror</span>
                                    </div>

                                    <div class="form-group">
                                        <label for="password_ulang" class="font-weight-bold">Ulangi Password</label>
                                        <input type="password" name="password_ulang" class="form-control" placeholder="Ulangi Password">
                                        <span class="text-danger">@error('password_ulang') {{ $message }} @enderror</span>
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary btn-block" value="Simpan">
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>