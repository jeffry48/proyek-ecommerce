<?php

namespace App\Http\Controllers;

use App\HTrans;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index(){
        $transaksis = HTrans::where('id_customer',session()->get('loggedIn')->id_customer)
                            ->join('dtrans','dtrans.id_htrans','=','htrans.id_htrans')
                            ->join('hotel', 'hotel.id_hotel','=','dtrans.id_hotel')
                            ->join('kategori_hotel','kategori_hotel.id_kategori','=','dtrans.id_kategori')
                            ->get();
        return view('Customer.historyTransaksi', compact('transaksis'));
    }
}
