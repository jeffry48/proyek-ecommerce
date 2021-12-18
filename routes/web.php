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

//////////////////////////////////Admin////////////////////////////////////
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
    Route::post('prosesUpdateProfile', "AdminController@updateProfile");
    Route::get('/profile', function ()
    {
        return view ('Admin.profile');
    });
    Route::get('logout', function () {
        session()->flush();
        return redirect("admin/login");
    });
    //pemilik dan customer
    Route::get('searchPemilik', "AdminController@searchPemilik");
    Route::get('detailCust{idCust}', "AdminController@getDetailCustomer");
    Route::get('/detailPem{idPem}', "AdminController@getDetailpem");
    Route::get('/listPem', "AdminController@getAllPem");
    Route::get('/listCust', "AdminController@getAllCust");

    //hotel dan kamar
    Route::get('searchHotel', "AdminController@searchHotel");
    Route::get('detailKamar{idKamar}', "AdminController@getDetailKamar");
    Route::get('/detailHotel{idHotel}', "AdminController@getDetailHotel");
    Route::get('/listHotel', "AdminController@getAllHotels");

    //daerah dan kota
    Route::get('listDaerah', "AdminController@getAllDaerah");
    Route::get('listKota', "AdminController@getAllKota");
    Route::get('tambahDaerah', function ()
    {
        return view("Admin.tambahDaerah");
    });
    Route::post('prosesTambahDaerah', "AdminController@TambahDaerah");
    Route::get('deleteDaerah{idD}', "AdminController@deleteDaerah");
    Route::get('searchDaerah', "AdminController@searchDaerah");
    Route::get('tambahKota', function ()
    {
        return view("Admin.tambahKota");
    });
    Route::post('prosesTambahKota', "AdminController@tambahKota");
    Route::get('searchKota', "AdminController@searchKota");

    //laporan
    Route::get('laporanTrans', "AdminController@getAllTrans");
    Route::get('searchTrans', "AdminController@searchTrans");

    Route::get('laporanUserBanyak', "AdminController@getAllUserbanyak");
    Route::get('searchUserbanyak', "AdminController@searchUserbanyak");

    Route::get('laporanPengPem', "AdminController@getAllpenghasilan");
    Route::get('searchPengPem', "AdminController@searchPengPem");

    Route::get('laporanPengPemBanyak', "AdminController@getAllPengPemBanyak");
    Route::get('searchPengPemBanyak', "AdminController@searchPengPemBanyak");
});
////////////////////////////////////////////////////////////////////////////


//HOTEL--
Route::prefix("userhotel")->group(function ()
{
    Route::get('/getdaerahfromkota',"Hotel\HotelController@getDaerahfromKota");

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
        Route::post('/edit/simpan',"Hotel\HotelController@simpanEditProfil");
    });
    Route::prefix("product")->group(function (){
        Route::get('/',"Hotel\HotelController@viewListProduct");
        Route::get('/tambah',"Hotel\HotelController@viewTambahProduct");
        Route::post('/tambah/insert',"Hotel\HotelController@tambahProduct");
        Route::post('/hapus',"Hotel\HotelController@hapusProduct");
        Route::get('/{id}',"Hotel\HotelController@viewDetailProduct");
        Route::get('/{id}/edit',"Hotel\HotelController@viewEditProduct");
        Route::post('/edit/simpan',"Hotel\HotelController@simpanEditProduct");
    });
});
//--HOTEL

