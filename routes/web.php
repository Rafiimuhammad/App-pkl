<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DatapendaftaranseminarpklController;
use App\Http\Controllers\DatadosenController;
use App\Http\Controllers\DatamahasiswaController;
use App\Http\Controllers\DatalogbookController;
use App\Http\Controllers\PendaftaranpklController;
use App\Http\Controllers\LogbookController;
use App\Http\Controllers\PendaftaranseminarpklController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DatapendaftaranpklController;
use App\Http\Controllers\JadwalSeminarController;
use App\Http\Controllers\DospemController;
use App\Http\Controllers\PanduanController;
use App\Http\Controllers\PanduanMasterController;
use App\Http\Controllers\RuanganWaktuController;

Route::get('/', [HomeController::class, 'index']);

// // LOGIN-LOGOUT// //
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::get('/tampilanregister', [LoginController::class, 'tampilanregister'])->name('tampilanregister');
Route::post('/registeruser', [LoginController::class, 'registeruser'])->name('registeruser');
Route::post('/postlogin', [LoginController::class, 'postlogin'])->name('postlogin');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// route::group(['middleware' => ['auth','ceklevel:Koordinator,Dosen,Mahasiswa']], function () {
//     Route::get('/beranda',[BerandaController::class,'index'])->name('beranda');
// });

// route::group(['middleware' => ['auth','ceklevel:Koordinator,Dosen']], function () {
//     Route::get('/datauser', [LoginController::class, 'datauser'])->name('datauser');
// });
// // MAHASISWA // //
// // Pendaftaran-PKL-// //
Route::get('/viewpendaftaranpkl/{id}', [PendaftaranpklController::class, 'view']);
Route::group(['middleware' => ['auth', 'CekLevel:Mahasiswa']], function () {
    Route::get('/pendaftaranpkl', [PendaftaranpklController::class, 'pendaftaranpkl'])->name('pendaftaranpkl');
    Route::get('/tambahdatapendaftaranpkl', [PendaftaranpklController::class, 'tambahdatapendaftaranpkl'])->name('tambahdatapendaftaranpkl');
    Route::post('/inputdatapendaftaranpkl', [PendaftaranpklController::class, 'inputdatapendaftaranpkl'])->name('inputdatapendaftaranpkl');
    Route::get('/tampilkandatapendaftaranpkl/{id}', [PendaftaranpklController::class, 'tampilkandatapendaftaranpkl'])->name('tampilkandatapendaftaranpkl');
    Route::post('/updatedatapendaftaranpkl/{id}', [PendaftaranpklController::class, 'updatedatapendaftaranpkl'])->name('updatedatapendaftaranpkl');
    Route::get('/deletedatapendaftaranpkl/{id}', [PendaftaranpklController::class, 'deletedatapendaftaranpkl'])->name('deletedatapendaftaranpkl');
});


// // Logbook// //
Route::group(['middleware' => ['auth', 'CekLevel:Mahasiswa']], function () {
    Route::get('/logbook', [LogbookController::class, 'logbook'])->name('logbook');
    Route::get('/tambahdatalogbook', [LogbookController::class, 'tambahdatalogbook'])->name('tambahdatalogbook');
    Route::post('/inputdatalogbook', [LogbookController::class, 'inputdatalogbook'])->name('inputdatalogbook');
    Route::get('/tampilkandatalogbook/{id}', [LogbookController::class, 'tampilkandatalogbook'])->name('tampilkandatalogbook');
    Route::post('/updatedatalogbook/{id}', [LogbookController::class, 'updatedatalogbook'])->name('updatedatalogbook');
});
Route::get('/deletedatalogbook/{id}', [LogbookController::class, 'deletedatalogbook'])->name('deletedatalogbook');

// // Pendaftaran-Seminar-PKL// //
Route::get('/viewlogbook/{id}', [LogbookController::class, 'view']);
Route::get('/viewlogbookseminar/{id}', [PendaftaranseminarpklController::class, 'view']);
Route::get('/viewproposal/{id}', [PendaftaranseminarpklController::class, 'viewproposal'])->name('viewproposal');
Route::get('/viewbimbingan/{id}', [PendaftaranseminarpklController::class, 'viewbimbingan'])->name('view-bimbingan');
Route::group(['middleware' => ['auth', 'CekLevel:Mahasiswa']], function () {
    Route::get('/pendaftaranseminarpkl', [PendaftaranseminarpklController::class, 'pendaftaranseminarpkl'])->name('pendaftaranseminarpkl');
    Route::get('/tambahdatapendaftaranseminar', [PendaftaranseminarpklController::class, 'tambahdatapendaftaranseminar'])->name('tambahdatapendaftaranseminar');
    Route::post('/inputdatapendaftaranseminar', [PendaftaranseminarpklController::class, 'inputdatapendaftaranseminar'])->name('inputdatapendaftaranseminar');
    Route::get('/tampilkandatapendaftaranseminar/{id}', [PendaftaranseminarpklController::class, 'tampilkandatapendaftaranseminar'])->name('tampilkandatapendaftaranseminar');
    Route::post('/updatedatapendaftaranseminar/{id}', [PendaftaranseminarpklController::class, 'updatedatapendaftaranseminar'])->name('updatedatapendaftaranseminar');
    Route::get('/deletedatapendaftaranseminar/{id}', [PendaftaranseminarpklController::class, 'deletedatapendaftaranseminar'])->name('deletedatapendaftaranseminar');
});



// // ADMIN-KOORDINATOR // //
// // DATA-USER // //
Route::group(['middleware' => ['auth', 'CekLevel:Koordinator']], function () {
    Route::get('/datauser', [LoginController::class, 'datauser'])->name('datauser');
    Route::get('/tambahdatauser', [LoginController::class, 'tambahdatauser'])->name('tambahdatauser');
    Route::get('/tampilkandatauser/{id}', [LoginController::class, 'tampilkandatauser'])->name('tampilkandatauser');
    Route::post('/updatedatauser/{id}', [LoginController::class, 'updatedatauser'])->name('updatedatauser');
    Route::get('/deletedatauser/{id}', [LoginController::class, 'deletedatauser'])->name('deletedatauser');
});

// // DATA-DOSEN // //
Route::group(['middleware' => ['auth', 'CekLevel:Koordinator']], function () {
    Route::get('/datadosen', [DatadosenController::class, 'index'])->name('datadosen');
});

// // DATA-MAHASISWA // //
Route::group(['middleware' => ['auth', 'CekLevel:Koordinator']], function () {
    Route::get('/datamahasiswa', [DatamahasiswaController::class, 'index'])->name('datamahasiswa');
});

// // DATA-PENDAFTARAN-PKL // //
Route::group(['middleware' => ['auth', 'CekLevel:Koordinator']], function () {
    Route::get('/datapendaftaranpkl', [DatapendaftaranpklController::class, 'datapendaftaranpkl'])->name('datapendaftaranpkl');
    Route::get('/cekpengajuanpkl/{id}/cek', [DatapendaftaranpklController::class, 'cekpengajuanpkl'])->name('cekpengajuanpkl');
    Route::put('/validasidatapendaftaranpkl/{id}', [DatapendaftaranpklController::class, 'approvals']);
    Route::get('/tolakdatapendaftaranpkl/{id}', [DatapendaftaranpklController::class, 'reject']);
});

// // DATA-LOGBOOK // //
Route::group(['middleware' => ['auth', 'CekLevel:Koordinator']], function () {
    Route::get('/datalogbook', [DatalogbookController::class, 'index'])->name('datalogbook');
    Route::get('/ceklogbook/{id}/cek', [DatalogbookController::class, 'ceklogbook'])->name('ceklogbook');
    Route::put('/validasilogbook/{id}', [DatalogbookController::class, 'approvals']);
    Route::get('/tolaklogbook/{id}', [DatalogbookController::class, 'reject']);
});

// // DATA-PENDAFTARAN-SEMINAR-PKL // //
Route::group(['middleware' => ['auth', 'CekLevel:Koordinator']], function () {
    Route::get('/datapendaftaranseminar', [DatapendaftaranseminarpklController::class, 'index'])->name('datapendaftaranseminar');
    //    Route::get('/jadwal-seminar', [JadwalSeminarController::class, 'index']);
    Route::get('/detail-jadwal-seminar/{group_id}', [JadwalSeminarController::class, 'show']);
    Route::get('/tambah-jadwal-seminar/', [JadwalSeminarController::class, 'tambah']);
    Route::get('/generate-jadwal', [JadwalSeminarController::class, 'generate_jadwal']);
    Route::post('/store-jadwal-seminar/', [JadwalSeminarController::class, 'store']);
    Route::get('/edit-jadwal-seminar/{group_id}', [JadwalSeminarController::class, 'edit']);
    Route::post('/update-jadwal-seminar/{group_id}', [JadwalSeminarController::class, 'update']);
    Route::get('/penentuan-dosen', [DataDosenController::class, 'penentuan_dosen']);
    Route::get('/ubah-status-pengajuan-pkl/{id}/{status}', [DataDosenController::class, 'ubah_status']);
    Route::get('/penentuan-dosen-edit/{id}', [DataDosenController::class, 'penentuan_dosen_edit']);
    Route::post('/penentuan-dosen-update', [DataDosenController::class, 'penentuan_dosen_update']);

    Route::get('/export-pdf', [\App\Http\Controllers\ExportController::class, 'exportPDF'])->name('export.pdf');

    Route::get('/panduan-master', [PanduanMasterController::class, 'index']);
    Route::post('/upload-panduan', [PanduanMasterController::class, 'upload_panduan']);
    Route::post('/upload-bimbingan', [PanduanMasterController::class, 'upload_bimbingan']);

    Route::get('/ruangan-waktu', [RuanganWaktuController::class, 'index']);
    Route::get('/tambah-ruangan', [RuanganWaktuController::class, 'create_ruangan']);
    Route::get('/tambah-waktu', [RuanganWaktuController::class, 'create_waktu']);
    Route::post('/tambah-ruangan', [RuanganWaktuController::class, 'store_ruangan']);
    Route::post('/tambah-waktu', [RuanganWaktuController::class, 'store_waktu']);
    Route::delete('/delete-ruangan/{id}', [RuanganWaktuController::class, 'delete_ruangan']);
    Route::delete('/delete-waktu/{id}', [RuanganWaktuController::class, 'delete_waktu']);
    Route::get('/edit-ruangan/{id}', [RuanganWaktuController::class, 'edit_ruangan']);
    Route::get('/edit-waktu/{id}', [RuanganWaktuController::class, 'edit_waktu']);
    Route::put('/edit-ruangan/{id}', [RuanganWaktuController::class, 'update_ruangan']);
    Route::put('/edit-waktu/{id}', [RuanganWaktuController::class, 'update_waktu']);
    //    Route::get('/jadwal-seminar', [JadwalSeminarController::class, 'showExamSchedule'])->name('generate_schedule');
});

Route::group(['middleware' => ['auth', 'CekLevel:Dospem']], function () {
    Route::get('/laporan-mahasiswa', [DospemController::class, 'laporan_mahasiswa']);
    Route::get('/detail-laporan-mahasiswa', [DospemController::class, 'detail_laporan_mahasiswa']);
    Route::get('/pengajuan-seminar', [DospemController::class, 'pengajuan_seminar']);
    Route::get('/ubah-status-logbook/{id}/{status}/{dosen}', [LogbookController::class, 'ubah_status_logbook']);
    Route::get('/ubah-status-seminar/{id}/{status}', [DospemController::class, 'ubah_status_seminar']);
});

Route::group(['middleware' => ['auth', 'CekLevel:Koordinator,Mahasiswa,Dospem']], function () {
    Route::get('/jadwal-seminar', [JadwalSeminarController::class, 'index'])->name('jadwal-seminar');
    Route::get('/panduan-penggunaan', [Controller::class, 'panduanPenggunaan'])->name('panduan-penggunaan');
});
