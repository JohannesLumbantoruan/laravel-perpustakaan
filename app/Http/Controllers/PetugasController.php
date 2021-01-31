<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Petugas;
use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Session;
use Validator;

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
            $simpan = Petugas::where('id', '=', Auth::guard('petugas')->user()->id)->update(['password' => Hash::make($request->password_baru),]);

            if ($simpan)
            {
                Auth::guard('petugas')->logout();

                return redirect()->route('login')->with('success', 'Password berhasil diganti, silahkan login kembali');
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

        $anggota = new Anggota;
        $anggota->nama = $request->nama;
        $anggota->nik = $request->nik;
        $anggota->alamat = $request->alamat;
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
        $anggota->delete();

        return redirect()->route('showAnggota')->with('success', 'Anggota berhasil dihapus');
    }

    public function kartuAnggota($id)
    {
        $anggota = Anggota::find($id);
        
        return view('petugas.kartu_anggota', ['anggota' => $anggota]);
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
        return view('petugas.tambah_buku');
    }

    public function tambahBukuAksi(Request $request)
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

        $buku = new Buku;
        $buku->judul = $request->judul;
        $buku->tahun = $request->tahun;
        $buku->penulis = $request->penulis;
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
        $buku->delete();

        return back()->with('success', 'Berhasil menghapus buku');
    }

    public function showPeminjaman()
    {
        $peminjaman = Peminjaman::paginate(10);

        return view('petugas.peminjaman', ['peminjaman' => $peminjaman]);
    }

    public function tambahPeminjaman()
    {
        $buku = Buku::where('status', '=', 1)->get();
        $anggota = Anggota::all();

        return view('petugas.tambah_peminjaman', ['anggota' => $anggota, 'buku' => $buku]);
    }

    public function tambahPeminjamanAksi(Request $request)
    {
        $messages = [
            'buku.required'             => 'Pilih buku yang ingin dipinjam',
            'anggota.required'          => 'Pilih anggota yang ingin meminjam',
            'tanggal_mulai.required'    => 'Tanggal mulai peminjaman wajib diisi',
            'tanggal_akhir.required'    => 'Tanggal akhir peminjaman wajib diisi',
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
            Buku::where('id', '=', $request->buku)->update(['status' => 2]);

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
        Buku::where('id', '=', $peminjaman->peminjaman_buku)->update(['status' => 1]);

        return redirect()->route('showPeminjaman')->with('success', 'Peminjaman berhasil dibatalkan');
    }

    public function peminjamanSelesai($id)
    {
        $peminjaman = Peminjaman::find($id);
        $peminjaman->update(['peminjaman_status' => 1]);
        Buku::where('id', '=', $peminjaman->peminjaman_buku)->update(['status' => 1]);

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
}
