@extends('layouts.template')

@section('title', 'Upload File')

@section('content')
<body>
    <div class="container d-flex justify-content-center">
        <div class="col-lg-8 mt-5">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center mb-3">UPLOAD FILE</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('uploadAksi') }}" method="POST" enctype="multipart/form-data">
                    @csrf
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

                        <div class="form-group row">
                            <label for="file" class="col-form-label col-3 text-left">Upload Gambar</label>
                            <div class="col-9">
                                <input type="file" name="file"><br>
                                <span class="text-danger">@error('file') {{ $message }} @enderror</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="keterangan" class="col-form-label col-3 text-left">Keterangan:</label>
                            <div class="col-9">
                                <textarea name="keterangan" class="form-control" placeholder="Masukkan keterangan gambar"></textarea>
                                <span class="text-danger">@error('keterangan') {{ $message }} @enderror</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary btn-block" value="Upload">
                        </div>
                    </form>

                    <table class="table table-bordered table-hover mt-5">
                        <thead class="thead-light">
                            <tr>
                                <th width="50%">Preview</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <body>
                            @foreach ($upload as $u)
                            <tr>
                                <td><img src="{{ ('/gambar/'.$u->file) }}" alt="gambar" width="180px" height="120px"></td>
                                <td>{{ $u->keterangan }}</td>
                            </tr>
                            @endforeach
                        </body>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection