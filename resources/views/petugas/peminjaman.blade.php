@extends('layouts.template')

@section('title', 'Data Peminjaman Buku')

@section('content')
<body>
    @include('petugas.navigation')

    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h2 class="font-weight-bold text-center">Data Peminjaman Buku</h2>
            </div>
            <div class="card-body">
                @if (Session::has('success'))
                    <div class="alert alert-success text-center">
                        {{ Session::get('success') }}
                    </div>
                @endif

                @if (Session::has('error'))
                    <div class="alert alert-danger text-center">
                        {{ Session::get('error') }}
                    </div>
                @endif

                <a href="{{ route('tambahPeminjaman') }}" class="btn btn-success float-right"><i class="fa fa-plus"></i> Tambah Peminjaman</a>
                <br><br>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th width="1%">No.</th>
                                <th>Buku</th>
                                <th>Peminjam</th>
                                <th>Tanggal Peminjaman</th>
                                <th>Akhir Peminjaman</th>
                                <th>Status</th>
                                <th width="18%">OPSI</th>
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
                                    else
                                    {
                                        echo "<div class='badge badge-warning'>Dipinjam</div>";
                                    }
                                    ?>
                                </td>
                                <td class="text-center">
                                    <?php
                                    if ($p->peminjaman_status == '1')
                                    {
                                        echo "-";
                                    }
                                    elseif ($p->peminjaman_status == '2')
                                    {
                                        ?>
                                        <a href="/petugas/peminjaman_selesai/{{ $p->peminjaman_id }}" class="btn btn-sm btn-warning"><i class="fa fa-sync"></i> Selesai</a>
                                        <a href="/petugas/batalkan_peminjaman/{{ $p->peminjaman_id }}" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Batalkan</a>
                                    <?php
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

    @include('petugas.footer')
</body>
@endsection