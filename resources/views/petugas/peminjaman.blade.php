@extends('layouts.template')

@section('title', 'Data Peminjaman Buku')

@section('content')
<body>
    @include('petugas.navigation')

    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h2 class="font-weight-bold text-center">Data Peminjaman Buku</h2>
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

                <button type="button" class="btn btn-success float-right mb-2" data-toggle="modal" data-target="#tambahPeminjaman">
                    <span><i class="fa fa-plus"></i> Tambah Peminjaman</span>
                </button>
                <div class="modal fade" id="tambahPeminjaman">
                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title font-weight-bold">Tambah Peminjaman</h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                            <form action="{{ route('tambahPeminjamanAksi') }}" method="POST">
                                @csrf
                                    <div class="form-group">
                                        <label for="buku" class="font-weight-bold">Buku</label>
                                        <select name="buku" class="form-control">
                                            <option value="">- Pilih Buku</option>
                                            @foreach ($buku as $b)
                                            <option value="{{ $b->id }}">{{  $b->judul." | ".$b->tahun." | ".$b->penulis}}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger">@error('buku') {{ $message }} @enderror</span>
                                    </div>

                                    <div class="form-group">
                                        <label for="anggota" class="font-weight-bold">Anggota</label>
                                        <select name="anggota" class="form-control">
                                            <option value="">- Pilih Anggota</option>
                                            @foreach ($anggota as $a)
                                            <option value="{{ $a->id }}">{{ $a->nama. " | ID: AGTA-". (321 + ($a->id)) }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger">@error('anggota') {{ $message }} @enderror</span>
                                    </div>

                                    <div class="form-group">
                                        <label for="tanggal_mulai" class="font-weight-bold">Tanggal Mulai Pinjam</label>
                                        <input type="date" name="tanggal_mulai" class="form-control" placeholder="Masukkan tanggal mulai pinjam">
                                        <span class="text-danger">@error('tanggal_mulai') {{ $message }} @enderror</span>
                                    </div>

                                    <div class="form-group">
                                        <label for="tanggal_selesai" class="font-weight-bold">Tanggal Akhir Peminjaman</label>
                                        <input type="date" name="tanggal_selesai" class="form-control" placehoder="Masukkan tanggal akhir peminjaman">
                                        <span class="text-danger">@error('tanggal_selesai') {{ $message }} @enderror</span>
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

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th width="1%">No.</th>
                                <th>Buku</th>
                                <th>Peminjam</th>
                                <th>Tanggal Peminjaman</th>
                                <th>Akhir Peminjaman</th>
                                <th>Status</th>
                                <th width="18%">OPSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach ($peminjaman as $p)
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
                                    else
                                    {
                                        echo "<div class='badge badge-warning'>Dipinjam</div>";
                                    }
                                    ?>
                                </td>
                                <td class="text-center">
                                    <?php
                                    if ($p->peminjaman_status == '1')
                                    {
                                        echo "-";
                                    }
                                    elseif ($p->peminjaman_status == '2')
                                    {
                                        ?>
                                        <a href="/petugas/peminjaman_selesai/{{ $p->peminjaman_id }}" class="btn btn-sm btn-warning"><i class="fa fa-sync"></i> Selesai</a>
                                        <a href="/petugas/batalkan_peminjaman/{{ $p->peminjaman_id }}" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Batalkan</a>
                                    <?php
                                    }
                                    ?>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('petugas.footer')
</body>
@endsection