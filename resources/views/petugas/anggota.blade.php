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

                    <a href="#tambahAnggota" class="btn btn-success float-right" data-toggle="modal" data-target="#tambahAnggota" id="tambah"><i class="fa fa-plus"></i> Tambah Anggota</a>
                    <div class="modal fade" id="tambahAnggota">
                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title font-weight-bold">Tambah Anggota</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('tambahAnggotaAksi') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                        <div class="form-group row">
                                            <label for="nama" class="font-weight-bold col-form-label col-3 text-left">Nama</label>
                                            <div class="col-9">
                                                <input type="text" name="nama" class="form-control" placeholder="Masukkan nama lengkap" value="{{ old('nama') }}" required oninvalid="this.setCustomValidity('Nama wajib diisi')" onchange="this.setCustomValidity('')">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="no_hp" class="font-weight-bold col-form-label col-3 text-left">No. HP</label>
                                            <div class="col-9">
                                                <input type="text" name="no_hp" class="form-control" placeholder="Masukkan no. hp" value="{{ old('no_hp') }}" required oninvalid="this.setCustomValidity('No. hp wajib diisi')" onchange="this.setCustomValidity('')">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="alamat" class="font-weight-bold col-form-label col-3 text-left">Alamat</label>
                                            <div class="col-9">
                                                <input type="text" name="alamat" class="form-control" placeholder="Masukkan alamat" value="{{ old('alamat') }}" required oninvalid="this.setCustomValidity('Alamat wajib diisi')" onchange="this.setCustomValidity('')">
                                            </div>
                                        </div>

                                        <div class="form-group row mt-2">
                                            <label for="foto" class="font-weight-bold col-form-label col-3 text-left">Foto Anggota</label>
                                            <div class="col-9">
                                                <input type="file" name="foto" required oninvalid="this.setCustomValidity('Foto anggota wajib dipilih'" onchange="this.setCustomValidty('')">
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
                                <th>ID Anggota</th>
                                <th>No. HP</th>
                                <th>Alamat</th>
                                <th width="30%">OPSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach ($anggota as $a)
                            <tr>
                                <td onclick="detail({{ $a->id }})">{{ $no++ }}</td>
                                <td>{{ $a->nama }}</td>
                                <td>{{ "AGTA-". (321 + ($a->id)) }}</td>
                                <td>{{ $a->no_hp }}</td>
                                <td>{{ $a->alamat }}</td>
                                <td>
                                    <a href="/petugas/kartu_anggota/{{ $a->id }}" class="btn btn-sm btn-primary"><i class="fa fa-address-card"></i> Cetak Kartu</a>
                                    <a href="/petugas/edit_anggota/{{ $a->id }}" class="btn btn-sm btn-warning"><i class="fa fa-wrench"></i> Edit</a>
                                    <a href="/petugas/hapus_anggota/{{ $a->id }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</a>
                                    <a href="#" class="btn btn-sm btn-info modal_anggota" data-toggle="modal" data-target="#profil" id="{{ $a->id }}"><i class="fa fa-user"></i> Profil</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="modal fade" id="profil">
                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Profil Anggota</h5>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body" id="profil_anggota">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                    {{ $anggota->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('petugas.footer')

    <script>
    $(document).ready(function() {
        $(".modal_anggota").click(function() {
            var id = $(this).attr("id");

            $.ajax({
                url: 'anggota/profil/'+ id,
                method: 'GET',
                data: {id:id},
                success:function(data) {
                    $("#profil_anggota").html(data);
                    $("#profil").modal("show");
                }
            })
        })
    })
    </script>
</body>
@endsection