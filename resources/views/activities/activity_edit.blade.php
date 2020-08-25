@extends('layouts.template')
@section('title','Edit Activity')
@section('page_css')
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection
@section('content')
<div class="container">
	<div class="row">
      	<div class="col-sm-12">
            	<div class="panel panel-default" id="panelbg">
                  	<div class="panel-heading" id="headerbg">
                        @if (!Auth::guest())
                              @include('includes.minimenu')
                        @endif
				</div>
                  
                        <div class="panel-body">
                              <div class="col-sm-4">
                              <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><i class="fa fa-home" aria-hidden="true"></i> <a href="{{ url('/dashboard') }}">Home</a></li>
                                    <li class="breadcrumb-item active"><a href="{{ url('/allactivities') }}">Activity Listing</a></li>
                                    <li class="breadcrumb-item active">Edit Activity</li>
                              </ol>
                              </div>
                              
                              <div class="col-md-12">
            <form method="post" name="frm_edit_activities" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="col-md-6 form-line">
                <div class="form-group">
                  <label for="activities_name">Activity name</label>
                  <input type="text" class="form-control" id="activities_name" placeholder="Activity Name" name="activities_name" required="required" value="{!! $activity[0]->activities_name !!}">
                </div>
              </div>
              <div class="col-md-6 form-line">
                <div class="form-group">
                  <label for="activities_location">Location</label>
                  <input type="text" class="form-control" name="activities_location" id="activities_location" placeholder="Activity Location" required="required" value="{!! $activity[0]->activities_location !!}" />
                </div>
              </div>
              <div class="col-md-12 form-line">
                <div class="form-group">
                  <div class="col-md-6" style="padding-left:0px;">
                    <label for="mainimage">Image</label>
                    <input type="file"  id="mainimage" placeholder="Upload image" name="mainimage">
                    @if($activity[0]->activities_image != '')
                    <img src="{{ asset('/activities/'.$activity[0]->activities_image) }}" height="150" width="150" />
                    <input type="hidden" name="old_activity_image" id="old_activity_image" value="{!! $activity[0]->activities_image !!}" />
                    @endif
                    </div>
                </div>
                <div class="col-md-3" style="padding-right:0px;">
                  <div class="form-group">
                    <label for="activities_price">Price</label>
                    <input type="text" class="form-control" name="activities_price" id="activities_price" placeholder="Activity Price" required="required" value="{!! $activity[0]->activities_price !!}" />
                  </div>
                </div>
                <div class="col-md-3" style="padding-right:0px;">
                  <div class="form-group">
                    <label for="activities_category">Category</label>
                    <select name="activities_category" id="activities_category" class="form-control">
                    	@if($activity[0]->activities_category == 'Outdoor Fun')
                    	<option value="Outdoor Fun" selected="selected">OUTDOOR FUN</option>
                     	@else
                        <option value="Outdoor Fun">OUTDOOR FUN</option>
                        @endif
                     	
                        @if($activity[0]->activities_category == 'Transfers & Transport')
                      	<option value="Transfers & Transport" selected="selected">TRANSFERS & TRANSPORT</option>
                        @else
                        <option value="Transfers & Transport">TRANSFERS & TRANSPORT</option>
                        @endif
                        
                        @if($activity[0]->activities_category == 'Tours & Sightseeing')
                      	<option value="Tours & Sightseeing" selected="selected">TOURS & SIGHTSEEING</option>
                        @else
                        <option value="Tours & Sightseeing">TOURS & SIGHTSEEING</option>
                        @endif
                      	
                        @if($activity[0]->activities_category == 'Food')
                      	<option value="Food" selected="selected">FOOD</option>
                        @else
                        <option value="Food">FOOD</option>
                        @endif
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-12 form-line">
                <div class="col-md-4" style="padding-left:0px;">
                  <div class="form-group">
                    <label for="activities_meeting_point">Meeting Point</label>
                    <input type="text" class="form-control" name="activities_meeting_point" id="activities_meeting_point" placeholder="Enter Point."  value="{!! $activity[0]->activities_meeting_point !!}">
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="activities_meeting_time">Meeting Time</label>
                    <input type="text" class="form-control" name="activities_meeting_time" id="activities_meeting_time" placeholder="Meeting Time." value="{!! $activity[0]->activities_meeting_time !!}">
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="activity_duration">Duration</label>
                    <input type="text" class="form-control" name="activity_duration" id="activity_duration" placeholder="Enter Duration" value="{!! $activity[0]->activities_duration !!}">
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="activities_rating">Rating</label>
                    <input type="text" class="form-control" name="activities_rating" id="activities_rating" placeholder="Rating" value="{!! $activity[0]->activities_rating !!}">
                  </div>
                </div>
                <div class="col-md-2" style="padding-right:0px;">
                  <div class="form-group">
                    <label for="activities_status">Status</label>
                    <select name="activities_status" id="activities_status" class="form-control">
                    	@if($activity[0]->activities_status == 'Active')
                    	<option value="Active" selected="selected">Active</option>
                     	@else
                        <option value="Active">Active</option>
                        @endif
                        
                      	@if($activity[0]->activities_category == 'Inactive')
                    	<option value="Inactive" selected="selected">Inactive</option>
                     	@else
                        <option value="Inactive">Inactive</option>
                        @endif
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-12 form-line">
                <div class="form-group">
                  <label for="activities_description">Description</label>
                  <textarea rows="6" class="form-control" id="activities_description" name="activities_description" placeholder="Enter Description" >{!! $activity[0]->activities_description !!}</textarea>
                </div>
              </div>
              <div class="col-md-12 form-line">
                <div class="form-group">
                  <label for="activities_additional_info">Additional Information</label>
                  <textarea rows="6" class="form-control" id="activities_additional_info" name="activities_additional_info" placeholder="Enter Additional Information" >{!! $activity[0]->activities_additional_info !!}</textarea>
                </div>
              </div>
              <div class="col-md-12 form-line">
                <div class="form-group">
                  <label for="packagename">Highlights</label>
                  <textarea rows="6" class="form-control" id="activities_highlights" name="activities_highlights" placeholder="Enter Highlights" >{!! $activity[0]->activities_highlights !!}</textarea>
                </div>
              </div>
               <div class="col-md-12 form-line">
                <div class="form-group">
                  <label for="packagename">Terms & Conditions</label>
                  <textarea rows="6" class="form-control" id="activities_terms_condition" name="activities_terms_condition" placeholder="Enter Terms & Conditions" >{!! $activity[0]->activities_terms_condition !!}</textarea>
                </div>
              </div>
              <div class="col-md-6 form-line">
                <div class="form-group">
                  <input type="submit" class="btn btn-primary submit" name="btn_edit_activity" id="btn_edit_activity" value="Save">
                </div>
              </div>
            </form>
          </div>
                        </div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('page_js')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
$(document).ready(function() 
{
	var d = new Date();
	//var strDate = d.getDate() + "-" + (d.getMonth()+1) + "-" + d.getFullYear();
	var strDate = $("#fromdate").val();
	var minDate= $("#fromdate").val();
	var maxDate=$("#todate").val();
	var dateFormat = "dd-mm-yy";
	$("#txt_hotel_fromdate").val(minDate);
	$("#txt_hotel_todate").val(maxDate);
	
	$("#txt_hotel_fromdate" ).datepicker(
	{
		numberOfMonths: 1,
      	showButtonPanel: false,
	      changeMonth: true,
      	changeYear: true
	});
	$( "#txt_hotel_fromdate" ).datepicker( "option", "dateFormat", "dd-mm-yy");
	$( "#txt_hotel_fromdate" ).datepicker( "option", "minDate", minDate);
	
	$("#txt_hotel_fromdate" ).on( "change", function() 
	{
		var date = $(this).val();
		strDate = $.datepicker.parseDate( dateFormat, date );
		maxDate = strDate.getDate() + "-" + (strDate.getMonth()+1) + "-" + strDate.getFullYear();
		$("#txt_hotel_fromdate").val(minDate);
		$("#txt_hotel_todate").val(maxDate);
	});
	
	$("#txt_hotel_todate" ).datepicker(
    	{
    		numberOfMonths: 1,
      	showButtonPanel: false,
	      changeMonth: true,
      	changeYear: true
    	});
    	$( "#txt_hotel_todate" ).datepicker( "option", "dateFormat", "dd-mm-yy");
	$( "#txt_hotel_todate" ).datepicker( "option", "minDate", minDate);
});
</script>
@endsection