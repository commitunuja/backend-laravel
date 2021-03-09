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

Route::get('profil', function () {
    $web = "Warungbelajar.com";
    return view('profil', compact('web'));
});

Route::get('about', function () {
    return 'ini adalah halaman about';
});

Route::get('halo','TestingController@halo');

Route::get('halaman/{page?}', function ($page = "profil") {
    return 'ini adalah halaman '.$page;
});

Route::get('halo/{nama?}','TestingController@halo');

Route::get('contact', function () {
    return 'ini adalah halaman contact';
})->name('contact');

Route::get('testing', function () {
    return redirect()->route('contact');
});

Route::group(["prefix"=>"produk"], function(){
      Route::get("all","ProdukController@all");
      Route::get("shirt","ProdukController@shirt");
      Route::get("latest","ProdukController@latest");
      Route::get("popular","ProdukController@popular");
});

Route::view('katalog','vw_katalog',["produk"=>"DVD TUTORIAL"]);

Route::resource('supplier','SupplierController');

Route::view('template','template/master');

Route::view('profil','vw_profil');
Route::view('about','vw_about');

Route::view('bootstrap','template/bootstrap');

