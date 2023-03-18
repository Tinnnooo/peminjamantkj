<?php

use Faker\Guesser\Name;
use App\Http\Controllers\DataMaster;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataPengguna;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BahanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\AmbilBahanController;
use App\Http\Controllers\PinjamBarangController;
use App\Http\Controllers\PinjamRuanganController;

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

Route::get('/', function () {
    if (Auth::check() && Auth::user()->hasRole('admin')) {
        return redirect('/dashboard/admin');
    } elseif (Auth::check() && Auth::user()->hasRole('guru')) {
        return redirect('/dashboard/guru');
    } elseif (Auth::check() && Auth::user()->hasRole('user')) {
        return redirect('/dashboard/user');
    } else {
        return redirect('/login');
    }
});



Route::middleware(['guest'])->group(function(){
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate']);
});

Route::middleware(['auth', 'role:admin'])->group(function(){

    // DASHBOARD
    Route::get('/dashboard/admin', [AdminController::class, 'index'])->name('admin.index');

    Route::put('/dashboard/admin/ruangan/{id}', [AdminController::class, 'ruanganApprove'])->name('admin.ruanganApprove');
    Route::put('/dashboard/admin/barang/{id}', [AdminController::class, 'barangApprove'])->name('admin.barangApprove');


    // LOGOUT
    Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

    // DATA MASTER

    // BARANG
    Route::get('/admin/datamaster/barang', [DataMaster::class, 'barang'])->name('barang');
    Route::post('/admin/datamaster/barang', [BarangController::class, 'tambahBarang'])->name('tambah_barang');
    Route::put('/admin/datamaster/barang/{id}', [BarangController::class, 'editBarang'])->name('edit_barang');
    Route::put('/admin/datamaster/barang/foto/{id}', [BarangController::class, 'updateFoto'])->name('update_foto');
    Route::delete('/admin/datamaster/barang/{id}', [BarangController::class, 'hapusBarang'])->name('hapus_barang');

    // RUANGAN
    Route::get('/admin/datamaster/ruangan', [DataMaster::class, 'ruangan'])->name('ruangan');
    Route::post('/admin/datamaste/ruangan', [RuanganController::class, 'tambahRuangan'])->name('tambah_ruangan');
    Route::put('/admin/datamaste/ruang/{id}', [RuanganController::class, 'editRuangan'])->name('edit_ruangan');
    Route::delete('/admin/datamaste/ruang/{id}', [RuanganController::class, 'hapusRuangan'])->name('hapus_ruangan');

    // BAHAN
    Route::get('/admin/datamaster/bahan', [DataMaster::class, 'bahan'])->name('bahan');
    Route::post('/admin/datamaster/bahan', [BahanController::class, 'tambahBahan'])->name('tambah_bahan');
    Route::put('/admin/datamaster/bahan/{id}', [BahanController::class, 'editBahan'])->name('edit_bahan');
    Route::delete('/admin/datamaster/bahan/{id}', [BahanController::class, 'hapusBahan'])->name('hapus_bahan');

    // DATA PEMINJAMAN

    // BARANG DIPINJAM
    Route::get('/admin/datapeminjaman/barangdipinjam', [PinjamBarangController::class, 'barangDipinjam'])->name('barangDipinjam');
    Route::put('/admin/datapeminjaman/barangdipinjam/{id}', [PinjamBarangController::class, 'approvePinjamBarang'])->name('approvePinjamBarang');

    // BARANG KEMBALI
    Route::get('/admin/datapeminjaman/barangkembali', [PinjamBarangController::class, 'barangKembali'])->name('barangKembali');

    // BARANG BATAL
    Route::get('/admin/datapeminjaman/barangbatal', [PinjamBarangController::class, 'barangBatal'])->name('barangBatal');

    // RUANGAN DIPINJAM
    Route::get('/admin/datapeminjaman/ruangandipinjam', [PinjamRuanganController::class, 'ruanganDipinjam'])->name('ruanganDipinjam');
    Route::put('/admin/datapeminjaman/ruangandipinjam/{id}', [PinjamRuanganController::class, 'approvePinjamRuangan'])->name('approvePinjamRuangan');

    // RUANGAN KEMBALI
    Route::get('/admin/datapeminjaman/ruangankembali', [PinjamRuanganController::class, 'ruanganKembali'])->name('ruanganKembali');

    // AMBIL BAHAN
    Route::get('/admin/ambilbahan', [AmbilBahanController::class, 'index'])->name('ambilBahan');
    Route::put('/admin/ambilbahan/{id}', [AmbilBahanController::class, 'approveBahan'])->name('approveBahan');

    // PENGGUNA
    Route::get('/admin/users', [DataPengguna::class, 'index'])->name('pengguna');
    Route::delete('/admin/users/{id}', [DataPengguna::class, 'hapusPengguna'])->name('hapus_pengguna');
    Route::put('/admin/users/{id}', [DataPengguna::class, 'gantiPassword'])->name('ganti_password');
    Route::put('/admin/user/{id}', [DataPengguna::class, 'editPengguna'])->name('edit_pengguna');
    Route::post('/admin/user', [DataPengguna::class, 'tambahPengguna'])->name('tambah_pengguna');
});

Route::middleware(['auth', 'role:guru'])->group(function(){

    // DASHBOARD
    Route::get('/dashboard/guru', [GuruController::class, 'index'])->name('guru');
    Route::put('/dashboard/guru/approveBarang/{id}', [GuruController::class, 'approveBarang'])->name('guru.approveBarang');
    Route::put('/dashboard/guru/approveRuangan/{id}', [GuruController::class, 'approveRuangan'])->name('guru.approveRuangan');


    // LOGOUT
    Route::post('guru/logout', [GuruController::class, 'logout'])->name('guru.logout');

    // PINJAM BARANG
    Route::get('guru/pinjambarang', [PinjamBarangController::class, 'pinjamBarang'])->name('pinjamBarangGuru');
    Route::put('guru/pinjambarang/batalkanpinjaman/{id}', [PinjamBarangController::class, 'batalPinjam'])->name('batalkanPinjamanGuru');
    Route::put('guru/pinjambarang/kembalikanpinjaman/{id}', [PinjamBarangController::class, 'kembaliPinjam'])->name('kembalikanPinjamanGuru');
    Route::get('guru/pinjambarang/form', [PinjamBarangController::class, 'pinjamBarang'])->name('inputPinjamBarangGuru');

    Route::post('guru/pinjambarang/kirimpinjaman', [PinjamBarangController::class, 'kirimPinjaman'])->name('kirimPinjamanGuru');

    // PINJAM RUANGAN
    Route::get('guru/pinjamruangan', [PinjamRuanganController::class, 'pinjamRuangan'])->name('pinjamRuanganGuru');
    Route::put('guru/pinjamruangan/batalkanPinjamRuangan/{id}', [PinjamRuanganController::class, 'batalkanPinjamRuangan'])->name('batalkanPinjamRuanganGuru');
    Route::put('guru/pinjamruangan/kembalikanruangan/{id}', [PinjamRuanganController::class, 'kembalikanRuangan'])->name('kembalikanRuanganGuru');
    Route::get('guru/pinjamruangan/form', [PinjamRuanganController::class, 'pinjamRuangan'])->name('inputPinjamRuanganGuru');

    Route::post('guru/pinjamruangan/kirimPinjaman', [PinjamRuanganController::class, 'kirimPinjaman'])->name('kirimPinjamanRuanganGuru');
});

Route::middleware(['auth', 'role:user'])->group(function(){

    // DASHBOARD
    Route::get('/dashboard/user', [UserController::class, 'index'])->name('user.index');


    // LOGOUT
    Route::post('user/logout', [UserController::class, 'logout'])->name('user.logout');

    // PINJAM BARANG
    Route::get('user/pinjambarang', [PinjamBarangController::class, 'pinjamBarang'])->name('pinjamBarangUser');
    Route::put('user/pinjambarang/batalkanpinjaman/{id}', [PinjamBarangController::class, 'batalPinjam'])->name('batalkanPinjamanUser');
    Route::put('user/pinjambarang/kembalikanpinjaman/{id}', [PinjamBarangController::class, 'kembaliPinjam'])->name('kembalikanPinjamanUser');
    Route::get('user/pinjambarang/form', [PinjamBarangController::class, 'pinjamBarang'])->name('inputPinjamBarangUser');

    Route::post('user/pinjambarang/kirimpinjaman', [PinjamBarangController::class, 'kirimPinjaman'])->name('kirimPinjamanUser');

    // PINJAM RUANGAN
    Route::get('user/pinjamruangan', [PinjamRuanganController::class, 'pinjamRuangan'])->name('pinjamRuanganUser');
    Route::put('user/pinjamruangan/batalkanPinjamRuangan/{id}', [PinjamRuanganController::class, 'batalkanPinjamRuangan'])->name('batalkanPinjamRuanganUser');
    Route::put('user/pinjamruangan/kembalikanruangan/{id}', [PinjamRuanganController::class, 'kembalikanRuangan'])->name('kembalikanRuanganUser');
    Route::get('user/pinjamruangan/form', [PinjamRuanganController::class, 'pinjamRuangan'])->name('inputPinjamRuanganUser');

    Route::post('user/pinjamruangan/kirimPinjaman', [PinjamRuanganController::class, 'kirimPinjaman'])->name('kirimPinjamanRuanganUser');
});

