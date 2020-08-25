@include('includes.newheader')
<div class="container">
<div class="breadcrumbs1 nw-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home" aria-hidden="true"></i> <a href="newhome.html">Home</a></li>
          <li class="breadcrumb-item active">Search</li>
        </ol>
      </div>

  <div class="row"> @if(!empty($tours))
    <?php $i = 1; ?>
    @foreach($tours as $tour)
    <div class="col-md-4"> @if($tour->tour_image != '') <a href="{{ url('/tourdetail/'.$tour->tour_id) }}" title="{!! $tour->tour_name !!}"><img src="{{ asset('/tours_images/'.$tour->tour_image) }}" alt="{!! $tour->tour_name !!}" class="img-responsive " style="height: 200px; width: 400px;"></a> @endif
      <div style="padding-top:20px;font-size:18px;"><a href="{{ url('/tourdetail/'.$tour->tour_id) }}" style="color:#FFFFFF;text-decoration:none;"><strong>{!! $tour->tour_name !!}</strong></a></div>
      <div class="col-md-7 nopadding">
        <div style="padding-top:15px;"><span>Starting at 
          @if($tour->sale_price != "" && $tour->sale_price > 0)
          Rs <strike>{!! $tour->price_per_person !!}</strike> <strong>{!! $tour->sale_price !!}</strong> @else
          Rs <strong>{!! $tour->price_per_person !!}</strong> @endif </span></div>
      </div>
      <div class="col-md-5">
        <div style="padding-top:20px;"> <a href="{{ url('/tourdetail/'.$tour->tour_id) }}" class="btn btn-warning">View Details</a> </div>
      </div>     
      <p>&nbsp;</p>
    </div>
    <?php if($i == 3) { echo '<div style="clear:both;"></div>'; $i = 0;} $i++; ?>
    @endforeach
    @endif
    
    @if(!empty($activities))
    <?php $i = 0; ?>
    @foreach($activities as $activity)
    <div class="col-md-4"> @if($activity->activities_image != '') <a href="{{ url('/activitydetail/'.$activity->activities_id) }}" title="{!! $activity->activities_name !!}"><img src="{{ asset('/activities/'.$activity->activities_image) }}" class="img-responsive" alt="{!! $activity->activities_name !!}" style="height: 200px; width: 400px;"></a> @endif
      <div style="padding-top:20px;font-size:18px;"><a href="{{ url('/activitydetail/'.$activity->activities_id) }}" style="color:#FFFFFF;text-decoration:none;"><strong>{!! $activity->activities_name !!}</strong></a></div>
      <div class="col-md-7 nopadding">
        <div style="padding-top:15px;"><span>Starting at Rs {!! $activity->activities_price !!}</span></div>
        <div style="padding-top:15px;"><span>Duration: {!! $activity->activities_duration !!}</span></div>
      </div>
      <div class="col-md-5">
        <div style="padding-top:20px;"> <a href="{{ url('/activitydetail/'.$activity->activities_id)}}" class="btn btn-warning">View Details</a> </div>
      </div>     
      <p>&nbsp;</p>
    </div>
    <?php if($i == 3) { echo '<div style="clear:both;"></div>'; $i = 0;} $i++; ?>
    @endforeach
    @endif
    
    @if(!empty($hotels))
    <?php $i = 0; ?>
    @foreach($hotels as $hotel)
    <div class="col-md-4"> @if($hotel->hotel_image != '') <a href="{{ url('/hoteldetail/'.$hotel->hotel_id) }}" title="{!! $activity->hotel_name !!}"><img src="{{ asset('/hotel_images/'.$hotel->hotel_image) }}" alt="{!! $hotel->hotel_name !!}" class="img-responsive " style="height: 200px; width: 400px;"></a> @endif
      <div style="padding-top:20px;font-size:18px;"><a href="{{ url('/hoteldetail/'.$hotel->hotel_id) }}" style="color:#FFFFFF;text-decoration:none;"><strong>{!! $hotel->hotel_name !!}</strong></a></div>
      <div class="col-md-7 nopadding">
        <div style="padding-top:15px;"><span>Starting at Rs {!! $hotel->hotel_saleprice !!}</span></div>
      </div>
      <div class="col-md-5">
        <div style="padding-top:20px;"> <a href="{{ url('/hoteldetail/'.$hotel->hotel_id)}}" class="btn btn-warning">View Details</a> </div>
      </div>
      <p>&nbsp;</p>
    </div>
    <?php if($i == 3) { echo '<div style="clear:both;"></div>'; $i = 0;} $i++; ?>
    @endforeach
    @endif </div>
</div>
@include('includes.newfooter')

<a href="#" id="toTop" style="display: inline;"><span id="toTopHover"></span></a><div id="ui-datepicker-div" class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all"></div></body></html>

