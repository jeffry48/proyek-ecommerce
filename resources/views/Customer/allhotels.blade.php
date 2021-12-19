
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
                        <li><a href="#" class="active">Home</a></li>
                        <li><a href="/hotel" class="active">Hotel</a></li>
                        @if (session()->get('loggedIn'))
                            <li class="dropdown"><a href="#">Account<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="/profile">My Profile</a></li>
                                    <li><a href="/favourite">My Favourite</a></li>
                                    <li><a href="#">My History</a></li>
                                </ul>
                            </li>
                        @endif

                        <li><a href="contact-us.html">Contact</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="search_box pull-right">
                    <form action="/searchHotel" method="post">
                        @csrf
                        <input type="text" name="nama" placeholder="Search"/>
                        <button type="submit"><img style="width:25px;height:25px" src="{{asset('images/search.png')}}" alt=""></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div><!--/header-bottom-->
</header><!--/header-->

{{-- <section id="slider"><!--slider-->
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                    <li data-target="#slider-carousel" data-slide-to="1"></li>
                    <li data-target="#slider-carousel" data-slide-to="2"></li>
                </ol>

                <div class="carousel-inner">
                    <div class="item active">
                        <div class="col-sm-6">
                            <h1><span>E</span>-SHOPPER</h1>
                            <h2>Free E-Commerce Template</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                            <button type="button" class="btn btn-default get">Get it now</button>
                        </div>
                        <div class="col-sm-6">
                            <img src="{{asset('images/home/girl1.jpg')}}" class="girl img-responsive" alt="" />
                            <img src="{{asset('images/home/pricing.png')}}"  class="pricing" alt="" />
                        </div>
                    </div>
                    <div class="item">
                        <div class="col-sm-6">
                            <h1><span>E</span>-SHOPPER</h1>
                            <h2>100% Responsive Design</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                            <button type="button" class="btn btn-default get">Get it now</button>
                        </div>
                        <div class="col-sm-6">
                            <img src="{{asset('images/home/girl2.jpg')}}" class="girl img-responsive" alt="" />
                            <img src="{{asset('images/home/pricing.png')}}"  class="pricing" alt="" />
                        </div>
                    </div>

                    <div class="item">
                        <div class="col-sm-6">
                            <h1><span>E</span>-SHOPPER</h1>
                            <h2>Free Ecommerce Template</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                            <button type="button" class="btn btn-default get">Get it now</button>
                        </div>
                        <div class="col-sm-6">
                            <img src="{{asset('images/home/girl3.jpg')}}" class="girl img-responsive" alt="" />
                            <img src="{{asset('images/home/pricing.png')}}" class="pricing" alt="" />
                        </div>
                    </div>

                </div>

                <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                    <i class="fa fa-angle-left"></i>
                </a>
                <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                    <i class="fa fa-angle-right"></i>
                </a>
            </div>

        </div>
    </div>
</div>
</section><!--/slider--> --}}

<section>
<div class="container">
    <div class="row">
        <div class="col-sm-3">
            <div class="left-sidebar">
                <h2>Kota</h2>
                <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                    @foreach ($kotas as $kota)
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title"><a href="{{route('filterHotel',['id'=>$kota->id_kota])}}">{{$kota->nama_kota}}</a></h4>
                            </div>
                        </div>
                    @endforeach
                </div><!--/category-products-->
                @if (isset($daerahs))
                    <h2>Daerah</h2>
                    <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                        @foreach ($daerahs as $daerah)
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a href="{{route('filterDaerah',['id'=>$daerah->id_daerah])}}">{{$daerah->nama_daerah}}</a></h4>
                                </div>
                            </div>
                        @endforeach
                    </div><!--/category-products-->
                @endif

                <div class="brands_products"><!--brands_products-->
                    <h2>Mengandung Fasilitas</h2>
                    <div class="brands-name">
                        <ul class="nav nav-pills nav-stacked">
                            <form action="/filterFasilitas" method="post">
                                @csrf
                                @foreach ($fasilitass as $fasilitas)
                                    <li><input type="checkbox" name="{{$fasilitas->id_fasilitas}}" value="{{$fasilitas->id_fasilitas}}" id="">  {{$fasilitas->nama_fasilitas}}</li>
                                @endforeach

                        </ul>
                    </div>
                    <h2>Review</h2>
                    <div class="brands-name">
                        <ul class="nav nav-pills nav-stacked">
                                @csrf
                                Rating Start: <input type="text" name="" id="">
                                Rating End: <input type="text" name="" id="">
                                <center> <input type="submit" value="filters"> <center>
                            </form>

                        </ul>
                    </div>
                </div><!--/brands_products-->

            </div>
        </div>

        <div class="col-sm-9 padding-right">
            <div class="features_items"><!--features_items-->
                <h2 class="title text-center">All Hotels</h2>

                @foreach ($hotels as $hotel)
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="{{Storage::disk('local')->url('hotel_images/'.$hotel->gambar_hotel)}}" alt="" />
                                        <h2>{{$hotel->nama_hotel}}</h2>
                                        {{-- <a href="{{route('kamar',['id'=>$hotel->id_hotel])}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Lihat Ketersediaannya</a> --}}
                                        <div>
                                            @for ($i=0; $i<$hotel->bintang; $i+=1)
                                                <img style="width:30px;height:30px" src="{{asset('images/home/bintang.jpg')}}" alt="">
                                            @endfor
                                        </div>
                                        <p>{{$hotel->detail_hotel}}</p>
                                    </div>
                            </div>
                            <div class="choose">
                                <ul class="nav nav-pills nav-justified">
                                    @if (in_array($hotel->id_hotel,$favs,true))
                                        <li><a href="{{route('removeFav',['id'=>$hotel->id_hotel])}}"><i class="fa fa-plus-square"></i>Remove dari Favorit</a></li>
                                    @else
                                        <li><a href="{{route('tambahFav',['id'=>$hotel->id_hotel])}}"><i class="fa fa-plus-square"></i>Tambah ke Favorit</a></li>
                                    @endif

                                    <li><a href="{{route('kamar',['id'=>$hotel->id_hotel])}}"><i class="fa fa-plus-square"></i>Lihat Detail</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div><!--features_items-->

        </div>
    </div>
</div>
</section>
@endsection


