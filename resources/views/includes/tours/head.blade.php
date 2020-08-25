<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="content-type" content="text/html;charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title')</title>
<meta name="keywords" content="@yield('keywords')">
<meta name="description" content="@yield('description')">
<meta name="author" content="">
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Bootstrap Core CSS -->
<link href="{{ url('public/css/bootstrap.css') }}" rel="stylesheet">
<!-- Custom CSS -->
<link href="{{ url('public/css/tripindia.css') }}" rel="stylesheet">
<!-- Custom Fonts -->
<link href="{{ url('public/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

@yield('page_css')