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
                    <a href="{{ route('showAnggota') }}" class="nav-link"><i class="fa fa-users"></i> Anggota</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('showBuku') }}" class="nav-link"><i class="fa fa-book"></i> Buku</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('showPeminjaman') }}" class="nav-link"><i class="fa fa-book"></i> Peminjaman</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('laporanPeminjaman') }}" class="nav-link"><i class="fa fa-book"></i> Laporan Peminjaman</a>
                </li>
            </ul>

            <div class="dropdown">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    Hai, {{ Auth::guard('petugas')->user()->username }}
                </button>
                <div class="dropdown-menu">
                    <a href="{{ route('petugasGantiPassword') }}" class="dropdown-item"><i class="fa fa-lock"></i> Ganti Password</a>
                    <a href="{{ route('petugasLogout') }}" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>
                </div>
            </div>
        </div>
    </div>
</nav>