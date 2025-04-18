<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\RekamMedisController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\TindakanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::resource('user', UserController::class);  
});

Route::middleware(['auth', 'role:operator'])->prefix('admin')->group(function () {
    Route::resource('pasien', PasienController::class);
});

Route::middleware(['auth', 'role:operator,admin'])->prefix('admin')->group(function () {
    Route::resource('obat', ObatController::class);
    Route::resource('tindakan', TindakanController::class);
    Route::resource('pegawai', PegawaiController::class);   
});

Route::middleware(['auth', 'role:dokter'])->prefix('admin')->group(function () {
    Route::get('rekam_medis', [RekamMedisController::class, 'index'])->name('rekam_medis.index');
    Route::get('rekam_medis/create', [RekamMedisController::class, 'create'])->name('rekam_medis.create');
    Route::post('rekam_medis', [RekamMedisController::class, 'store'])->name('rekam_medis.store');
    Route::get('rekam_medis/{rekam_medis}', [RekamMedisController::class, 'show'])->name('rekam_medis.show');
    Route::get('rekam_medis/{rekam_medis}/edit', [RekamMedisController::class, 'edit'])->name('rekam_medis.edit');
    Route::put('rekam_medis/{rekam_medis}', [RekamMedisController::class, 'update'])->name('rekam_medis.update');
    Route::delete('rekam_medis/{rekam_medis}', [RekamMedisController::class, 'destroy'])->name('rekam_medis.destroy');
    Route::get('/rekam-medis/cetak/{id}', [RekamMedisController::class, 'cetak'])->name('rekam_medis.cetak'); 
});

Route::middleware(['auth', 'role:kasir'])->prefix('admin')->group(function () {
    Route::resource('tagihan', TagihanController::class);
    Route::get('/tagihan/{id}/cetak', [TagihanController::class, 'cetak'])->name('tagihan.cetak'); 
});

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home')
    ->middleware('role:dokter,admin,operator,kasir');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
