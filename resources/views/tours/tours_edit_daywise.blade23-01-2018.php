@extends('layouts.template')
@section('title','Edit Tour Daywise')
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
              <li class="breadcrumb-item active"><a href="{{ url('/tours-list') }}">Tour Listing</a></li>
              <li class="breadcrumb-item active">Edit Tour Daywise</li>
            </ol>
          </div>
          
          <div class="col-md-12">
            <form method="post" name="frm_add_tour_daywise">
              {{ csrf_field() }}            
             
              @for($i = 1; $i <= $tour_detail[0]->days; $i++)
              @if(isset($tour_daywise[$i-1]))
              <input type="hidden" name="hid_daywise[{!! $i !!}]" value="{!! $tour_daywise[$i-1]->itinerydata_id !!}" />
              <div class="col-md-6 form-line">
                <div class="form-group">
                  <label for="packagename">Day {!! $i !!} - Title</label>
                  <input type="text" name="txt_day{!! $i !!}" id="txt_day{!! $i !!}" placeholder="Day {!! $i !!} Title" value="{!! $tour_daywise[$i-1]->itinerydata_title !!}" class="form-control" required="required"/>
                </div>
                <div class="form-group">
                  <label for="packagename">Day {!! $i !!} - Description</label>
                  <textarea rows="6" name="desc_{!! $i !!}" id="desc_{!! $i !!}" class="form-control"  placeholder="Day {!! $i !!} Description">{!! $tour_daywise[$i-1]->itinerydata_description !!}</textarea>
                </div>
              </div>
              @endif
              @endfor
              <div class="form-group">
                <input type="submit" class="btn btn-primary submit" name="btn_edit_tour_daywise" id="btn_edit_tour_daywise" value="Save and continue">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection