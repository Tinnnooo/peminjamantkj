<?php

use App\Http\Controllers\AdminController;
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
    Route::get('/login', [LoginController::class, 'index']);
    Route::post('/login', [LoginController::class, 'authenticate']);
});

Route::middleware(['auth', 'role:admin'])->group(function(){
    Route::get('/dashboard/admin', [AdminController::class, 'index']);
    Route::get('/logout', [LoginController::class, 'logout']);
});


Route::middleware(['auth', 'role:guru'])->group(function(){
    Route::get('/dashboard/guru', [LoginController::class, 'index']);
});

Route::middleware(['auth', 'role:user'])->group(function(){
    Route::get('/dashboard/guru', [LoginController::class, 'index']);
});

