<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script type = "text/javascript" src = "https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="{{ URL::asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <link rel="stylesheet" href="{{ URL::asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('adminlte/dist/css/adminlte.min.css') }}">
    <title>Document</title>
</head>
<body class="hold-transition sidebar-collapse">
    <section class="content">
        <header class="main-header">
            <nav class="navbar navbar-expand navbar-white navbar-light">
                <div class="container-fluid">
                <span class="logo-lg"><b>ADMIN HOTEL</b></span>
                <ul class="navbar-nav">
                    <li class="nav-item d-none d-sm-inline-block"><a class="nav-link" href="/userhotel/logout">Log Out</a></li>
                </ul>
                </div>
            </nav>
        </header>
        <form action="/userhotel/sethotel" method="post">
            @csrf
            <div class="content-wrapper" style=" padding-bottom: 20px">
                <center><h3>PILIH HOTEL</h3></center>
                <input type="hidden" name="" value="{{$jumKolom = 0}}">
                <center>
                @foreach ($hotel as $item)
                    @if ($jumKolom == 0)
                        <center><div class="card-group">
                    @endif
                        <div class="card col-3" style="margin: 5px">
                            <div class="card-header">
                                <center><input type="radio" name="id_hotel" value="{{$item->id_hotel}}" id=""></center>
                              </div>
                            <img class="card-img-top" src="" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title"><center>
                                    {{$item->nama_hotel}}
                                    @for ($i=0; $i<$item->bintang; $i+=1)
                                        <img style="width:30px;height:30px" src="{{asset('images/home/bintang.jpg')}}" alt="">
                                    @endfor
                                </center></h5>
                                <p class="card-text">{{$item->alamat_hotel, $item->daerahHotel->nama_daerah, $item->kotaHotel->nama_kota}}</p>
                            </div>
                        </div>
                        <input type="hidden" name="" value="{{$jumKolom++}}">
                    @if ($jumKolom == 3)
                        </div></center>
                    @endif
                @endforeach</center>
                <center><button class="btn btn-secondary" style="width: 30%; margin-top: 20px" type="submit">HOME</button></center>
            </form>
                <script>
                    $(document).ready(function () {
                        var msg = '{{Session::get('alert')}}';
                        var exist = '{{Session::has('alert')}}';
                        if(exist){
                            alert(msg);
                        }
                    });
                </script>
            </div>
    </section>
</body>
</html>

