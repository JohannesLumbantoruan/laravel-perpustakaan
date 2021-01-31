<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Cetak Laporan Peminjaman</title>

    <!-- meta -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <style type="text/css">
    .table, .table tr, .table tr th, .table tr td{
        border: 1px solid #000;
        border-collapse: collapse;
    }

    h2{
        text-align: center;
    }

    th{
        text-align: left;
    }
    </style>

    <h2>Laporan Peminjaman Buku</h2>

    @if ($tgl_mulai == "" || $tgl_sampai == "")
        <br>
    @else
        <table>
            <tr>
                <th>Dari Tanggal</th>
                <th>:</th>
                <td>{{ date('d/m/Y', strtotime($tgl_mulai)) }}</td>
            </tr>
            <tr>
                <th>Sampai Tanggal</th>
                <th>:</th>
                <td>{{ date('d/m/Y', strtotime($tgl_sampai)) }}</td>
            </tr>
        </table>
        <br>
    @endif

    <table class="table">
        <tr>
            <th width="1%">No.</th>
            <th>Buku</th>
            <th>Peminjam</th>
            <th>Mulai Pinjam</th>
            <th>Pinjam Sampai</th>
            <th>Status</th>
        </tr>
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
    </table>
</body>
</html>