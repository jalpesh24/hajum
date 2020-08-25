<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
	@include('includes.head')
</head>
<body style="background-image: url('public/img/background.jpg'); background-repeat: no-repeat; background-attachment: fixed; background-position: center;  background-size:100% 100% ">
	@include('includes.header')
      
      @yield('content')
	
      <div style="clear:both"></div>
      @include('includes.footer')      
      @include('includes.footer_js')
</body>
</html>