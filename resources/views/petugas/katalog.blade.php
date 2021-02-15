@extends('layouts.template')

@section('title', 'Katalog Buku')

@section('content')
<body>
    @include('petugas.navigation')
    
    <div class="container">
        <h1 class="font-weight-bold text-center my-3">KATALOG BUKU</h1>
        <div class="card">
            <div class="card-body">
                <div class="row">              
                @foreach ($buku as $b)
                    <div class="col-md-3 mb-3">
                        <img src="{{ ('/cover/'. $b->cover) }}" alt="cover buku" class="card-img-top" style="height: 150px">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?php if (strlen($b->judul) > 30){$b->judul = substr($b->judul, 0, 30)."...";} ?> {{ $b->judul }}</h5>
                                <p class="card-text"><?php if (strlen($b->deskripsi) > 45){$b->deskripsi = substr($b->deskripsi, 0, 45)."...";} ?>{{ $b->deskripsi }}</p>
                            </div>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">{{"Post on ".date('d/m/Y h:i', strtotime($b->created_at)) }}</small>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>

    @include('petugas.footer')
</body>
@endsection