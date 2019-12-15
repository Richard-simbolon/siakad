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

Route::get('admin/print_khs/{id}/{ids}', 'Mahasiswa@print_khs')->name('getcalender');
Route::get('admin/print_transkrip/{id}', 'Mahasiswa@print_transkrip')->name('transkrip');
Route::get('admin/print_krs/{id}', 'Mahasiswa@print_krs')->name('transkrip');


Route::get('mahasiswa/prestasi/{id}', 'Mahasiswa@prestasi')->name('prestasi mahasiswa');
Route::get('admin/mahasiswa/khs/{id}', 'Mahasiswa@khs')->name('KRS mahasiswa');
Route::get('admin/mahasiswa/krs/{id}', 'Mahasiswa@krs')->name('KHS mahasiswa');
Route::get('admin/mahasiswa/transkrip/{id}', 'Mahasiswa@transkrip')->name('KHS mahasiswa');
Route::post('/data/mahasiswa/save_prestasi', 'Mahasiswa@save_prestasi')->name('save prestasi');
Route::post('/mahasiswa/paging_prestasi', 'Mahasiswa@paging_prestasi')->name('paging_prestasi');
Route::get('/data/mahasiswa/grafik_mahasiswa', 'Mahasiswa@grafik_mahasiswa')->name('grafik_mahasiswa');
Route::get('/data/mahasiswa/grafik_jurusan', 'Mahasiswa@grafik_jurusan')->name('grafik_jurusan');
Route::get('/data/mahasiswa/grafik_status', 'Mahasiswa@grafik_status')->name('grafik_status');


// Module Mahasiswa
//Route::get('/data/mahasiswa/profile', 'MahasiswaModule@profile')->name('profile');
Route::get('/data/mahasiswa/alamat', 'MahasiswaModule@alamat')->name('alamat');
Route::get('/data/mahasiswa/orangtua', 'MahasiswaModule@orangtua')->name('orangtua');
Route::get('/data/mahasiswa/wali', 'MahasiswaModule@wali')->name('wali');
Route::get('/data/mahasiswa/prestasi', 'MahasiswaModule@prestasi')->name('prestasi');
Route::get('/data/mahasiswa/kebutuhankhusus', 'MahasiswaModule@kebutuhankhusus')->name('kebutuhankhusus');
Route::get('/data/mahasiswa/gantipassword', 'MahasiswaModule@gantipassword')->name('gantipassword');
Route::get('/data/mahasiswa/tugasakhir', 'MahasiswaModule@tugasakhir')->name('tugasakhir');
Route::post('/data/mahasiswa/submit_gantipassword', 'MahasiswaModule@submit_gantipassword')->name('submit_gantipassword');
Route::post('/data/mahasiswa/prestasipaging', 'MahasiswaModule@prestasipaging')->name('prestasipaging');
Route::post('/data/mahasiswa/delete', 'MahasiswaModule@delete')->name('delete');
Route::post('/data/mahasiswa/resetpassword', 'mahasiswa@resetpassword')->name('resetpassword');

Route::post('mahasiswa/jadwalperkuliahan/pagingujian', 'JadwalPerkuliahan@pagingujian')->name('Jadwal Ujian');

// KRS
//Route::get('mahasiswa/krs', 'JadwalPerkuliahan@krs')->name('krs');
//Route::get('mahasiswa/khs', 'JadwalPerkuliahan@khs')->name('khs');
Route::post('mahasiswa/khs_load', 'JadwalPerkuliahan@khs_load')->name('khs');
Route::post('admin/khs_load', 'Mahasiswa@khs_load')->name('khs');
Route::post('/data/mahasiswa/submitprestasi', 'MahasiswaModule@submitprestasi')->name('submitprestasi');
Route::post('/data/mahasiswa/submitprofile', 'MahasiswaModule@submitprofile')->name('submitprofile');
Route::post('/data/mahasiswa/submitalamat', 'MahasiswaModule@submitalamat')->name('submitalamat');
Route::post('/data/mahasiswa/submitorangtua', 'MahasiswaModule@submitorangtua')->name('submitorangtua');
Route::post('/data/mahasiswa/submitwali', 'MahasiswaModule@submitwali')->name('submitwali');
Route::post('/data/mahasiswa/submitkebutuhankhusus', 'MahasiswaModule@submitkebutuhankhusus')->name('submitkebutuhankhusus');
Route::post('/data/mahasiswa/upload_profile', 'MahasiswaModule@upload_profile')->name('submitkebutuhankhusus');
Route::post('/data/dosen/upload_profile', 'DosenModule@upload_profile')->name('submitkebutuhankhusus');
Route::get('print_khs/{id}', 'JadwalPerkuliahan@print_khs')->name('getcalender');
Route::get('print_transkrip', 'JadwalPerkuliahan@print_transkrip')->name('transkrip');
Route::get('print_krs', 'JadwalPerkuliahan@print_krs')->name('transkrip');
Route::post('/data/dosen/pembimbing_akademik', 'DosenModule@pembimbing_akademik')->name('pembimbing_akademik');
Route::post('/data/dosen/pembimbing_akademik_paging', 'DosenModule@pembimbing_akademik_paging')->name('pembimbing_akademik_paging');
// MODULE MAHASISWA END

// Module Dosen
//Route::get('/data/dosen/profile', 'DosenModule@profile')->name('profile');
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

Route::post('/data/dosen/submitpenugasan_dosen', 'DosenModule@submitpenugasan_dosen')->name('penugasan_dosen');
Route::post('/data/dosen/submitfungsional_dosen', 'DosenModule@submitfungsional_dosen')->name('fungsional_dosen');
Route::post('/data/dosen/submitpengangkatan_dosen', 'DosenModule@submitpengangkatan_dosen')->name('kepangkatan_dosen');
Route::post('/data/dosen/submitpendidikan_dosen', 'DosenModule@submitpendidikan_dosen')->name('pendidikan_dosen');
Route::post('/data/dosen/submitsertifikasi_dosen', 'DosenModule@submitsertifikasi_dosen')->name('sertifikasi_dosen');
Route::post('/data/dosen/submitpenelitian_dosen', 'DosenModule@submitpenelitian_dosen')->name('penelitian_dosen');
Route::post('/data/dosen/validatewizard', 'dosen@validatewizard')->name('validate_wizard');

Route::post('/data/dosen/modaledit', 'DosenModule@modaledit')->name('penelitian_dosen');
Route::post('/data/dosen/modaleditadmin', 'Dosen@modaleditadmin')->name('modaleditadmin');

Route::post('/data/dosen/submitprofile', 'DosenModule@submitprofile')->name('submitprofile');
Route::post('/data/dosen/submitbiodata', 'DosenModule@submitbiodata')->name('submitbiodata');
Route::post('/data/dosen/submitkeluarga', 'DosenModule@submitkeluarga')->name('submitkeluarga');
Route::post('/data/dosen/submitkebutuhankhusus', 'DosenModule@submitkebutuhankhusus')->name('submitkebutuhankhusus');
Route::post('/data/dosen/submit_gantipassword', 'DosenModule@submit_gantipassword')->name('dosen ganti pass');
Route::get('/data/dosen/grafik_dosen', 'Dosen@grafik_dosen')->name('grafik_dosen');
Route::get('/data/dosen/grafik_jenis', 'Dosen@grafik_jenis')->name('grafik_jenis');
Route::get('/data/dosen/grafik_status', 'Dosen@grafik_status')->name('grafik_status');
Route::get('/data/dosen/activity/{id}', 'Dosen@activity')->name('activity');
Route::get('/data/dosen/activitydosen', 'DosenModule@activity')->name('activity');
Route::post('dosen/penguji_paging', 'Dosen@penguji_paging')->name('penguji_paging');
Route::post('/data/dosen/activity_paging', 'DosenModule@activity_paging')->name('activity_paging');
Route::post('dosen/activity_paging_data', 'Dosen@activity_paging_data')->name('activity_paging_data');

Route::post('/data/dosen/update', 'Dosen@update')->name('update');
Route::get('dosen/penugasan/{id}', 'Dosen@penugasan')->name('penugasan');
Route::get('dosen/pengangkatan/{id}', 'Dosen@pengangkatan')->name('riwayatpengangkatan');
Route::post('dosen/tambahpenugasan', 'Dosen@tambahpenugasan')->name('tambah_penugasan');
Route::post('dosen/tambahkepangkatan', 'Dosen@tambahkepangkatan')->name('tambah_pengangkatan');
Route::post('/data/dosen/delete', 'dosen@delete')->name('delete');
Route::post('/data/dosen/resetpassword', 'dosen@resetpassword')->name('resetpassword');

Route::get('dosen/pendidikan/{id}', 'Dosen@r_pendidikan')->name('riwayat_pendidikan');
Route::post('dosen/tambah_r_pendidikan', 'Dosen@tambah_r_pendidikan')->name('tambah_riwayat_pendidikan');

Route::get('dosen/sertifikasi/{id}', 'Dosen@r_sertifikasi')->name('riwayat_sertifikasi');
Route::post('dosen/tambah_r_sertifikasi', 'Dosen@tambah_r_sertifikasi')->name('tambah_riwayat_sertifikasi');

Route::get('dosen/penelitian/{id}', 'Dosen@r_penelitian')->name('riwayat_penelitian');
Route::post('dosen/tambah_r_penelitian', 'Dosen@tambah_r_penelitian')->name('tambah_riwayat_penelitian');

Route::get('dosen/fungsional/{id}', 'Dosen@r_fungsional')->name('riwayat_fungsional');
Route::post('dosen/tambah_r_fungsional', 'Dosen@tambah_r_fungsional')->name('tambah_riwayat_fungsional');
Route::get('/data/dosen/getdosen_select2', 'Dosen@getdosen_select2')->name('getdosen_select2');

Route::get('dosen/pembimbing/{id}', 'Dosen@pembimbing')->name('pembimbing');
Route::get('dosen/penguji/{id}', 'Dosen@penguji')->name('penguji');
Route::post('dosen/pembimbing_paging', 'Dosen@pembimbing_paging')->name('pembimbing_paging');
Route::post('dosen/penguji_paging', 'Dosen@penguji_paging')->name('penguji_paging');
Route::post('dosen/activity_paging', 'Dosen@activity_paging')->name('activity_paging');


Route::post('/master/kelas/edit', 'Kelas@edit')->name('edit');
Route::post('master/kelas/delete', 'Kelas@delete')->name('delete');
Route::post('/kelas/listkurikulum', 'Kelas@listkurikulum')->name('ListKurikulum');
Route::post('/kelas/listkelas', 'Kelas@listkelas')->name('ListKelas');

Route::post('/master/semester/activate', 'Semester@activate')->name('activate');


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

Route::get('/data/jadwalujian/form/{id}/{jenis}', 'JadwalUjian@form')->name('index');
Route::get('data/jadwalujian/kelas/{jenis}', 'JadwalUjian@kelas')->name('kelas');
Route::post('/data/jadwalujian/paging', 'JadwalUjian@paging')->name('paging');
Route::post('/data/jadwalujian/paging_daftar', 'JadwalUjian@paging_daftar')->name('paging_daftar');


Route::get('/data/kalenderakademik/get/{id}', 'KalenderAkademik@get')->name('get');
Route::get('data/kalenderakademik/getall', 'KalenderAkademik@getall')->name('getall');

//upload soal ujian
Route::get('dosen/uploadsoal/create', 'DosenUploadUjian@create')->name('create');
Route::get('/dosen/uploadsoal/edit/{id}', 'DosenUploadUjian@edit')->name('edit');
Route::post('dosen/uploadsoal/save', 'DosenUploadUjian@save')->name('save');
Route::post('dosen/uploadsoal/update', 'DosenUploadUjian@update')->name('update');
Route::post('dosen/uploadsoal/delete', 'DosenUploadUjian@delete')->name('delete');
Route::post('dosen/uploadsoal/paging', 'DosenUploadUjian@paging')->name('paging');
Route::get('data/dosen/daftarsoal', 'Dosen@daftarsoal')->name('daftarsoal');
Route::post('dosen/paging_soal', 'Dosen@paging_soal')->name('paging');

Route::get('/login/akademik', 'Auth\LoginController@akademik')->name('akademik');
Route::get('/login/dosen', 'Auth\LoginController@dosen')->name('dosen');
Route::get('/login/mahasiswa', 'Auth\LoginController@mahasiswa')->name('mahasiswa');

$results = DB::select('select * from module');
//print_r($results); exit;
foreach($results as $val){
    if($val->crud == 1){
        Route::get(strtolower($val->link), $val->mval.'@index')->name($val->mval);
        Route::post(strtolower($val->link).'/save', $val->mval.'@'.'save')->name($val->mval.'save');
        Route::get(strtolower($val->link).'/create', $val->mval.'@'.'create')->name($val->mval.'create');
        Route::post(strtolower($val->link).'/update', $val->mval.'@'.'update')->name($val->mval.'update');
        Route::get(strtolower($val->link).'/edit/{id}', $val->mval.'@'.'edit')->name($val->mval.'edit');
        Route::get(strtolower($val->link).'/view/{id}', $val->mval.'@'.'view')->name($val->mval.'view');
        Route::post(strtolower($val->link).'/delete', $val->mval.'@'.'delete')->name($val->mval.'delete');
       // Route::post(strtolower($val->link).'/delete', $val->mval.'@'.'delete')->name($val->mval.'delete');
        Route::post(strtolower($val->link).'/paging', $val->mval.'@'.'paging')->name('pagination');
    }else if($val->crud == 2){
        Route::get(strtolower($val->link), $val->mval.'@index')->name($val->mval);
        Route::get(strtolower($val->link), $val->mval)->name($val->mval);
    }else{
        Route::get(strtolower($val->link), $val->mval.'@index')->name($val->mval);
        Route::get(strtolower($val->link), $val->mval.'@create')->name($val->mval);
        Route::post(strtolower($val->link).'/paging', $val->mval.'@'.'paging')->name('pagination');
    }
    
}

// ADMIN 
Route::get('admin/jadwalkuliah', 'AdminJadwalPerkuliahan@index')->name('Jadwal Perkuliahan');
Route::get('admin/administrator', 'Administrator@index')->name('Jadwal Perkuliahan');
Route::post('admin/jadwalkuliah/paging', 'AdminJadwalPerkuliahan@paging')->name('Jadwal Perkuliahan');
Route::post('administrator/change_password', 'Administrator@change_password')->name('change_password');
//Route::post('module/administrator/create', 'Administrator@create')->name('Jadwal Perkuliahan');

Auth::routes();
Route::post('g_password/generate_key', 'Administrator@generate_key')->name('generate_key');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/getcalender', 'HomeController@getcalender')->name('getcalender');

//Route::get('/mahasiswa/login', 'Auth\LoginController@showLoginForm')->name('login');

