<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PetugasController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [LoginController::class, 'getLogin'])->name('login');
Route::post('/login', [LoginController::class, 'postLogin'])->name('loginAksi');

Route::middleware('auth:admin')->group(function()
{
    Route::get('/admin/dashboard', [LoginController::class, 'adminDashboard'])->name('adminDashboard');
    Route::get('/admin/logout', [LoginController::class, 'adminLogout'])->name('adminLogout');
    Route::get('/admin/ganti_password', [AdminController::class, 'gantiPassword'])->name('adminGantiPassword');
    Route::put('/admin/ganti_password_aksi', [AdminController::class, 'gantiPasswordAksi'])->name('adminGantiPasswordAksi');
    Route::get('/admin/petugas', [AdminController::class, 'showPetugas'])->name('showPetugas');
    Route::get('/admin/tambah_petugas', [AdminController::class, 'tambahPetugas'])->name('tambahPetugas');
    Route::post('/admin/tambah_petugas_aksi', [AdminController::class, 'tambahPetugasAksi'])->name('tambahPetugasAksi');
    Route::get('/admin/edit_petugas/{id}', [AdminController::class, 'editPetugas'])->name('editPetugas');
    Route::put('/admin/edit_petugas_aksi/{id}', [AdminController::class, 'editPetugasAksi'])->name('editPetugasAksi');
    Route::get('/admin/petugas/cari', [AdminController::class, 'cariPetugas'])->name('cariPetugas');
    Route::get('/admin/hapus_petugas/{id}', [AdminController::class, 'hapusPetugas'])->name('hapusPetugas');
    Route::get('/admin/buku', [AdminController::class, 'showBuku'])->name('adminShowBuku');
    Route::get('/admin/buku/cari', [AdminController::class, 'cariBuku'])->name('adminCariBuku');
    Route::get('/admin/tambah_buku', [AdminController::class, 'tambahBuku'])->name('adminTambahBuku');
    Route::post('/admin/tambah_buku/aksi', [AdminController::class, 'tambahBukuAksi'])->name('adminTambahBukuAksi');
    Route::get('/admin/edit_buku/{id}', [AdminController::class, 'editBuku'])->name('adminEditBuku');
    Route::put('/admin/edit_buku_aksi/{id}', [AdminController::class, 'editBukuAksi'])->name('adminEditBukuAksi');
    Route::get('/admin/hapus_buku/{id}', [AdminController::class, 'hapusBuku'])->name('adminHapusBuku');
    Route::get('/admin/anggota', [AdminController::class, 'showAnggota'])->name('adminShowAnggota');
    Route::get('/admin/tambah_anggota', [AdminController::class, 'tambahAnggota'])->name('adminTambahAnggota');
    Route::post('/admin/tambah_anggota_aksi', [AdminController::class, 'tambahAnggotaAksi'])->name('adminTambahAnggotaAksi');
    Route::get('/admin/anggota/cari', [AdminController::class, 'cariAnggota'])->name('adminCariAnggota');
    Route::get('/admin/edit_anggota/{id}', [AdminController::class, 'editAnggota'])->name('adminEditAnggota');
    Route::put('/admin/edit_anggota_aksi/{id}', [AdminController::class, 'editAnggotaAksi'])->name('adminEditAnggotaAksi');
    Route::get('/admin/hapus_anggota/{id}', [AdminController::class, 'hapusAnggota'])->name('adminHapusAnggota');
    Route::get('/admin/kartu_anggota/{id}', [AdminController::class, 'kartuAnggota'])->name('adminKartuAnggota');
    Route::get('/admin/laporan_peminjaman', [AdminController::class, 'laporanPeminjaman'])->name('adminLaporanPeminjaman');
    Route::get('/admin/laporan_peminjaman/cetak', [AdminController::class, 'cetakLaporan'])->name('adminCetakLaporan');
    Route::get('/admin/laporan_peminjaman/filter', [AdminController::class, 'filterLaporanPeminjaman'])->name('adminFilterLaporanPeminjaman');
});

Route::middleware('auth:petugas')->group(function()
{
    Route::get('/petugas/dashboard', [LoginController::class, 'petugasDashboard'])->name('petugasDashboard');
    Route::get('/petugas/logout', [LoginController::class, 'petugasLogout'])->name('petugasLogout');
    Route::get('/petugas/ganti_password', [PetugasController::class, 'gantiPassword'])->name('petugasGantiPassword');
    Route::put('/petugas/ganti_password_aksi', [PetugasController::class, 'gantiPasswordAksi'])->name('petugasGantiPasswordAksi');
    Route::get('/petugas/anggota', [PetugasController::class, 'showAnggota'])->name('showAnggota');
    Route::get('/petugas/anggota/cari', [PetugasController::class, 'cariAnggota'])->name('cariAnggota');
    Route::get('/petugas/tambah_anggota', [PetugasController::class, 'tambahAnggota'])->name('tambahAnggota');
    Route::post('/petugas/tambah_anggota_aksi', [PetugasController::class, 'tambahAnggotaAksi'])->name('tambahAnggotaAksi');
    Route::get('/petugas/edit_anggota/{id}', [PetugasController::class, 'editAnggota'])->name('editAnggota');
    Route::put('/petugas/edit_anggota_aksi/{id}', [PetugasController::class, 'editAnggotaAksi'])->name('editAnggotaAksi');
    Route::get('/petugas/hapus_anggota/{id}', [PetugasController::class, 'hapusAnggota'])->name('hapusAnggota');
    Route::get('/petugas/kartu_anggota/{id}', [PetugasController::class, 'kartuAnggota'])->name('kartuAnggota');
    Route::get('/petugas/buku', [PetugasController::class, 'showBuku'])->name('showBuku');
    Route::get('/petugas/buku/cari', [PetugasController::class, 'cariBuku'])->name('cariBuku');
    Route::get('/petugas/tambah_buku', [PetugasController::class, 'tambahBuku'])->name('tambahBuku');
    Route::post('/petugas/tambah_buku_aksi', [PetugasController::class, 'tambahBukuAksi'])->name('tambahBukuAksi');
    Route::get('/petugas/edit_buku/{id}', [PetugasController::class, 'editBuku'])->name('editBuku');
    Route::put('/petugas/edit_buku_aksi/{id}', [PetugasController::class, 'editBukuAksi'])->name('editBukuAksi');
    Route::get('/petugas/hapus_buku/{id}', [PetugasController::class, 'hapusBuku'])->name('hapusBuku');
    Route::get('/petugas/peminjaman', [PetugasController::class, 'showPeminjaman'])->name('showPeminjaman');
    Route::get('/petugas/peminjaman/cari', [PetugasController::class, 'cariPeminjaman'])->name('cariPeminjaman');
    Route::get('/petugas/tambah_peminjaman', [PetugasController::class, 'tambahPeminjaman'])->name('tambahPeminjaman');
    Route::post('/petugas/tambah_peminjaman_aksi', [PetugasController::class, 'tambahPeminjamanAksi'])->name('tambahPeminjamanAksi');
    Route::get('/petugas/batalkan_peminjaman/{id}', [PetugasController::class, 'batalkanPeminjaman'])->name('batalkanPeminjaman');
    Route::get('/petugas/peminjaman_selesai/{id}', [PetugasController::class, 'peminjamanSelesai'])->name('peminjamanSelesai');
    Route::get('/petugas/laporan_peminjaman', [PetugasController::class, 'laporanPeminjaman'])->name('laporanPeminjaman');
    Route::get('/petugas/laporan_peminjaman/filter', [PetugasController::class, 'filterLaporanPeminjaman'])->name('filterLaporanPeminjaman');
    Route::get('/petugas/laporan_peminjaman/cetak', [PetugasController::class, 'cetakLaporan'])->name('cetakLaporan');
});