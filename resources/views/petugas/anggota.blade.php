@extends('layouts.template')

@section('title', 'Daftar Anggota')

@section('content')
<body>
    @include('petugas.navigation')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2 class="font-weight-bold text-center">Daftar Anggota</h2>
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
                
                <form action="{{ route('cariAnggota') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="cari" class="form-control" placeholder="Cari Anggota" value="{{ old('cari') }}">
                        <button type="submit" class="btn btn-light">
                            <span><i class="fa fa-search"></i></span>
                        </button>
                    </div>
                </form>
                <br>

                <a href="{{ route('tambahAnggota') }}" class="btn btn-success float-right"><i class="fa fa-plus"></i> Tambah Anggota</a>
                <br><br>          

                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th width="1%">No.</th>
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>Alamat</th>
                            <th width="28%">OPSI</th>
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
                                <a href="/petugas/kartu_anggota/{{ $a->id }}" class="btn btn-sm btn-primary"><i class="fa fa-address-card"></i> Cetak Kartu</a>
                                <a href="/petugas/edit_anggota/{{ $a->id }}" class="btn btn-sm btn-warning"><i class="fa fa-wrench"></i> Edit</a>
                                <a href="/petugas/hapus_anggota/{{ $a->id }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <p class="text-center">
                Halaman: {{ $anggota->currentPage() }} <br>
                Jumlah Data: {{ $anggota->total() }} <br>
                Data per halaman: {{ $anggota->perPage() }} <br></p>

                <div class="d-flex justify-content-center">
                    {{ $anggota->links() }}
                </div>
            </div>
        </div>
    </div>
</body>
@endsection