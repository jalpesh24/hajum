@extends('layouts.template_tours')
@section('title','Search Activities')
@section('page_css')
<style type="text/css">
.package small { text-align:left; }
</style>
@endsection
@section('content')
<div class="container">
  <div class="col-md-12" style="margin-bottom:50px">
    <div class="package">
    	<small>Explore the world</small> {{ strtoupper($name_location) }} </div>
  </div>
  <div class="col-md-3">
    <div class="left-bar">
      <h2 class="title">Category</h2>
       <div class="box-section">
      {{ csrf_field() }}       
      <p class="last">
         <input type="checkbox" name="activity_category[]" id="activity_category1" value="Outdoor Fun" />
          <label for="east">OUTDOOR FUN</label>
      </p>
      <p class="last">
         <input type="checkbox" name="activity_category[]" id="activity_category2" value="Transfers & Transport" />
          <label for="east">TRANSFERS & TRANSPORT</label>
      </p>
     <p class="last">
          <input type="checkbox" name="activity_category[]" id="activity_category3" value="Tours & Sightseeing" />
          <label for="east">TOURS & SIGHTSEEING</label>
     </p>
     <p class="last">
           <input type="checkbox" name="activity_category[]" id="activity_category4" value="Food" />
          <label for="east">FOOD</label>
     </p>
     
	  </div>
      <h2 class="title">Price</h2>
      <div class="box-section">
      <p class="last">
          <input type="checkbox" name="activity_price[]" id="activity_price3" value="3000-4000" />
          <label for="east">3000 to 4000</label>
     </p>
     <p class="last">
          <input type="checkbox" name="activity_price[]" id="activity_price4" value="4000-5000" />
          <label for="east">4000 to 5000</label>
     </p>
      <input type="hidden" name="name_location" id="name_location" value="{!! $name_location !!}" />
      </div>
      </div>
  </div>
  <div class="col-md-9" id="listactivities">
    <div class="right-bar grid-view">
      <?php $i = 1; ?>
      @foreach($activities as $activity)
      <div class="col-md-4">
        <div style="margin-top:20px;"> @if($activity->activities_image != '') <a href="{{ url('/activitydetail/'.$activity->activities_id) }}"><img src="{{ asset('/activities/'.$activity->activities_image) }}" class="img-responsive" style="height: 200px; width: 400px;"></a> @else <a href="{{ url('/activitydetail/'.$activity->activities_id) }}"><img src="{{ asset('/activities/akshardham.jpg') }}" class="img-responsive"></a> @endif
          <div style="padding-top:5px;"> <a href="{{ url('/activitydetail/'.$activity->activities_id) }}" style="color:#FFFFFF;text-decoration:none;"><strong>{!! ucwords(strtolower($activity->activities_name)) !!}</strong></a> </div>
          <div style="padding-top:5px;">Price: Rs {!! $activity->activities_price !!} / per person</div>          
          <div style="padding-top:5px;">Location: {!! $activity->activities_location !!}</div>
          <div style="padding:5px 0 25px 0;"> <a href="{{ url('/activitydetail/'.$activity->activities_id) }}" class="btn btn-warning">Book now</a></div>
        </div>
      </div>
      <?php 
			if($i == 3) { $i=0;  echo '<div style="clear:both; "></div>'; } 
			$i++; ?>
      @endforeach </div>
  </div>
</div>
@endsection

@section('page_js')
<script type="text/javascript">
$(document).ready(function() 
{
	$("input[name='activity_category[]']").click(function()
	{
		var name_location = $("#name_location").val();
		var activity_category_chked = '';
		$('input[name="activity_category[]"]:checked').each(function() {
			activity_category_chked = activity_category_chked + "'"+this.value+"',";
		});
		var activity_category = activity_category_chked.substring(0,activity_category_chked.length - 1);
		
		var activity_price_chked = '';
		$('input[name="activity_price[]"]:checked').each(function() {
			activity_price_chked = activity_price_chked + "'"+this.value+"',";
		});
		var activity_price = activity_price_chked.substring(0,activity_price_chked.length - 1);
		
		var token = $("input[name='_token']").val();
		
		$.ajax(
		{
			url:"{{ url('/listsearchactivities') }}",
			method : 'POST',
			data: { "_token":token,"activity_category":activity_category,"name_location":name_location,'activity_price':activity_price},
			success: function(data) {
				$("#listactivities").html(data);
			}
		});
	});
	
	$("input[name='activity_price[]']").click(function()
	{
		var name_location = $("#name_location").val();
		var activity_category_chked = '';
		$('input[name="activity_category[]"]:checked').each(function() {
			activity_category_chked = activity_category_chked + "'"+this.value+"',";
		});
		var activity_category = activity_category_chked.substring(0,activity_category_chked.length - 1);
		
		var activity_price_chked = '';
		$('input[name="activity_price[]"]:checked').each(function() {
			activity_price_chked = activity_price_chked + this.value+",";
		});
		var activity_price = activity_price_chked.substring(0,activity_price_chked.length - 1);
		
		var token = $("input[name='_token']").val();
		
		$.ajax(
		{
			url:"{{ url('/listsearchactivities') }}",
			method : 'POST',
			data: { "_token":token,"activity_category":activity_category,"name_location":name_location,'activity_price':activity_price},
			success: function(data) {
				$("#listactivities").html(data);
			}
		});
	});
});
</script>
@endsection