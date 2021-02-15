@extends('layouts.template')

@section('title', 'Daftar Buku')

@section('content')
<body>
    @include('admin.navigation')

    <div class="container-fluid">
        <div class="card">
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
                            <input type="text" name="cari" class="form-control" placeholder="Cari Judul Buku" value="{{ old('cari') }}" id="search">
                            <button type="button" class="btn btn-secondary">
                                <span><i class="fa fa-search"></i></span>
                            </button>
                        </div>
                    </form>

                    <a href="#tambahBuku" class="btn btn-success float-right" data-toggle="modal" data-target="#tambahBuku" id="tambah"><i class="fa fa-plus"></i> Tambah Buku</a>
                    <div class="modal fade" id="tambahBuku">
                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title font-weight-bold">Tambah Buku</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('adminTambahBukuAksi') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                        <div class="form-group row">
                                            <label for="judul" class="font-weight-bold col-form-label col-3 text-left">Judul Buku</label>
                                            <div class="col-9">
                                                <input type="text" name="judul" class="form-control" placeholder="Masukkan Judul Buku" value="{{ old('judul') }}" required oninvalid="this.setCustomValidity('Judul buku wajib diisi')" onchange="this.setCustomValidty('')">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="isbn" class="font-weight-bold col-form-label col-3 text-left">No. ISBN</label>
                                            <div class="col-9">
                                                <input type="text" name="isbn" class="form-control" placeholder="Masukkan no. isbn" value="{{ old('isbn') }}" required oninvalid="this.setCustomValidity('No. ISBN wajib diisi')" onchange="this.setCustomValidity('')">
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

                                        <div class="form-group row">
                                            <label for="kategori" class="font-weight-bold col-form-label col-3 text-left">Kategori</label>
                                            <div class="col-9">
                                                <select name="kategori" class="form-control">
                                                    <option value="">-Pilih Kategori-</option>
                                                    @foreach ($kategori as $k)
                                                    <option value="{{ $k->kategori_id }}">{{ $k->kategori_nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="jumlah" class="font-weight-bold col-form-label col-3 text-left">Jumlah Buku(Stock)</label>
                                            <div class="col-9">
                                                <input type="number" name="jumlah" class="form-control" placeholder="Masukkan jumlah buku(stock)" value="{{ old('jumlah') }}" required oninvalid="this.setCustomValidity('Jumlah buku(stock) wajib diisi')" onchange="this.setCustomValidity('')">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="deskripsi" class="font-weight-bold col-form-label col-3 text-left">Deskripsi/Sinopsi Buku</label>
                                            <div class="col-9">
                                                <textarea name="deskripsi" class="form-control" placeholder="Masukkan deskripsi/sinopsis buku" required oninvalid="this.setCustomValidity('Deskripsi/sinopsis buku wajib diisi')" onchange="this.setCustomValidity('')"></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="penerbit" class="font-weight-bold col-form-label col-3 text-left">Penerbit Buku</label>
                                            <div class="col-9">
                                                <input type="text" name="penerbit" class="form-control" placeholder="Masukkan penerbit buku" value="{{ old('penerbit') }}" required oninvalid="this.setCustomValidity('Penerbit buku wajib diisi')" onchange="this.setCustomValidty('')">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="cover" class="font-weight-bold col-form-label col-3 text-left">Cover Buku</label>
                                            <div class="col-9">
                                                <input type="file" name="cover" required oninvalid="this.setCustomValidity('Cover buku wajib dipilih')" onchange="this.setCustomvalidity('')">
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
                                <th width="20%">OPSI</th>
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
                                    <a href="{{ route('adminEditBuku', $b->id) }}" class="btn btn-sm btn-warning"><i class="fa fa-wrench"></i> Edit</a>
                                    <a href="{{ route('adminHapusBuku', $b->id) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</a>
                                    <a href="#" class="btn btn-sm btn-info modal_buku" data-toggle="modal" data-target="#detail" id="{{ $b->id }}"><i class="fa fa-book"></i> Detail</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="modal fade" id="detail">
                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Detail Buku</h5>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body" id="detail_buku">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center mt-2">
                        {{ $buku->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.footer')

    <script>
    $(document).ready(function() {
        $(".modal_buku").click(function() {
            var id = $(this).attr("id");

            $.ajax({
                url: 'buku/detail/'+ id,
                method: 'GET',
                data: {id:id},
                success:function(data){
                    $("#detail_buku").html(data);
                    $("#detail").modal("show");
                }
            });
        });
    });
    </script>
</body>
@endsection