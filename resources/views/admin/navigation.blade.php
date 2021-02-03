<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5">
    <div class="container">
        <a href="{{ route('adminDashboard') }}" class="navbar-brand">SI PERPUSTAKAAN</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a href="{{ route('adminDashboard') }}" class="nav-link"><i class="fa fa-home"></i> Dashboard</a>
                </li>
                <li class="nav-item">
                    <div class="dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Petugas</a>
                        <div class="dropdown-menu">
                            <a href="{{ route('showPetugas') }}" class="dropdown-item"><i class="fa fa-list-alt"></i> Daftar Petugas</a>
                            <a href="{{ route('tambahPetugas') }}" class="dropdown-item"><i class="fa fa-user-plus"></i> Tambah Petugas</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <div class="dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-users"></i> Anggota</a>
                        <div class="dropdown-menu">
                            <a href="{{ route('adminShowAnggota') }}" class="dropdown-item"><i class="fa fa-list-alt"></i> Daftar Anggota</a>
                            <a href="{{ route('adminTambahAnggota') }}" class="dropdown-item"><i class="fa fa-user-plus"></i> Tambah Anggota</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <div class="dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-book"></i> Buku</a>
                        <div class="dropdown-menu">
                            <a href="{{ route('adminShowBuku') }}" class="dropdown-item"><i class="fa fa-list-alt"></i> Daftar Buku</a>
                            <a href="{{ route('adminTambahBuku') }}" class="dropdown-item"><i class="fa fa-book-open"></i> Tambah Buku</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="{{ route('adminLaporanPeminjaman') }}" class="nav-link"><i class="fa fa-book"></i> Laporan Peminjaman</a>
                </li>
            </ul>

            <div class="dropdown">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    Hai, {{ Auth::guard('admin')->user()->username }}
                </button>
                <div class="dropdown-menu">
                    <a href="#gantiPassword" class="dropdown-item" data-toggle="modal" data-target="#gantiPassword"><i class="fa fa-lock"></i> Ganti Password</a>
                    <a href="{{ route('adminLogout') }}" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>
                </div>
                <div class="modal fade" id="gantiPassword">
                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title font-weight-bold">Ganti Password</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('adminGantiPasswordAksi') }}" method="POST">
                                @csrf
                                @method('PUT')
                                    <div class="form-group row">
                                        <label for="password_lama" class="font-weight-bold col-form-label col-3 text-left">Password Lama</label>
                                        <div class="col-9">
                                            <input type="password" name="password_lama" class="form-control" placeholder="Password Lama" required oninvalid="this.setCustomValidity('Masukkan password lama')" onchange="this.setCustomValidity('')">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password_baru" class="font-weight-bold col-form-label col-3 text-left">Password Baru</label>
                                        <div class="col-9">
                                            <input type="password" name="password_baru" class="form-control" placeholder="Masukkan password baru" required oninvalid="this.setCustomValidity('Masukkan password baru')" onchange="this.setCustomValidity('')">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password_ulang" class="font-weight-bold col-form-label col-3 text-left">Ulangi Password</label>
                                        <div class="col-9">
                                            <input type="password" name="password_ulang" class="form-control" placeholder="Ulangi Password" required oninvalid="this.setCustomValidity('Ulangi password')" onchange="this.setCustomValidity('')">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary btn-block" value="Ubah Password">
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