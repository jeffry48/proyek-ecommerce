@extends('layouts.index')

@section('center')

<div class="header-bottom"><!--header-bottom-->
    <div class="container">
        <div class="row">
            <div class="col-sm-9">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="mainmenu pull-left">
                    <ul class="nav navbar-nav collapse navbar-collapse">
                        <li><a href="/customerHome" class="active">Home</a></li>
                        <li><a href="/hotel" class="active">Hotel</a></li>
                        @if (session()->get('loggedIn'))
                            <li class="dropdown"><a href="#">Account<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="/profile">My Profile</a></li>
                                    <li><a href="/favourite">My Favourite</a></li>
                                    <li><a href="/history">My History</a></li>
                                </ul>
                            </li>
                        @endif

                        <li><a href="contact-us.html">Contact</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div><!--/header-bottom-->
</header><!--/header-->

<form action="/checkout" method="post">
    @csrf
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="#">Home</a></li>
              <li class="active">Shopping Cart</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td></td>
                        <td class="image">Item</td>\
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cartItems as $item)
                        <tr>
                            <td><input type="radio" name="id_cart" value="{{$item->id_cart}}"></td>
                            <td class="cart_product">
                                <h4>{{$item->nama_hotel}} berjenis kamar {{$item->nama_kamar}}</h4>
                                <p>Tanggal {{$item->tgl_checkin}} sampai {{$item->tgl_checkout}}</p>
                            </td>
                            <td class="cart_price">{{$item->harga_kamar}}</td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button">

                                    <a class="cart_quantity_down" href="{{route('minJumlah',['id'=>$item->id_cart])}}"> - </a>
                                    <input class="cart_quantity_input" type="text" name="quantity" value="{{$item->jumlah_kamar_pesan}}" autocomplete="off" size="2">
                                    <a class="cart_quantity_up" href="{{route('plusJumlah',['id'=>$item->id_cart])}}"> + </a>
                                </div>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">{{$item->harga_kamar*$item->jumlah_kamar_pesan}}</p>
                            </td>
                            <td class="cart_delete">
                                <a class="cart_quantity_delete" href="{{route('deleteItemfromCart',['id'=>$item->id_cart])}}"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>

                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</section> <!--/#cart_items-->

<section id="do_action">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li>Total <span>{{$total}}</span></li>
                    </ul>
                    <button class="btn btn-default check_out" href="">Check Out</button>
                </div>
            </div>
        </div>
    </div>
</section><!--/#do_action-->
</form>
@endsection

