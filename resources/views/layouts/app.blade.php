<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header"><a class="navbar-brand navbar-link" href="#">Coupon!! </a>
            <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
        </div>
        <div class="collapse navbar-collapse" id="navcol-1">
            @if(auth()->check())
                <ul class="nav navbar-nav">
                    @if(auth()->user()->check_user =='1')
                        <li role="presentation"><a href="/make">쿠폰 생성</a></li>
                        <li role="presentation"><a href="{{ route('list.cView') }}">쿠폰 관리</a></li>
                    @endif
                    <li role="presentation"><a href="/logout">Logout</a></li>
                </ul>
            @endif



        </div>
    </div>
</nav>
{{--<ol class="breadcrumb">--}}
    {{--<li><a href="#"><span>Store </span></a></li>--}}
    {{--<li><a href="#"><span>Men</span></a></li>--}}
    {{--<li class="active"><span>Suits </span></li>--}}
{{--</ol>--}}

<div class="__content">
    @include('flash::message')
    @yield('content')
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>