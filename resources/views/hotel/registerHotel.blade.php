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
    <div class="content-wrapper">
        <form action="/userhotel/prosesregister" method="post">
        @csrf
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-between">
                    <div class="col">
                        <center><h1>REGISTER PEMILIK HOTEL</h1></center>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                    <center>
                        <div class="card" style="width: 80%">
                            <div class="card-body">
                                <div class="col" style="margin-top: 10px">
                                    Username
                                    <br><input type="text" class="form-control" name="username" placeholder="Masukkan username" id="namaHotel"><br>
                                    Password
                                    <br><input type="text" class="form-control" name="password" placeholder="Masukkan password" id="namaHotel"><br>
                                    Nama Pemilik
                                    <br><input type="text" class="form-control" name="nama" placeholder="Masukkan nama" id="namaHotel"><br>
                                    Nomor Telepon
                                    <br><input type="text" class="form-control" name="noTelp" placeholder="Masukkan nomor telepon" id="namaHotel"><br>
                                    <button class="btn btn-secondary" style="width: 60%" type="submit">Register</button>
                                </div>
                            </div>
                        </div>
                    </center>
                    </div>
                </div>
            </div>
        </section>
        </form>
    </div>
</body>
<script>
    $(document).ready(function () {
        var msg = '{{Session::get('alert')}}';
        var exist = '{{Session::has('alert')}}';
        if(exist){
            alert(msg);
        }
    });
</script>
</html>
