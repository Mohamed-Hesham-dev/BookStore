<html>
<head>
    <title>library</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
    <style type="text/css">
        body{
            background: url("{{asset('image/bodybg.jpg')}}") no-repeat center center fixed;
            background-size: 100% auto;
        }
        header{opacity: 0.7;}
        footer{background-color: #fff;opacity: 0.9; text-align: center}
    </style>
</head>
<body>
<header class="jumbotron">
    <a href="{{route('library.index')}}" style="color: black;float: right;padding-right: 100px">Home</a>
    <br>
    @if(Auth::check())
    <a href="{{route('admin')}}" style="color: black;float: right;padding-right: 100px">{{Auth::user()->name}}'s area</a>
    <br>

    <a href="{{route('summary')}}" style="color: black;float: right;padding-right: 100px">Summary List</a>
    <br>
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"style="color: black;float: right;padding-right: 100px"> Logout </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
        <br>
    @else
        <a href="{{route('login')}}" style="color: black;float: right;padding-right: 100px">LogIn</a>
        <br>
        <a href="{{route('register')}}" style="color: black;float: right;padding-right: 100px">Register</a>
        <br>
    @endif
    <div class="c" style="float: left;">
        <h3 style="color: black">The BookStore!!</h3>
        <p style="color: black">Reading a good book from my site ^^</p>
    </div>

</header>

@if(Session::has('m'))
    <div class="container">
        <?php $a=[]; $a=session()->pull('m'); ?>
        <div class="alert alert-{{$a[0]}}">
            {{$a[1]}}
        </div>
    </div>

@endif


@yield('content');


<footer class="container" style="clear: both;width: 100%">
    &copy;All Right Reserved For Hasan -2017


</footer>

</body>
</html>