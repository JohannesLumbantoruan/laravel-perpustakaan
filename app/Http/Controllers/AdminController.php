<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Petugas;
use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Katalog;
use App\Models\Kategori;
use Hash;
use Auth;
use Validator;
use Session;
use File;

class AdminController extends Controller
{
    public function gantiPassword()
    {
        return view('admin.ganti_password');
    }
    
    public function gantiPasswordAksi(Request $request)
    {
        $messages = [
            'password_lama.required'    => 'Password Lama wajib diisi',
            'password_baru.required'    => 'Password Baru wajib diisi',
            'password_baru.min'         => 'Password minimal 4 karakter',
            'password_baru.max'         => 'Password maksimal 20 karakter',
            'password_ulang.required'   => 'Ulangi Password',
            'password_ulang.same'       => 'Password tidak sama',
        ];

        $request->validate([
            'password_lama'     => 'required',
            'password_baru'     => 'required|min:4|max:20',
            'password_ulang'    => 'required|same:password_baru',
        ], $messages);

        if (Hash::check($request->password_lama, Auth::guard('admin')->user()->password))
        {
            if (Hash::check($request->password_baru, Auth::guard('admin')->user()->password))
            {
                return redirect()->route('adminGantiPassword')->with('error', 'Password baru tidak boleh sama dengan password lama');
            }
            else
            {
                $simpan = Admin::where('id', '=', Auth::guard('admin')->user()->id)->update([
                    'password'  => Hash::make($request->password_baru),
                ]);
    
                if ($simpan)
                {
                    Auth::guard('admin')->logout();
        
                    return redirect()->route('login')->with('success', 'Password berhasil diubah, silahkan login kembali');
                }
            }
        }
        else
        {
            return back()->with('error', 'Password Lama salah, silahkan coba kembali');
        }
    }

    public function showPetugas()
    {
        $petugas = Petugas::all();

        return view('admin.petugas', ['petugas' => $petugas]);
    }

    public function tambahPetugas()
    {
        return view('admin.tambah_petugas');
    }

    public function tambahPetugasAksi(Request $request)
    {
        $messages = [
            'nama.required'     => 'Nama wajib diisi',
            'nama.min'          => 'Nama minimal 4 karakter',
            'nama.max'          => 'Nama maksimal 30 karakter',
            'username.required' => 'Username wajib diisi',
            'username.min'      => 'Username minimal 4 karakter',
            'username.max'      => 'Username maksimal 10 karakter',
            'password.required' => 'Password wajib diisi',
            'password.min'      => 'Password minimal 4 karakter',
            'password.max'      => 'Password maksimal 20 karakter',
            'no_hp.required'    => 'No. HP wajib diisi',
            'no_hp.numeric'     => 'No. HP harus berupa angka',
            'foto.required'     => 'Foto petugas wajib diisi',
            'foto.file'         => 'Foto harus berupa file',
            'foto.image'        => 'Foto harus berupa image',
            'foto.mimes'        => 'Foto harus berekstensi jpeg, jpg dan png',
            'foto.max'          => 'Ukuran maksimal 2048',
        ];

        $request->validate([
            'nama'      => 'required|min:4|max:30',
            'username'  => 'required|min:4|max:10',
            'password'  => 'required|min:4|max:20',
            'no_hp'     => 'required|numeric',
            'foto'      => 'required|file|image|mimes:jpeg,jpg,png|max:2048',
        ], $messages);

        $foto = $request->file('foto');
        $tempat_upload = 'petugas';
        $nama_foto = date('d-m-y') ."_". $foto->getClientOriginalName();
        $foto->move($tempat_upload, $nama_foto);

        $petugas = new Petugas;
        $petugas->nama = $request->nama;
        $petugas->username = $request->username;
        $petugas->password = Hash::make($request->password);
        $petugas->no_hp = $request->no_hp;
        $petugas->foto = $nama_foto;
        $simpan = $petugas->save();

        if ($simpan)
        {
            return redirect()->route('showPetugas')->with('success', 'Petugas berhasil ditambahkan');
        }
        else
        {
            return back()->with('error', 'Gagal menambahkan petugas');
        }
    }

    public function editPetugas($id)
    {
        $petugas = Petugas::find($id);

        return view('admin.edit_petugas', ['petugas' => $petugas]);
    }

    public function editPetugasAksi($id, Request $request)
    {
        $messages = [
            'nama.required'     => 'Nama Lengkap wajib diisi',
            'nama.min'          => 'Nama Lengkap minimal 4 karakter',
            'nama.max'          => 'Nama maksimal 30 karakter',
            'username.required' => 'Username wajib diisi',
            'username.min'      => 'Username minimal 4 karakter',
            'username.max'      => 'Username maksimal 10 karakter',
            'password.min'      => 'Password minimal 4 karakter',
            'password.max'      => 'Password maksimal 20 karakter',
        ];

        $request->validate([
            'nama'      => 'required|min:4|max:30',
            'username'  => 'required|min:4|max:10',
            'password'  => 'min:4|max:20',
        ], $messages);

        $petugas = Petugas::find($id);
        $petugas->nama = $request->nama;
        $petugas->username = $request->username;
        $petugas->password = Hash::make($request->password);
        $simpan = $petugas->save();

        if ($simpan)
        {
            return redirect()->route('showPetugas')->with('success', 'Petugas berhasil diedit');
        }
        else
        {
            return back()->with('error', 'Gagal mengedit petugas, silahkan coba kembali');
        }
    }

    public function hapusPetugas($id)
    {
        $petugas = Petugas::find($id);
        File::delete('petugas/'. $petugas->foto);
        $petugas->delete();

        return redirect()->route('showPetugas')->with('success', 'Petugas berhasil dihapus');
    }

    public function cariPetugas(Request $request)
    {
        $cari = $request->cari;
        $petugas = Petugas::where('username', 'like', "%".$cari."%")->paginate(10);

        return view('admin.petugas', ['petugas' => $petugas]);
    }

    public function showBuku()
    {
        $kategori = Kategori::all();
        $buku = Buku::paginate(10);

        return view('admin.buku', compact('buku', 'kategori'));
    }

    public function cariBuku(Request $request)
    {
        $cari = $request->cari;
        $buku = Buku::where('judul', 'like', "%".$cari."%")->paginate(10);

        return view('admin.buku', compact('buku'));
    }

    public function tambahBuku()
    {
        $kategori = Kategori::all();

        return view('admin.tambah_buku', compact('kategori'));
    }
    
    public function tambahBukuAksi(Request $request)
    {
        $messages = [
            'judul.required'        => 'Judul buku wajib diisi',
            'isbn.required'         => 'No. ISBN wajib diisi',
            'tahun.required'        => 'Tahun penerbitan buku wajib diisi',
            'penulis.required'      => 'Nama penulis buku wajib diisi',
            'kategori.required'     => 'Kategori buku wajib dipilih',
            'jumlah.required'       => 'Jumlah(stock) buku wajib diisi',
            'jumlah.numeric'        => 'Jumlah(stock) buku harus berupa angka',
            'deskripsi.required'    => 'Deskripsi/sinopsis buku wajib diisi',
            'deskripsi.min'         => 'Deskripsi/sinopsis buku minimal 50 karakter',
            'deskripsi.max'         => 'Deskripsi/sinopsis buku maksimal 1000 karakter',
            'penerbit.required'     => 'Penerbit buku wajib diisi',
            'cover.required'        => 'Cover buku wajib dipilih',
            'cover.file'            => 'Cover buku harus berupa file',
            'cover.image'           => 'Cover buku harus berupa image',
            'cover.mimes'           => 'Cover buku harus berekstensi png,jpeg,jpg',
            'cover.max'             => 'Ukuran cover buku max 2048',
        ];

        $request->validate([
            'judul'     => 'required',
            'isbn'      => 'required',
            'tahun'     => 'required',
            'penulis'   => 'required',
            'kategori'  => 'required',
            'jumlah'    => 'required|numeric',
            'deskripsi' => 'required|min:50|max:1000',
            'penerbit'  => 'required',
            'cover'     => 'required|file|image|mimes:png,jpeg,jpg|max:2048',
        ], $messages);

        $cover = $request->file('cover');
        $tempat_upload = 'cover';
        $nama_cover = date('d-m-y') ."_". $cover->getClientOriginalName();
        $cover->move($tempat_upload, $nama_cover);

        $buku = new Buku;
        $buku->judul = $request->judul;
        $buku->isbn = $request->isbn;
        $buku->tahun = $request->tahun;
        $buku->penulis = $request->penulis;
        $buku->kategori = $request->kategori;
        $buku->jumlah = $request->jumlah;
        $buku->deskripsi = $request->deskripsi;
        $buku->penerbit = $request->penerbit;
        $buku->cover = $nama_cover;
        $buku->status = 1;
        $simpan = $buku->save();

        if ($simpan)
        {
            return redirect()->route('adminShowBuku')->with('success', 'Buku berhasil ditambahkan');
        }
        else
        {
            return back()->with('error', 'Buku gagal ditambahkan, silahkan coba kembali');
        }
    }

    public function editBuku($id)
    {
        $buku = Buku::find($id);

        return view('admin.edit_buku', ['buku' => $buku]);
    }

    public function editBukuAksi($id, Request $request)
    {
        $messages = [
            'judul.required'    => 'Judul buku wajib diisi',
            'tahun.required'    => 'Tahun penerbitan wajib diisi',
            'penulis.required'  => 'Nama Penulis Buku wajib diisi',
        ];

        $request->validate([
            'judul'     => 'required',
            'tahun'     => 'required',
            'penulis'   => 'required',
        ], $messages);

        $buku = Buku::find($id);
        $buku->judul = $request->judul;
        $buku->tahun = $request->tahun;
        $buku->penulis = $request->penulis;
        $buku->status = 1;
        $simpan = $buku->save();

        if ($simpan)
        {
            return redirect()->route('adminShowBuku')->with('success', 'Buku berhasil diedit');
        }
        else
        {
            return bacK()->with('error', 'Buku gagal diedit, silahkan coba kembali');
        }
    }

    public function hapusBuku($id)
    {
        $buku = Buku::find($id);
        File::delete('cover/'. $buku->cover);
        $buku->delete();

        return redirect()->back()->with('success', 'Buku berhasil dihapus');
    }

    public function detailBuku($id)
    {
        $buku = Buku::find($id);

        return view('admin.buku_detail', compact('buku'));
    }

    public function showAnggota()
    {
        $anggota = Anggota::paginate(10);

        return view('admin.anggota', ['anggota' => $anggota]);
    }

    public function tambahAnggota()
    {
        return view('admin.tambah_anggota');
    }

    public function tambahAnggotaAksi(Request $request)
    {
        $messages = [
            'nama.required'     => 'Nama anggota wajib diisi',
            'nama.min'          => 'Nama minimal 4 karakter',
            'nama.max'          => 'Nama maksimal 30 karakter',
            'no_hp.required'    => 'No. HP wajib diisi',
            'no_hp.numeric'     => 'No. HP harus berupa angka',
            'alamat.required'   => 'Alamat wajib diisi',
            'alamat.min'        => 'Alamat minimal 5 karakter',
            'alamat.max'        => 'Alamat maksimal 50 karakter',
            'foto.required'     => 'Foto wajib dipilih',
            'foto.file'         => 'Foto harus berupa file',
            'foto.mimes'        => 'Foto harus berekstensi png,jpeg,jpg',
            'foto.max'          => 'Foto berukuran maksimal 2048',
        ];

        $request->validate([
            'nama'      => 'required|min:4|max:30',
            'no_hp'     => 'required|numeric',
            'alamat'    => 'required|min:5|max:50',
            'foto'      => 'required|file|mimes:png,jpeg,jpg|max:2048',
        ], $messages);

        $foto = $request->file('foto');
        $tempat_upload = 'anggota';
        $nama_foto = date('d-m-y') ."_". $foto->getClientOriginalName();
        $foto->move($tempat_upload, $nama_foto);

        $anggota = new Anggota;
        $anggota->nama = $request->nama;
        $anggota->no_hp = $request->no_hp;
        $anggota->alamat = $request->alamat;
        $anggota->foto = $nama_foto;
        $simpan = $anggota->save();

        if ($simpan)
        {
            return redirect()->route('adminShowAnggota')->with('success', 'Berhasil menambah anggota');
        }
        else
        {
            return back()->with('error', 'Gagal menambah anggota, silahkan coba kembali');
        }
    }

    public function cariAnggota(Request $request)
    {
        $cari = $request->cari;

        $anggota = Anggota::where('nama', 'like', "%".$cari."%")->paginate(10);

        return view('admin.anggota', ['anggota' => $anggota]);
    }

    public function editAnggota($id)
    {
        $anggota = Anggota::find($id);

        return view('admin.edit_anggota', ['anggota' => $anggota]);
    }

    public function editAnggotaAksi(Request $request, $id)
    {
        $messages = [
            'nama.required'     => 'Nama anggota wajib diisi',
            'nama.min'          => 'Nama minimal 4 karakter',
            'nama.max'          => 'Nama maksimal 30 karaker',
            'nik.required'      => 'NIK wajib diisi',
            'nik.min'           => 'NIK minima 5 karakter',
            'nik.max'           => 'NIK maksimal 10 karakter',
            'alamat.required'   => 'Alamat wajib diisi',
            'alamat.min'        => 'Alamat minimal 5 karakter',
            'alamat.max'        => 'Alamat maksimal 50 karakter',
        ];

        $request->validate([
            'nama'      => 'required|min:4|max:30',
            'nik'       => 'required|min:5|max:20',
            'alamat'    => 'required|min:5|max:50',
        ], $messages);

        $anggota = Anggota::find($id);
        $anggota->nama = $request->nama;
        $anggota->nik = $request->nik;
        $anggota->alamat = $request->alamat;
        $simpan = $anggota->save();

        if ($simpan)
        {
            return redirect()->route('adminShowAnggota')->with('success', 'Data anggota berhasil diubah');
        }
        else
        {
            return back()->with('error', 'Gagal melakukan perubahan, silahkan coba kembali');
        }
    }

    public function hapusAnggota($id)
    {
        $anggota = Anggota::find($id);
        File::delete('anggota/'. $anggota->foto);
        $anggota->delete();

        return redirect()->route('adminShowAnggota')->with('success', 'Anggota berhasil dihapus');
    }

    public function kartuAnggota($id)
    {
        $anggota = Anggota::find($id);

        return view('admin.kartu_anggota', ['anggota' => $anggota]);
    }

    public function profilAnggota($id)
    {
        $anggota = Anggota::find($id);

        return view('admin.anggota_profil', compact('anggota'));
    }

    public function laporanPeminjaman()
    {
        $peminjaman = Peminjaman::all();

        return view('admin.laporan_peminjaman', ['peminjaman' => $peminjaman]);
    }
    
    public function filterLaporanPeminjaman(Request $request)
    {
        $rules = [
            'tanggal_mulai'     => 'required',
            'tanggal_sampai'    => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails())
        {
            $peminjaman = Peminjaman::all();

            return view('admin.laporan_peminjaman', compact('peminjaman'));
        }
        else
        {
            $tgl_mulai = $request->tanggal_mulai;
            $tgl_sampai = $request->tanggal_sampai;

            $peminjaman = Peminjaman::whereDate('peminjaman_tanggal_mulai', '>=', $tgl_mulai)->whereDate('peminjaman_tanggal_sampai', '<=', $tgl_sampai)->get();

            return view('admin.laporan_peminjaman', compact('peminjaman'));
        }

        Session::put(['mulai' => $request->tanggal_mulai, 'sampai' => $request->tanggal_sampai]);
    }


    public function cetakLaporan()
    {
        $tgl_mulai = Session::get('mulai');
        $tgl_sampai = Session::get('sampai');

        if ($tgl_mulai == "" || $tgl_sampai == "")
        {
            $peminjaman = Peminjaman::all();

            return view('admin.cetak_laporan', compact('peminjaman', 'tgl_mulai', 'tgl_sampai'));
        }
        else
        {
            $peminjaman = Peminjaman::whereDate('peminjaman_tanggal_mulai', '>=', $tgl_mulai)->whereDate('peminjaman_tanggal_sampai', '<=', $tgl_sampai)->get();

            return view('admin.cetak_laporan', compact('peminjaman', 'tgl_mulai', 'tgl_sampai'));
        }
    }

    public function katalog()
    {
        $buku = Buku::all();

        return view('admin.katalog', compact('buku'));
    }
}
