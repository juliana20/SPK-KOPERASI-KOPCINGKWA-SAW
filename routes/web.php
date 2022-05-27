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

// 

// RUOTE DIPAKAI =============================================================================================================
Route::get('/',function(){
	return view('auth.login');
});

Route::get('/login','Login@login');
Route::post('/auth','Login@auth');
Route::get('/logout', 'Login@logout');

Route::group(['middleware' => ['admin']], function () {
	#PETUGAS
	Route::prefix('user')->group(function() {
		Route::get('/', 'UserController@index');
		Route::match(array('GET', 'POST'),'/datatables','UserController@datatables_collection');
		Route::match(array('GET', 'POST'),'/create','UserController@create');
		Route::match(array('GET', 'POST'),'/edit/{id}','UserController@edit');
		Route::match(array('GET', 'POST'),'/view/{id}','UserController@view');
		Route::match(array('GET', 'POST'),'/delete/{id}','UserController@delete');
	});
	#DEBITUR
	Route::prefix('debitur')->group(function() {
		Route::get('/', 'DebiturController@index');
		Route::match(array('GET', 'POST'),'/datatables','DebiturController@datatables_collection');
		Route::match(array('GET', 'POST'),'/create','DebiturController@create');
		Route::match(array('GET', 'POST'),'/edit/{id}','DebiturController@edit');
		Route::match(array('GET', 'POST'),'/view/{id}','DebiturController@view');
		Route::match(array('GET', 'POST'),'/delete/{id}','DebiturController@delete');
	});
	#KRITERIA
	Route::prefix('kriteria')->group(function() {
		Route::get('/', 'KriteriaController@index');
		Route::match(array('GET', 'POST'),'/datatables','KriteriaController@datatables_collection');
		Route::match(array('GET', 'POST'),'/create','KriteriaController@create');
		Route::match(array('GET', 'POST'),'/edit/{id}','KriteriaController@edit');
		Route::match(array('GET', 'POST'),'/view/{id}','KriteriaController@view');
	});
	#SUB KRITERIA
	Route::prefix('sub-kriteria')->group(function() {
		Route::get('/', 'SubKriteriaController@index');
		Route::match(array('GET', 'POST'),'/datatables','SubKriteriaController@datatables_collection');
		Route::match(array('GET', 'POST'),'/create','SubKriteriaController@create');
		Route::match(array('GET', 'POST'),'/edit/{id}','SubKriteriaController@edit');
		Route::match(array('GET', 'POST'),'/view/{id}','SubKriteriaController@view');
		Route::match(array('GET', 'POST'),'/delete/{id}','SubKriteriaController@delete');
	});
	#ALTERNATIF
	Route::prefix('alternatif')->group(function() {
		Route::get('/', 'AlternatifController@index');
		Route::match(array('GET', 'POST'),'/datatables','AlternatifController@datatables_collection');
		Route::match(array('GET', 'POST'),'/create','AlternatifController@create');
		Route::match(array('GET', 'POST'),'/edit/{id}','AlternatifController@edit');
		Route::match(array('GET', 'POST'),'/view/{id}','AlternatifController@view');
		Route::match(array('GET', 'POST'),'/delete/{id}','AlternatifController@delete');
	});
	#PINJAMAN
	Route::prefix('pinjaman')->group(function() {
		Route::get('/', 'PinjamanController@index');
		Route::match(array('GET', 'POST'),'/datatables','PinjamanController@datatables_collection');
		Route::match(array('GET', 'POST'),'/create','PinjamanController@create');
		Route::match(array('GET', 'POST'),'/edit/{id}','PinjamanController@edit');
		Route::match(array('GET', 'POST'),'/view/{id}','PinjamanController@view');
		Route::match(array('GET', 'POST'),'/lookup_alternatif','PinjamanController@datatables_lookup_alternatif');
		Route::match(array('GET', 'POST'),'/delete/{id}','PinjamanController@delete');
		
	});
	#PROSES SPK
	Route::prefix('proses-spk')->group(function() {
		Route::get('/', 'ProsesSpkController@index');
		Route::match(array('GET', 'POST'),'/datatables','ProsesSpkController@datatables_collection');
		Route::match(array('GET', 'POST'),'/proses-normalisasi','ProsesSpkController@proses_normalisasi');
		Route::match(array('GET', 'POST'),'/normalisasi','ProsesSpkController@normalisasi');
		Route::match(array('GET', 'POST'),'/datatables-normalisasi','ProsesSpkController@datatables_collection_normalisasi');
		Route::match(array('GET', 'POST'),'/proses-perhitungan-akhir','ProsesSpkController@proses_perhitungan_akhir');
		Route::match(array('GET', 'POST'),'/perhitungan-akhir','ProsesSpkController@perhitungan_akhir');
		Route::match(array('GET', 'POST'),'/datatables-perhitungan-akhir','ProsesSpkController@datatables_collection_perhitungan_akhir');
		Route::match(array('GET', 'POST'),'/perangkingan','ProsesSpkController@perangkingan');
		Route::match(array('GET', 'POST'),'/reset-hasil','ProsesSpkController@reset_hasil');
	});
	#DASHBOARD
	Route::prefix('dashboard')->group(function() {
		Route::get('/','Dashboard@index');
		Route::get('/dashboard-master','Dashboard@dashboard_master');
		Route::get('/dashboard-laporan','Dashboard@dashboard_laporan');
		Route::post('/chart','Dashboard@chart');
		Route::match(array('GET', 'POST'),'/info_siswa','Dashboard@info_siswa');
		Route::match(array('GET', 'POST'),'/info_pemasukan','Dashboard@info_pemasukan');
		Route::match(array('GET', 'POST'),'/info_pengeluaran','Dashboard@info_pengeluaran');
	});
	#LAPORAN
	Route::prefix('laporan')->group(function() {
		Route::get('/pinjaman','Laporan@pinjaman');
		Route::post('/pinjaman/print','Laporan@print_pinjaman');

		Route::get('/hasil-perhitungan','Laporan@hasil_perhitungan');
		Route::post('/hasil-perhitungam/print','Laporan@print_hasil_perhitungan');
	});

});











// =========================================================================================================================

?>