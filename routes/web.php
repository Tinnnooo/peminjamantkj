<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AmbilBahanController;
use App\Http\Controllers\BahanController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DataMaster;
use App\Http\Controllers\DataPengguna;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PinjamBarangController;
use App\Http\Controllers\PinjamRuanganController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\UserController;
use Faker\Guesser\Name;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function() {
    return redirect('/login');
})->middleware(['guest']);

Route::get('/', function() {
    return redirect('/dashboard/admin');
})->middleware(['auth', 'role:admin']);

Route::get('/', function() {
    return redirect('/dashboard/guru');
})->middleware(['auth', 'role:guru']);

Route::get('/', function() {
    return redirect('/dashboard/user');
})->middleware(['auth', 'role:user']);

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

    // LOGOUT
    Route::post('guru/logout', [GuruController::class, 'logout'])->name('guru.logout');

    // PINJAM BARANG
    Route::get('guru/pinjambarang', [PinjamBarangController::class, 'pinjamBarang'])->name('pinjamBarang');
});

Route::middleware(['auth', 'role:user'])->group(function(){
    // DASHBOARD
    Route::get('/dashboard/user', [UserController::class, 'index'])->name('user.index');

    // LOGOUT
    Route::post('user/logout', [UserController::class, 'logout'])->name('user.logout');

    // PINJAM BARANG
    Route::get('user/pinjambarang', [PinjamBarangController::class, 'pinjamBarang'])->name('pinjamBarang');
    Route::put('user/pinjambarang/batalkanpinjaman/{id}', [PinjamBarangController::class, 'batalPinjam'])->name('batalkanPinjaman');
    Route::put('user/pinjambarang/kembalikanpinjaman/{id}', [PinjamBarangController::class, 'kembaliPinjam'])->name('kembalikanPinjaman');
});

