<?php

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
    return view('welcome');
});

Route::get('/setting_menu', 'SettingMenu@index')->name('setting_menu');
Route::get('setting/create', 'SettingMenu@create')->name('create');
Route::get('/list', 'SettingMenu@list')->name('list');
Route::get('setting/save', 'SettingMenu@save')->name('save');
Route::post('setting/mtable', 'SettingMenu@mtable')->name('mtable');
Route::post('/data/mahasiswa/validatewizard', 'Mahasiswa@validatewizard')->name('validate_wizard');
Route::post('/data/mahasiswa/update', 'Mahasiswa@update')->name('update');
Route::post('/data/dosen/update', 'Dosen@update')->name('update');
Route::get('dosen/penugasan/{id}', 'Dosen@penugasan')->name('penugasan');
Route::get('dosen/pengangkatan/{id}', 'Dosen@pengangkatan')->name('riwayatpengangkatan');
Route::post('dosen/tambahpenugasan', 'Dosen@tambahpenugasan')->name('tambah_penugasan');
Route::post('dosen/tambahpengangkatan', 'Dosen@tambahpengangkatan')->name('tambah_pengangkatan');

Route::get('dosen/pendidikan/{id}', 'Dosen@r_pendidikan')->name('riwayat_pendidikan');
Route::post('dosen/tambah_r_pendidikan', 'Dosen@tambah_r_pendidikan')->name('tambah_riwayat_pendidikan');

Route::get('dosen/sertifikasi/{id}', 'Dosen@r_sertifikasi')->name('riwayat_sertifikasi');
Route::post('dosen/tambah_r_sertifikasi', 'Dosen@tambah_r_sertifikasi')->name('tambah_riwayat_sertifikasi');

Route::get('dosen/penelitian/{id}', 'Dosen@r_penelitian')->name('riwayat_penelitian');
Route::post('dosen/tambah_r_penelitian', 'Dosen@tambah_r_penelitian')->name('tambah_riwayat_penelitian');

Route::get('dosen/fungsional/{id}', 'Dosen@r_fungsional')->name('riwayat_fungsional');
Route::post('dosen/tambah_r_fungsional', 'Dosen@tambah_r_fungsional')->name('tambah_riwayat_fungsional');

Route::post('/master/kelas/edit', 'Kelas@edit')->name('edit');
Route::post('master/kelas/delete', 'Kelas@delete')->name('delete');


//kelas perkuliahan
Route::get('/data/kelasperkuliahan', 'KelasPerkuliahan@index')->name('index');
Route::get('data/kelasperkuliahan/create', 'KelasPerkuliahan@create')->name('create');
//end of kelas perkuliahan

//aktivitas perkuliahan
Route::get('/data/aktivitasperkuliahan', 'AktivitasPerkuliahan@index')->name('index');
Route::post('data/aktivitasperkuliahan/paging', 'AktivitasPerkuliahan@paging')->name('pagination');
//end of aktivitas perkuliahan

Route::post('kurikulum/carimatakuliah', 'Kurikulum@carimatakuliah')->name('CariMatakuliah');
Route::post('kurikulum/filtering_table', 'Kurikulum@filtering_table')->name('FilteringTable');

//Route::post('master/agama/paging', 'Agama@paging')->name('pagination');
//Route::post('master/matakuliah/paging', 'MataKuliah@paging')->name('pagination');

$results = DB::select('select * from module');
foreach($results as $val){
    Route::get(strtolower($val->link), $val->mval.'@index')->name($val->mval);
    Route::post(strtolower($val->link).'/save', $val->mval.'@'.'save')->name($val->mval.'save');
    Route::get(strtolower($val->link).'/create', $val->mval.'@'.'create')->name($val->mval.'create');
    Route::post(strtolower($val->link).'/update', $val->mval.'@'.'update')->name($val->mval.'update');
    Route::get(strtolower($val->link).'/edit/{id}', $val->mval.'@'.'edit')->name($val->mval.'edit');
    Route::get(strtolower($val->link).'/view/{id}', $val->mval.'@'.'view')->name($val->mval.'view');
    Route::get(strtolower($val->link).'/delete', $val->mval.'@'.'delete')->name($val->mval.'delete');
    Route::post(strtolower($val->link).'/delete', $val->mval.'@'.'delete')->name($val->mval.'delete');
    Route::post(strtolower($val->link).'/paging', $val->mval.'@'.'paging')->name('pagination');
}

