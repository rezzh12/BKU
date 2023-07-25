<?php

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('admin/home',
    [App\Http\Controllers\AdminController::class, 'index'])->name('admin.home')->middleware('admin');

Route::get('admin/kas_masuk',
    [App\Http\Controllers\AdminController::class, 'kas_masuk'])->name('admin.masuk')->middleware('admin');
Route::post('admin/kas_masuk', 
    [App\Http\Controllers\AdminController::class, 'submit_masuk'])->name('admin.masuk.submit')->middleware('admin');
Route::get('admin/masuk/download/{nama}', 
    [App\Http\Controllers\AdminController::class, 'download'])->name('admin.masuk.download')->middleware('admin');
Route::patch('admin/kas_masuk', 
    [App\Http\Controllers\AdminController::class, 'update_masuk'])->name('admin.masuk.update')->middleware('admin');
 Route::get('admin/kas_masuk/ajaxadmin/dataMasuk/{id}', 
    [App\Http\Controllers\AdminController::class, 'getDataMasuk']);
Route::post('admin/kas_masuk/delete/{id}', 
    [App\Http\Controllers\AdminController::class, 'delete_masuk'])->name('admin.masuk.delete')->middleware('admin');

Route::get('admin/kas_keluar',
    [App\Http\Controllers\AdminController::class, 'kas_keluar'])->name('admin.keluar')->middleware('admin');
Route::post('admin/kas_keluar', 
    [App\Http\Controllers\AdminController::class, 'submit_keluar'])->name('admin.keluar.submit')->middleware('admin');
Route::patch('admin/kas_keluar', 
    [App\Http\Controllers\AdminController::class, 'update_keluar'])->name('admin.keluar.update')->middleware('admin');
Route::get('admin/kas_keluar/ajaxadmin/dataKeluar/{id}', 
    [App\Http\Controllers\AdminController::class, 'getDataKeluar']);
Route::post('admin/kas_keluar/delete/{id}', 
    [App\Http\Controllers\AdminController::class, 'delete_keluar'])->name('admin.keluar.delete')->middleware('admin');

Route::get('admin/rekapitulasi',
    [App\Http\Controllers\AdminController::class, 'rekapitulasi'])->name('admin.rekapitulasi')->middleware('admin');

Route::get('admin/laporan',
    [App\Http\Controllers\AdminController::class, 'laporan'])->name('admin.laporan')->middleware('admin');
Route::post('admin/laporan', 
    [App\Http\Controllers\AdminController::class, 'submit_laporan'])->name('admin.laporan.submit')->middleware('admin');
Route::patch('admin/laporan', 
    [App\Http\Controllers\AdminController::class, 'update_laporan'])->name('admin.laporan.update')->middleware('admin');
Route::get('admin/laporan/ajaxadmin/dataLaporan/{id}', 
    [App\Http\Controllers\AdminController::class, 'getDataLaporan']);
Route::post('admin/laporan/delete/{id}', 
    [App\Http\Controllers\AdminController::class, 'delete_laporan'])->name('admin.laporan.delete')->middleware('admin');
Route::get('admin/laporan/print/{dari}/{sampai}',
    [App\Http\Controllers\AdminController::class, 'print'])->name('admin.laporan.print')->middleware('admin');
Route::get('admin/laporan/print/terima/{dari}/{sampai}',
    [App\Http\Controllers\AdminController::class, 'terima_print'])->name('admin.laporan.terimaprint')->middleware('admin');

Route::get('admin/data_user',
    [App\Http\Controllers\AdminController::class, 'data_user'])->name('admin.pengguna')->middleware('admin');
Route::post('admin/data_user', 
    [App\Http\Controllers\AdminController::class, 'submit_user'])->name('admin.pengguna.submit')->middleware('admin');
Route::patch('admin/data_user/update', 
    [App\Http\Controllers\AdminController::class, 'update_user'])->name('admin.pengguna.update')->middleware('admin');
Route::post('admin/data_user/delete/{id}',
    [App\Http\Controllers\AdminController::class, 'delete_user'])->name('admin.pengguna.delete')->middleware('admin');
Route::get('admin/ajaxadmin/dataUser/{id}', 
    [App\Http\Controllers\AdminController::class, 'getDataUser']);

Route::get('admin/Profile',
    [App\Http\Controllers\AdminController::class, 'profile'])->name('admin.profile')->middleware('admin');
Route::post('admin/Profile', 
    [App\Http\Controllers\AdminController::class, 'submit_profile'])->name('admin.profile.submit')->middleware('admin');
Route::patch('admin/Profile/update', 
    [App\Http\Controllers\AdminController::class, 'update_profile'])->name('admin.profile.update')->middleware('admin');
Route::post('admin/Profile/delete/{id}',
    [App\Http\Controllers\AdminController::class, 'delete_profile'])->name('admin.profile.delete')->middleware('admin');
Route::get('admin/ajaxadmin/dataProfile/{id}', 
    [App\Http\Controllers\AdminController::class, 'getDataProfile']);

Route::get('admin/Info',
    [App\Http\Controllers\AdminController::class, 'info'])->name('admin.info')->middleware('admin');
Route::patch('admin/Info/profile/update', 
    [App\Http\Controllers\AdminController::class, 'update_info_profile'])->name('admin.info.profile.update')->middleware('admin');
Route::patch('admin/Info/data_user/update', 
    [App\Http\Controllers\AdminController::class, 'update_info_user'])->name('admin.info.pengguna.update')->middleware('admin');

Route::get('bensek/home',
    [App\Http\Controllers\BensekController::class, 'index'])->name('bensek.home')->middleware('bensek');

Route::get('bensek/kas_masuk',
    [App\Http\Controllers\BensekController::class, 'kas_masuk'])->name('bensek.masuk')->middleware('bensek');
Route::post('bensek/kas_masuk', 
    [App\Http\Controllers\BensekController::class, 'submit_masuk'])->name('bensek.masuk.submit')->middleware('bensek');
Route::get('bensek/masuk/download/{nama}', 
    [App\Http\Controllers\BensekController::class, 'download'])->name('bensek.masuk.download')->middleware('bensek');
Route::patch('bensek/kas_masuk', 
    [App\Http\Controllers\BensekController::class, 'update_masuk'])->name('bensek.masuk.update')->middleware('bensek');
 Route::get('bensek/kas_masuk/ajaxadmin/dataMasuk/{id}', 
    [App\Http\Controllers\BensekController::class, 'getDataMasuk']);
Route::post('bensek/kas_masuk/delete/{id}', 
    [App\Http\Controllers\BensekController::class, 'delete_masuk'])->name('bensek.masuk.delete')->middleware('bensek');

Route::get('bensek/kas_keluar',
    [App\Http\Controllers\BensekController::class, 'kas_keluar'])->name('bensek.keluar')->middleware('bensek');
Route::post('bensek/kas_keluar', 
    [App\Http\Controllers\BensekController::class, 'submit_keluar'])->name('bensek.keluar.submit')->middleware('bensek');
Route::patch('bensek/kas_keluar', 
    [App\Http\Controllers\BensekController::class, 'update_keluar'])->name('bensek.keluar.update')->middleware('bensek');
Route::get('bensek/kas_keluar/ajaxadmin/dataKeluar/{id}', 
    [App\Http\Controllers\BensekController::class, 'getDataKeluar']);
Route::post('bensek/kas_keluar/delete/{id}', 
    [App\Http\Controllers\BensekController::class, 'delete_keluar'])->name('bensek.keluar.delete')->middleware('bensek');

Route::get('bensek/rekapitulasi',
    [App\Http\Controllers\BensekController::class, 'rekapitulasi'])->name('bensek.rekapitulasi')->middleware('bensek');

Route::get('bensek/laporan',
    [App\Http\Controllers\BensekController::class, 'laporan'])->name('bensek.laporan')->middleware('bensek');
Route::post('bensek/laporan', 
    [App\Http\Controllers\BensekController::class, 'submit_laporan'])->name('bensek.laporan.submit')->middleware('bensek');
Route::patch('bensek/laporan', 
    [App\Http\Controllers\BensekController::class, 'update_laporan'])->name('bensek.laporan.update')->middleware('bensek');
Route::get('bensek/laporan/ajaxadmin/dataLaporan/{id}', 
    [App\Http\Controllers\BensekController::class, 'getDataLaporan']);
Route::post('bensek/laporan/delete/{id}', 
    [App\Http\Controllers\BensekController::class, 'delete_laporan'])->name('bensek.laporan.delete')->middleware('bensek');
Route::get('bensek/laporan/print/{dari}/{sampai}',
    [App\Http\Controllers\BensekController::class, 'print'])->name('bensek.laporan.print')->middleware('bensek');
Route::get('bensek/laporan/print/terima/{dari}/{sampai}',
    [App\Http\Controllers\BensekController::class, 'terima_print'])->name('bensek.laporan.terimaprint')->middleware('bensek');

Route::get('bensek/info',
    [App\Http\Controllers\BensekController::class, 'info'])->name('bensek.info')->middleware('bensek');
Route::patch('bensek/Info/profile/update', 
    [App\Http\Controllers\BensekController::class, 'update_info_profile'])->name('bensek.info.profile.update')->middleware('bensek');
Route::patch('bensek/Info/data_user/update', 
    [App\Http\Controllers\BensekController::class, 'update_info_user'])->name('bensek.info.pengguna.update')->middleware('bensek');

Route::get('kepsek/home',
    [App\Http\Controllers\KepsekController::class, 'index'])->name('kepsek.home')->middleware('kepsek');
Route::get('kepsek/kas_masuk',
    [App\Http\Controllers\KepsekController::class, 'kas_masuk'])->name('kepsek.masuk')->middleware('kepsek');
Route::get('kepsek/kas_keluar',
    [App\Http\Controllers\KepsekController::class, 'kas_keluar'])->name('kepsek.keluar')->middleware('kepsek');
Route::get('kepsek/laporan',
    [App\Http\Controllers\KepsekController::class, 'laporan'])->name('kepsek.laporan')->middleware('kepsek');
Route::get('kepsek/laporan/terima/{id}',
    [App\Http\Controllers\KepsekController::class, 'terima_laporan'])->name('kepsek.laporan.terima')->middleware('kepsek');
Route::get('kepsek/laporan/tolak/{id}',
    [App\Http\Controllers\KepsekController::class, 'tolak_laporan'])->name('kepsek.laporan.tolak')->middleware('kepsek');
Route::get('kepsek/laporan/print/{dari}/{sampai}',
    [App\Http\Controllers\KepsekController::class, 'print'])->name('kepsek.laporan.print')->middleware('kepsek');
Route::get('kepsek/laporan/print/terima/{dari}/{sampai}',
    [App\Http\Controllers\KepsekController::class, 'terima_print'])->name('kepsek.laporan.terimaprint')->middleware('kepsek');

Route::get('kepsek/info',
    [App\Http\Controllers\KepsekController::class, 'info'])->name('kepsek.info')->middleware('kepsek');
Route::patch('kepsek/Info/profile/update', 
    [App\Http\Controllers\KepsekController::class, 'update_info_profile'])->name('kepsek.info.profile.update')->middleware('kepsek');
Route::patch('kepsek/Info/data_user/update', 
    [App\Http\Controllers\KepsekController::class, 'update_info_user'])->name('kepsek.info.pengguna.update')->middleware('kepsek');

