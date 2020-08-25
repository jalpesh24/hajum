@extends('layouts.template_hotels')
@section('title','Hotel Detail')
@section('keywords', 'Trip India')
@section('description', 'Trip India')
@section('page_css')

@endsection
@section('content')
<div class="container">
 @foreach($hotel_detail as $data)
 <div class="col-md-12" style="margin:50px 0">
    <div class="package">{!! $data->hotel_name !!}</div>
  </div>
    <div class="right-bar grid-view">
      <div class="grid-left">
        <div class="top">
          <h2>{!! $data->hotel_name !!}</h2>
        </div>
        <div>
          <h5>{!! $data->hotel_address !!}, {!! $data->city_location !!}, {!! $data->hotel_pincode !!}</h5>
        </div>
        <div class="grid-img"> <img src="{{ asset('hotel_images/'.$data->hotel_image) }}" alt="{!! $data->hotel_name !!}" title="{!! $data->hotel_name !!}" class="img-responsive" alt="" width="100%"/>
          <div class="details">
            <div class="company-name">{!! $data->hotel_name !!}</div>
            <div class="location">{!! $data->city_location !!}</div>
            <div class="rating"> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> </div>
          </div>
        </div>
      </div>
      <div class="grid-right">
        <h5> <span class="itemPrice">Rs. {!! $hotel_rooms[0]->hotel_saleprice !!}</span>
          <p>per person</p>
        </h5>
        <div style="float:right;"><span>From {!! $data->fromdate !!} To {!! $data->todate !!}</span><br>
          <br>
        </div>
        <div style="margin-top:25px;float:right;">
          <div><i class="hs hs-CHKIN icon-box"></i>Checkin &nbsp;&nbsp;Time  : {!! $data->checkin_time !!}</div>
          <div>Checkout Time : {!! $data->checkout_time !!}</div>
        </div>
      </div>
      <div style="clear:both;"></div>
      <div class="col-md-12">
      @if($data->hotel_amenities != "")
        <h4 class="inclusions">Amenities</h4>
        <ul class="option">
        @foreach(explode(',', $data->hotel_amenities) as $info) 
              @if($info == "wifi")
               <li><img src="{{ url('public/img/wifi.png') }}" class="sign">
                  <p>Wifi</p>
                </li>
              @endif  
              @if($info == "parking") 
                <li><img src="{{ url('public/img/parking.png') }}" class="sign">
                 <p>Parking</p>
                </li> 
              @endif
               @if($info == "roomservice") 
                <li><img src="{{ url('public/img/roomservice.png') }}" class="sign">
                 <p>Roomservice</p>
                </li> 
              @endif
               @if($info == "Gym") 
                <li><img src="{{ url('public/img/gym.png') }}" class="sign">
                 <p>Gym</p>
                </li> 
              @endif
              
              @if($info == "telephone") 
                <li><img src="{{ url('public/img/telephone.png') }}" class="sign">
                 <p>Telephone</p>
                </li> 
              @endif
              @if($info == "restaurant") 
                <li><img src="{{ url('public/img/resturant.png') }}" class="sign">
                 <p>Resturant</p>
                </li> 
              @endif
              @if($info == "newspaper") 
                <li><img src="{{ url('public/img/newspaper.png') }}" class="sign">
                 <p>Newspaper</p>
                </li> 
              @endif
              @if($info == "refrigerator") 
                <li><img src="{{ url('public/img/refregirator.png') }}" class="sign">
                 <p>Refrigerator</p>
                </li> 
              @endif
              @if($info == "safe") 
                <li><img src="{{ url('public/img/safe.png') }}" class="sign">
                 <p>Safe</p>
                </li> 
              @endif
            @endforeach
             
         <!--  <li><img src="{{ url('/img/transfer-icon.png') }}" class="sign">
            <p>Transfer</p>
          </li>
          <li><img src="{{ url('/img/meals-icon.png') }}">
            <p>Meals</p>
          </li>
          <li><img src="{{ url('/img/sight-icon.png') }}" class="sign">
            <p>Sightseeing</p>
          </li> -->
        </ul><div style="clear:both;">
        <hr>
      @endif  
      </div>
      </div>
      
      <div class="col-md-12"><h4 class="inclusions">Highlights / Overview</h4>
        <p align="justify">{!! $data->hotel_highlights !!}</p>
        <p>&nbsp&nbsp</p>
         <p align="justify">{!! $data->hotel_nearestplace !!}</p>
      <div style="clear:both;">
        <hr>
      </div></div>
      
      @foreach($hotel_rooms as $roomdata)
      <div class="col-md-12">
        <div class="col-md-3" style="padding-left:0px;"> <img src="{{ asset('hotel_room_images/'.$roomdata->hotel_image) }}" class="img-responsive" alt="" style="height:150px;" width="100%"/> </div>
        <div class="col-md-4 col-sm-6 col-xs-6">
          <div>
          <strong>Room Type :</strong>
          {!! ucfirst($roomdata->hotel_roomtype) !!}
        </div>
          
          <div>
          <strong>Max Child </strong>: {!! $roomdata->hotel_max_child !!}
          <p> <strong>Max Adult</strong> : {!! $roomdata->hotel_max_adult !!}</p>
          <p> <strong>Amenities</strong> : <?php echo ucfirst($roomdata->hotel_amenities)?></p>
          </div>
          
        </div>
                
        <div class="col-md-4 col-sm-12 col-xs-12">
         Price Rs. <strike>{!! $roomdata->hotel_price !!}</strike>
          <p class="p50"> Sale Rs. {!! $roomdata->hotel_saleprice !!}</p>
       
        
        <?php if(isset($_GET['adults']) && $_GET['adults'] > 0) { $url = '?adults='.$_GET['adults']; }
	   	else { $url = '?adults=1'; }
	   if(isset($_GET['childs']) && $_GET['childs']>0) { $url .= '&childs='.$_GET['childs']; } 
	   else { $url .= '&childs=0'; } ?>
       
          <a href="{{ url('/hotel-checkout'.$url) }}" class="checkout" hid="{!! $data->hotel_id !!}"  hrid="{!! $roomdata->hotel_room_id !!}" data-token="{{ csrf_token() }}">
          <button class="btn btn-lg btn-detail">Book Now</button>
          </a> </div>
          
      <div style="clear:both; margin-top:15px;">&nbsp;
       
      </div></div>
      
      <!--<div class="col-md-12"><strong>Cancellation Fees </strong>
        <p align="justify">{!! $data->hotel_cancellationfees  !!}</p>
      </div>-->
      
      @endforeach
      <!--<div class="col-md-6"><strong>Payment Policy</strong>
        <p align="justify">{!! $data->hotel_paymentpolicy !!}</p>
      </div>-->
      <div class="col-md-6"><h4 class="inclusions">Cancellation Policy</h4>
        <p align="justify">{!! $data->hotel_cancellationpolicy !!}</p>
      </div>
      
      <div class="col-md-12"><h4 class="inclusions">Term &amp; Conditions</h4>
        <p align="justify">{!! $data->hotel_terms_conditions !!}</p>
      </div>
    </div>
  
   
  @endforeach 
</div>
@endsection
@section('page_js')
<script type="text/javascript">
$(document).ready(function() 
{
	$(".checkout").click(function()
	{
		var token = $(this).attr("data-token");
		var hotel_id = $(this).attr("hid");
		var hotel_roomid = $(this).attr("hrid");
		$.ajax(
		{
			url:"{{ url('/checkouthotelorder') }}",
			method : 'POST',
			async: false,
			dataType: "json",
			data: { "_token":token,"hotel_id":hotel_id,"hotel_roomid":hotel_roomid},
			success: function(data) {
			}
		});
		return true;
	});
});
</script>
@endsection