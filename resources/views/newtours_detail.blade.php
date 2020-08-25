@include('includes.newheader')
<style>
.typebox{border:2px solid;width:100%;height:70px;}
.city{width:20%;color:%000;margin-left:20px;}
.hotle{width:20%;color:%000;margin-left:20px;}
.star{width:20%;margin-left:20px;}
.vehicle{width:20%;margin-left:20px;}
.listing_radio_btn_main {
    color: rgb(89, 93, 95);
    display: inline-block;
    font-size: 13px;
    vertical-align: top;
    width: 152px;
}
.hoteldetails{display: block; margin-top: 40px;}
</style>

<div class="container">
    <div class="row">
      <div class="breadcrumbs1 nw-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home" aria-hidden="true"></i> <a href="newhome.html">Home</a></li>
          <li class="breadcrumb-item active">Tour Detail</li>
        </ol>
      </div>
    </div>
	
 @foreach ($tours as $tour)
    <div class="col-md-12">
        <h1 class="text-center text-uppercase mb-4">{!! $tour->tour_name !!}</h1>
      </div>  
    
<?php $imgs = explode(',', $tour->tour_image); ?>
    <div class="row">
        <div class="col-md-8">
            <div class="slide-cont">
              <div class="owl-carousel">
			  @foreach($imgs as $tourimg)
                <div><img src="{{ url('tours_images/'.$tourimg) }}"></div>
                @endforeach
              </div>
            </div>
        </div>
        <div class="col-md-4 payment-box">
		@if($tour->tour_image != "") 
            <div class="person-price">
			<?php $images = $imgs[0]; ?>
                <img class="img-responsive center-block" src="{{ url('tours_images/'.$images) }}">
		@endif
		
				<h4 class="mb-2">{!! $tour->days !!} days & {!! $tour->nights !!} Nights</h4>
				
		<div class="col-md-12 ">
		<div class="typebox">
		<?php $i = 0; ?>
		@foreach ($tour_prices as $tour_price)
		

				<div class="col-md-4" style="background-color:#f5f5f5;" >	
				<input type="radio" name="type" class="type"  id="{!! $tour_price->tour_package_type; !!}" value="{!! $tour_price->tour_package_type; !!}" onchange="changeprice({!! $i !!})" <?php if($i==0) { echo "checked"; } ?>><b>{!! ucfirst($tour_price->tour_package_type); !!}</b>				
              </div>			  
			  
			  <?php $i++; ?>
	@endforeach	
			
<?php $i = 0; ?>
		@foreach ($tour_prices as $tour_price)			
	  
		<div class="hoteldetails detail{!! $i !!}" <?php if($i==0) { echo 'style="display:block;"'; } else { echo 'style="display:none;"'; } ?> >
		<div class="col-md-12 " >
		
		<table width="100%">		
		<tr>
			<td><span class="city" name="location" id="location">{!! $tour->city_location !!}</span></td>
			<td><span class="vehicle" name="vehicle" id="vehicle">{!! $tour_price->vehicle	 !!}</span></td>
			<td><span class="hotle" name="hotelname" id="hotelname">{!! $tour_price->hotel_name !!}</span></td>
			<td><span class="star" name="hotelstar" id="hotelstar">{!! $tour_price->hotel_star !!} Star</span></td>
			</tr>
			</table></div>
		
		<div class="col-md-12">	
		<input type="hidden" name="person" id="person" value="{!! $tour_price->person !!}" >
		<input type="hidden" name="pricevalue" id="pricevalue" value="{!! $tour_price->package_per_person !!}" >
				
		<div class="showprice" style="margin-top:50px;">
			<span class="price" id="price" name="price">Rs. <b>{!! $tour_price->package_per_person !!}</b></span><br/>
			<span> Per Person Price</span>
		</div></div>
		
		
		</div>
	
		<?php $i++; ?>
			  @endforeach	
		</div></div>
		<div class="clear:both;"></div>
		<div class="col-md-12">	
                 <?php if($user = Auth::user())
{ ?>
    <a href="#" class="checkout" tid="{!! $tour->tour_id !!}" data-token="{{ csrf_token() }}">
            <button class="btn-default btn1" >Book Now</button>
            </a>
<?php } else { ?>
            		<a href="#" class="checkout" tid="{!! $tour->tour_id !!}" data-token="{{ csrf_token() }}">
            <button class="btn-default btn1">Book Now</button>
            </a>
<?php } ?>			        
		 	<a href="#" class="getacall" tid="{!! $tour->tour_id !!}">
	        <button class="btn-default btn1">Get A Callback</button>
    	    </a> 
				</div>
            </div>
			<div class="details">        
        <div class="location"><i class="fa fa-map-marker" aria-hidden="true"></i> {!! $tour->city_location !!}</div>
        <div class="rating"> @for($r = 1; $r <= $tour->rating; $r++) <i class="fa fa-star" aria-hidden="true"></i> @endfor </div>
      </div>
        </div>
    </div>
	
    <div class="row mt-2 hotels-tour-services">
        <div class="col-md-12">
            <div class="services-hotels mb-3">  
			 @if($tour->inclusion_select != "")
				 
                <ul class="option">
				@foreach(explode(',', $tour->inclusion_select) as $info) 
              @if($info == "accomodation")
                    <li style="width: 15%;float: left;list-style: none;"><img src="{{ url('public/img/stars-icon.png') }}" class="sign" style="width:25px;">
                  <p>Accommodation</p>
                </li>
              @endif  
              @if($info == "transfer") 
                <li style="width: 15%;float: left;list-style: none;"><img src="{{ url('public/img/transfer-icon.png') }}" class="sign" style="width:25px;">
                 <p>Transfer</p>
                </li> 
              @endif
               @if($info == "meals") 
                <li style="width: 15%;float: left;list-style: none;"><img src="{{ url('public/img/meals-icon.png') }}" class="sign" style="width:25px;">
                 <p>Meals</p>
                </li> 
              @endif
               @if($info == "sightseen") 
                <li style="width: 15%;float: left;list-style: none;"><img src="{{ url('public/img/sight-icon.png') }}" class="sign" style="width:25px;">
                 <p>Sightseen</p>
                </li> 
              @endif
			   @endforeach
			  <li><p>{!! $tour->partofindia !!}</p></li>
       
                </ul>
               @endif

			   @if($tour->overview != '' )
  <!--Overview starts-->

   <h2 class="mt-4 mb-1">Overview</h2>
    <p align="justify">{!! $tour->overview !!}</p>
  
  <!--Overview ends-->
  @endif
  
  
  
  <!--Tabbing starts here-->
                <div class="vertical-tab mt-4 mb-4">
                    <h2 class="mb-2 mt-3 text-center text-primary text-uppercase"><i class="fa fa-map-marker mr-2"></i>Tour Details Description</h2>
                   
					<?php $i = 0;$j=1; ?>
					<div class="tab">
						@foreach($tour_days as $days)
		   
						@if($i == 0)<button class="tablinks" onclick="openCity(event, 'd{{ $i = $i+1 }}')" id="defaultOpen">Day 1</button>
						@else <button class="tablinks" onclick="openCity(event, 'd{{ $i = $i+1 }}')" id="defaultOpen">Day {{ $i }}</button>
						@endif
		  
						@endforeach
					</div>
                    
					@foreach($tour_sightseeing as $sightseeing)
					
                    <div id="d{{ $j++ }}" class="tabcontent">
                        <div class="tab-bg">
							<img src="{{ url('public/img/hotel.png') }}">                            
                            <span class="ml-2">{!! $sightseeing->travel !!} </span>
                        </div>
						<?php $sights = explode(" ### ",$sightseeing->sightseeing); ?>
						@if($sights[0])
                        <div class="tab-bg">
                            <img src="{{ url('public/img/sightseen.png') }}">
							@foreach($sights as $sight)
                            <h4>{!! trim($sight) !!}</h4>
							 @endforeach
                        </div>
						 @endif
						  <?php $meals = explode(",",$sightseeing->meal); ?>
						  @if($meals[0])							  
                        <div class="tab-bg">
                            <img src="{{ url('public/img/meal.png') }}">
                            @foreach($meals as $meal)
								<h4>{!! ucfirst(trim($meal)) !!}<h4>
							@endforeach
                        </div>
						@endif
                    </div>
					
							
					@endforeach		
                </div>
                <!--Tabbing ends here-->
  
  
  @if($tour->inclusions != '' )
  <!--Inclusions starst-->
<h2 class="mt-4 mb-1">Inclusions</h2>
                 <p>{!! $tour->inclusions !!}</p>  
  <!--Inclusions ends-->
  @endif
  
  @if($tour->exclusions != '' )
  <!--Exclusions starts-->
  <h2 class="mt-4 mb-1">Exclusions</h2>
   <p align="justify">{!! $tour->exclusions !!}</p>  
  <!--Exclusions ends-->
  @endif
  
  @if(isset($tour_days[0]))
  <!--Detailed itinery starts-->
  <h2 class="mt-4 mb-1">Detailed Day Wise Itinerary</h2>
          <?php $i=0; ?>
          @foreach($tour_days as $days)
           <b>Day {{ $i = $i+1 }} - {!! $days->itinerydata_title !!}</b>
                <p>{!! $days->itinerydata_description !!} </p>
          @endforeach </div>
  
  <!--Detailed itinery ends-->  
  @endif
                

                @if(isset($tour_pvisits[0]))
  <!--About itinery starts-->  
  <div style="clear:both;margin:20px; 0"><hr /></div>
  <div class="col-md-12">
          <h3>About Itinerary</h3>
          <!-- Nav tabs -->
          <ul class="nav nav-tabs">
            <?php $i=0; ?>
            @foreach($tour_pvisits as $pvisit)
            @if($i==0)
            <li class="active"><a href="#pv{{ $i = $i+1 }}" data-toggle="tab" class="title">{!! $pvisit->pvisit_name !!}</a> </li>
            @else
            <li><a href="#pv{{ $i = $i+1 }}" data-toggle="tab" class="title">{!! $pvisit->pvisit_name !!}</a> </li>
            @endif
            @endforeach
          </ul>
          <!-- Tab panes -->
          <div class="tab-content">
            <?php $i=0; ?>
            @foreach($tour_pvisits as $pvisit)
            @if($i==0)
            <div class="tab-pane fade in active" id="pv{{ $i = $i+1 }}">
              <p align="justify">{!! $pvisit->pvisit_description !!}</p>
            </div>
            @else
            <div class="tab-pane fade" id="pv{{ $i = $i+1 }}">
              <p align="justify">{!! $pvisit->pvisit_description !!}</p>
            </div>
            @endif
            @endforeach </div>     
  </div>
  @endif
  <!--About itinery ends-->

                <div style="background-color: #fff;" class="row services-hotels mt-5 mb-1">
                    <div class="row">
                        <div class="col-md-6">
						 <h3>Payment Policy</h3>
						<p align="justify">{!! $tour->paymentpolicy !!} </p>
                        </div>
                        <div class="col-md-6">
                        <h3>Cancellation Policy</h3>
						<p align="justify">{!! $tour->cancellationpolicy !!} </p>   
						</div>
                    </div>
                </div>
            </div>
        </div>
    
	@endforeach
	</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel" style="color:#000000;">Get the Best Holiday Planned by us!</h4>
      </div>
      <div class="modal-body" style="color:#000000;">
        <form action="" method="post" name="frm_get_call">
          {{ csrf_field() }}
          <input type="hidden" name="tid" id="tid" value="" />
          <div class="col-md-8">
            <div class="col-md-12">
              <!-- <label for="txt_name">Name *:</label>-->
              <input type="text" name="txt_name" class="form-control" id="txt_name" required="required" value="" placeholder="Full Name" />
            </div>
            <div class="col-md-12">
              <!-- <label for="txt_email">Email *:</label>-->
              &nbsp;
              <input type="email" name="txt_email" class="form-control" id="txt_email" required="required" value="" placeholder="Email ID" />
            </div>
            <div class="col-md-12">
              <!--  <label for="txt_mobile">Mobile *:</label>-->
              &nbsp;
              <input type="number" name="txt_mobile" class="form-control" id="txt_mobile" required="required" value="" placeholder="Phone Number" />
            </div>
          </div>
          <div class="col-md-4"> <img src="{{ url('/tours_images/1.jpg') }}" class="img-responsive" id="modelimage" /><br />
            <span id="tourname">Get the Best Holiday Planned by us!</span> </div>
        </form>
      </div>
      <div class="modal-footer" style="border-top:none;">
        <div class="col-md-4" style="padding-top:20px;border-top:none;">
          <button type="button" class="btn btn-primary">Send</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div>
   
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
	</div>
	
	
<!-- Modal for Select booknow-->
<div class="modal fade" id="mycheckout" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel" style="color:#000000;">Select Number of Rooms & Travellers</h4>
      </div>
      <div class="modal-body" style="color:#000000;">
        <form action="newtour-checkout" method="post" name="frm_book now">
          {{ csrf_field() }}
		  
          <input type="hidden" name="tid" id="tid" value="" />
		  <span class="tourname">   </span>
          <div class="col-md-8">
		  <span class="package"></span>
		  <span class="packperson"></span>
		  <span class="pacprice"></span>
            <table  class="table table-hover small-text" id="tb" width="100%;">
<tr class="tr-header">
<th>Room</th>
<th>Adults</th>
<th>Childs</th>

<th><a href="javascript:void(0);" style="font-size:18px;" id="addMore" title="Add More Room"><span class="glyphicon glyphicon-plus"></span></a></th>
<tr>
<td><select name="room" >
	<option value="1">1 Room</option>
	<option value="2">2 Room</option>
	<option value="3">3 Room</option>
	<option value="4">4 Room</option>
	</select></td>
<td>
<select name="adults" >
	<option value="1">1 Adults</option>
	<option value="2">2 Adults</option>
	<option value="3">3 Adults</option>
	<option value="4">4 Adults</option>
	</select>
 </td>
 <td>
 <select name="childs" >
	<option value="1">1 childs</option>
	<option value="2">2 childs</option>
	<option value="3">3 childs</option>
	<option value="4">4 childs</option>
	</select>
 </td>
<td><a href='javascript:void(0);'  class='remove'><span class='glyphicon glyphicon-remove'></span></a></td>
</tr>
</table>
          </div>
          <div class="col-md-4"> <img src="{{ url('/tours_images/1.jpg') }}" class="img-responsive" id="modelimage" /><br />
            <span id="tourname">Get the Best Holiday Planned by us!</span> </div>
        <div class="modal-footer" style="border-top:none;">
        <div class="col-md-4" style="padding-top:20px;border-top:none;">
          <button type="button" class="btn btn-primary">Book Now</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div>

	   </form>
      </div>
     
   
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
	</div>

<div class="clearfix"></div>
@include('includes.newfooter')
  

<script src="{{ url('newhtml/js/jquery.js') }}"></script>
<script src="{{ url('newhtml/js/jquery-ui.js') }}"></script>
<script src="{{ url('newhtml/js/jquery-migrate-1.js') }}"></script>
<script src="{{ url('newhtml/js/superfish.js') }}"></script>
<script src="{{ url('newhtml/js/select2.js') }}"></script>
<script src="{{ url('newhtml/js/jquery_002.js') }}"></script>
<script src="{{ url('newhtml/js/jquery_006.js') }}"></script>
<script src="{{ url('newhtml/js/jquery_003.js') }}"></script>
<script src="{{ url('newhtml/js/jquery_007.js') }}"></script>
<script src="{{ url('newhtml/js/scripts.js') }}"></script>
<script src="{{ url('newhtml/js/owl.carousel.min.js') }}"></script>
<script src="{{ url('newhtml/js/bootstrap.min.js') }}"></script>

<script type="text/javascript">
function changeprice(i)
{
	$(".hoteldetails").hide();
	$(".detail"+i).show();
}
$(document).ready(function(){
  $(".owl-carousel").owlCarousel({
    items: 1,
    loop:true,
    autoplay:true
  });
}); 
jQuery( document ).ready(function() {
    dotcount = 1;
      jQuery('.owl-dot').each(function() {
        jQuery( this ).addClass( 'dotnumber' + dotcount);
        jQuery( this ).attr('data-info', dotcount);
        dotcount=dotcount+1;
      });
      slidecount = 1;
      jQuery('.owl-item').not('.cloned').each(function() {
        jQuery( this ).addClass( 'slidenumber' + slidecount);
        slidecount=slidecount+1;
      });
      jQuery('.owl-dot').each(function() {
          grab = jQuery(this).data('info');
          slidegrab = jQuery('.slidenumber'+ grab +' img').attr('src');
          console.log(slidegrab);
          jQuery(this).css("background-image", "url("+slidegrab+")");  
      });
      amount = jQuery('.owl-dot').length;
      gotowidth = 100/amount;
      
      jQuery('.owl-dot').css("width", gotowidth+"%");
      newwidth = jQuery('.owl-dot').width();
      jQuery('.owl-dot').css("height", newwidth+"px");
  });


/* vertical tab */

function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}
document.getElementById("defaultOpen").click();
</script>
<script type="text/javascript">
$(document).ready(function() {
    $("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
        e.preventDefault();
        $(this).siblings('a.active').removeClass("active");
        $(this).addClass("active");
        var index = $(this).index();
        $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
        $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
    });
});

$(document).ready(function() 
{
	$(".getacall").click(function()
	{ 
		var id = $(this).attr("tid");
		var tourname = $("#tourname_"+id).html();
		var tourimage = $("#tourimage_"+id).attr("src");
		$("#myModalLabel").html(tourname);
		$("#modelimage").attr("src",tourimage);
		$("#tourname").html(tourname);
		$('#myModal').modal('show');
		return false;
	});
	$(".checkout").click(function()
	{
		    
		$('#mycheckout').modal('show');	
		var selValue = $('input[name=type]:checked').val();   
		var person =$('#person').val();
		var price =$('#pricevalue').val();
		var id = $(this).attr("tid");
		alert(id);
		
		 $('.package').html('<br/>Selected Package is : <b>' + selValue + '</b>');
		 $('.packperson').html('<br/>Person  : <b>' + person + '</b>');
		 $('.pacprice').html('<br/>Price  : <b>Rs. ' + price + ' Per Person</b>');
		
	});
});
</script>

<a href="#" id="toTop" style="display: inline;"><span id="toTopHover"></span></a><div id="ui-datepicker-div" class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all"></div></body></html>








