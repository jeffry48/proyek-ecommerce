<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Kamar;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    public function index(){
        $kamars = Kamar::all();

        return view("Customer.allkamars", compact("kamars"));
    }

    public function addKamartoCart(Request $request, $id){
        //ambil id user di session

        //pengecekan kalau sudah ada atau belum
        $jumlah = $request->input('jumlah');
        $tgl_checkin = $request->input('tgl_checkin');
        $tgl_checkout = $request->input('tgl_checkout');

        $cart = Cart::where('id_kamar',$id)->where('tgl_checkin',$tgl_checkin)->where('tgl_checkout',$tgl_checkout)->get();
        if($cart->count()>0){
            $updateCart = $cart[0];
            $updateCart->jumlah_kamar = $jumlah+$updateCart->jumlah_kamar;
            $updateCart->save();
        }else{
            //insert ke cart kalau tidak ada
            $id_cart = "CA";
            $allCart = Cart::all();
            $banyak = $allCart->count();
            if($banyak<9){
                $id_cart = $id_cart."0000000".($banyak+1);
            }else if ($banyak<99){
                $id_cart = $id_cart."000000".($banyak+1);
            }

            $newCart = new Cart;
            $newCart->id_cart = $id_cart;
            $newCart->id_customer = "guest001";
            $newCart->id_kamar = $id;
            $newCart->jumlah_kamar = $jumlah;
            $newCart->tgl_checkin = $tgl_checkin;
            $newCart->tgl_checkout = $tgl_checkout;
            $newCart->save();

        }
        $kamars = Kamar::all();

        return view("Customer.allkamars", compact("kamars"));
    }

    public function showCart(Request $req){
        $cart = Cart::where('id_customer',"guest001")
            ->join('kategori_hotel','kategori_hotel.id_kategori','=','cart.id_kamar')
            ->join('hotel','hotel.id_hotel','=','kategori_hotel.id_hotel')
            ->get();

        $total = 0;
        foreach ($cart as $i) {
            $total = $total+$i->jumlah_kamar_pesan*$i->harga_kamar;
        }


        return view('Customer.cart',['cartItems'=>$cart,'total'=>$total]);
    }

    public function minJumlah(Request $req, $id){
        $cart = Cart::where('id_cart',$id)->get();
        $updateCart = $cart[0];
        $updateCart->jumlah_kamar_pesan = $updateCart->jumlah_kamar_pesan-1;
        $updateCart->save();

        $cart = Cart::where('id_customer',"guest001")
            ->join('kategori_hotel','kategori_hotel.id_kategori','=','cart.id_kamar')
            ->join('hotel','hotel.id_hotel','=','kategori_hotel.id_hotel')
            ->get();

            $total = 0;
            foreach ($cart as $i) {
                $total = $total+$i->jumlah_kamar_pesan*$i->harga_kamar;
            }


            return view('Customer.cart',['cartItems'=>$cart,'total'=>$total]);
    }

    public function plusJumlah(Request $req, $id){
        $cart = Cart::where('id_cart',$id)->get();
        $updateCart = $cart[0];
        $updateCart->jumlah_kamar_pesan = $updateCart->jumlah_kamar_pesan+1;
        $updateCart->save();

        $cart = Cart::where('id_customer',"guest001")
            ->join('kategori_hotel','kategori_hotel.id_kategori','=','cart.id_kamar')
            ->join('hotel','hotel.id_hotel','=','kategori_hotel.id_hotel')
            ->get();
            $total = 0;
            foreach ($cart as $i) {
                $total = $total+$i->jumlah_kamar_pesan*$i->harga_kamar;
            }


            return view('Customer.cart',['cartItems'=>$cart,'total'=>$total]);
    }

    public function deleteItemfromCart(Request $req, $id){
        $cart = Cart::where('id_cart',$id);
        $cart->delete();

        $cart = Cart::where('id_customer',"guest001")
        ->join('kategori_hotel','kategori_hotel.id_kategori','=','cart.id_kamar')
        ->join('hotel','hotel.id_hotel','=','kategori_hotel.id_hotel')
        ->get();
        $total = 0;
        foreach ($cart as $i) {
            $total = $total+$i->jumlah_kamar_pesan*$i->harga_kamar;
        }

        return view('Customer.cart',['cartItems'=>$cart,'total'=>$total]);
    }
}
