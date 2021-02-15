@extends('layouts.template')

@section('title', 'Tambah Peminjaman')

@section('content')
<body>
    @include('petugas.navigation')

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2 class="font-weight-bold text-center">TAMBAH PEMINJAMAN</h2>
            </div>
            <div class="card-body">
                <a href="{{ route('showPeminjaman') }}" class="btn btn-light btn-outline-dark float-right"><i class="fa fa-arrow-left"></i> Kembali</a>
                <br><br>

                <form action="{{ route('tambahPeminjamanAksi') }}" method="POST">
                @csrf
                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif

                    @if (Session::has('error'))
                        <div class="alert alert-danger">
                            {{ Session::get('error') }}
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="buku" class="font-weight-bold">Buku</label>
                        <select name="buku" class="form-control">
                            <option value="">- Pilih Buku</option>
                            <?php foreach ($buku as $b){ ?>
                            <option value="{{ $b->id }}"><?php echo $b->judul." | ".$b->tahun." | ".$b->penulis; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <span class="text-danger">@error('buku') {{ $message }} @enderror</span>
                    </div>

                    <div class="form-group">
                        <label for="anggota" class="font-weight-bold">Anggota</label>
                        <select name="anggota" class="form-control">
                            <option value="">--Pilih Anggota--</option>
                            @foreach ($anggota as $a)
                            <option value="{{ $a->id }}">{{ $a->nama ." | ID: AGTA". (321 + ($a->id)) }}</option>
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
        </div>
    </div>

    @include('petugas.footer')
</body>
@endsection