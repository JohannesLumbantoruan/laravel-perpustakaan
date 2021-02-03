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

                <div class="clearfix mb-3">
                    <form action="{{ route('adminCariAnggota') }}" method="GET">
                        <div class="btn-group float-left">
                            <input type="text" name="cari" class="form-control" placeholder="Cari anggota" value="{{ old('cari') }}" style="width: 300px;">
                            <button type="button" class="btn btn-light"><i class="fa fa-search"></i></button>
                        </div>
                    </form>

                    <a href="#tambahAnggota" class="btn btn-success float-right" data-toggle="modal" data-target="#tambahAnggota"><i class="fa fa-plus"></i> Tambah Anggota</a>
                    <div class="modal fade" id="tambahAnggota">
                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title font-weight-bold">Tambah Anggota</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('adminTambahAnggotaAksi') }}" method="POST">
                                    @csrf
                                        <div class="form-group row">
                                            <label for="nama" class="font-weight-bold col-form-label col-2 text-left">Nama</label>
                                            <div class="col-10">
                                                <input type="text" name="nama" class="form-control" placeholder="Masukkan nama lengkap" value="{{ old('nama') }}" required oninvalid="this.setCustomValidity('Nama wajib diisi')" onchange="this.setCustomValidity('')">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nik" class="font-weight-bold col-form-label col-2 text-left">NIK</label>
                                            <div class="col-10">
                                                <input type="text" name="nik" class="form-control" placeholder="Masukkan NIK" value="{{ old('nik') }}" required oninvalid="this.setCustomValidity('NIK wajib diisi')" onchange="this.setCustomValidity('')">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="alamat" class="font-weight-bold col-form-label col-2 text-left">Alamat</label>
                                            <div class="col-10">
                                                <input type="text" name="alamat" class="form-control" placeholder="Masukkan alamat" value="{{ old('alamat') }}" required oninvalid="this.setCustomValidity('Alamat wajib diisi')" onchange="this.setCustomValidity('')">
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