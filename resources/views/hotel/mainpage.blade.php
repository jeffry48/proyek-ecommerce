<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script type = "text/javascript" src = "https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/styles.css') }}">
    <title>Document</title>
</head>
<body>

    @include('hotel.include.header')
    @yield('content')
    @include('hotel.include.footer')
</body>
</html>
