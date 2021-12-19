
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
        <div class="col-sm-3">
            <div class="left-sidebar">
                <h2>{{$hotel->nama_hotel}}</h2>
                <center>
                    <img style="width:150px;height:150px" src="{{Storage::disk('local')->url('hotel_images/'.$hotel->gambar_hotel)}}" alt="" />
                    <div>
                        @for ($i=0; $i<$hotel->bintang; $i+=1)
                            <img style="width:30px;height:30px" src="{{asset('images/home/bintang.jpg')}}" alt="">
                        @endfor
                    </div>
                    <table>
                        <tr>
                            <td>Alamat Hotel:</td>
                            <td>{{$hotel->alamat_hotel}}</td>
                        </tr>
                        <tr>
                            <td>Daerah Hotel:</td>
                            <td>{{$hotel->nama_daerah}}</td>
                        </tr>
                        <tr>
                            <td>Kota Hotel:</td>
                            <td>{{$hotel->nama_kota}}</td>
                        </tr>
                        <tr>
                            <td>Rating:</td>
                            <td>{{$rating}}/5</td>
                        </tr>
                        @for ($i = 0; $i < $fasilitass->count(); $i++)
                        <tr>
                            @if ($i==0)
                                <td>Fasilitas:</td>
                            @else
                                <td></td>
                            @endif
                            <td> - {{$fasilitass[$i]->nama_fasilitas}}</td>
                        </tr>
                        @endfor
                    </table>

                </center>
            </div>
        </div>

        <div class="col-sm-9 padding-right">
            <div class="features_items"><!--features_items-->
                <h2 class="title text-center">Jenis Kamar yang Tersedia</h2>

                @foreach ($kamars as $kamar)
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="{{Storage::disk('local')->url('kamar_images/'.$kamar->gambar_kamar)}}" alt="" />
                                        <h2>{{$kamar->nama_kamar}}</h2>
                                        <p>{{$kamar->detail_kamar}}</p>
                                        <p>Rp. {{$kamar->harga_kamar}},00</p>
                                        <a href="{{route('AddToCartKamar',['id'=>$kamar->id_kategori])}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                    </div>
                                    <div class="product-overlay">
                                        <div class="overlay-content">
                                            <form action="{{route('AddToCartKamar',['id'=>$kamar->id_kategori])}}" method="get">
                                                <h4>Tanggal Checkin:</h4>
                                                <input type="date" name="tgl_checkin" id="" required><br>
                                                <h4>Tanggal Checkout:</h4>
                                                <input type="date" name="tgl_checkout" id="" required><br>
                                                <h4>Jumlah:</h4>
                                                <input type="number" name="jumlah" id="" required><br><br>
                                                <input type="submit" value="Add To Cart">
                                            </form>
                                            {{-- <a href="{{route('AddToCartKamar',['id'=>$kamar->id_kategori])}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a> --}}
                                        </div>
                                    </div>
                            </div>
                            <div class="choose">
                                <ul class="nav nav-pills nav-justified">
                                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div><!--features_items-->



            <div class="recommended_items"><!--recommended_items-->
                <h2 class="title text-center">Hotel Reviews</h2>

                <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="item active">
                            @for ($i=0;$i<3;$i++)
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <h4>{{$reviews[$i]->nama_customer}}</h4>
                                                <div>
                                                @for ($j=0; $j<$reviews[$i]->rating; $j+=1)
                                                    <img style="width:30px;height:30px" src="{{asset('images/home/bintang.jpg')}}" alt="">
                                                @endfor
                                                </div>
                                                <p>{{$reviews[$i]->detail_review}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                        @if ($reviews->count()>3)
                            <div class="item">
                                @for ($i=3;$i<$reviews->count();$i++)
                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <h4>{{$reviews[$i]->nama_customer}}</h4>
                                                    <div>
                                                    @for ($j=0; $j<$reviews[$i]->rating; $j+=1)
                                                        <img style="width:30px;height:30px" src="{{asset('images/home/bintang.jpg')}}" alt="">
                                                    @endfor
                                                    </div>
                                                    <p>{{$reviews[$i]->detail_review}}</p>
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

            </div><!--/recommended_items-->
            @if (session()->get('loggedIn'))
                <div class="recommended_items">
                    <h2 class="title text-center">Penilaian Hotel</h2>
                    <form action="/addReview" method="post">
                        @csrf
                        Rating Hotel: <br>
                        <i class="fa fa-star fa-2x" data-index="0"></i>
                        <i class="fa fa-star fa-2x" data-index="1"></i>
                        <i class="fa fa-star fa-2x" data-index="2"></i>
                        <i class="fa fa-star fa-2x" data-index="3"></i>
                        <i class="fa fa-star fa-2x" data-index="4"></i>
                        <input type="hidden" name="rating">
                        <br>
                        Comment: <br>
                        <textarea name="detail" id="" cols="30" rows="5"></textarea>
                        <br><br>
                        <input type="submit" value="Add Review">
                    </form>
                    <br>
                </div>
            @endif
        </div>
    </div>
</div>
</section>
@endsection


