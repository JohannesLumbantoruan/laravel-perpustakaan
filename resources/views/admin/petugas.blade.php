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
                
                <form action="{{ route('cariPetugas') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="cari" class="form-control" placeholder="Cari petugas" value="{{ old('cari') }}">
                        <button type="button" class="btn btn-light">
                            <span><i class="fa fa-search"></i></span>
                        </button>
                    </div>
                </form>
                <br>

                <a href="{{ route('tambahPetugas') }}" class="btn btn-success float-right"><i class="fa fa-plus"></i> Tambah Petugas</a>
                <br><br>

                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th width="1%">No.</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th width="16%">OPSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach ($petugas as $p)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $p->nama }}</td>
                            <td>{{ $p->username }}</td>
                            <td>
                                <a href="/admin/edit_petugas/{{ $p->id }}" class="btn btn-sm btn-warning"><i class="fa fa-wrench"></i> Edit</a>
                                <a href="/admin/hapus_petugas/{{ $p->id }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
@endsection