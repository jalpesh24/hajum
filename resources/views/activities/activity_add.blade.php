@extends('layouts.template')
@section('title','Add New Activities')
@section('page_css')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection
@section('content')
<div class="container">
  <div class="row">
    <div class="col-sm-12"> @if (session('status'))
      <div class="alert alert-success">{{ session('status') }}</div>
      @endif
      <div class="panel panel-default" id="panelbg">
        <div class="panel-heading" id="headerbg">
         @if (Auth::guest())              
         @else
	     @include('includes.minimenu')              
         @endif
        </div>
        <div class="panel-body">
          <div class="col-sm-4">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><i class="fa fa-home" aria-hidden="true"></i> <a href="{{ url('/dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{ url('/activitylist') }}">Activity Listing</a></li>
              <li class="breadcrumb-item active">Add New Activity</li>
            </ol>
          </div>
          <div class="col-md-12">
            <form method="post" name="frm_add_activities" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="col-md-6 form-line">
                <div class="form-group">
                  <label for="packagename">Activity name</label>
                  <input type="text" class="form-control" id="activities_name" placeholder="Activity Name" name="activities_name" required="required">
                </div>
              </div>
              <div class="col-md-6 form-line">
                <div class="form-group">
                  <label>Location</label>
                  <input type="text" class="form-control" name="activities_location" id="activities_location" placeholder="Activity Location" required="required" />
                </div>
              </div>
              <div class="col-md-12 form-line">
                <div class="form-group">
                  <div class="col-md-6" style="padding-left:0px;">
                    <label for="packagename">Image</label>
                    {!! Form::file('mainimg', array('id'=>'mainimage','required'=>'required')) !!} </div>
                </div>
                <div class="col-md-3" style="padding-right:0px;">
                  <div class="form-group">
                    <label for ="activities_price">Price</label>
                    <input type="text" class="form-control" name="activities_price" id="activities_price" placeholder="Activity Price" required="required" />
                  </div>
                </div>
                <div class="col-md-3" style="padding-right:0px;">
                  <div class="form-group">
                    <label>Category</label>
                    <select name="activities_category" id="activities_category" class="form-control">
                      <option value="Outdoor Fun" selected="OUTDOOR FUN">OUTDOOR FUN</option>
                      <option value="Transfers & Transport">TRANSFERS & TRANSPORT</option>
                      <option value="Tours & Sightseeing">TOURS & SIGHTSEEING</option>
                      <option value="Food">FOOD</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-12 form-line">
                <div class="col-md-4" style="padding-left:0px;">
                  <div class="form-group">
                    <label>Meeting Point</label>
                    <input type="text" class="form-control" name="activities_meeting_point" id="activities_meeting_point" placeholder="Enter Point." >
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for ="price">Meeting Time</label>
                    <input type="text" class="form-control" name="activities_meeting_time" id="activities_meeting_time" placeholder="Meeting Time." >
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label>Duration</label>
                    <input type="text" class="form-control" name="activity_duration" id="activity_duration" placeholder="Enter Duration">
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for ="price">Rating</label>
                    <input type="text" class="form-control" name="activities_rating" id="activities_rating" placeholder="Meeting Time." >
                  </div>
                </div>
                <div class="col-md-2" style="padding-right:0px;">
                  <div class="form-group">
                    <label>Status</label>
                    <select name="activities_status" id="activities_status" class="form-control">
                      <option value="Active" selected="Active">Active</option>
                      <option value="Inactive">Inactive</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-12 form-line">
                <div class="form-group">
                  <label for="packagename">Description</label>
                  <textarea rows="6" class="form-control" id="activities_description" name="activities_description" placeholder="Enter Description" ></textarea>
                </div>
              </div>
              <div class="col-md-12 form-line">
                <div class="form-group">
                  <label for="packagename">Additional Information</label>
                  <textarea rows="6" class="form-control" id="activities_additional_info" name="activities_additional_info" placeholder="Enter Additional Information" ></textarea>
                </div>
              </div>
              <div class="col-md-12 form-line">
                <div class="form-group">
                  <label for="packagename">Highlights</label>
                  <textarea rows="6" class="form-control" id="activities_highlights" name="activities_highlights" placeholder="Enter Highlights" ></textarea>
                </div>
              </div>
              <div class="col-md-12 form-line">
                <div class="form-group">
                  <label for="packagename">Terms & Conditions</label>
                  <textarea rows="6" class="form-control" id="activities_terms_condition" name="activities_terms_condition" placeholder="Enter Terms & Conditions" ></textarea>
                </div>
              </div>
              
              <div class="col-md-6 form-line">
                <div class="form-group">
                  <input type="submit" class="btn btn-primary submit" name="btn_add_activities" id="btn_add_activities" value="Save">
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