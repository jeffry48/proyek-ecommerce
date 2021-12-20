
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

<section>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h2 class="title text-center">E-SHOPPER</h2>
        </div>
        <div class="row">
            <div class="col-sm-8">
                <img style="width:100%;height:50%" src="{{asset('images/banner.jpg')}}" alt="">
            </div>
            <div class="col-sm-4">
                <h4 style="color:orange" class="title text-center">Masalah terhadap pembookingan hotel?</h4>
                <p style="color:orange">E Shopper akan membantumu untuk melakukan pembookingan hotel, kalian hanya memilih hotel, memilih kamar yang dimau, dan melakukan pembayaran dan nanti semuanya langsung diproses oleh kami</p>
            </div>
        </div>
        <br><br>

        @if (session()->get('loggedIn'))
            <div class="row">
                <div class="col-sm-12">
                    <div class="recommended_items"><!--recommended_items-->
                        <h2 class="title text-center">Favourite Hotel</h2>

                        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="item active">
                                    @if ($favs->count()>3)
                                        @for ($i=0;$i<3;$i++)
                                            <div class="col-sm-4">
                                                <div class="product-image-wrapper">
                                                    <div class="single-products">
                                                        <div class="productinfo text-center">
                                                            <img src="{{Storage::disk('local')->url('hotel_images/'.$favs[$i]->gambar_hotel)}}" alt="" />
                                                            <h2>{{$favs[$i]->nama_hotel}}</h2>
                                                            <div>
                                                                @for ($i=0; $i<$favs[$i]->bintang; $i+=1)
                                                                    <img style="width:30px;height:30px" src="{{asset('images/home/bintang.jpg')}}" alt="">
                                                                @endfor
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endfor
                                    @else
                                        @foreach ($favs as $fav)
                                        <div class="col-sm-4">
                                            <div class="product-image-wrapper">
                                                <div class="single-products">
                                                    <div class="productinfo text-center">
                                                        <img src="{{Storage::disk('local')->url('hotel_images/'.$fav->gambar_hotel)}}" alt="" />
                                                            <h2>{{$fav->nama_hotel}}</h2>
                                                            <div>
                                                                @for ($i=0; $i<$fav->bintang; $i+=1)
                                                                    <img style="width:30px;height:30px" src="{{asset('images/home/bintang.jpg')}}" alt="">
                                                                @endfor
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach

                                    @endif

                                </div>
                                @if ($favs->count()>3)
                                    <div class="item">
                                        @for ($i=3;$i<$favs->count();$i++)
                                            <div class="col-sm-4">
                                                <div class="product-image-wrapper">
                                                    <div class="single-products">
                                                        <div class="productinfo text-center">
                                                            <img src="{{Storage::disk('local')->url('hotel_images/'.$favs[$i]->gambar_hotel)}}" alt="" />
                                                            <h2>{{$favs[$i]->nama_hotel}}</h2>
                                                            <div>
                                                                @for ($i=0; $i<$favs[$i]->bintang; $i+=1)
                                                                    <img style="width:30px;height:30px" src="{{asset('images/home/bintang.jpg')}}" alt="">
                                                                @endfor
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endfor

                                    </div>
                                @endif
                            </div>
                             <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                              </a>
                              <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                                <i class="fa fa-angle-right"></i>
                              </a>
                        </div>
                </div>
            </div>
        @endif

    </div>
</div>
</section>
@endsection


