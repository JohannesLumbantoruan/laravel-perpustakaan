@extends('layouts.template')

@section('title', 'Daftar Anggota')

@section('content')
<body>
    @include('petugas.navigation')
    <div class="container-fluid">
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
                
                <div class="clearfix mb-3">
                    <form action="{{ route('cariAnggota') }}" method="GET">
                        <div class="btn-group float-left">
                            <input type="text" name="cari" class="form-control" placeholder="Cari Anggota" value="{{ old('cari') }}" id="search">
                            <button type="submit" class="btn btn-secondary">
                                <span><i class="fa fa-search"></i></span>
                            </button>
                        </div>
                    </form>
                    <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#tambahAnggota">
                    <span><i class="fa fa-plus"></i> Tambah Anggota</span>
                    </button>
                    <div class="modal fade" id="tambahAnggota">
                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title font-weight-bold">Tambah Anggota</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                <form action="{{ route('tambahAnggotaAksi') }}" method="POST">
                                    @csrf
                                        <div class="form-group row">
                                            <label for="nama" class="font-weight-bold col-form-label col-2 text-left">Nama</label>
                                            <div class="col-10">
                                                <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Lengkap" value="{{ old('nama') }}" required oninvalid="this.setCustomValidity('Nama wajib diisi')" onchange="this.setCustomValidity('')">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nik" class="font-weight-bold col-form-label col-2 text-left">NIK</label>
                                            <div class="col-10">
                                                <input type="text" name="nik" class="form-control" placeholder="Masukkkan NIK" value="{{ old('nik') }}" required oninvalid="this.setCustomValidity('NIK wajib diisi')" onchange="this.setCustomValidity('')">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="alamat" class="font-weight-bold col-form-label col-2 text-left">Alamat</label>
                                            <div class="col-10">
                                                <input type="text" name="alamat" class="form-control" placeholder="Masukkan Alamat" value="{{ old('alamat') }}" required oninvalid="this.setCustomValidity('Alamat wajib diisi')" onchange="this.setCustomValidity('')">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary btn-block" value="Tambah">
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

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th width="1%">No.</th>
                                <th>Nama</th>
                                <th>NIK</th>
                                <th>Alamat</th>
                                <th width="24%">OPSI</th>
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
                    <div class="d-flex justify-content-center">
                    {{ $anggota->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('petugas.footer')
</body>
@endsection