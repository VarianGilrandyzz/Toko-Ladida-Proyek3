<?php

use Illuminate\Support\Facades\Auth;
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
Auth::routes();

Route::get('/', function () {
    return view('/home/index');
})->name('home');

Route::get('/pemesanan', function () {
    return view('/home/pemesanan');
})->name('pemesanan');

Route::get('home', function () {
    return redirect()->route('admin.home');
});

Route::get('admin', 'HomeController@index')->name('admin.home');
Route::get('admin/profile', 'homeController@profile')->name('admin.profile');

Route::resource('admin/user', UserController::class);
Route::resource('admin/barang', BarangController::class);


