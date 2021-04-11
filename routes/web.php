<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\JenisKegiatanController;

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

require __DIR__.'/auth.php';

Route::get('/', function (){
    return redirect()->route('login');
})->middleware('guest');

Route::middleware(['auth'])->group(function () {

    //Route User
    Route::middleware(['user'])->prefix('anggota')->name('user.')->group(function () {

        Route::get('/', [App\Http\Controllers\User\DashboardController::class, '__invoke'])->name('dashboard');

        Route::middleware(['verified'])->group(function () {
            Route::get('/anggota', [App\Http\Controllers\User\AnggotaController::class, 'index'])->name('anggota.index');
            Route::get('/anggota/{id}', [App\Http\Controllers\User\AnggotaController::class, 'show'])->name('anggota.show');

            Route::get('/pengumuman', [App\Http\Controllers\User\PengumumanController::class, 'index'])->name('pengumuman.index');
            Route::get('/pengumuman/{id}', [App\Http\Controllers\User\PengumumanController::class, 'show'])->name('pengumuman.show');

            Route::get('/pengurus', [App\Http\Controllers\User\PengurusController::class, 'index'])->name('pengurus.index');
            Route::get('/pengurus/{id}', [App\Http\Controllers\User\PengurusController::class, 'show'])->name('pengurus.show');

        });

        //Route Profil User
        Route::get('/profile', [App\Http\Controllers\User\ProfileController::class, 'index'])->name('profile');
        Route::post('/change_profile', [App\Http\Controllers\User\ProfileController::class, 'updateProfile'])->name('change_profile');
        Route::post('/change_password', [App\Http\Controllers\User\ChangePasswordController::class, 'changePassword'])->name('change_password');
        Route::post('/change_foto', [App\Http\Controllers\User\ProfileController::class, 'changeFotoProfile'])->name('change_foto');
        Route::get('/delete_foto', [App\Http\Controllers\User\ProfileController::class, 'deleteFotoProfile'])->name('delete_foto');
    });

    //Route Admin
    Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {

        Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, '__invoke'])->name('dashboard');

        Route::middleware(['verified'])->group(function () {
            Route::resource('/pengurus', App\Http\Controllers\Admin\PengurusController::class);
            Route::resource('/anggota', App\Http\Controllers\Admin\AnggotaController::class);
            Route::resource('/jenis_kegiatan', JenisKegiatanController::class)->only(['store','index','destroy']);

            Route::resource('/kegiatan', App\Http\Controllers\Admin\KegiatanController::class);
            Route::get('/kegiatan/{id}/cetak', [App\Http\Controllers\Admin\KegiatanController::class, 'cetak'])->name('kegiatan.cetak');
        });

        //Route Profile Admin
        Route::get('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'index'])->name('profile');
        Route::post('/change_profile', [App\Http\Controllers\Admin\ProfileController::class, 'updateProfile'])->name('change_profile');
        Route::post('/change_password', [App\Http\Controllers\Admin\ChangePasswordController::class, 'changePassword'])->name('change_password');
        Route::post('/change_foto', [App\Http\Controllers\Admin\ProfileController::class, 'changeFotoProfile'])->name('change_foto');
        Route::get('/delete_foto', [App\Http\Controllers\Admin\ProfileController::class, 'deleteFotoProfile'])->name('delete_foto');
    });
});
