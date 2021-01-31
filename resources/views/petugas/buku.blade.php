@extends('layouts.template')

@section('title', 'Daftar Buku')

@section('content')
    <body>
    @include('petugas.navigation')
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

                <form action="{{ route('cariBuku') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="cari" class="form-control" placeholder="Cari Judul Buku" value="{{ old('cari') }}">
                        <button type="submit" class="btn btn-light">
                            <span><i class="fa fa-search"></i></span>
                        </button>
                    </div>
                </form>
                <br>

                <a href="{{ route('tambahBuku') }}" class="btn btn-success float-right"><i class="fa fa-plus"></i> Tambah Buku</a>
                <br><br>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th width="1%">No.</th>
                                <th>Judul Buku</th>
                                <th>Tahun Terbit</th>
                                <th>Penulis</th>
                                <th width="7%">Status</th>
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
                                    <a href="/petugas/edit_buku/{{ $b->id }}" class="btn btn-sm btn-warning"><i class="fa fa-wrench"></i> Edit</a>
                                    <a href="/petugas/hapus_buku/{{ $b->id }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</a>
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

    @include('petugas.footer')
</body>
@endsection