@include('includes.newheader')
<div class="container">
<div class="row">
      <div class="breadcrumbs1 nw-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home" aria-hidden="true"></i> <a href="newhome.html">Home</a></li>
          <li class="breadcrumb-item active">Search Hotel List</li>
        </ol>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <h1 class="text-center text-uppercase mb-4">{{ strtoupper($name_location) }}</h1>
      </div>
    </div>
<div class="row">
  <div class="col-md-3">
  <div class="payment-box1">
    <div class="left-bar"> {{ csrf_field() }}
      <h2 class="title">Refine Your Search</h2>
      <div class="box-section">
        <p>Search by Hotel Name</p>
        <input type="text" name="hotel_name" id="hotel_name" class="form-control" />
      </div>
      <div class="box-section">
        <p class="title">Price</p>
        <div class="form-check ml-1">
                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                  <label class="form-check-label ml-1" for="defaultCheck1">1001 to 2000 </label>
                </div>
                <div class="form-check ml-1">
                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
                  <label class="form-check-label ml-1" for="defaultCheck2">2001 to 3000 </label>
                </div>
                <div class="form-check ml-1">
                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck3">
                  <label class="form-check-label ml-1" for="defaultCheck3">3001 to 4000 </label>
                </div>
                <div class="form-check ml-1">
                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck4">
                  <label class="form-check-label ml-1" for="defaultCheck4">4001 to 5000 </label>
                </div>
                <div class="form-check ml-1">
                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck5">
                  <label class="form-check-label ml-1" for="defaultCheck5">5001 to 6000 </label>
                </div>
                <div class="form-check ml-1">
                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck6">
                  <label class="form-check-label ml-1" for="defaultCheck6">6001 to 7000 </label>
                </div>
                <div class="form-check ml-1">
                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck7">
                  <label class="form-check-label ml-1" for="defaultCheck7">7001 to 8000 </label>
                </div>
                <div class="form-check ml-1">
                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck8c">
                  <label class="form-check-label ml-1" for="defaultCheck8">8001 to 10000 </label>
                </div>
      </div>
    </div>
  </div>
  </div>
  
  <div class="col-md-9">
    <div class="right-bar grid-view">
      <!--Heading start
      <div class="col-md-12" style="background-color:#FFFFFF; float:left; width:100%; color:#000000;">
        <div class="col-md-4" style="padding:0px;">Total Search Result: <span id="searchcount">{{ count($hotels) }}</span></div>
        <div class="col-md-5 col-sm-7 col-xs-7" style="padding:0px;"><span style="cursor:pointer" id="byname">Short by Name</span></div>
        <div class="col-md-3 col-sm-5 col-xs-5" style="padding:0px;" align="center"><span style="cursor:pointer" id="byprice">Sort by Price</span></div>
      </div>-->
      <!--Heading ends-->
      <div id="searchresult" style="float:left; width:100%;">
        @foreach($hotels as $hotel)
		<?php $imgs = explode(',', $hotel->hotel_image); 
		$images = $imgs[0];
		?>		
            <div class="payment-box2">
                <div class="row">
                    <div class="col-md-4 rest-img">
					@if($hotel->hotel_image != '')
                      <img class="img-responsive center-block" src="{{ asset('hotel_images/'.$images) }}">
					@else
						<div class="col-md-4" style="padding-left:10px;"><img src="{{ asset('hotel_images/2.jpg') }}" class="img-thumbnail"/> </div>
					@endif
                    </div>
                    <div class="col-md-5">
                      <h4><b>{!! ucwords(strtolower($hotel->hotel_name)) !!}</b></h4>
                      <p>{!! $hotel->hotel_address !!}, {!! $hotel->city_location !!}</p>
                      <p>Star Rating &nbsp;<i class="fa fa-star" aria-hidden="true"></i>&nbsp;<i class="fa fa-star" aria-hidden="true"></i>&nbsp;<i class="fa fa-star" aria-hidden="true"></i>&nbsp;<i class="fa fa-star" aria-hidden="true"></i>&nbsp;<i class="fa fa-star" aria-hidden="true"></i></p>
                      <p>{!! ucfirst($hotel->hotel_amenities) !!}</p>
                    </div>
                    <div class="col-md-3">
                      <span>Per Person</span>
                      <h4 class="text-primary"><s class="text-muted mr-1">Rs. {!! $hotel->hotels_roomdata->hotel_price !!}</s>Rs. {!! $hotel->hotels_roomdata->hotel_saleprice !!}</h4>
                      &nbsp;
					  <?php if(isset($adults) && $adults > 0) { $url = '?adults='.$adults; }
	   	else { $url = '?adults=1'; }
	   if(isset($childs) && $childs>0) { $url .= '&childs='.$childs; } 
	   else { $url .= '&childs=0'; }
	   if(isset($room) && $room>0) { $url .= '&room='.$room; } 
	   else { $url .= '&room=0'; }
	   
	   if(isset($fromdate)) { $url .= '&fromdate='.$fromdate; } 
	   
	   if(isset($todate)) { $url .= '&todate='.$todate; } 
	   
	   ?>
            <div style="margin-top:20px;">
			@if($hotel->hotel_status == '1')
            <a href="{{ url('/hoteldetail/'.$hotel->hotel_id.$url) }}" class="btn-danger btn btn-md">Choose Room</a>
			@else
			<a href="#" class="btn-danger btn btn-md">Not Available Room</a>	
			@endif
                      
                    </div>
                </div>
            </div>
    
        </div>
   
  @endforeach
      </div>
    </div>
  </div>
  </div>
</div>
@include('includes.newfooter')


<script type="text/javascript">
$(document).ready(function() 
{
	$("#hotel_name").keyup(function() 
	{
		var token = $("input[name='_token']").val();
		var hotel_name = $(this).val();
		var hotel_price_chked = '';
		$('input[name="hotel_price[]"]:checked').each(function() {
			hotel_price_chked = hotel_price_chked + this.value+",";
		});
		var hotel_price = hotel_price_chked.substring(0,hotel_price_chked.length - 1);
		
		$.ajax(
		{
			url:"{{ url('/listsearchhotels') }}",
			method : 'POST',
			async : false,
			data: { "_token":token,"hotel_name":hotel_name,'hotel_price':hotel_price},
			success: function(data) 
			{
				$("#searchresult").html(data);
				var searchcount = $("#total_hotels").val();
				$("#searchcount").html(searchcount);
			}
		});
	});
	
	$("input[name='hotel_price[]']").click(function()
	{
		var token = $("input[name='_token']").val();
		var hotel_price_chked = '';
		$('input[name="hotel_price[]"]:checked').each(function() {
			hotel_price_chked = hotel_price_chked + this.value+",";
		});
		var hotel_price = hotel_price_chked.substring(0,hotel_price_chked.length - 1);
		var hotel_name = $("#hotel_name").val();
		
		$.ajax(
		{
			url:"{{ url('/listsearchhotels') }}",
			method : 'POST',
			async : false,
			data: { "_token":token,"hotel_name":hotel_name,'hotel_price':hotel_price},
			success: function(data) 
			{
				$("#searchresult").html(data);
				var searchcount = $("#total_hotels").val();
				$("#searchcount").html(searchcount);
			}
		});
	});
});
</script>
