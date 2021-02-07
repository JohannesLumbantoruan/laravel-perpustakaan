<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Petugas;
use App\Models\Peminjaman;
use App\Models\Buku;
use App\Models\Anggota;
use App\Models\Katalog;
use Hash;
use Auth;

class LoginController extends Controller
{
    public function home()
    {
        $katalog = Katalog::all();

        return view('perpustakaan', compact('katalog'));
    }

    public function getLogin()
    {
        if (Auth::guard('admin')->check())
        {
            return redirect()->route('adminDashboard');
        }
        elseif(Auth::guard('petugas')->check())
        {
            return redirect()->route('petugasDashboard');
        }
        else
        {
            return view('login');
        }
    }

    public function postLogin(Request $request)
    {
        $messages = [
            'username.required' => 'Username wajib diisi',
            'password.required' => 'Password wajib diisi',
            'sebagai.required'  => 'Pilih salah satu',
        ];

        $request->validate([
            'username'      => 'required',
            'password'      => 'required',
            'sebagai'       => 'required',
        ], $messages);

        $sebagai = $request->sebagai;

        if ($sebagai == "admin")
        {
            $data = [
                'username'  => $request->username,
                'password'  => $request->password,
            ];

            Auth::guard('admin')->attempt($data);

            if (Auth::guard('admin')->check())
            {
                return redirect()->route('adminDashboard');
            }
            else
            {
                return back()->with('error', 'Username atau password salah');
            }
        }
        elseif ($sebagai == "petugas")
        {
            $data = [
                'username'  => $request->username,
                'password'  => $request->password,
            ];

            Auth::guard('petugas')->attempt($data);

            if (Auth::guard('petugas')->check())
            {
                return redirect()->route('petugasDashboard');
            }
            else
            {
                return back()->with('error', 'Username atau password salah');
            }
        }
        else
        {
            return back()->with('error', 'Tolong isi semua data');
        }
    }

    public function adminDashboard()
    {
        $anggota = Anggota::count();
        $petugas = Petugas::count();
        $peminjaman = Peminjaman::count();
        $buku = Buku::count();

        return view('admin.dashboard', ['anggota' => $anggota, 'petugas' => $petugas, 'peminjaman' => $peminjaman, 'buku' => $buku]);
    }

    public function adminLogout()
    {
        Auth::guard('admin')->logout();

        return redirect()->route('login')->with('success', 'Anda telah berhasil logout');
    }

    public function petugasDashboard()
    {
        $anggota = Anggota::count();
        $petugas = Petugas::count();
        $peminjaman = Peminjaman::count();
        $buku = Buku::count();

        return view('petugas.dashboard', ['anggota' => $anggota, 'petugas' => $petugas, 'peminjaman' => $peminjaman, 'buku' => $buku]);
    }

    public function petugasLogout()
    {
        Auth::guard('petugas')->logout();

        return redirect()->route('login')->with('success', 'Anda telah berhasil logout');
    }
}
