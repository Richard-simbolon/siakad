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

Route::get('/', 'HomeController@index')->name('Index');
Route::get('/setting_menu', 'SettingMenu@index')->name('setting_menu');
Route::get('setting/create', 'SettingMenu@create')->name('create');
Route::get('/list', 'SettingMenu@list')->name('list');
Route::get('setting/save', 'SettingMenu@save')->name('save');
Route::post('setting/mtable', 'SettingMenu@mtable')->name('mtable');
Route::post('/data/mahasiswa/validatewizard', 'Mahasiswa@validatewizard')->name('validate_wizard');
Route::post('/data/mahasiswa/update', 'Mahasiswa@update')->name('update');


Route::get('mahasiswa/prestasi/{id}', 'Mahasiswa@prestasi')->name('prestasi mahasiswa');
Route::get('admin/mahasiswa/khs/{id}', 'Mahasiswa@khs')->name('KRS mahasiswa');
Route::get('admin/mahasiswa/krs/{id}', 'Mahasiswa@krs')->name('KHS mahasiswa');
Route::post('/data/mahasiswa/save_prestasi', 'Mahasiswa@save_prestasi')->name('save prestasi');
Route::post('/mahasiswa/paging_prestasi', 'Mahasiswa@paging_prestasi')->name('paging_prestasi');



// Module Mahasiswa
Route::get('/data/mahasiswa/profile', 'MahasiswaModule@profile')->name('profile');
Route::get('/data/mahasiswa/alamat', 'MahasiswaModule@alamat')->name('alamat');
Route::get('/data/mahasiswa/orangtua', 'MahasiswaModule@orangtua')->name('orangtua');
Route::get('/data/mahasiswa/wali', 'MahasiswaModule@wali')->name('wali');
Route::get('/data/mahasiswa/prestasi', 'MahasiswaModule@prestasi')->name('prestasi');
Route::get('/data/mahasiswa/kebutuhankhusus', 'MahasiswaModule@kebutuhankhusus')->name('kebutuhankhusus');
Route::get('/data/mahasiswa/gantipassword', 'MahasiswaModule@gantipassword')->name('gantipassword');
Route::post('/data/mahasiswa/submit_gantipassword', 'MahasiswaModule@submit_gantipassword')->name('submit_gantipassword');
Route::post('/data/mahasiswa/prestasipaging', 'MahasiswaModule@prestasipaging')->name('prestasipaging');
Route::post('/data/mahasiswa/submitprestasi', 'MahasiswaModule@submitprestasi')->name('submitprestasi');
Route::post('/data/mahasiswa/submitprofile', 'MahasiswaModule@submitprofile')->name('submitprofile');
Route::post('/data/mahasiswa/submitalamat', 'MahasiswaModule@submitalamat')->name('submitalamat');
Route::post('/data/mahasiswa/submitorangtua', 'MahasiswaModule@submitorangtua')->name('submitorangtua');
Route::post('/data/mahasiswa/submitwali', 'MahasiswaModule@submitwali')->name('submitwali');
Route::post('/data/mahasiswa/submitkebutuhankhusus', 'MahasiswaModule@submitkebutuhankhusus')->name('submitkebutuhankhusus');
// MODULE MAHASISWA END

// Module Dosen
Route::get('/data/dosen/profile', 'DosenModule@profile')->name('profile');
Route::get('/data/dosen/keluarga', 'DosenModule@keluarga')->name('keluarga');
Route::get('/data/dosen/kebutuhankhusus', 'DosenModule@kebutuhankhusus')->name('kebutuhankhusus');
Route::get('/data/dosen/biodata', 'DosenModule@biodata')->name('biodata');
Route::get('/data/dosen/gantipassword', 'DosenModule@gantipassword')->name('gantipassword');
Route::get('/data/dosen/penugasan_dosen', 'DosenModule@penugasan_dosen')->name('penugasan_dosen');
Route::get('/data/dosen/fungsional_dosen', 'DosenModule@fungsional_dosen')->name('fungsional_dosen');
Route::get('/data/dosen/kepangkatan_dosen', 'DosenModule@kepangkatan_dosen')->name('kepangkatan_dosen');
Route::get('/data/dosen/pendidikan_dosen', 'DosenModule@pendidikan_dosen')->name('pendidikan_dosen');
Route::get('/data/dosen/sertifikasi_dosen', 'DosenModule@sertifikasi_dosen')->name('sertifikasi_dosen');
Route::get('/data/dosen/fungsional_dosen', 'DosenModule@fungsional_dosen')->name('fungsional_dosen');
Route::get('/data/dosen/penelitian_dosen', 'DosenModule@penelitian_dosen')->name('penelitian_dosen');
Route::post('/data/dosen/submitprofile', 'DosenModule@submitprofile')->name('submitprofile');
Route::post('/data/dosen/submitbiodata', 'DosenModule@submitbiodata')->name('submitbiodata');
Route::post('/data/dosen/submitkeluarga', 'DosenModule@submitkeluarga')->name('submitkeluarga');
Route::post('/data/dosen/submitkebutuhankhusus', 'DosenModule@submitkebutuhankhusus')->name('submitkebutuhankhusus');
Route::post('/data/dosen/submit_gantipassword', 'DosenModule@submit_gantipassword')->name('submit_gantipassword');
// MODULE MAHASISWA END


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
Route::get('/data/dosen/getdosen_select2', 'Dosen@getdosen_select2')->name('getdosen_select2');


// KRS
Route::get('mahasiswa/krs', 'JadwalPerkuliahan@krs')->name('krs');

Route::get('mahasiswa/khs', 'JadwalPerkuliahan@khs')->name('khs');


Route::post('/master/kelas/edit', 'Kelas@edit')->name('edit');
Route::post('master/kelas/delete', 'Kelas@delete')->name('delete');
Route::post('/kelas/listkurikulum', 'Kelas@listkurikulum')->name('ListKurikulum');
Route::post('/kelas/listkelas', 'Kelas@listkelas')->name('ListKelas');


Route::get('/data/tugasakhir', 'TugasAkhir@index')->name('list');
Route::post('/data/tugasakhir/paging', 'TugasAkhir@paging')->name('pagination');
Route::get('/data/tugasakhir/create', 'TugasAkhir@create')->name('create');
Route::get('data/tugasakhir/get/{nim}', 'TugasAkhir@get')->name('get');
Route::get('data/tugasakhir/view/{id}', 'TugasAkhir@view')->name('get');
Route::post('/data/tugasakhir/paging', 'TugasAkhir@paging')->name('pagination');
Route::post('data/tugasakhir/save', 'TugasAkhir@save')->name('save');
Route::post('data/tugasakhir/update', 'TugasAkhir@update')->name('update');
Route::post('data/tugasakhir/delete', 'TugasAkhir@delete')->name('delete');


//kelas perkuliahan
Route::post('/kelasperkuliahan/update_kelas_perkuliahan', 'kelasperkuliahan@update_kelas_perkuliahan')->name('UpdateKelasPerkuliahan');
Route::post('/kelasperkuliahan/save_kelas_perkuliahan', 'kelasperkuliahan@save_kelas_perkuliahan')->name('SimpanKelasPerkuliahan');
Route::post('/kelasperkuliahan/filtering_kelas_perkuliahan_index', 'kelasperkuliahan@filtering_kelas_perkuliahan_index')->name('filtering_kelas_perkuliahan_index');
Route::get('/data/kelasperkuliahan', 'KelasPerkuliahan@index')->name('index');
Route::get('data/kelasperkuliahan/create', 'KelasPerkuliahan@create')->name('create');
Route::get('data/kelasperkuliahan/view/{id}', 'KelasPerkuliahan@view')->name('view');
Route::post('/kelasperkuliahan/listmatakuliah', 'KelasPerkuliahan@listmatakuliah')->name('Listmatakuliah');

//end of kelas perkuliahan

//aktivitas perkuliahan
Route::get('/data/aktivitasperkuliahan', 'AktivitasPerkuliahan@index')->name('index');
Route::post('data/aktivitasperkuliahan/paging', 'AktivitasPerkuliahan@paging')->name('pagination');
//end of aktivitas perkuliahan

Route::post('kurikulum/carimatakuliah', 'Kurikulum@carimatakuliah')->name('CariMatakuliah');
Route::post('kurikulum/filtering_table', 'Kurikulum@filtering_table')->name('FilteringTable');

//Route::post('master/agama/paging', 'Agama@paging')->name('pagination');
//Route::post('master/matakuliah/paging', 'MataKuliah@paging')->name('pagination');

// ABSENSI
Route::get('/data/absensimahasiswa/absensi/{id}', 'AbsensiMahasiswa@absensi')->name('index');
// DOSEN
Route::get('/dosen/absensi/absensi/{id}', 'DosenAbsensi@absensi')->name('index');

Route::get('/data/jadwalujian/form/{id}', 'JadwalUjian@form')->name('index');

Route::get('/data/kalenderakademik/get/{id}', 'kalenderakademik@get')->name('get');
Route::get('data/kalenderakademik/getall', 'kalenderakademik@getall')->name('getall');

$results = DB::select('select * from module');
foreach($results as $val){
    if($val->crud == 1){
        Route::get(strtolower($val->link), $val->mval.'@index')->name($val->mval);
        Route::post(strtolower($val->link).'/save', $val->mval.'@'.'save')->name($val->mval.'save');
        Route::get(strtolower($val->link).'/create', $val->mval.'@'.'create')->name($val->mval.'create');
        Route::post(strtolower($val->link).'/update', $val->mval.'@'.'update')->name($val->mval.'update');
        Route::get(strtolower($val->link).'/edit/{id}', $val->mval.'@'.'edit')->name($val->mval.'edit');
        Route::get(strtolower($val->link).'/view/{id}', $val->mval.'@'.'view')->name($val->mval.'view');
        Route::get(strtolower($val->link).'/delete', $val->mval.'@'.'delete')->name($val->mval.'delete');
        Route::post(strtolower($val->link).'/delete', $val->mval.'@'.'delete')->name($val->mval.'delete');
        Route::post(strtolower($val->link).'/paging', $val->mval.'@'.'paging')->name('pagination');
    }else{
        Route::get(strtolower($val->link), $val->mval.'@index')->name($val->mval);
        Route::post(strtolower($val->link).'/paging', $val->mval.'@'.'paging')->name('pagination');
    }
    
}


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
