@extends('layouts.template')
@section('title','Hotel Booking')
@section('content')
<style> 
.product-name, .total , .price { color:#999999 !important;}
label{ color:#999999;}
</style>
<form action="{!! url('/payumoney.php') !!}" method="post" name="frm_checkout" id="frm_checkout">
{{ csrf_field() }}
<div class="container">
  <div class="row">
  	
    <div class="col-xs-12">
      
    <a href="#"><img src="{{ url('public/img/hotel-booking.png') }}" /></a>
    </div>
  </div>
</div>
</form>
@endsection
