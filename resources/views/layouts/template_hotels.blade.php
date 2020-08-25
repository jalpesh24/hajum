<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>@include('includes.tours.head')
</head>
<body style="background-image: url('public/img/tour_background.jpg'); background-repeat: no-repeat; background-attachment: fixed; background-position: center;  background-size:100% 100% ">
@include('includes.tours.header')
<div style="clear:both"></div>
@yield('content')
<div style="clear:both"></div>
@include('includes.tours.footer')
@include('includes.tours.footer_js')
</body>
</html>
