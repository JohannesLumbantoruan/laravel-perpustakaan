@extends('layouts.template')

@section('title', 'Daftar Anggota')

@section('content')
<body>
    @include('admin.navigation')

    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h2 class="font-weight-bold text-center">DAFTAR ANGGOTA</h2>
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

                <form action="{{ route('adminCariAnggota') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="cari" class="form-control" placeholder="Cari anggota" value="{{ old('cari') }}">
                        <button type="button" class="btn btn-light"><i class="fa fa-search"></i></button>
                    </div>
                </form>
                <br>

                <a href="{{ route('adminTambahAnggota') }}" class="btn btn-success float-right"><i class="fa fa-plus"></i> Tambah Anggota</a>
                <br><br>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th width="1%">No.</th>
                                <th>Nama</th>
                                <th>NIK</th>
                                <th>Alamat</th>
                                <th width="25%">OPSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach ($anggota as $a)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $a->nama }}</td>
                                <td>{{ $a->nik }}</td>
                                <td>{{ $a->alamat }}</td>
                                <td>
                                    <a href="/admin/kartu_anggota/{{ $a->id }}" class="btn btn-sm btn-primary"><i class="fa fa-address-card"></i> Cetak Kartu</a>
                                    <a href="/admin/edit_anggota/{{ $a->id }}" class="btn btn-sm btn-warning"><i class="fa fa-wrench"></i> Edit</a>
                                    <a href="/admin/hapus_anggota/{{ $a->id }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <p class="text-center">Halaman saat ini: {{ $anggota->currentPage() }} <br>
                    Jumlah Data: {{ $anggota->total() }} <br>
                    Data per Halaman: {{ $anggota->perPage() }} <br></p>

                    <div class="d-flex justify-content-center">
                        {{ $anggota->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection