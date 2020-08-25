@extends('layouts.template')
@section('title', 'Trip India')
@section('keywords', 'Trip India')
@section('description', 'Trip India')
@section('page_css')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{ asset('/css/bootcomplete.css') }}">
@endsection
@section('content')
<div class="container">
 <div class="col-md-12" style="background-color: rgba(0, 18, 28, 0.45);margin-bottom:20px; padding:10px 15px 20px; border-radius:5px;">
    <div id="myTab" ><a id="myTab" data-toggle="tab" href="#tours" class="myTab active">Tours</a></div>
    <div id="myTab" ><a id="myTab" data-toggle="tab" href="#hotels" class="myTab">Hotels</a></div>
    <div id="myTab" ><a id="myTab" data-toggle="tab" href="#activities" class="myTab">Activities </a></div>
    <div id="myTab" ><a id="myTab" data-toggle="tab" href="#transport" class="myTab">Transport </a></div>
    <div class="tab-content" id="myTabContent" >
      <div id="tours" class="tab-pane fade in active">
        <form action="{{ url('/searchtours') }}" class="form-inline" role="form" method="post" name="frm_tours">
        {{ csrf_field() }}
          <div class="inner-addon left-addon form-group input-group"> <span class="input-group-addon">
            <button class="btn btn-default" type="button"><i class="fa fa-road" aria-hidden="true"></i></button>
            </span>
            <input  type="text" class="form-control" placeholder="Going to" name="name_location" id="txt_tours_name_location" required="required" />
          </div>
          <div class="inner-addon left-addon">
            <select class="form-control" name="tours_month" id="tours_month">
              <option value="" selected="selected">Month of Travel (Any)</option>
              <?php  $month_num = date("Y-m"); $month_name = date("M-Y");
						echo '<option value="'.$month_num.'">'.$month_name.'</option>';
						$month = time();
						for ($i = 1; $i <= 12; $i++) 
						{
							$month = strtotime('next month', $month);
							$month_num = date("Y-m", $month);
							$month_name = date("M-Y", $month);
							echo '<option value="'.$month_num.'">'.$month_name.'</option>';
						}
						?>
            </select>
          </div>
          <button class="btn btn-lg btn-warning" type="submit" name="btn_tours_search" id="btn_tours_search">Search</button>
        </form>
      </div>
      <div id="hotels" class="tab-pane fade">
        <form action="{{ url('/searchhotels') }}" class="form-inline" role="form" method="post" name="frm_hotels">
         {{ csrf_field() }}
          <div class="inner-addon left-addon form-group input-group hotels-group"> <span class="input-group-addon">
            <button class="btn btn-default" type="button"><i class="fa fa-road"></i></button>
            </span>
            <input type="text" name="hotel_name_location" id="hotel_name_location" class="form-control" placeholder="Select City, Location or Hotel Name (Worldwide)" required="required" />
          </div>
          <div class="inner-addon left-addon form-group input-group hotels-group"> <span class="input-group-addon">
            <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
            </span>
            <input type="text" name="checkin" id="fromdate" class="form-control datepicker" placeholder="Check-in" />
          </div>
          <div class="inner-addon left-addon form-group input-group hotels-group"> <span class="input-group-addon">
            <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
            </span>
            <input type="text" name="checkout" id="todate" class="form-control datepicker" placeholder="Check-out" />
          </div>
          <div class="inner-addon left-addon form-group input-group hotels-group-persons"> <span class="input-group-addon">
            <button class="btn btn-default" type="button"><i class="fa fa-user"></i></button>
            </span>
            <input type="number" name="adults" class="form-control" placeholder="1 Adult" />
          </div>
          <div class="inner-addon left-addon form-group input-group hotels-group-persons"> <span class="input-group-addon">
            <button class="btn btn-default" type="button"><i class="fa fa-user"></i></button>
            </span>
            <input type="number" name="childs" class="form-control" placeholder="0 Child" />
          </div>
          <button class="btn btn-lg btn-warning" type="submit" name="btn_hotels_search" id="btn_hotels_search">Search</button>
        </form>
      </div>
      <div id="activities" class="tab-pane fade">
        <form action="{{ url('/searchactivities') }}" class="form-inline" role="form" method="post" name="frm_activities">
        {{ csrf_field() }}
          <div class="inner-addon left-addon form-group input-group" style="width: 80%;"> <span class="input-group-addon" style="width:50px">
            <button class="btn btn-default" type="button"><i class="fa fa-road" aria-hidden="true"></i></button>
            </span>
            <input required type="text" class="form-control" placeholder="Going to" name="txt_activity_name_location" id="txt_activity_name_location" />
          </div>
          <button class="btn btn-lg btn-warning" type="submit" name="btn_activities_search" id="btn_activities_search">Search</button>
        </form>
      </div>
      <div id="transport" class="tab-pane fade">
        <form class="form-inline" role="form">
          <div class="inner-addon left-addon form-group input-group">
            <input type="text" class="form-control" />
          </div>
          <div class="inner-addon left-addon form-group input-group">
            <input type="text" class="form-control" />
          </div>
          <div class="inner-addon left-addon form-group input-group">
            <input type="text" class="form-control" />
          </div>
          <button class="btn btn-lg btn-warning" type="button">Search</button>
        </form>
      </div>
    </div>
  </div>
  
  
  <div class="col-md-12 top-text">
    <div class="vertical-text"><small>Travel</small></div>
    <div class="font60" style="text-align:left">SERENE</div>
  </div>
  <div class="col-md-12 col-md-offset-1 middle-text">
    <div class="font60" style="text-align:left !important;">B H I M T A L </div>
    <div style="float:left;">ATMOSPHERE OF SERENE COUNTRY</div>
  </div>
  <div class="sidebar" style="display:none;">
    <div><a href="http://139.59.67.102/searchtours?name_location=Goa&tours_month=&btn_tours_search=">Goa &copy;</a></div>
    <div><a href="http://139.59.67.102/searchtours?name_location=Ladakh&tours_month=&btn_tours_search=">Ladakh &copy;</a></div>
    <div><a href="http://139.59.67.102/searchtours?name_location=Rajasthan&tours_month=&btn_tours_search=">Rajasthan &copy;</a></div>
    <div><a href="http://139.59.67.102/searchtours?name_location=Kerela&tours_month=&btn_tours_search=">kerela &copy;</a></div>
    <div><a href="#" class="allregions">All Regions</a></div>
    <div><a href="http://139.59.67.102/searchactivities?txt_activity_name_location_id=&txt_activity_name_location=&btn_activities_search=">All Activities</a></div>
  </div>
  <div class="btmspace">&nbsp;</div>
</div>
<div style="clear:both;"></div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel" style="color:#000000;">All Regions</h4>
      </div>
      <div class="modal-body" style="color:#000000;padding-top:5px">
        <div class="row">
          @if(!empty($regions))            
              @foreach($regions as $region)
              <?php $url = 'http://139.59.67.102/searchtours?name_location='.$region->city_location.'&tours_month=&btn_tours_search='; ?>
            <div class="col-md-6" style="padding:5"> <a href="<?php echo $url ?>">{!! $region->city_location !!}</a> </div>
              @endforeach           
            @endif             
        </div>
      </div>
      <div class="modal-footer" style="border-top:none;">
        <div class="col-md-4" style="padding-top:20px;border-top:none;">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endsection
@section('page_js')
<script type="text/javascript">
	$(document).ready(function() 
	{
		$(".allregions").click(function()
		{
			$('#myModal').modal('show');
			return false;
		});
		
		$('#txt_tours_name_location').bootcomplete({
      		url:'/tourlocations',
			minLength : 1
    		});
		$('#hotel_name_location').bootcomplete({
      		url:'/gethotels',
			minLength : 1
    		});
		
		$('#txt_activity_name_location').bootcomplete({
      		url:'/getactivities',
			minLength : 1
    		});
		
		var d = new Date();
	var strDate = d.getDate() + "-" + (d.getMonth()+1) + "-" + d.getFullYear();
	var minDate=strDate;
	var maxDate=strDate;
	var dateFormat = "dd-mm-yy";
	var $from = $("#fromdate");
  	var $to = $("#todate");
  
	$("#todate" ).datepicker(
    	{
    		numberOfMonths: 1,
      	showButtonPanel: false,
	      changeMonth: true,
      	changeYear: true,
		onSelect: function(selected) {
			$from.datepicker("option", "maxDate", selected);
		}
    	});
    	$( "#todate" ).datepicker( "option", "dateFormat", "dd-mm-yy");
	$( "#todate" ).datepicker( "option", "minDate", minDate);
	
	$("#todate" ).on( "change", function() 
	{
		var date = $(this).val();
		strDate = $.datepicker.parseDate( dateFormat, date );
		maxDate = strDate.getDate() + "-" + (strDate.getMonth()+1) + "-" + strDate.getFullYear();
	});
	
	$("#fromdate" ).datepicker(
	{
		numberOfMonths: 1,
      	showButtonPanel: false,
	      changeMonth: true,
      	changeYear: true,
		onSelect: function(selected) {
			$to.datepicker("option", "minDate", selected);
		}
	});
	$( "#fromdate" ).datepicker( "option", "dateFormat", "dd-mm-yy");
	$( "#fromdate" ).datepicker( "option", "minDate", minDate);
	
	$("#fromdate" ).on( "change", function() 
	{
		var date = $(this).val();
		strDate = $.datepicker.parseDate( dateFormat, date );
		minDate = strDate.getDate() + "-" + (strDate.getMonth()+1) + "-" + strDate.getFullYear();
	});
		
		$(".myTab").click(function()
		{ 
			$(".myTab").removeClass("active");
			$(this).addClass("active");
		});
		
	});
	</script>
@endsection