<?php

namespace App\Http\Controllers;

use App\Cart;
use App\DTrans;
use App\FasilitasHotel;
use App\Hotel;
use App\HTrans;
use App\Kamar;
use App\ReviewHotel;
use Exception;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    public function index(Request $req, $id){
        session(['idHotel' => $id]);
        $kamars = Kamar::where('id_hotel',$id)->get();
        $hotel = Hotel::where('id_hotel', $id)
                        ->join('daerah','daerah.id_daerah','=','hotel.Daerah')
                        ->join('kota','kota.id_kota','=','hotel.Kota')
                        ->first();

        $fasilitass = FasilitasHotel::join('fas_utk_hotel','fas_utk_hotel.id_fasilitas','=','fasilitas_hotel.id_fasilitas')
                                    ->where('id_hotel',$id)->get();

        $reviews = ReviewHotel::where('id_hotel',$id)
                                ->join('customer','customer.id_customer','=','review_hotel.id_customer')
                                ->get();
        $rating = 0;
        foreach ($reviews as $review) {
            $rating += $review->rating;
        }
        if($reviews->count()>0){
            $rating = $rating/$reviews->count();
        }

        return view("Customer.allkamars", compact("hotel","kamars","fasilitass","rating","reviews"));
    }

    public function addReview(Request $req){
        $rating = $req->input('rating');
        $detail = $req->input('detail');

        $now = date("Y-m-d");

        $review = new ReviewHotel();
        $review->id_customer = session()->get('loggedIn')->id_customer;
        $review->rating = $rating;
        $review->id_hotel = session()->get('idHotel');
        $review->detail_review = $detail;
        $review->tgl_review = $now;
        $review->save();

        return redirect('/kamar/'.session()->get('idHotel'));
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
            $updateCart->jumlah_kamar_pesan = $jumlah+$updateCart->jumlah_kamar;
            $updateCart->save();
        }else{
            //insert ke cart kalau tidak ada
            $id_cart = "CA";
            $allCart = Cart::where('jumlah_kamar_pesan','>',0)->orderBy('id_cart', 'DESC')->get();
            $banyak = substr($allCart[0]->id_cart,3);
            if($banyak<9){
                $id_cart = $id_cart."0000000".($banyak+1);
            }else if ($banyak<99){
                $id_cart = $id_cart."000000".($banyak+1);
            }else if ($banyak<999){
                $id_cart = $id_cart."00000".($banyak+1);
            }

            $newCart = new Cart;
            $newCart->id_cart = $id_cart;
            $newCart->id_customer = session()->get('loggedIn')->id_customer;
            $newCart->id_kamar = $id;
            $newCart->jumlah_kamar_pesan = $jumlah;
            $newCart->tgl_checkin = $tgl_checkin;
            $newCart->tgl_checkout = $tgl_checkout;
            $newCart->save();

        }
        $kamars = Kamar::all();

        return redirect('/kamar/'.session()->get('idHotel'));
    }

    public function showCart(Request $req){
        $cart = Cart::where('id_customer',session()->get('loggedIn')->id_customer)
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

        $cart = Cart::where('id_customer',session()->get('loggedIn')->id_customer)
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

        $cart = Cart::where('id_customer',session()->get('loggedIn')->id_customer)
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

        $cart = Cart::where('id_customer',session()->get('loggedIn')->id_customer)
        ->join('kategori_hotel','kategori_hotel.id_kategori','=','cart.id_kamar')
        ->join('hotel','hotel.id_hotel','=','kategori_hotel.id_hotel')
        ->get();
        $total = 0;
        foreach ($cart as $i) {
            $total = $total+$i->jumlah_kamar_pesan*$i->harga_kamar;
        }

        return view('Customer.cart',['cartItems'=>$cart,'total'=>$total]);
    }

    // CHECKOUT--
    public function viewCheckout(Request $request)
    {
        $id_cart = $request->id_cart;
        $cart = Cart::select("*")->where("id_cart",$id_cart);
        $hotel = Hotel::select("*")->where("id_hotel", $cart->first()->kamar->id_hotel);
        return view('Customer.checkout',[
            "pesanan"=>$cart->first(),
            "hotel"=> $hotel->first()
        ]);
    }
    public function viewPembayaran(Request $request)
    {
        $id_cart = $request->id_cart;
        $cart = Cart::select("*")->where("id_cart",$id_cart)->first();
        $hargaKamar = $cart->kamar->harga_kamar;
        $jumKamar = $cart->jumlah_kamar_pesan;
        $jumMalam = date_diff(date_create($cart->tgl_checkin),date_create($cart->tgl_checkout))->format("%a");
        return view('Customer.pembayaran',[
            "id_cart" => $id_cart,
            "hargaKamar"=>$hargaKamar,
            "jumlahKamar"=> $jumKamar,
            "jumlahMalam" => $jumMalam,
            "totalBayar" => $hargaKamar*$jumKamar*$jumMalam
        ]);
    }
    public function generateKeyHtrans()
    {
        $kode = "HT";
        $idmaks = HTrans::max('id_htrans');
        $index = ((int)substr($idmaks,3))+1;
        $kode .= str_pad($index,8,'0',STR_PAD_LEFT);
        return $kode;
    }
    public function generateKeyDtrans()
    {
        $kode = "DT";
        $idmaks = DTrans::max('id_dtrans');
        $index = ((int)substr($idmaks,3))+1;
        $kode .= str_pad($index,8,'0',STR_PAD_LEFT);
        return $kode;
    }
    public function addTransaksi(Request $request)
    {
        $id_cart = $request->id_cart;
        $id_customer = session()->get('loggedIn')->id_customer;
        $cart = Cart::select("*")->where("id_cart",$id_cart)->first();
        $hargaKamar = $cart->kamar->harga_kamar;
        $jumKamar = $cart->jumlah_kamar_pesan;
        $jumMalam = date_diff(date_create($cart->tgl_checkin),date_create($cart->tgl_checkout))->format("%a");
        $imgfile = $request->file('imgfile');
        $filename = "";

        if ($request->hasFile('imgfile')) {
            $imgfile = $request->file('imgfile');
            if($request->hasFile('imgfile')){
                $filename = pathinfo($imgfile->getClientOriginalName(), PATHINFO_FILENAME).".".$imgfile->getClientOriginalExtension();
                $imgfile->storeAs("public/images/hotel_images", $filename);
            }
        }
        try{
            $HTrans = [
                "id_htrans" => $this->generateKeyHtrans(),
                "id_customer" => $id_customer,
                "metode_bayar" => "transfer",
                "tgl_transaksi" => date("Y-m-d"),
                "total_harga" => $hargaKamar*$jumKamar*$jumMalam,
                "gambar_bukti" => $filename
            ];
            HTrans::create($HTrans);
            $dtrans = [
                "id_dtrans" => $this->generateKeyDtrans(),
                "id_htrans" =>$this->generateKeyHtrans(),
                "id_hotel" =>$cart->kamar->id_hotel,
                "id_kategori" =>$cart->id_kamar,
                "jumlah_kamar" =>$cart->jumlah_kamar_pesan,
                "tgl_checkin" =>$cart->tgl_checkin,
                "tgl_checkout" =>$cart->tgl_checkout,
                "harga_kamar" => $hargaKamar,
                "subtotal" => $hargaKamar*$jumKamar*$jumMalam,
            ];
            DTrans::create($dtrans);
            Cart::find($id_cart)->delete();
            return redirect('/cart')->with('alert',"Berhasil menambah transaksi");
        }catch (Exception $e) {
            return back()->with('alert',$e->getMessage());
        }
    }
    //--CHECKOUT
}
