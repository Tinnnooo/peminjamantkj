<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DataMaster;
use App\Http\Controllers\DataPengguna;
use App\Http\Controllers\LoginController;
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
    Route::post('/logout', [AdminController::class, 'logout']);

    // DATA MASTER
    Route::get('/dashboard/admin/datamaster/{any}', [DataMaster::class, 'datamaster'])->name('datamaster');

    // PENGGUNA
    Route::get('/dashboard/admin/users', [DataPengguna::class, 'index'])->name('pengguna');
    Route::delete('/dashboard/admin/users/{id}', [DataPengguna::class, 'hapusPengguna'])->name('hapus_pengguna');
    Route::put('/dashboard/admin/users/{id}', [DataPengguna::class, 'gantiPassword'])->name('ganti_password');
    Route::put('/dashboard/admin/user/{id}', [DataPengguna::class, 'editPengguna'])->name('edit_pengguna');
});

Route::get('/logout', [LoginController::class, 'logout']);


Route::middleware(['auth', 'role:guru'])->group(function(){
    Route::get('/dashboard/guru', [LoginController::class, 'index']);
});

Route::middleware(['auth', 'role:user'])->group(function(){
    Route::get('/dashboard/guru', [LoginController::class, 'index']);
});

