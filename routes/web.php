<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
| These routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth:sanctum', 'verified', 'check_babinsa'])->group(function () {
    // Semua rute yang memerlukan autentikasi dan memeriksa peran 'Babinsa'
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/list-laporan-pending', [LaporanController::class, 'index'])->name('list-laporan-pending');
Route::get('/list-laporan-accepted', [LaporanController::class, 'laporanDiterima'])->name('list-laporan-accepted');
Route::get('/list-laporan-rejected', [LaporanController::class, 'laporanDitolak'])->name('list-laporan-rejected');

    Route::post('/tambah-laporan', [LaporanController::class, 'store'])->name('laporan.store');

   Route::get('/tambah-laporan', function () {
        return view('tambah-laporan');
    })->name('tambah-laporan');
    Route::get('/edit-laporan/{id}', [LaporanController::class, 'edit'])->name('edit-laporan');
    Route::put('/laporan/{laporan}', [LaporanController::class, 'update'])->name('laporan.update');
    Route::delete('/laporan/{laporan}', [LaporanController::class, 'destroy'])->name('laporan.destroy');
    Route::get('/laporan/{laporan}', [LaporanController::class, 'show'])->name('laporan.show');
    // Tambahkan rute-rute lainnya di sini...
});
