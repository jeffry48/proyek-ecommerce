@include('layouts.header')

@yield('center')

<script>
    $(document).ready(function () {
        var msg = '{{Session::get('alert')}}';
        var exist = '{{Session::has('alert')}}';
        if(exist){
            alert(msg);
        }
    });
</script>
@include('layouts.footer')
