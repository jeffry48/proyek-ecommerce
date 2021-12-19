
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

        @if (session()->get('loggedIn')->id_customer)
            <div class="row">
                <div class="col-sm-12"></div>
            </div>
        @endif

    </div>
</div>
</section>
@endsection


