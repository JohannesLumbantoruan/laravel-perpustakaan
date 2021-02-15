@extends('layouts.template')

@section('title', 'Daftar Petugas')

@section('content')
<body>
    @include('admin.navigation')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2 class="font-weight-bold text-center">Daftar Petugas</h2>
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
                    <form action="{{ route('cariPetugas') }}" method="GET">
                        <div class="btn-group float-left">
                            <input type="text" name="cari" class="form-control" placeholder="Cari petugas" value="{{ old('cari') }}" id="search">
                            <button type="button" class="btn btn-secondary">
                                <span><i class="fa fa-search"></i></span>
                            </button>
                        </div>
                    </form>

                    <a href="#tambahPetugas" class="btn btn-success float-right" data-toggle="modal" data-target="#tambahPetugas" id="tambah"><i class="fa fa-plus"></i> Tambah Petugas</a>
                    <div class="modal fade" id="tambahPetugas">
                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title font-weight-bold">Tambah Petugas</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                <form action="{{ route('tambahPetugasAksi') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                        <div class="form-group row">
                                            <label for="nama" class="font-weight-bold col-form-label col-3 text-left">Nama Lengkap</label>
                                            <div class="col-9">
                                                <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Lengkap" value="{{ old('nama') }}" required oninvalid="this.setCustomValidity('Nama lengkap wajib diisi')" onchange="this.setCustomValidity('')">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="username" class="font-weight-bold col-form-label col-3 text-left">Username</label>
                                            <div class="col-9">
                                                <input type="text" name="username" class="form-control" placeholder="Masukkan Username" value="{{ old('username') }}" required oninvalid="this.setCustomValidity('Username wajib diisi')" onchange="this.setCustomValidity('')">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="password" class="font-weight-bold col-form-label col-3">Password</label>
                                            <div class="col-9">
                                                <input type="password" name="password" class="form-control" placeholder="Masukkan Password" required oninvalid="this.setCustomValidity('Password wajib diisi')" onchange="this.setCustomValidity('')">
                                            </div>
                                        </div>

                                        <div class="form-gorup row">
                                            <label for="no_hp" class="font-weight-bold col-form-label col-3 text-left">No. HP</label>
                                            <div class="col-9">
                                                <input type="text" name="no_hp" class="form-control" placeholder="Masukkan no. hp" value="{{ old('no_hp') }}" required oninvalid="this.setCustomValidity('No. HP wajib diisi')" onchange="this.setCustomValidity('')">
                                            </div>
                                        </div>

                                        <div class="form-group row mt-2">
                                            <label for="foto" class="font-weight-bold col-form-label col-3 tex-left">Foto Petugas</label>
                                            <div class="col-9">
                                                <input type="file" name="foto" required oninvalid="this.setCustomValidity('Foto petugas wajib dipilih')" onchange="this.setCustomValidity('')">
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

                <div class="row mt-3">
                    @foreach ($petugas as $p)
                    <div class="col-lg-3 mb-3">
                        <img src="{{ '/petugas/'.$p->foto }}" height="150px" class="card-img-top" alt="foto_petugas">
                        <div class="card">
                            <div class="card-body">
                                <table>
                                    <tr>
                                        <th>ID Petugas</th>
                                        <th>:</th>
                                        <td>{{ "PTGS-". (123 + ($p->id)) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama</th>
                                        <th>:</th>
                                        <td>{{ $p->nama }}</td>
                                    </tr>
                                    <tr>
                                        <th>No. HP</th>
                                        <th>:</th>
                                        <td>{{ $p->no_hp }}</td>
                                    </tr>
                                </table>
                                <div class="mt-2">
                                    <a href="{{ route('editPetugas', $p->id) }}" class="btn btn-warning"><i class="fa fa-wrench"></i> Edit</a>
                                    <a href="{{ route('hapusPetugas', $p->id) }}" class="btn btn-danger ml-2"><i class="fa fa-trash"></i> Hapus</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @include('admin.footer')
</body>
@endsection