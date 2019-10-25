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

//oute::post('master/agama/paging', 'Agama@paging')->name('pagination');
//Route::post('master/matakuliah/paging', 'MataKuliah@paging')->name('pagination');

$results = DB::select('select * from module');
foreach($results as $val){
    Route::get(strtolower($val->link), $val->mval.'@index')->name($val->mval);
    Route::post(strtolower($val->link).'/save', $val->mval.'@'.'save')->name($val->mval.'save');
    Route::get(strtolower($val->link).'/create', $val->mval.'@'.'create')->name($val->mval.'create');
    Route::get(strtolower($val->link).'/edit', $val->mval.'@'.'edit')->name($val->mval.'edit');
    Route::get(strtolower($val->link).'/view/{id}', $val->mval.'@'.'view')->name($val->mval.'view');
    Route::get(strtolower($val->link).'/delete', $val->mval.'@'.'delete')->name($val->mval.'delete');
    Route::post(strtolower($val->link).'/paging', $val->mval.'@'.'paging')->name('pagination');
}

