<?php

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

Route::get('/', function () {
    return view('test');
});

//Customer
Route::get('/kamar', "KamarController@index");
Route::get('/hotel', "HotelsController@index");
Route::get('/kamar/addtoCart/{id}',['uses'=>'KamarController@addKamarToCart','as'=>'AddToCartKamar']);
Route::get('/cart', ['uses'=>'KamarController@showCart','as'=>"cartKamars"]);
Route::get('/cart/minJumlah/{id}',['uses'=>'KamarController@minJumlah','as'=>'minJumlah']);
Route::get('/cart/plusJumlah/{id}',['uses'=>'KamarController@plusJumlah','as'=>'plusJumlah']);
Route::get('/cart/deleteItemfromCart/{id}',['uses'=>'KamarController@deleteItemfromCart','as'=>'deleteItemfromCart']);

//----------------------------------//
Route::get('/register', function () {
    return view('register');
});
Route::post('/prosesRegister', "user@register");
Route::get('/login', function () {
    return view('login');
});
Route::post('/prosesLogin', "user@login");
Route::get('/listHotel', "hotels@getAllHotels");
Route::get('/detailHotel{idHotel}', "hotels@getDetailHotel");
Route::get('/addFavorite', "hotels@addfavorite");
Route::get('/removeFavorite', "hotels@removeFavorite");
Route::get('/listFavorite', "user@getAllFavorite");


//Admin
Route::get('/adminProducts', 'Admin\AdminProductsController@displayProducts');
