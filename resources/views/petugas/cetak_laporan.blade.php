@extends('layouts.template')

@section('title', 'Laporan Peminjaman Buku')

@section('content')
<body>
    <div class="container">
    <h2 class="font-weight-bold text-center mt-5">Laporan Peminjaman Buku</h2>
        <br>
        <div class="row">
            <div class="col-md-4">
                @if ($tanggal_mulai == "" || $tanggal_sampai == "")
                    <br>
                @else
                    <table class="table">
                        <tr>
                            <th width="50%">Dari Tanggal</th>
                            <th>:</th>
                            <td>{{ date('d/m/Y', strtotime($tanggal_mulai)) }}</td>
                        </tr>
                        <tr>
                            <th width="50%">Sampai Tanggal</th>
                            <th>:</th>
                            <td>{{ date('d/m/Y', strtotime($tanggal_sampai)) }}</td>
                        </tr>        
                    </table>
                @endif
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
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
                        <?php
                        $no = 1;
                        foreach ($peminjaman as $p)
                        { ?>
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
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        window.print();
    </script>
</body>
@endsection