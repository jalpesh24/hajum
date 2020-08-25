<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>@include('includes.head')
</head>
<body style="background-image: url('/img/background.jpg'); background-repeat: no-repeat; background-attachment: fixed; background-position: center;  background-size:100% 100% ">
@include('includes.header')
<header class="intro-header">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="logo"><a href="{{ url('/') }}"><img src="{{ url('/img/logo.png') }}" alt="logo"></a></div>
        <nav class="navbar col-md-offset-2">
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="padding-top:30px;" >
            <ul class="nav navbar-nav">
              <li><a href="{{ url('/about-us') }}">ABOUT US </a></li>
              <li><a href="{{ url('/offers') }}">OFFERS</a></li>
              <li><a href="{{ url('/testimonial') }}">TESTIMONIALS</a></li>
              <li><a href="{{ url('/tickets') }}">SUPPORT</a></li>
              <li><a href="{{ url('/login') }}">TRAVEL AGENTS</a></li>
              <li><a href="{{ url('/newhome') }}">New Home Page</a></li>
            </ul>
          </div>
        </nav>
      </div>
    </div>
  </div>
</header>
<div style="clear:both;"></div>
@yield('content')
<div style="clear:both"></div>
@include('includes.footer')      
@include('includes.footer_js')
</body>
</html>