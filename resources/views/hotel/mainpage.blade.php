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
            @include('hotel.include.header')
            <div class="content-wrapper" style=" padding-bottom: 20px">
                @yield('content')
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
