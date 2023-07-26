<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HakAksesController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListAkunController;
use App\Http\Controllers\JenisSurveyController;
use App\Http\Controllers\KategoriSurveyController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\TransaksiKasMasukController;
use App\Http\Controllers\KasbonController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\LaporanSurveyController;
use App\Http\Controllers\LaporanJenisPembayaranController;
use App\Http\Controllers\TestPesanController;
use App\Http\Controllers\PertanyaanController;
use App\Http\Controllers\SaldoController;
use App\Http\Controllers\SurveyEksekutifController;
use App\Imports\PesanImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

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

// Route::get('/', [\App\Http\Controllers\LoginController::class, 'index'])->name('login');
// Route::get('/login', [\App\Http\Controllers\LoginController::class, 'index'])->name('login');
// Route::post('/login', [\App\Http\Controllers\LoginController::class, 'authenticate'])->name('login.store');
// // Route::get('/register', [\App\Http\Controllers\RegisterController::class, 'index'])->name('register');
// // Route::post('/register', [\App\Http\Controllers\RegisterController::class, 'store'])->name('register.store');
// Route::post('/logout', function () {
//     auth()->logout();
//     request()->session()->invalidate();
//     request()->session()->regenerateToken();
    
//     return redirect('/');
// })->name('logout');


// Route::group(['middleware' => ['auth']], function () {
//     Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
//     // route::group()->middleware();
//     Route::controller(HakAksesController::class)->middleware('cek_login:hakakses.index')->group(function () {
//         Route::get('/hakakses', 'index')->name('hakakses.index');
//         Route::get('/hakakses/edit/{id}', 'edit');
//         Route::get('/hakakses/delete/{id}', 'delete');
//         Route::get('/hakakses/modul_akses/{id}', 'modul_akses');
//         Route::post('/hakakses/modul_akses', 'modul_akses_store');
//         Route::post('/hakakses/store', 'store');
//         Route::post('/hakakses/update', 'update');
//     });
//     Route::controller(MenuController::class)->middleware('cek_login:menu.index')->group(function () {
//         Route::get('/menu', 'index')->name('menu.index');
//         Route::get('/menu/edit/{id}', 'edit');
//         Route::get('/menu/status/{id}', 'status');
//         Route::get('/menu/delete/{id}', 'delete');
//         Route::post('/menu/store', 'store');
//         Route::post('/menu/update', 'update');
//     });
//     Route::controller(StrukturController::class)->middleware('cek_login:struktur.index')->group(function () {
//         Route::get('/struktur', 'index')->name('struktur.index');
//         Route::get('/struktur/edit/{id}', 'edit');
//         Route::get('/struktur/status/{id}', 'status');
//         Route::get('/struktur/delete/{id}', 'delete');
//         Route::post('/struktur/store', 'store');
//         Route::post('/struktur/update', 'update');
//     });
//     Route::controller(UserController::class)->middleware('cek_login:user.index')->group(function () {
//         Route::get('/user', 'index')->name('user.index');
//         Route::get('/user/sync', 'sync');
//         Route::get('/user/edit/{id}', 'edit');
//         Route::post('/user/update', 'update');
//     });
//     Route::controller(ListAkunController::class)->middleware('cek_login:struktur.index')->group(function () {
//         Route::get('/list_akun', 'index')->name('list_akun.index');
//         Route::get('/list_akun/edit/{id}', 'edit');
//         Route::get('/list_akun/qr/{id}', 'qr');
//         Route::get('/list_akun/status/{id}', 'status');
//         Route::get('/list_akun/delete/{id}', 'delete');
//         Route::post('/list_akun/store', 'store');
//         Route::post('/list_akun/update', 'update');
//     });
//     Route::controller(JenisSurveyController::class)->middleware('cek_login:jenis_survey.index')->group(function () {
//         Route::get('/jenis_survey', 'index')->name('jenis_survey.index');
//         Route::get('/jenis_survey/edit/{id}', 'edit');
//         Route::get('/jenis_survey/delete/{id}', 'delete');
//         Route::post('/jenis_survey/store', 'store');
//         Route::post('/jenis_survey/update', 'update');
//     });
//     Route::controller(KategoriSurveyController::class)->middleware('cek_login:kategori_survey.index')->group(function () {
//         Route::get('/kategori_survey', 'index')->name('kategori_survey.index');
//         Route::get('/kategori_survey/edit/{id}', 'edit');
//         Route::get('/kategori_survey/delete/{id}', 'delete');
//         Route::post('/kategori_survey/store', 'store');
//         Route::post('/kategori_survey/update', 'update');
//     });
//     Route::controller(PertanyaanController::class)->middleware('cek_login:pertanyaan.index')->group(function () {
//         Route::get('/pertanyaan', 'index')->name('pertanyaan.index');
//         Route::get('/pertanyaan/urutan', 'urutan');
//         Route::get('/pertanyaan/edit/{id}', 'edit');
//         Route::get('/pertanyaan/delete/{id}', 'delete');
//         Route::post('/pertanyaan/store', 'store');
//         Route::post('/pertanyaan/urutan', 'urutan_detail');
//         Route::post('/pertanyaan/urutan_detail', 'ubah_urutan');
//         Route::post('/pertanyaan/update', 'update');
//     });
//     Route::controller(LaporanSurveyController::class)->middleware('cek_login:laporan_survey.index')->group(function () {
//         Route::get('/laporan_survey/index', 'index')->name('laporan_survey.index');
//         Route::post('/laporan_survey/index', 'detail');
//         Route::get('/laporan_survey/export_excel/{awal}/{akhir}/{jenis_survey}/{kategori_survey}', 'export_excel');
//         // Route::post('/laporan_survey/detail', 'detail');
//     });
//     Route::controller(LaporanJenisPembayaranController::class)->middleware('cek_login:laporan_jenis_pembayaran.index')->group(function () {
//         Route::get('/laporan_jenis_pembayaran/index', 'index')->name('laporan_jenis_pembayaran.index');
//         Route::get('/laporan_jenis_pembayaran/export_excel/{jenis_pembayaran_id}/{tanggal_awal}/{tanggal_akhir}/{pemid}','export_excel');
//     });
// });


Route::controller(SurveyEksekutifController::class)->group(function () {
    // Route::get('/', 'form')->name('tulip.form');
    Route::get('/{jenis}/{id}', 'form')->name('form');
    Route::post('/action/{id}', 'action')->name('action');
    // Route::get('/{jenis}/{id}', 'kuis')->name('kuis');
    // Route::get('/ranap/{id}', 'ranap')->name('tulip.ranap');
    // Route::get('/rajal/{id}', 'rajal')->name('tulip.action');
});
Route::controller(ReportController::class)->group(function () {
    Route::get('/report/tulip', 'tulip')->name('report.tulip.form');
    Route::post('/report/tulip', 'tulipResult')->name('report.tulip.result');
});