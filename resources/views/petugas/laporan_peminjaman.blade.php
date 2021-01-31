@extends('layouts.template')

@section('title', 'Laporan Peminjaman')

@section('content')
<body>
    @include('petugas.navigation')

    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h2 class="font-weight-bold text-center">Laporan Peminjaman Buku</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="font-weight-bold text-center">Filter Berdasarkan Tanggal</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('filterLaporanPeminjaman') }}" method="GET">
                                    <div class="form-group">
                                        <label for="tanggal_mulai" class="font-weight-bold">Tanggal Mulai Peminjaman</label>
                                        <input type="date" name="tanggal_mulai" class="form-control" placeholer="Masukkan tanggal mulai peminjaman">
                                        <span class="text-danger">@error('tanggal_mulai') {{ $message }} @enderror</span>
                                    </div>

                                    <div class="form-group">
                                        <label for="tanggal_sampai" class="font-weight-bold">Tanggal Akhir Peminjaman</label>
                                        <input type="date" name="tanggal_sampai" class="form-control" placeholder="Masukkan tanggal akhir peminjaman">
                                        <span class="text-danger">@error('tanggal_sampai') {{ $message }} @enderror</span>
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary btn-block" value="Filter">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <br>

                <a href="{{ route('cetakLaporan') }}" class="btn btn-primary"><i class="fa fa-print"></i> Cetak</a>
                <br><br>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead light">
                            <tr>
                                <th width="1%">No.</th>
                                <th>Buku</th>
                                <th>Peminjam</th>
                                <th>Mulai Pinjam</th>
                                <th>Pinjam Sampai</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach ($peminjaman as $p)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $p->buku->judul }}</td>
                                <td>{{ $p->anggota->nama }}</td>
                                <td><?php echo date('d-m-Y', strtotime($p->peminjaman_tanggal_mulai)); ?></td>
                                <td><?php echo date('d-m-Y', strtotime($p->peminjaman_tanggal_sampai)); ?></td>
                                <td>
                                    <?php
                                    if ($p->peminjaman_status == "1")
                                    {
                                        echo "<div class='badge badge-success'>Selesai</div>";
                                    }
                                    elseif ($p->peminjaman_status == "2")
                                    {
                                        echo "<div class='badge badge-warning'>Dipinjam</div>";
                                    }
                                    ?>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection