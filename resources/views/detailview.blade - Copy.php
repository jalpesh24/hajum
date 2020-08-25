@extends('layouts.template')
@section('title','Detail View')
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
              <li class="breadcrumb-item active"><a href="{{ url('/mybooking') }}">My Booking</a></li>
              <li class="breadcrumb-item active">Detail View</li>
            </ol>
          </div>
          <div class="col-md-12"> 
          	<form method="post" name="frm_detailview">
              {{ csrf_field() }}
              @if(!empty($tour_detail))
             @foreach($tour_detail as $detailview)
              
              <div class="col-md-4 form-line">
                <div class="form-group">
                  <label for="exampleInputUsername">Tour Name</label>
                  <input type="text" class="form-control" value="{!! $detailview->tour_name !!}" disabled="disabled">
                  <label for="location" >Location</label>
                  <input type="text" class="form-control" value="{!! $detailview->city_location !!}" disabled="disabled">
                </div>
              </div>
              <div class="col-md-4 form-line">
                <div class="form-group">
                  <div class="col-md-6" style="padding-left:0px;">
                    <label for ="price">From Date</label>
                    <input type="text" class="form-control" value="{!! $detailview->fromdate !!}" disabled="disabled">
                  </div>
                  <div class="col-md-6" style="padding-right:0px;">
                    <label for ="price">To Date</label>
                    <input type="text" class="form-control" value="{!! $detailview->todate !!}" disabled="disabled">
                  </div>
                </div>
              </div>
              <div class="col-md-4 form-line">
                <div class="form-group">
                  <div class="col-md-6" style="padding-left:0px;">
                    <label for ="price">Price per person</label>
                    <input type="text" class="form-control" value="{!! $detailview->price_per_person !!}" disabled="disabled">
                  </div>
                  <div class="col-md-6" style="padding-right:0px;">
                    <label for ="price">Part of india</label>
                    <input type="text" class="form-control" value="{!! $detailview->partofindia !!}" disabled="disabled">
                  </div>
                </div>
              </div>
              <div class="col-md-4 form-line">
                <div class="form-group">
                  <div class="col-md-6" style="padding-left:0px;">
                    <label for ="price">Days</label>
                    <input type="text" class="form-control" value="{!! $detailview->days !!}" disabled="disabled">
                  </div>
                  <div class="col-md-6" style="padding-right:0px;">
                    <label for ="price">Nights</label>
                    <input type="text" class="form-control" value="{!! $detailview->nights !!}" disabled="disabled">
                  </div>
                </div>
              </div>
              <div class="col-md-4 form-line">
                <div class="form-group">
                  <div class="col-md-6" style="padding-left:0px;">
                    <label for ="price">Rating</label>
                    <input type="text" class="form-control" value="{!! $detailview->rating !!}" disabled="disabled">
                  </div>
                  <div class="col-md-6" style="padding-right:0px;">
                    <label for ="price"></label>
                    <input type="text" class="form-control" value="" disabled="disabled">
                  </div>
                </div>
              </div>
              @endforeach 
              @endif
              
              @if(!empty($activity_detail))
              @foreach($activity_detail as $detailview)
              <div class="col-md-4 form-line">
                <div class="form-group">
                  <label for="exampleInputUsername">Activity Name</label>
                  <input type="text" class="form-control" value="{!! $detailview->activities_name !!}" disabled="disabled">
                  <label for="location" >Location</label>
                  <input type="text" class="form-control" value="{!! $detailview->activities_location !!}" disabled="disabled">
                </div>
              </div>
              @endforeach
              @endif
              
               @if(!empty($hotel_detail))
              @foreach($hotel_detail as $detailview)
              <div class="col-md-4 form-line">
                <div class="form-group">
                  <label for="exampleInputUsername">Hotel Name</label>
                  <input type="text" class="form-control" value="{!! $detailview->hotel_name !!}" disabled="disabled">
                  <label for="location" >Location</label>
                  <input type="text" class="form-control" value="{!! $detailview->city_location !!}" disabled="disabled">
                </div>
              </div>
              <div class="col-md-4 form-line">
                <div class="form-group">
                  <label for="exampleInputUsername">Room Type</label>
                  <input type="text" class="form-control" value="{!! $hotel_room_detail[0]->hotel_roomtype !!}" disabled="disabled">
                  <label for="location" >Price</label>
                  <input type="text" class="form-control" value="{!! $hotel_room_detail[0]->hotel_saleprice !!}" disabled="disabled">
                </div>
              </div>
              @endforeach
              @endif
            </form>
            
            
            
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection 