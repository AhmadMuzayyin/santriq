<?php

use App\Http\Controllers\AbsensiDiniyahController;
use App\Http\Controllers\AbsensiPengajianController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\IzinSantriController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\PelanggaranController;
use App\Http\Controllers\PelanggaranSantriController;
use App\Http\Controllers\RayonKamarController;
use App\Http\Controllers\SantriController;
use App\Http\Controllers\SuratIzinController;
use App\Http\Controllers\TahunAkademikController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return to_route('login');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\Home\HomeController::class, 'index'])->name('home');
    Route::get('/pelanggaranBulanan', [App\Http\Controllers\Home\HomeController::class, 'pelanggaranBulanan'])->name('pelanggaranBulanan');
    Route::get('/persentasePelanggaran', [App\Http\Controllers\Home\HomeController::class, 'persentasePelanggaran'])->name('persentasePelanggaran');
    Route::controller(RayonKamarController::class)->group(function () {
        Route::get('/rayon-kamar', 'index')->name('rayon-kamar.index');
        Route::post('/rayon-kamar/store', 'store')->name('rayon-kamar.store');
        Route::put('/rayon-kamar/{rayon}/update', 'update')->name('rayon-kamar.update');
        Route::delete('/rayon-kamar/{rayon}/destroy', 'destroy')->name('rayon-kamar.destroy');
    });
    Route::controller(KamarController::class)->group(function () {
        Route::get('/kamar', 'index')->name('kamar.index');
        Route::post('/kamar/store', 'store')->name('kamar.store');
        Route::put('/kamar/{kamar}/update', 'update')->name('kamar.update');
        Route::delete('/kamar/{kamar}/destroy', 'destroy')->name('kamar.destroy');
    });
    Route::controller(SantriController::class)->group(function () {
        Route::get('/santri', 'index')->name('santri.index');
        Route::post('/santri/store', 'store')->name('santri.store');
        Route::put('/santri/{santri}/update', 'update')->name('santri.update');
        Route::delete('/santri/{santri}/destroy', 'destroy')->name('santri.destroy');
    });
    Route::controller(PelanggaranController::class)->group(function () {
        Route::get('/pelanggaran', 'index')->name('pelanggaran.index');
        Route::post('/pelanggaran/store', 'store')->name('pelanggaran.store');
        Route::put('/pelanggaran/{pelanggaran}/update', 'update')->name('pelanggaran.update');
        Route::delete('/pelanggaran/{pelanggaran}/destroy', 'destroy')->name('pelanggaran.destroy');
    });
    Route::controller(SuratIzinController::class)->group(function () {
        Route::get('/surat', 'index')->name('surat.index');
        Route::post('/surat/store', 'store')->name('surat.store');
        Route::put('/surat/{surat}/update', 'update')->name('surat.update');
        Route::delete('/surat/{surat}/destroy', 'destroy')->name('surat.destroy');
    });
    Route::controller(TahunAkademikController::class)->group(function () {
        Route::get('/tahun/akademik', 'index')->name('tahun.index');
        Route::post('/tahun/akademik/store', 'store')->name('tahun.store');
        Route::put('/tahun/akademik/{tahun}/update', 'update')->name('tahun.update');
        Route::delete('/tahun/akademik/{tahun}/destroy', 'destroy')->name('tahun.destroy');
        Route::get('/tahun/akademik/aktif/{tahun}', 'aktif')->name('tahun.aktif');
    });
    Route::controller(AbsensiDiniyahController::class)->group(function () {
        Route::get('/absensi/diniyah', 'index')->name('absensi.diniyah.index');
        Route::post('/absensi/diniyah/store', 'store')->name('absensi.diniyah.store');
        Route::put('/absensi/diniyah/{absensi}/update', 'update')->name('absensi.diniyah.update');
        Route::delete('/absensi/diniyah/{absensi}/destroy', 'destroy')->name('absensi.diniyah.destroy');
    });
    Route::controller(AbsensiPengajianController::class)->group(function () {
        Route::get('/absensi/pengajian', 'index')->name('absensi.pengajian.index');
        Route::post('/absensi/pengajian/store', 'store')->name('absensi.pengajian.store');
        Route::put('/absensi/pengajian/{absensi}/update', 'update')->name('absensi.pengajian.update');
        Route::delete('/absensi/pengajian/{absensi}/destroy', 'destroy')->name('absensi.pengajian.destroy');
    });
    Route::controller(PelanggaranSantriController::class)->group(function () {
        Route::get('/pelanggaran/santri', 'index')->name('pelanggaran.santri.index');
        Route::post('/pelanggaran/santri/store', 'store')->name('pelanggaran.santri.store');
        Route::put('/pelanggaran/santri/{pelanggaranSantri}/update', 'update')->name('pelanggaran.santri.update');
        Route::delete('/pelanggaran/santri/{pelanggaranSantri}/destroy', 'destroy')->name('pelanggaran.santri.destroy');
    });
    Route::controller(IzinSantriController::class)->group(function () {
        Route::get('/izin/santri', 'index')->name('izin.santri.index');
        Route::post('/izin/santri/store', 'store')->name('izin.santri.store');
        Route::put('/izin/santri/{izinSantri}/update', 'update')->name('izin.santri.update');
        Route::delete('/izin/santri/{izinSantri}/destroy', 'destroy')->name('izin.santri.destroy');
    });
    Route::controller(UserController::class)->group(function () {
        Route::get('/user', 'index')->name('user.index');
        Route::post('/user/store', 'store')->name('user.store');
        Route::put('/user/{user}/update', 'update')->name('user.update');
        Route::delete('/user/{user}/destroy', 'destroy')->name('user.destroy');
    });

    # logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

require __DIR__ . '/auth.php';
