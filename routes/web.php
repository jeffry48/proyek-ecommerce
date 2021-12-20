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
Route::get('/kamar/{id}', ['uses'=>'KamarController@index','as'=>'kamar']);
Route::get('/tambahFav/{id}', ['uses'=>'HotelsController@tambahFav','as'=>'tambahFav']);
Route::get('/removeFav/{id}', ['uses'=>'HotelsController@removeFav','as'=>'removeFav']);
Route::get('/hotel', "HotelsController@index");
Route::get('/kamar/addtoCart/{id}',['uses'=>'KamarController@addKamarToCart','as'=>'AddToCartKamar']);
Route::get('/cart', ['uses'=>'KamarController@showCart','as'=>"cartKamars"]);
Route::get('/cart/minJumlah/{id}',['uses'=>'KamarController@minJumlah','as'=>'minJumlah']);
Route::get('/cart/plusJumlah/{id}',['uses'=>'KamarController@plusJumlah','as'=>'plusJumlah']);
Route::get('/cart/deleteItemfromCart/{id}',['uses'=>'KamarController@deleteItemfromCart','as'=>'deleteItemfromCart']);
Route::get('/profile', 'user@getProfile');
Route::get('/favourite','user@getFavourite');
Route::get('/logout', 'user@logout');
Route::get('/editProfile', 'user@editProfile');
Route::post('/proseseditProfile', "user@prosesEditProfile");
Route::get('/filterHotel/{id}',['uses'=>'HotelsController@filterHotel', 'as'=>'filterHotel']);
Route::get('/filterDaerah/{id}',['uses'=>'HotelsController@filterDaerah', 'as'=>'filterDaerah']);
Route::post('/filterFasilitas','HotelsController@filterFasilitas');
Route::post('/searchHotel','HotelsController@searchHotel');
Route::post('/addReview','KamarController@addReview');
Route::post('/sendLetter', 'user@sendLetter');
Route::get('/customerHome','CustomerHomeCtroller@index');

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
Route::post('/checkout', "KamarController@viewCheckout");
Route::post('/pembayaran', "KamarController@viewPembayaran");
Route::post('/bayar', "KamarController@addTransaksi");

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
    Route::get('/login',"Hotel\HotelController@viewLogin");
    Route::post('/ceklogin',"Hotel\HotelController@login");
    Route::post('/register',"Hotel\HotelController@viewRegister");
    Route::post('/prosesregister',"Hotel\HotelController@register");
    Route::get('/pilihhotel',"Hotel\HotelController@viewPilihHotel");
    Route::post('/sethotel',"Hotel\HotelController@setHotel");
    Route::get('/logout',"Hotel\HotelController@logout");

    Route::get('/getdaerahfromkota',"Hotel\HotelController@getDaerahfromKota");
    //Route::get('/getkotafromdaerah',"Hotel\HotelController@getKotafromDaerah");

    Route::get('/','Hotel\HotelController@viewHome');
    Route::prefix("transaksi")->group(function (){
        Route::get('/',"Hotel\HotelController@viewListTransaksi");
        Route::post('/detail',"Hotel\HotelController@viewDetailTransaksi");
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

