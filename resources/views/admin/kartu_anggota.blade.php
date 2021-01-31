@extends('layouts.template')

@section('title', 'Kartu Anggota')

@section('content')
<body>
    
    <style type="text/css">
        .card{
            border: 1px solid #000;
            width: 450px;
        }

        .card-header{
            border-bottom: 1px solid #000;
            text-align: center;
            font-weight: bold;
            padding: 10px;
        }

        .card-body{
            padding: 20px;
        }    
    </style>

    <div class="card">
        <div class="card-header">
            KARTU ANGGOTA PERPUSTAKAAN
        </div>
        <div class="card-body">
            <div class="container">
                <table class="table table-borderless table-sm fs-2">
                    <?php $no = 1; ?>
                        <tr>
                            <td width="14%">Nomor</td>
                            <td width="12%">:</td>
                            <td><?php echo 10000+$anggota->id; ?></td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td>{{ $anggota->nama }}</td>
                        </tr>
                        <tr>
                            <td>NIK</td>
                            <td>:</td>
                            <td>{{ $anggota->nik }}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td>{{ $anggota->alamat }}</td>
                        </tr>
                </table>
            </div>
        </div>
    </div>
</body>
@endsection