<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Petugas;
use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Peminjaman;
use Hash;
use Auth;
use Validator;
use Session;

class AdminController extends Controller
{
    public function gantiPassword()
    {
        return view('admin.ganti_password');
    }
    
    public function gantiPasswordAksi(Request $request)
    {
        $messages = [
            'password_baru.required'    => 'Password Baru wajib diisi',
            'password_baru.min'         => 'Password minimal 4 karakter',
            'password_baru.max'         => 'Password maksimal 20 karakter',
            'password_ulang.required'   => 'Ulangi Password',
            'password_ulang.same'       => 'Password tidak sama',
        ];

        $request->validate([
            'password_baru'     => 'required|min:4|max:20',
            'password_ulang'    => 'required|same:password_baru',
        ], $messages);

        $simpan = Admin::where('id', '=', Auth::guard('admin')->user()->id)->update([
            'password'  => Hash::make($request->password_baru),
        ]);

        if ($simpan)
        {
            Auth::guard('admin')->logout();

            return redirect()->route('login')->with('success', 'Password berhasil diubah, silahkan login kembali');
        }
        else
        {
            return back()->with('error', 'Gagal mengganti password, silahkan coba kembali');
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
        ];

        $request->validate([
            'nama'      => 'required|min:4|max:30',
            'username'  => 'required|min:4|max:10',
            'password'  => 'required|min:4|max:20',
        ], $messages);

        $petugas = new Petugas;
        $petugas->nama = $request->nama;
        $petugas->username = $request->username;
        $petugas->password = Hash::make($request->password);
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
        $buku = Buku::paginate(10);

        return view('admin.buku', ['buku' => $buku]);
    }

    public function tambahBuku()
    {
        return view('admin.tambah_buku');
    }
    
    public function tambahBukuAksi(Request $request)
    {
        $messages = [
            'judul.required'    => 'Judul buku wajib diisi',
            'tahun.required'    => 'Tahun penerbitan buku wajib diisi',
            'penulis.required'  => 'Nama penulis buku wajib diisi',
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
        $buku->delete();

        return redirect()->back()->with('success', 'Buku berhasil dihapus');
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
            'nik.required'      => 'NIK wajib diisi',
            'nik.min'           => 'NIK minimal 5 karater',
            'nik.max'           => 'NIK maksimal 10 karakter',
            'alamat.required'   => 'Alamat wajib diisi',
            'alamat.min'        => 'Alamat minimal 5 karakter',
            'alamat.max'        => 'Alamat maksimal 50 karakter',
        ];

        $request->validate([
            'nama'      => 'required|min:4|max:30',
            'nik'       => 'required|min:5|max:10',
            'alamat'    => 'required|min:5|max:50',
        ], $messages);

        $anggota = new Anggota;
        $anggota->nama = $request->nama;
        $anggota->nik = $request->nik;
        $anggota->alamat = $request->alamat;
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
        $anggota->delete();

        return redirect()->route('adminShowAnggota')->with('success', 'Anggota berhasil dihapus');
    }

    public function kartuAnggota($id)
    {
        $anggota = Anggota::find($id);

        return view('admin.kartu_anggota', ['anggota' => $anggota]);
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
}
