@extends('layouts.template')

@section('title', 'Detail Buku')

@section('content')
<body>
    <div class=" container my-5">
        <img src="{{ '/cover/'.$buku->cover }}" alt="cover_buku" width="200px" height="300px" class="mx-auto d-block mb-3">
        <table class="table">
            <tr>
                <th>ID Buku</th>
                <th>:</th>
                <td>{{ "IBSP-". (456 + ($buku->id)) }}</td>
            </tr>
            <tr>
                <th>Judul</th>
                <th>:</th>
                <td>{{ $buku->judul }}</td>
            </tr>
            <tr>
                <th>No. ISBN</th>
                <th>:</th>
                <td>{{ $buku->isbn }}</td>
            </tr>
            <tr>
                <th>Tahun Terbit</th>
                <th>:</th>
                <td>{{ $buku->tahun }}</td>
            </tr>
            <tr>
                <th>Penulis Buku</th>
                <th>:</th>
                <td>{{ $buku->penulis }}</td>
            </tr>
            <tr>
                <th>Kategori</th>
                <th>:</th>
                <td>{{ $buku->category->kategori_nama }}</td>
            </tr>
            <tr>
                <th>Jumlah/Stock Buku</th>
                <th>:</th>
                <td>{{ $buku->jumlah }}</td>
            </tr>
            <tr>
                <th>Deskripsi</th>
                <th>:</th>
                <td>{{ $buku->deskripsi }}</td>
            </tr>
            <tr>
                <th>Penerbit Buku</th>
                <th>:</th>
                <td>{{ $buku->penerbit }}</td>
            </tr>
        </table>
    </div>
</body>
@endsection