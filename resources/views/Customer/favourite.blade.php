@extends('layouts.index');
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
                        <li class="dropdown"><a href="#">Account<i class="fa fa-angle-down"></i></a>
                            <ul role="menu" class="sub-menu">
                                <li><a href="/profile">My Profile</a></li>
                                <li><a href="/favourite">My Favourite</a></li>
                                <li><a href="/history">My History</a></li>
                            </ul>
                        </li>

                        <li><a href="contact-us.html">Contact</a></li>
                    </ul>
                </div>
            </div>
            {{-- <div class="col-sm-3">
                <div class="search_box pull-right">
                    <input type="text" placeholder="Search"/>
                </div>
            </div> --}}
        </div>
    </div>
</div><!--/header-bottom-->
</header><!--/header-->

<section>
    <center>
        <div class="container">
            <h3>List Favourite Hotel</h3>
            <table style="border:1px solid black" class="table table-sm table-bordered">
                <thead class="table-light">
                    <th style="border:1px solid black">Nama Hotel</th>
                    <th style="border:1px solid black">Alamat Hotel</th>
                    <th style="border:1px solid black">Bintang</th>
                    <th></th>
                </thead>
                @foreach ($favs as $fav)
                    <tr>
                        <td style="border:1px solid black">{{$fav->nama_hotel}}</td>
                        <td style="border:1px solid black">{{$fav->alamat_hotel}} {{$fav->nama_daerah}}, {{$fav->nama_kota}}</td>
                        <td style="border:1px solid black">{{$fav->bintang}}</td>
                        <td style="border:1px solid black"> <a href="{{route('removeFav',['id'=>$fav->id_hotel])}}"><img style="width:25px;height:25px" src="{{asset('images/remove.png')}}" alt=""></a></td>
                    </tr>
                @endforeach
            </table>
        </div>
    </center>
</section>

<br><br><br><br>




@endsection
