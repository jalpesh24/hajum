@extends('layouts.template_tours')
@section('title','Activity Detail View')
@section('content')
<div class="container">
  <div class="col-md-12" style="margin-bottom:50px">
    <div class="package">B H I M T A L </div>
  </div>
  <div class="col-md-12">
    <?php //print_r($activities); exit;?>
    @foreach ($activities as $activity)
    <div class="right-bar grid-view">
      <div class="grid-left">
        <div class="top">
          <h2>{!! $activity->activities_name !!}</h2>
        </div>
        <div class="grid-img"> <img src="{{ url('/activities/') }}{!! '/'.$activity->activities_image !!}" class="img-responsive" alt=""/>
          <div class="details">
            <div class="company-name"><a href="#">{!! $activity->activities_name !!}</a></div>
            <div class="location"><i class="fa fa-map-marker" aria-hidden="true"></i> {!! $activity->activities_location !!}</div>
            <div class="rating"> @for($r = 1; $r <= $activity->activities_rating; $r++) <i class="fa fa-star" aria-hidden="true"></i> @endfor </div>
          </div>
        </div>
      </div>
      <div class="grid-right activities_mob">
        <!--<h5><span style="font-size:20px;">Rs. {!! $activity->activities_price !!}</span></h5>-->
        <h5><span class="itemPrice">Rs. {!! $activity->activities_price !!}</span> <p>Starting Price(Per Adult)</p>
                              </h5>
        @if($activity->activities_duration  != '' )
        <div style="margin-top:10px;">
        	<h4>Duration</h4>
	        <p align="justify">{!! $activity->activities_duration !!} Hours</p>
        </div>
        @endif
        
        @if($activity->activities_highlights  != '' )
       <div style="padding-top:10px;">
           	<h4>Hightlights</h4>
            <p align="justify">{!! $activity->activities_highlights !!}</p>
        </div>
        @endif
        
        @if($activity->activities_meeting_point  != '' )
      	<div style="padding-top:10px;">
            <h4>MEETING POINT</h4>
			<p align="justify">{!! $activity->activities_meeting_point !!}</p>
        </div>
        @endif
    
        @if($activity->activities_meeting_time  != '' )
        <div style="padding-top:10px;">
           <h4>MEETING TIME</h4>
			<p align="justify">{!! $activity->activities_meeting_time !!}</p></div>
        @endif 
        
        <div style="padding-top:10px;">
        <a href="{{ url('/activity-checkout') }}" class="checkout" tid="{!! $activity->activities_id !!}" data-token="{{ csrf_token() }}">
        <button class="btn btn-lg btn-detail">Add to Cart</button>
        </a> 
        </div>
        
        </div>
    </div>
    <div class="col-md-1">
      <div style="float:left; width:100%;">&nbsp;</div>
    </div>
    @if($activity->activities_description  != '' )
    <!--Overview starts-->
    <div class="col-md-12" style="padding:0px; display:inline-block;">
      <div>
        <h3>Description</h3>
        <p align="justify">{!! $activity->activities_description !!}</p>
      </div>
    </div>
    <!--Overview ends-->
    @endif
    
    
    @if($activity->activities_additional_info != '' )
    <!--Inclusions starst-->
    <div class="col-md-12" style="padding:0px; display:inline-block;">
      <div>
        <h3>Additional Information</h3>
        <p align="justify">{!! $activity->activities_additional_info !!}</p>
      </div>
    </div>
    <!--Inclusions ends-->
    @endif
    @if($activity->activities_terms_condition  != '' )
    <!--Overview starts-->
    <div class="col-md-12" style="padding:0px; display:inline-block;">
      <div>
        <h3>Terms and Conditions</h3>
        <p align="justify">{!! $activity->activities_terms_condition !!}</p>
      </div>
    </div>
    <!--Overview ends-->
    @endif
    
    @endforeach </div>
</div>
@endsection
@section('page_js')
<script type="text/javascript">
$(document).ready(function() 
{
	$(".checkout").click(function()
	{
		var token = $(this).attr("data-token");
		var activity_id = $(this).attr("tid");
		$.ajax(
		{
			url:"{{ url('/checkoutactivityorder') }}",
			method : 'POST',
			async: false,
			dataType: "json",
			data: { "_token":token,"activity_id":activity_id },
			success: function(data) {
			}
		});
		return true;
	});
});
</script>
@endsection