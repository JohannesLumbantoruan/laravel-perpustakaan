<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Petugas;
use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Katalog;
use App\Models\Kategori;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Session;
use Validator;
use File;

class PetugasController extends Controller
{
    public function gantiPassword()
    {
        return view('petugas.ganti_password');
    }

    public function gantiPasswordAksi(Request $request)
    {
        $messages = [
            'password_lama.required'    => 'Password lama wajib diisi',
            'password_baru.required'    => 'Password Baru wajib diisi',
            'password_baru.min'         => 'Password minimal 4 karakter',
            'password_baru.max'         => 'Password maksimal 20 karaker',
            'password_ulang.required'   => 'Ulangi Password',
            'password_ulang.same'       => 'Password tidak sama',
        ];

        $request->validate([
            'password_lama'     => 'required',
            'password_baru'     => 'required|min:4|max:20',
            'password_ulang'    => 'required|same:password_baru',
        ], $messages);

        if (Hash::check($request->password_lama, Auth::guard('petugas')->user()->password))
        {
            if (Hash::check($request->password_baru, Auth::guard('petugas')->user()->password))
            {
                return redirect()->route('petugasGantiPassword')->with('error', 'Password baru tidak boleh sama dengan password lama');
            }
            else
            {
                $simpan = Petugas::where('id', '=', Auth::guard('petugas')->user()->id)->update(['password' => Hash::make($request->password_baru),]);

                if ($simpan)
                {
                    Auth::guard('petugas')->logout();
    
                    return redirect()->route('login')->with('success', 'Password berhasil diganti, silahkan login kembali');
                }
            }
        }
        else
        {
            return back()->with('error', 'Password tidak sama, silahkan coba kembali');
        }
    }

    public function showAnggota()
    {
        $anggota = Anggota::paginate(10);

        return view('petugas.anggota', ['anggota' => $anggota]);
    }

    public function cariAnggota(Request $request)
    {
        $cari = $request->cari;

        $anggota = Anggota::where('nama', 'like', "%".$cari."%")->paginate(10);

        return view('petugas.anggota', ['anggota' => $anggota]);
    }

    public function tambahAnggota()
    {
        return view('petugas.tambah_anggota');
    }

    public function tambahAnggotaAksi(Request $request)
    {
        $messages = [
            'nama.required'     => 'Nama Lengkap wajib diisi',
            'nama.min'          => 'Nama minimal 4 karakter',
            'nama.max'          => 'Nama maksimal 30 karakter',
            'no_hp.required'    => 'No. HP wajib diisi',
            'no_hp.numeric'     => 'No. HP harus berupa angka',
            'alamat.required'   => 'Alamat wajib diisi',
            'alamat.min'        => 'Alamat minimal 5 karakter',
            'alamat.max'        => 'Alamat maksimal 50 karakter',
            'foto.required'     => 'Foto anggota wajib dipilih',
            'foto.file'         => 'Foto harus berupa file',
            'foto.mimes'        => 'Foto harus berekstensi png,jpeg,jpg',
            'foto.max'          => 'Foto maksimal berukuran 2048',
        ];

        $request->validate([
            'nama'      => 'required|min:4|max:30',
            'no_hp'     => 'required|numeric',
            'alamat'    => 'required|min:5|max:50',
            'foto'      => 'required|file|mimes:jpeg,jpg,png|max:2048',
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
            return redirect()->route('showAnggota')->with('success', 'Anggota berhasil ditambahkan');
        }
        else
        {
            return back()->with('error', 'Gagal menambah anggota, silahkan coba kembali');
        }
    }

    public function editAnggota($id)
    {
        $anggota = Anggota::find($id);

        return view('petugas.edit_anggota', ['anggota' => $anggota]);
    }

    public function editAnggotaAksi(Request $request, $id)
    {
        $messages = [
            'nama.required'     => 'Nama Lengkap wajib diisi',
            'nama.min'          => 'Nama minimal 4 karakter',
            'nama.max'          => 'Nama maksimal 30 karakter',
            'nik.required'      => 'NIK wajib diisi',
            'nik.min'           => 'NIK minimal 5 karakter',
            'nik.max'           => 'NIK maksimal 10 karakter',
            'nik.unique'        => 'NIK sudah terdaftar',
            'alamat.required'   => 'Alamat wajib diisi',
            'alamat.min'        => 'Alamat minimal 5 karakter',
            'alamat.max'        => 'Alamat maksimal 50 karakter',
        ];

        $request->validate([
            'nama'      => 'required|min:4|max:30',
            'nik'       => 'required|min:5|max:10|unique:anggota',
            'alamat'    => 'required|min:5|max:50',
        ], $messages);

        $anggota = Anggota::find($id);
        $anggota->nama = $request->nama;
        $anggota->nik = $request->nik;
        $anggota->alamat = $request->alamat;
        $simpan = $anggota->save();

        if ($simpan)
        {
            return redirect()->route('showAnggota')->with('success', 'Data Anggota berhasi diperbaharui');
        }
        else
        {
            return back()->with('error', 'Gagal memperbaharui data anggota');
        }
    }

    public function hapusAnggota($id)
    {
        $anggota = Anggota::find($id);
        File::delete('anggota/'. $anggota->foto);
        $anggota->delete();

        return redirect()->route('showAnggota')->with('success', 'Anggota berhasil dihapus');
    }

    public function kartuAnggota($id)
    {
        $anggota = Anggota::find($id);
        
        return view('petugas.kartu_anggota', ['anggota' => $anggota]);
    }

    public function profilAnggota($id)
    {
        $anggota = Anggota::find($id);

        return view('petugas.anggota_profil', compact('anggota'));
    }

    public function showBuku()
    {
        $buku = Buku::paginate(10);

        return view('petugas.buku', ['buku' => $buku]);
    }

    public function cariBuku(Request $request)
    {
        $cari = $request->cari;
        $buku = Buku::where('judul', 'like', "%".$cari."%")->paginate(10);

        return view('petugas.buku', ['buku' => $buku]);
    }

    public function tambahBuku()
    {
        $kategori = Kategori::all();

        return view('petugas.tambah_buku', compact('kategori'));
    }

    public function tambahBukuAksi(Request $request)
    {
        $messages = [
            'judul.required'        => 'Judul Buku wajib diisi',
            'iabn.required'         => 'No. ISBN wajib diisi',
            'tahun.required'        => 'Tahun penerbitan wajib diisi',
            'penulis.required'      => 'Nama Penulis Buku wajib diisi',
            'kategori.required'     => 'Kategori buku wajib dipilih',
            'jumlah.required'       => 'Jumlah(stock) buku wajib diisi',
            'jumlah.numeric'        => 'Jumlah(stock) buku harus berupa angka',
            'deskripsi.required'    => 'Deskripsi/sinopsis buku wajib diisi',
            'deskripsi.min'         => 'Deskripsi/sinopsis buku minimal 50 karakter',
            'deskripsi.max'         => 'Deskripsi/sinopsis buku maksimal 1000 karakter',
            'penerbit.required'     => 'Penerbit buku wajib diisi',
            'cover.required'        => 'Cover buku wajib dipilih',
            'cover.file'            => 'Cover buku harus berupa file gambar',
            'cover.mimes'           => 'Cover buku harus berekstensi jpeg,jpg,png',
            'cover.max'             => 'Cover buku maksimal berukuran 2048',
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
            'cover'     => 'required|file|mimes:jpeg,jpg,png|max:2048',
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
            return redirect()->route('showBuku')->with('success', 'Buku berhasil ditambahkan');
        }
        else
        {
            return back()->with('error', 'Gagal menambahkan buku, silahkan coba kembali');
        }
    }

    public function editBuku($id)
    {
        $buku = Buku::find($id);

        return view('petugas.edit_buku', ['buku' => $buku]);
    }

    public function editBukuAksi($id, Request $request)
    {
        $messages = [
            'judul.required'    => 'Judul Buku wajib diisi',
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
            return redirect()->route('showBuku')->with('success', 'Buku berhasil diedit');
        }
        else
        {
            return back()->with('error', 'Gagal mengedit buku, silahkan coba kembali');
        }
    }

    public function hapusBuku($id)
    {
        $buku = Buku::find($id);
        File::delete('cover/'. $buku->cover);
        $buku->delete();

        return back()->with('success', 'Berhasil menghapus buku');
    }

    public function detailBuku($id)
    {
        $buku = Buku::find($id);

        return view('petugas.buku_detail', compact('buku'));
    }

    public function showPeminjaman()
    {
        $peminjaman = Peminjaman::orderBy('peminjaman_id', 'desc')->paginate(10);
        $buku = Buku::where('status', 1)->get();
        $anggota = Anggota::all();

        return view('petugas.peminjaman', compact('peminjaman', 'buku', 'anggota'));
    }

    public function tambahPeminjaman()
    {
        $buku = Buku::where('jumlah', '>', 0)->get();
        $anggota = Anggota::all();

        return view('petugas.tambah_peminjaman', ['anggota' => $anggota, 'buku' => $buku]);
    }

    public function tambahPeminjamanAksi(Request $request)
    {
        $messages = [
            'buku.required'             => 'Pilih buku yang ingin dipinjam',
            'anggota.required'          => 'Pilih anggota yang ingin meminjam',
            'tanggal_mulai.required'    => 'Tanggal mulai peminjaman wajib diisi',
            'tanggal_selesai.required'  => 'Tanggal selesai peminjaman wajib diisi',
        ];

        $request->validate([
            'buku'              => 'required',
            'anggota'           => 'required',
            'tanggal_mulai'     => 'required',
            'tanggal_selesai'   => 'required',
        ], $messages);

        $peminjaman = new Peminjaman;
        $peminjaman->peminjaman_buku = $request->buku;
        $peminjaman->peminjaman_anggota = $request->anggota;
        $peminjaman->peminjaman_tanggal_mulai = $request->tanggal_mulai;
        $peminjaman->peminjaman_tanggal_sampai = $request->tanggal_selesai;
        $peminjaman->peminjaman_status = 2;
        $simpan = $peminjaman->save();

        if ($simpan)
        {
            Buku::where('id', $request->buku)->decrement('jumlah');
            if (Buku::where('id', $request->buku)->where('jumlah', '>', 0))
            {
                Buku::where('id', $request->buku)->update(['status' => 1]);
            }
            else
            {
                Buku::where('id', $request->buku)->update(['status' => 2]);
            }

            return redirect()->route('showPeminjaman')->with('success', 'Peminjaman baru berhasil ditambahkan');
        }
        else
        {
            return back()->with('error', 'Gagal menambahkan peminjaman, silahkan coba kembali');
        }
    }

    public function batalkanPeminjaman($id)
    {
        $peminjaman = Peminjaman::find($id);
        $peminjaman->delete();
        Buku::where('id', '=', $peminjaman->peminjaman_buku)->increment('jumlah');

        return redirect()->route('showPeminjaman')->with('success', 'Peminjaman berhasil dibatalkan');
    }

    public function peminjamanSelesai($id)
    {
        $peminjaman = Peminjaman::find($id);
        $peminjaman->update(['peminjaman_status' => 1]);
        Buku::where('id', '=', $peminjaman->peminjaman_buku)->increment('jumlah');

        return back()->with('success', 'Buku telah dikembalikan');
    }

    public function laporanPeminjaman()
    {
        $peminjaman = Peminjaman::all();

        return view('petugas.laporan_peminjaman', ['peminjaman' => $peminjaman]);
    }

    public function filterLaporanPeminjaman(Request $request)
    {
        $rules = [
            'tanggal_mulai'     => 'required',
            'tanggal_sampai'    => 'required',
        ];

        Session::put(['mulai' => $request->tanggal_mulai, 'sampai' => $request->tanggal_sampai]);

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails())
        {
            $peminjaman = Peminjaman::all();

            return view('petugas.laporan_peminjaman', ['peminjaman' => $peminjaman]);
        }
        else
        {
            $tanggal_mulai = $request->tanggal_mulai;
            $tanggal_sampai = $request->tanggal_sampai;

            $peminjaman = Peminjaman::whereDate('peminjaman_tanggal_mulai', '>=', $tanggal_mulai)->whereDate('peminjaman_tanggal_sampai', '<=', $tanggal_sampai)->get();

            return view('petugas.laporan_peminjaman', ['peminjaman' => $peminjaman]);

        }
    }

    public function cetakLaporan(Request $request)
    {
        $tanggal_mulai = Session::get('mulai');
        $tanggal_sampai = Session::get('sampai');

        if ($tanggal_mulai == "" || $tanggal_sampai == "")
        {
            $peminjaman = Peminjaman::all();

            return view('petugas.cetak_laporan', ['peminjaman' => $peminjaman, 'tanggal_mulai' => $tanggal_mulai, 'tanggal_sampai' => $tanggal_sampai]);
        }
        else
        {
            $peminjaman = Peminjaman::whereDate('peminjaman_tanggal_mulai', '>=', $tanggal_mulai)->whereDate('peminjaman_tanggal_sampai', '<=', $tanggal_sampai)->get();

            return view('petugas.cetak_laporan', ['peminjaman' => $peminjaman, 'tanggal_mulai' => $tanggal_mulai, 'tanggal_sampai' => $tanggal_sampai]);
        }
    }

    public function katalog()
    {
        $buku = Buku::all();

        return view('petugas.katalog', compact('buku'));
    }
}
