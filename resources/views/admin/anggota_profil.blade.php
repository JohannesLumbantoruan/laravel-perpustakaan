@extends('layouts.template')

@section('title', 'Profil Anggota')

@section('content')
<body>
    <img src="{{ '/anggota/'.$anggota->foto }}" alt="foto_anggota" width="200px" height="200px" class="mx-auto d-block mb-3">

    <table class="table">
        <tr>
            <th>ID Anggota</th>
            <th>:</th>
            <td>{{ "AGTA-". (321 + ($anggota->id)) }}</td>
        </tr>
        <tr>
            <th>Nama</th>
            <th>:</th>
            <td>{{ $anggota->nama }}</td>
        </tr>
        <tr>
            <th>No. HP</th>
            <th>:</th>
            <td>{{ $anggota->no_hp }}</td>
        </tr>
        <tr>
            <th>Alamat</th>
            <th>:</th>
            <td>{{ $anggota->alamat }}</td>
        </tr>
    </table>
</body>
@endsection