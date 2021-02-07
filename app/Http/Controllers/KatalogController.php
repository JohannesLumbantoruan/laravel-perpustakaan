<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Katalog;

class KatalogController extends Controller
{
    public function katalog()
    {
        $katalog = Katalog::all();

        return view('katalog', compact('katalog'));
    }

    public function tambahKatalog()
    {
        return view('tambah_katalog');
    }

    public function tambahKatalogAksi(Request $request)
    {
        $messages = [
            'judul.required'        => 'Judul buku wajib diisi',
            'deskripsi.required'    => 'Deskripsi buku wajib diisi',
            'deskripsi.min'         => 'Deskripsi buku minimal 50 karakter',
            'deskripsi.max'         => 'Deskripsi buku maksimal 200 karakter',
            'tag.required'          => 'Tag buku wajib diisi',
            'cover.required'        => 'Upload cover buku',
            'cover.file'            => 'Cover buku harus berupa file',
            'cover.image'           => 'Cover buku harus berupa gambar',
            'cover.mimes'           => 'Format cover buku wajib jpeg, png atau jpg',
            'cover.max'             => 'Cover buku maksimal 2048',
            'penulis.required'      => 'Nama penulis buku wajib diisi',
        ];

        $request->validate([
            'judul'     => 'required',
            'deskripsi' => 'required|min:50|max:200',
            'tag'       => 'required',
            'cover'     => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
            'penulis'   => 'required',
        ], $messages);

        $cover = $request->file('cover');
        $tempat_upload = 'gambar';
        $nama_cover = time() ."_". $cover->getClientOriginalName();
        $cover->move($tempat_upload, $nama_cover);

        $katalog = new Katalog;
        $katalog->judul = $request->judul;
        $katalog->deskripsi = $request->deskripsi;
        $katalog->tag = $request->tag;
        $katalog->foto = $nama_cover;
        $katalog->penulis = $request->penulis;
        $simpan = $katalog->save();

        if ($simpan)
        {
            return redirect()->route('katalog')->with('success', 'Katalog buku berhasil ditambah');
        }
        else
        {
            return back()->with('error', 'Gagal menambah katalog buku, silahkan coba kembali');
        }
    }
}
