@include('includes.newheader')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <script>
  $( function() {
    $( "#fromdate" ).datepicker();
	$( "#todate" ).datepicker();
  } );
  </script>
<style>
/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: -75px !important;
    width: 100%; /* Full width */
    height: auto; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
   margin-bottom: auto;
    margin-left: 59%;
    margin-right: auto;
    margin-top: 18%;
    padding-bottom: 20px;
    padding-left: 17px;
    padding-right: 20px;
    /*padding-top: 81px;*/
   width:25%;
	padding:15px;
}
#childage{color:#000;}

/* The Close Button */
.close {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}
#hotels #myroomselect .modal-content {
    margin-top: 15%;
}
.cart-box{
	  color: #2d67b2 !important;
    font-size: 18px;
    letter-spacing: 0;
margin-bottom: 10px;
border:1px solid;}
</style>
  <div class="container">
    <div class="row">
      <div class="breadcrumbs1 nw-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home" aria-hidden="true"></i> <a href="newhome.html">Home</a></li>
          <li class="breadcrumb-item active">Hotel Detail</li>
        </ol>
      </div>
    </div>

	@foreach($hotel_detail as $data)
    <div class="row">
      <div class="col-md-12">
        <h1 class="text-center text-uppercase mb-4">{!! $data->hotel_name !!}</h1>
      </div>
    </div>
	<?php $imgs = explode(',', $data->hotel_image); ?>
		
    <div class="row">
        <div class="col-md-8">
            <div class="slide-cont">
              <div id="nw-hotel" class="owl-carousel">
			  @foreach($imgs as $hotelimage)  
                <div><img src="{{ url('hotel_images/'.$hotelimage) }}"></div>
                 @endforeach                
              </div>
            </div>
        </div>
		<?php
$date1=date_create($_GET['fromdate']);
$date2=date_create($_GET['todate']);
$diff=date_diff($date1,$date2);
$days = $diff->format("%a");
?>
        <div class="col-md-4 payment-box">
		<?php $i=0; ?>
            @foreach($hotel_rooms as $roomdata)
		<?php $i++; ?>			
                <div style="background-color: #fff;" class="row services-hotels mt-5 mb-1">
                    <div class="row">
         
		 <div class="col-md-12">
		 <form action="">
					Price Rs. <strike>{!! $roomdata->hotel_price !!}</strike>per room per night
					<b class="p50">Sale Rs. {!! $roomdata->hotel_saleprice !!} </b>	
					</div>	
					<div class="col-md-12">
          <div class="col-md-6">
          <div class="inner-addon left-addon form-group input-group hotels-group"> 
            <i class="fa fa-calendar"></i> Checkin       
			<input type="text" id="fromdate" name="checkin" class="form-control datepicker" value="{!! $_GET['fromdate'] !!}">       
          </div></div>
		  <div class="col-md-6">
          <div class="inner-addon left-addon form-group input-group hotels-group"> <i class="fa fa-calendar"></i>Checkout
			<input type="text" id="todate" name="checkout" class="form-control datepicker" value="{!! $_GET['todate'] !!}">             
          </div>
          </div>
		  </div>
		  	 <div class="col-md-12">
		  <div class="inner-addon left-addon form-group input-group hotels-group-room"> <span class="input-group-addon">
            <button class="" type="button"><i class="fa fa-user"></i></button>
            </span>		
			<input type="hidden" name="totroom" id="totroom" class="form-control" value="{!! $_GET['room'] !!}" />
			<input type="hidden" name="totadult" id="totadult" class="form-control" value="{!! $_GET['adults'] !!}" />
			<input type="hidden" name="totchild" id="totchild" class="form-control" value="{!! $_GET['childs'] !!}" />
			
			<input type="text" name="rooms" id="rooms" class="form-control" value="{!! $_GET['room'] !!} Room/{!! $_GET['adults'] !!} Guests" />
			 </div>
          </div>
          
           <div class="col-md-12">
		  <div id="myroomselect" class="modal">
		<div class="modal-content">
		<span class="close" id="closerooms">&times;</span>
			<select name="room" id="room" class="form-control" onChange="getrooms(this.value);">			
			<option value="1" selected="selected" >1 Room</option>
			<option value="2" >2 Room</option>
			<option value="3" >3 Room</option>
			<option value="4" >4 Room</option>
			<option value="5" >5 Room</option>
			<option value="6" >6 Room</option>
			<option value="7" >7 Room</option>
			<option value="8" >8 Room</option>
			</select>
			<select name="adults" id="adults" class="form-control" onChange="getadults(this.value);">				
			<option value="1" >1 Adult</option>
			<option value="2" selected="selected" >2 Adult</option>
			<option value="3" >3 Adult</option>
			<option value="4" >4 Adult</option>
			<option value="5" >5 Adult</option>
			<option value="6" >6 Adult</option>
			<option value="7" >7 Adult</option>
			<option value="8" >8 Adult</option>
			<option value="9" >9 Adult</option>
			<option value="10" >10 Adult</option>
			<option value="11" >11 Adult</option>
			<option value="12" >12 Adult</option>
			<option value="13" >13 Adult</option>
			<option value="14" >14 Adult</option>
			<option value="15" >15 Adult</option>
			<option value="16" >16 Adult</option>
			<option value="17" >17 Adult</option>
			<option value="18" >18 Adult</option>
			<option value="19" >19 Adult</option>
			<option value="20" >20 Adult</option>
			</select>
			<select name="childrens" id="childrens" class="form-control" onChange="getchildages(this.value);">
			<option value="0" selected="selected">0 Children</option>
			<option value="1" >1 children</option>
			<option value="2" >2 children</option>
			<option value="3" >3 children</option>
			<option value="4" >4 children</option>
			<option value="5" >5 children</option>
			<option value="6" >6 children</option>
			<option value="7" >7 children</option>
			<option value="8" >8 children</option>
			<option value="9" >9 children</option>
			<option value="10" >10 children</option>
			</select>  	


<div id="childage" style="display:none;">
  	
  </div>			
	
  </div>
  
  </div></div>
        <b class="p50"> Rs. {!! ($days * $roomdata->hotel_saleprice) !!} For {!! $days !!} Nights</b>	
		<div class="col-md-12">
							<?php
								$adult = $roomdata->hotel_max_adult;
								$childs = $roomdata->hotel_max_child;
								?>
								<?php if(isset($_GET['adults']) && $_GET['adults'] > 0) { $url = '?adults='.$_GET['adults']; }
								else { $url ='?adults='.$adult; }
							   if(isset($_GET['childs']) && $_GET['childs']>0) { $url .= '&childs='.$_GET['childs']; } 
							   else { $url .= '&childs='.$childs; } 
							   if(isset($_GET['room']) && $_GET['room']>0) { $url .= '&room='.$_GET['room']; } 
							   else { $url .= '&room='.$room; } 
							   
							   if(isset($fromdate)) { $url .= '&fromdate='.$fromdate; } 
	   
							if(isset($todate)) { $url .= '&todate='.$todate; } ?>
								<?php if($user = Auth::user())
							{ ?>
								 <a href="{{ url('/newhotel-checkout'.$url) }}" class="checkout" hid="{!! $data->hotel_id !!}"  hrid="{!! $roomdata->hotel_room_id !!}" data-token="{{ csrf_token() }}">
								  <button class="btn btn-lg btn-detail" >Book Now</button>
								  </a> 
							<?php }else { ?>
								 <a href="{{ url('/hotel-checkout'.$url) }}" class="checkout" hid="{!! $data->hotel_id !!}"  hrid="{!! $roomdata->hotel_room_id !!}" data-token="{{ csrf_token() }}">
										  <button class="btn btn-lg btn-detail">Book Now</button>
										  </a>
								<?php } ?>
						
                    </div></form>
                </div></div>
				<?php if($i ==1) break; ?>
				
				@endforeach
        </div>
		<div class="col-md-4 cart-box" >
		
		<section class="yourSelectionCard" style="right: 20px;">
		<div class="fl width100">
		<div class="selectionHdr">
		<span class="white ico14 fmed txtCenter">Your Cart Selection</span></div>
		<div class="fl width100 blueBg padB5 ">
		<div class="selectionScroll pad10 fl width100">
		<p id="cartbox">Your Cart is empty</p>
		<p id="buy"></p>
		</div></div></div></section>
		</div>
    </div>

    <div class="row mt-2 hotels-tour-services">
        <div class="col-md-12">
            <div class="services-hotels mb-3">
                @if($data->hotel_amenities != "")
        <h4 class="inclusions">Amenities</h4>
        <ul class="option">
        @foreach(explode(',', $data->hotel_amenities) as $info) 
              @if($info == "wifi")
               <li><img src="{{ url('/img/wifi.png') }}" class="sign">
                  <p>Wifi</p>
                </li>
              @endif  
              @if($info == "parking") 
                <li><img src="{{ url('/img/parking.png') }}" class="sign">
                 <p>Parking</p>
                </li> 
              @endif
               @if($info == "roomservice") 
                <li><img src="{{ url('/img/roomservice.png') }}" class="sign">
                 <p>Roomservice</p>
                </li> 
              @endif
               @if($info == "Gym") 
                <li><img src="{{ url('/img/gym.png') }}" class="sign">
                 <p>Gym</p>
                </li> 
              @endif
              
              @if($info == "telephone") 
                <li><img src="{{ url('/img/telephone.png') }}" class="sign">
                 <p>Telephone</p>
                </li> 
              @endif
              @if($info == "restaurant") 
                <li><img src="{{ url('/img/resturant.png') }}" class="sign">
                 <p>Resturant</p>
                </li> 
              @endif
              @if($info == "newspaper") 
                <li><img src="{{ url('/img/newspaper.png') }}" class="sign">
                 <p>Newspaper</p>
                </li> 
              @endif
              @if($info == "refrigerator") 
                <li><img src="{{ url('/img/refregirator.png') }}" class="sign">
                 <p>Refrigerator</p>
                </li> 
              @endif
              @if($info == "safe") 
                <li><img src="{{ url('/img/safe.png') }}" class="sign">
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
                

                <!-- Start overview details -->
	  <h2 class="mt-4 mb-1">Highlights / Overview</h2>  
        <p align="justify">{!! $data->hotel_highlights !!}</p>      
         <p align="justify">{!! $data->hotel_nearestplace !!}</p>
		  <!-- end overview details -->
		  <!-- Start Cancellation details -->

		<h2 class="mt-4 mb-1">Cancellation Policy</h2>
        <p align="justify">{!! $data->hotel_cancellationpolicy !!}</p>
      
      <!-- end Cancellation details -->
		  <!-- Start Conditions details -->
      <h2 class="mt-4 mb-1">Term &amp; Conditions</h2>
        <p align="justify">{!! $data->hotel_terms_conditions !!}</p>
		 <!-- end Conditions details -->

                
                
 <!-- Start Room  details --><?php $i=1; ?>
		 <div id="services">
		 @foreach($hotel_rooms as $roomdata)     
                <div style="background-color: #fff;" class="row services-hotels mt-5 mb-1">
                    <div class="row">
					<div class="col-md-6">
                            <div id="nw-hotel<?php echo $i; ?>" class="owl-carousel">
                             <?php $roomimgs = explode(',', $roomdata->hotel_image); ?>
					 @foreach($roomimgs as $roomimg)  
						<div><img class="img-responsive center-block" src="{{ url('hotel_room_images/'.$roomimg) }}"></div>
					@endforeach
                            </div>
                        </div>
					
                         <div class="col-md-3">
                            <p><b>Room Type: </b>{!! ucfirst($roomdata->hotel_roomtype) !!}</p>
                            <strong>Max Child </strong>: {!! $roomdata->hotel_max_child !!}
							<p> <strong>Max Adult</strong> : {!! $roomdata->hotel_max_adult !!}<br/>
							<strong>Extra Adult </strong> Rs.: {!! $roomdata->hotel_extra_adult !!}<br/>
							<strong>Extra Child </strong> Rs.: {!! $roomdata->hotel_extra_child !!}<br/>
							<strong>Extra Room </strong> Rs.: {!! $roomdata->hotel_extra_room !!}<br/>
							<strong>Children Age </strong>: {!! $roomdata->child_age !!}</p>
							<p> <strong>Amenities</strong> : <?php echo ucfirst($roomdata->hotel_amenities)?></p>
                        </div>
                          <div class="col-md-3">
							Price Rs. <strike>{!! $roomdata->hotel_price !!}</strike>
							<p class="p50"> Sale Rs. {!! $roomdata->hotel_saleprice !!}</p>
							<?php
								$adult = $roomdata->hotel_max_adult;
								$childs = $roomdata->hotel_max_child;
								?>
								<?php if(isset($_GET['adults']) && $_GET['adults'] > 0) { $url = '?adults='.$_GET['adults']; }
								else { $url ='?adults='.$adult; }
							   if(isset($_GET['childs']) && $_GET['childs']>0) { $url .= '&childs='.$_GET['childs']; } 
							   else { $url .= '&childs='.$childs; } 
							   if(isset($_GET['room']) && $_GET['room']>0) { $url .= '&room='.$_GET['room']; } 
							   else { $url .= '&room='.$room; } 
							   
							   if(isset($fromdate)) { $url .= '&fromdate='.$fromdate; } 
	   
							if(isset($todate)) { $url .= '&todate='.$todate; } ?>
								<?php if($user = Auth::user())
							{ ?>
								 <a href="{{ url('/newhotel-checkout'.$url) }}" style="display:none;" class="checkout" hid="{!! $data->hotel_id !!}"  hrid="{!! $roomdata->hotel_room_id !!}" data-token="{{ csrf_token() }}">
								  <button class="btn btn-lg btn-detail">Book Now</button>
								  </a> 
							<?php }else { ?>
								 <a href="{{ url('/hotel-checkout'.$url) }}" style="display:none;" class="checkout" hid="{!! $data->hotel_id !!}"  hrid="{!! $roomdata->hotel_room_id !!}" data-token="{{ csrf_token() }}">
										  <button class="btn btn-lg btn-detail">Book Now</button>
										  </a>
								<?php } ?>
								<button onclick="myFunction('{!! $roomdata->hotel_roomtype !!}','{!! $roomdata->hotel_saleprice !!}','{!! $_GET['adults'] !!}','{!! $_GET['childs'] !!}','{!! $_GET['room'] !!}','{!! $days !!}','{!! $_GET['fromdate'] !!}','{!! $_GET['todate'] !!}','{!! $data->hotel_id !!}','{!! $roomdata->hotel_room_id !!}','{{ csrf_token() }}')">Select Room</button>
						</div>
                    </div>
                </div>
				<?php $i++; ?>
				@endforeach
            </div>
        </div>
		 </div>
    </div>
	@endforeach
	</div>
</div>
</div>
<div class="clearfix"></div>

@include('includes.newfooter')
<script src="{{ url('newhtml/js/owl.carousel.min.js') }}"></script>
<script src="{{ url('newhtml/js/bootstrap.min.js') }}"></script>
<?php $i=1; ?>
@foreach($hotel_rooms as $roomdata)
<script type="text/javascript">
$(document).ready(function(){
  $("#nw-hotel<?php echo $i; ?>").owlCarousel({
    items: 1,
    loop:true,
    autoplay:true,
    autoplayTimeout:3000,
    animateOut: 'fadeOut'
  });
}); 
</script>
<?php $i++; ?>
@endforeach

<script type="text/javascript">
var date = new Date(); 
			$('#todate').datepicker(
			{
				format: "dd-mm-yy",
				autoclose: true,
				onSelect: function(date){ 
				}
			});
			
			$('#fromdate').datepicker(
			{
				format: "dd-mm-yy",
				autoclose: true,
				minDate: date,
				onSelect: function(date){ 
					var dt2 = $('#todate');
					var startDate = $(this).datepicker('getDate');
					startDate.setDate(startDate.getDate() + 1);
					var minDate = $(this).datepicker('getDate');
					minDate.setDate(minDate.getDate() + 1);
					
					dt2.datepicker('setDate', minDate);
					dt2.datepicker('option', 'minDate', minDate);
					dt2.open();
				}
			});
			$("#fromdate").datepicker("setDate", "0");
			$("#todate").datepicker("setDate", "1");

$(document).ready(function(){
  $("#nw-hotel").owlCarousel({
    items: 1,
    loop:true,
    autoplay:true,
    autoplayTimeout:3000,
    animateOut: 'fadeOut'
  });
}); 

jQuery( document ).ready(function() {
	
    dotcount = 1;
      jQuery('#nw-hotel .owl-dot').each(function() {
        jQuery( this ).addClass( 'dotnumber' + dotcount);
        jQuery( this ).attr('data-info', dotcount);
        dotcount=dotcount+1;
      });
      slidecount = 1;
      jQuery('#nw-hotel .owl-item').not('.cloned').each(function() {
        jQuery( this ).addClass( 'slidenumber' + slidecount);
        slidecount=slidecount+1;
      });
      jQuery('#nw-hotel .owl-dot').each(function() {
          grab = jQuery(this).data('info');
          slidegrab = jQuery('.slidenumber'+ grab +' img').attr('src');
          console.log(slidegrab);
          jQuery(this).css("background-image", "url("+slidegrab+")");  
      });
      amount = jQuery('#nw-hotel .owl-dot').length;
      gotowidth = 100/amount;
      
      jQuery('#nw-hotel .owl-dot').css("width", gotowidth+"%");
      newwidth = jQuery('#nw-hotel .owl-dot').width();
      jQuery('#nw-hotel .owl-dot').css("height", newwidth+"px");
  });


</script>
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
<script type="text/javascript">
    function getrooms(room)
	{
		var adults = $("#adults").val();
		var childrens = $("#childrens").val();
		guests = (parseInt(adults) + parseInt(childrens));
		$("#rooms").val(room+' rooms/'+guests+' Guests');
		$("#totroom").val(room);
	}
	
	function getadults(adults)
	{
		var room = $("#room").val();
		var childrens = $("#childrens").val();
		guests = (parseInt(adults) + parseInt(childrens));
		$("#rooms").val(room+' rooms/'+guests+' Guests');
		$("#totadult").val(adults);
	}
	
	
	function getchildages(childrens)
	{
		var room = $("#room").val();
		var adults = $("#adults").val();
		guests = (parseInt(adults) + parseInt(childrens));
		$("#rooms").val(room+' rooms/'+guests+' Guests');
		$("#totchild").val(childrens);
		
		$("#childage").html('');
		var childs=$( "#childrens option:selected" ).val();
		for(i=1; i <=childs; i++)
		{
			$("#childage").append('<div> child age '+i+'</div><select id="childage'+i+'" name="childage[]" ><option value="1" >1</option><option value="2" >2</option><option value="3" >3</option><option value="4" >4</option><option value="5" >5</option><option value="6" >6</option><option value="7" >7</option><option value="8" >8</option><option value="9" >9</option><option value="10" >10</option><option value="11" >11</option><option value="12" >12</option><option value="13" >13</option></select>');	
		}
		$("#childage").show();
	}
	
	
	
	</script>	
		
		
<script type="text/javascript">
// Get the modal
var modal = document.getElementById('myroomselect');

// Get the button that opens the modal
var btn = document.getElementById("rooms");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
<script type="text/javascript">
function myFunction(roomtype,price,adult,child,rooms,days,checkin,checkout,hid,hrid,tokan) {
	var totalprice = (days * price)
	 
    document.getElementById("cartbox").innerHTML ="<b>Total Price </b><br/>Rs."+totalprice+"<br/>Adults"+adult+",Child "+child+"<br/>Total "+rooms+"Room,"+days+"Nights<br/><br/>";
	document.getElementById("buy").innerHTML ="<form action='{{ url('/hotel-checkout') }}' method='GET'><input type='hidden' value='"+totalprice+"' name='price'><input type='hidden' value='"+adult+"' name='adults'><input type='hidden' value='"+child+"' name='childs'><input type='hidden' value='"+rooms+"' name='room'><input type='hidden' value='"+checkin+"' name='fromdate'><input type='hidden' value='"+checkout+"' name='todate'><input type='hidden' value='"+hid+"' name='hid'><input type='hidden' value='"+hrid+"' name='hrid'><input type='hidden' value='"+tokan+"' name='data-token'><input type='submit' value='Buy Now'></form>";
}
</script>

<a href="#" id="toTop" style="display: inline;"><span id="toTopHover"></span></a><div id="ui-datepicker-div" class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all"></div>
 









