<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function() {
    return redirect(route('login'));
});

Auth::routes(['register' => false]);

Route::group(['middleware' => 'auth'], function(){
    //Manajemen Rak
    Route::group(['middleware' => ['permission:manajemen rak']], function() {
        Route::get('/rak','RakController@index')->name('rak.index');
        Route::get('/tambahrak','RakController@create')->name('rak.create');
        Route::post('/store/rak','RakController@store')->name('rak.store');
        Route::get('/edit/rak/{id}','RakController@edit')->name('rak.edit');
        Route::put('/update/rak','RakController@update')->name('rak.update');
        Route::delete('/delete/rak/{id}','RakController@destroy')->name('rak.destroy');
    });

    //Manajemen Arsip
    Route::group(['middleware' => ['permission:manajemen arsip']], function() {
        Route::get('/arsip','ArsipController@index')->name('arsip.index');
        Route::get('/tambaharsip','ArsipController@create')->name('arsip.create');
        Route::post('/store/arsip','ArsipController@store')->name('arsip.store');
        Route::get('/edit/arsip/{id}','ArsipController@edit')->name('arsip.edit');
        Route::put('/update/arsip','ArsipController@update')->name('arsip.update');
        Route::delete('/delete/arsip/{id}','ArsipController@destroy')->name('arsip.destroy');
    });

    //Transaksi
    Route::group(['middleware' => ['permission:manajemen transaksi']], function() {
        Route::get('/transaksi','PeminjamanController@transaksi')->name('transaksi.index');
        Route::get('/transaksi/create','PeminjamanController@transaksi_create')->name('transaksi.create');
        Route::post('/transaksi/store','PeminjamanController@transaksi_store')->name('transaksi.store');
        // Approval
        Route::get('/approval','PeminjamanController@approval')->name('approval.index');
        Route::get('/terima/approval/{id}','PeminjamanController@approval_terima')->name('approval.terima');
        Route::get('/tolak/approval/{id}','PeminjamanController@approval_tolak')->name('approval.tolak');
        //Pengembalian Arsip
        Route::post('/transaksi/kembali/{id}','PeminjamanController@transaksi_kembali')->name('transaksi.kembali');
        //Riwayat Peminjaman
        Route::get('/history','PeminjamanController@history')->name('history.index');
    });

    //Peminjaman
    Route::group(['middleware' => ['permission:manajemen peminjaman']], function() {
        Route::get('/peminjaman','PeminjamanController@peminjaman_user')->name('peminjaman.user');
        Route::get('/peminjaman/create','PeminjamanController@peminjaman_create')->name('peminjaman.create');
        Route::post('/peminjaman/pinjam/{id}','PeminjamanController@peminjaman_post')->name('peminjaman.pinjam');
        Route::get('/riwayat','PeminjamanController@riwayat_user')->name('riwayat.user');
    });

    //settings
    Route::group(['middleware' => ['role:admin']], function() {
        Route::resource('setting', 'SettingController');        
    });

    
    Route::group(['middleware' => ['permission:manajemen users|manajemen roles']], function() {
        Route::get('/roles/search','RoleController@search')->name('roles.search');
        Route::resource('users', 'UserController');
        Route::resource('roles', 'RoleController');
    });

    //profile
    Route::resource('/profile', 'ProfileController');

    Route::get('/home', 'HomeController@index')->name('home');

});

    //ujicoba
    Route::get('/generateBarcode','ArsipController@generateBarcode')->name('arsip.generateBarcode');
    Route::get('/DetailBarcode/{id}','ArsipController@DetailBarcode')->name('arsip.DetailBarcode');
    Route::post('/pinjamBarcode','PeminjamanController@pinjamBarcode')->name('peminjaman.pinjamBarcode');
    Route::get('/kembaliBarcode/{id}','PeminjamanController@kembaliBarcode')->name('peminjaman.kembaliBarcode');
