@extends('layouts.template')

@section('title', 'Daftar Buku')

@section('content')
<body>
    @include('admin.navigation')

    <div class="container-fluid">
        <div class="card mt-5">
            <div class="card-header">
                <h2 class="font-weight-bold text-center">DAFTAR BUKU</h2>
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
                    <form action="{{ route('adminCariBuku') }}" method="GET">
                        <div class="btn-group float-left">
                            <input type="text" name="cari" class="form-control" placeholder="Cari Judul Buku" value="{{ old('cari') }}" style="width: 300px">
                            <button type="button" class="btn btn-light">
                                <span><i class="fa fa-search"></i></span>
                            </button>
                        </div>
                    </form>

                    <a href="#tambahBuku" class="btn btn-success float-right" data-toggle="modal" data-target="#tambahBuku"><i class="fa fa-plus"></i> Tambah Buku</a>
                    <div class="modal fade" id="tambahBuku">
                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title font-weight-bold">Tambah Buku</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('adminTambahBukuAksi') }}" method="POST">
                                    @csrf
                                        <div class="form-group row">
                                            <label for="judul" class="font-weight-bold col-form-label col-3 text-left">Judul Buku</label>
                                            <div class="col-9">
                                                <input type="text" name="judul" class="form-control" placeholder="Masukkan Judul Buku" value="{{ old('judul') }}" required oninvalid="this.setCustomValidity('Judul buku wajib diisi')" onchange="this.setCustomValidty('')">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="tahun" class="font-weight-bold col-form-label col-3 text-left">Tahun Penerbitan</label>
                                            <div class="col-9">
                                                <select name="tahun" class="form-control" required oninvalid="this.setCustomValidity('Pilih tahun penerbitan buku')" onchange="this.setCustomValidty('')">
                                                    <option value="">- Pilih Tahun</option>
                                                    <?php for ($tahun=date('Y'); $tahun>=1990; $tahun--) { ?>
                                                    <option value="<?php echo $tahun; ?>"><?php echo $tahun; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="penulis" class="font-weight-bold col-form-label col-3 text-left">Penulis Buku</label>
                                            <div class="col-9">
                                                <input type="text" name="penulis" class="form-control" placeholder="Masukkan Nama Penulis Buku" value="{{ old('penulis') }}" required oninvalid="this.setCustomValidity('Nama penulis wajib diisi')" onchange="this.setCustomValidty('')">
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
                                <th>Judul Buku</th>
                                <th>Tahun Terbit</th>
                                <th>Penulis</th>
                                <th width="10%">Status</th>
                                <th width="15%">OPSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach ($buku as $b)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $b->judul }}</td>
                                <td>{{ $b->tahun }}</td>
                                <td>{{ $b->penulis }}</td>
                                <td>
                                    <?php
                                    if ($b->status == "1")
                                    {
                                        echo "<span class='badge badge-success'>Tersedia</span>";
                                    }
                                    elseif ($b->status == "2")
                                    {
                                        echo "<span class='badge badge-warning'>Dipinjam</span>";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <a href="/admin/edit_buku/{{ $b->id }}" class="btn btn-sm btn-warning"><i class="fa fa-wrench"></i> Edit</a>
                                    <a href="/admin/hapus_buku/{{ $b->id }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    <p class="text-center">Halaman: {{ $buku->currentPage() }} <br>
                    Jumlah Data: {{ $buku->total() }} <br>
                    Data per Halaman: {{ $buku->perPage() }} <br></p>

                    <div class="d-flex justify-content-center mt-2">
                        {{ $buku->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection