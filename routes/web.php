<?php

use Illuminate\Support\Facades\Route;

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
//  jika user belum login
Route::group(['middleware' => 'guest'], function() {
    Route::get('/', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
    Route::post('/login', [\App\Http\Controllers\AuthController::class, 'dologin']);
    Route::post('/regisanggota', [\App\Http\Controllers\AuthController::class, 'regisanggota'])->name('doregist');

    Route::get('/register', [\App\Http\Controllers\AuthController::class, 'regisform'])->name('registerman');
});

// untuk superadmin dan agent dan vendor
Route::group(['middleware' => ['auth', 'checkrole:1,2,3']], function() {
    Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
    Route::get('/redirect', [\App\Http\Controllers\RedircetController::class, 'cek']);
});


// untuk superadmin
Route::group(['middleware' => ['auth', 'checkrole:1']], function() {
    Route::get('/admin', [\App\Http\Controllers\Petugas\DashboardController::class, 'index']);
    Route::resource('/kelas', \App\Http\Controllers\Petugas\KelasController::class);
    Route::resource('/petugas/siswa', \App\Http\Controllers\Petugas\SiswaController::class);

    Route::resource('/petugas/petugas', \App\Http\Controllers\Petugas\UserController::class);
    Route::resource('/petugas/pengumuman', \App\Http\Controllers\Petugas\PengumumanController::class);
    Route::get('/petugas/passwordedit/{id}', [\App\Http\Controllers\Petugas\UserController::class, 'passwordedit'])->name('petugas.passwordedit');
    Route::get('/petugas/pengumuman/tidakactive/{id}', [\App\Http\Controllers\Petugas\PengumumanController::class, 'tidakactive'])->name('pengumuman.tidakaktive');
    Route::get('/petugas/pengumuman/active/{id}', [\App\Http\Controllers\Petugas\PengumumanController::class, 'active'])->name('pengumuman.aktive');

    Route::post('/petugas/passwordupdate/{id}', [\App\Http\Controllers\Petugas\UserController::class, 'password'])->name('password.update');
    Route::get('/petugas/absensi', [\App\Http\Controllers\Petugas\AbsenController::class, 'index'])->name('absensi.index');
    Route::get('/petugas/absensi/create', [\App\Http\Controllers\Petugas\AbsenController::class, 'create'])->name('absensi.create');
    Route::get('/petugas/absensi/hadir/{id}', [\App\Http\Controllers\Petugas\AbsenController::class, 'hadir'])->name('absensi.hadir');
    Route::get('/petugas/absensi/tidakhadir/{id}', [\App\Http\Controllers\Petugas\AbsenController::class, 'tidakhadir'])->name('absensi.tidakhadir');
    Route::get('/petugas/absensi/cekletter/{id}', [\App\Http\Controllers\Petugas\AbsenController::class, 'cekletter'])->name('absensi.cekletter');
    Route::get('/petugas/absensi/konfirmasiletter/{id}', [\App\Http\Controllers\Petugas\AbsenController::class, 'konfirmasiletter'])->name('absensi.konfirmasiletter');


});

// untuk vendor
Route::group(['middleware' => ['auth', 'checkrole:2']], function() {
    Route::get('/siswa', [\App\Http\Controllers\Siswa\DashboardController::class, 'index'])->name('siswa');
    Route::resource('/siswa/letter', \App\Http\Controllers\Siswa\LetterController::class);
    Route::get('/siswa/myprofile', [\App\Http\Controllers\Siswa\DashboardController::class, 'myprofile'])->name('siswa.myprofile');
    Route::post('/siswa/myprofileupdate/{id}', [\App\Http\Controllers\Siswa\DashboardController::class, 'updateprofile'])->name('siswa.updateprofile');
    Route::get('/siswa/rekapabsensi', [\App\Http\Controllers\Siswa\DashboardController::class, 'rekapabsensi'])->name('siswa.rekapabsensi');

});
