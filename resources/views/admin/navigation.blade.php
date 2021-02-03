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
                    <a href="{{ route('adminGantiPassword') }}" class="dropdown-item"><i class="fa fa-lock"></i> Ganti Password</a>
                    <a href="{{ route('adminLogout') }}" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>
                </div>
            </div>
        </div>
    </div>
</nav>