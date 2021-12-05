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

// Route::get('/', function () {
//     return view('test');
// });

// Route::get('/hotel', "HotelsController@index");
// Route::get('/register', function () {
//     return view('register');
// });
// Route::post('/prosesRegister', "user@register");
// Route::get('/login', function () {
//     return view('login');
// });
// Route::post('/prosesLogin', "user@login");
// Route::get('/listHotel', "hotels@getAllHotels");
// Route::get('/detailHotel{idHotel}', "hotels@getDetailHotel");
// Route::get('/addFavorite', "hotels@addfavorite");
// Route::get('/removeFavorite', "hotels@removeFavorite");
// Route::get('/listFavorite', "user@getAllFavorite");

//Admin
// Route::get('/adminProducts', 'Admin\AdminProductsController@displayProducts');
Route::prefix("admin")->group(function ()
{
    Route::get('/register', function () {
        return view('Admin.register');
    });
    Route::post('/prosesRegister', "AdminController@register");
    Route::get('/login', function () {
        return view('Admin.login');
    });
    Route::post('/prosesLogin', "AdminController@login");
    Route::get('/listHotel', "AdminController@getAllHotels");
    Route::get('/listPem', "AdminController@getAllPem");
    Route::get('/listCust', "AdminController@getAllCust");

    Route::get('/detailHotel{idHotel}', "AdminController@getDetailHotel");
    Route::get('/detailPem{idPem}', "AdminController@getDetailpem");


});


//HOTEL--
Route::prefix("userhotel")->group(function ()
{
    Route::get('/','Hotel\HotelController@viewHome');
    Route::prefix("transaksi")->group(function (){
        Route::get('/',"Hotel\HotelController@viewListTransaksi");
        Route::get('/{id}',"Hotel\HotelController@viewDetailTransaksi");
    });
    Route::prefix("promo")->group(function (){
        Route::get('/',"Hotel\HotelController@viewListPromo");
        Route::get('/{id}',"Hotel\HotelController@viewDetailPromo");
        Route::get('/tambah',"Hotel\HotelController@viewTambahPromo");
    });
    Route::prefix("profil")->group(function (){
        Route::get('/',"Hotel\HotelController@viewProfil");
        Route::get('/edit',"Hotel\HotelController@viewEditProfil");
    });
    Route::prefix("product")->group(function (){
        Route::get('/',"Hotel\HotelController@viewListProduct");
        Route::get('/tambah',"Hotel\HotelController@viewTambahProduct");
        Route::get('/{id}',"Hotel\HotelController@viewTambahProduct");
    });
});
//--HOTEL

