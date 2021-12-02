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

<<<<<<< main
Route::get('/hotel', "HotelsController@index");
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
=======
//HOTEL--
/*
Route::prefix("hotel")->group(function ()
{
    Route::get('/',"HotelController@viewHome");
    Route::prefix("transaksi")->group(function (){
        Route::get('/',"HotelController@viewListTransaksi");
        Route::get('/{id}',"HotelController@viewDetailTransaksi");
    });
    Route::prefix("promo")->group(function (){
        Route::get('/',"HotelController@viewListPromo");
        Route::get('/{id}',"HotelController@viewDetailPromo");
        Route::get('/tambah',"HotelController@viewTambahPromo");
    });
    Route::prefix("profil")->group(function (){
        Route::get('/',"HotelController@viewProfil");
        Route::get('/edit',"HotelController@viewEditProfil");
    });
    Route::prefix("product")->group(function (){
        Route::get('/',"HotelController@viewListProduct");
        Route::get('/tambah',"HotelController@viewTambahProduct");
        Route::get('/{id}',"HotelController@viewTambahProduct");
    });
});
*/
//--HOTEL
>>>>>>> Lidya
