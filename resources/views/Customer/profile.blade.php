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
                                <li><a href="#">My History</a></li>
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
            <h3>Profile <a href="/editProfile"><img style="width:10px;height:10px" src="{{asset('images/edit.png')}}" alt=""></a></h3>
            <table>
                <tr>
                    <td>Username:</td>
                    <td>{{session()->get('loggedIn')->username_customer}}</td>
                </tr>
                <tr>
                    <td>Nama Customer:</td>
                    <td>{{session()->get('loggedIn')->nama_customer}}</td>
                </tr>
                <tr>
                    <td>No Telp Customer:</td>
                    <td>{{session()->get('loggedIn')->no_telp_customer}}</td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td>{{session()->get('loggedIn')->email_customer}}</td>
                </tr>
            </table>
        </div>
    </center>
</section>

<br><br><br><br>




@endsection
