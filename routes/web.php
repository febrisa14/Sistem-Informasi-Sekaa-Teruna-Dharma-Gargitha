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

            Route::get('/anggota', [App\Http\Controllers\User\AnggotaController::class, 'index'])->name('anggota.index');
            Route::get('/anggota/{id}', [App\Http\Controllers\User\AnggotaController::class, 'show'])->name('anggota.show');

            Route::get('/pengumuman', [App\Http\Controllers\User\PengumumanController::class, 'index'])->name('pengumuman.index');
            Route::get('/pengumuman/{id}', [App\Http\Controllers\User\PengumumanController::class, 'show'])->name('pengumuman.show');

            Route::get('/pengurus', [App\Http\Controllers\User\PengurusController::class, 'index'])->name('pengurus.index');
            Route::get('/pengurus/{id}', [App\Http\Controllers\User\PengurusController::class, 'show'])->name('pengurus.show');

            Route::get('/baju', [App\Http\Controllers\User\BajuController::class, 'index'])->name('baju.index');
            Route::get('/baju/{id}', [App\Http\Controllers\User\BajuController::class, 'show'])->name('baju.show');

            Route::post('order/{id}', [App\Http\Controllers\User\OrderController::class, 'prosesOrder'])->name('order');

            Route::get('/pesanan_saya', [App\Http\Controllers\User\OrderController::class, 'pesananSaya'])->name('pesanan');
            Route::get('/pesanan_saya/{no_pesanan}/edit', [App\Http\Controllers\User\OrderController::class, 'editPesanan'])->name('pesanan.edit');
            Route::put('/pesanan_saya/{no_pesanan}', [App\Http\Controllers\User\OrderController::class, 'update'])->name('pesanan.update');
            Route::post('/pesanan_saya/{no_pesanan}', [App\Http\Controllers\User\OrderController::class, 'destroy'])->name('pesanan.destroy');

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

            Route::resource('/pengurus', App\Http\Controllers\Admin\PengurusController::class);
            Route::post('/pengurus/{penguru}', [App\Http\Controllers\Admin\PengurusController::class, 'transfer'])->name('pengurus.transfer');
            Route::resource('/anggota', App\Http\Controllers\Admin\AnggotaController::class);
            Route::resource('/jenis_kegiatan', JenisKegiatanController::class)->only(['store','index','destroy']);
            Route::resource('/baju', App\Http\Controllers\Admin\BajuController::class);
            Route::resource('/pemesan', App\Http\Controllers\Admin\OrderController::class);
            Route::resource('/kas/pemasukan', App\Http\Controllers\Admin\PemasukanController::class);
            Route::resource('/kas/pengeluaran', App\Http\Controllers\Admin\PengeluaranController::class);
            Route::get('/kas/laporan',[App\Http\Controllers\Admin\CetakLaporanController::class,'cetakFormKas'])->name('kas.laporan');
            Route::get('/kas/laporan/cetak/{tglawal}/{tglakhir}',[App\Http\Controllers\Admin\CetakLaporanController::class,'cetakLaporanKas'])->name('cetak_laporan_kas');
            Route::get('/order/laporan',[App\Http\Controllers\Admin\CetakLaporanController::class,'cetakFormPemesanan'])->name('pemesanan.laporan');
            Route::get('/order/laporan/cetak/{baju_id}/{status}',[App\Http\Controllers\Admin\CetakLaporanController::class,'cetakLaporanPemesanan'])->name('cetak_laporan_pemesanan');

            Route::resource('/kegiatan', App\Http\Controllers\Admin\KegiatanController::class);
            Route::get('/kegiatan/{id}/cetak', [App\Http\Controllers\Admin\KegiatanController::class, 'cetak'])->name('kegiatan.cetak');

        //Route Profile Admin
        Route::get('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'index'])->name('profile');
        Route::post('/change_profile', [App\Http\Controllers\Admin\ProfileController::class, 'updateProfile'])->name('change_profile');
        Route::post('/change_password', [App\Http\Controllers\Admin\ChangePasswordController::class, 'changePassword'])->name('change_password');
        Route::post('/change_foto', [App\Http\Controllers\Admin\ProfileController::class, 'changeFotoProfile'])->name('change_foto');
        Route::get('/delete_foto', [App\Http\Controllers\Admin\ProfileController::class, 'deleteFotoProfile'])->name('delete_foto');
    });
});
