@extends('layouts.template')
@section('title','Edit Tour Place Visits')
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
          <div class="col-md-6">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><i class="fa fa-home" aria-hidden="true"></i> <a href="{{ url('/dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{ url('/tours-list') }}">Tour Listing</a></li>
              <li class="breadcrumb-item active">Edit Tour Place Visits</li>
            </ol>
          </div>
          <div class="col-md-12">
            <form method="post" name="frm_edit_tour_placevisit">
              {{ csrf_field() }}
              @for($i = 1; $i <= $tour_detail[0]->no_places; $i++)
              <input type="hidden" name="hid_placevisit[{!! $i !!}]" value="{!! $tour_placevisit[$i-1]->	pvisit_id !!}" />
              <div class="col-md-6 form-line">
                <div class="form-group">
                  <label for="packagename">Place {!! $i !!} - Name</label>
                  <input type="text" name="txt_place{!! $i !!}" id="txt_place{!! $i !!}" placeholder="Place {!! $i !!} Name" class="form-control" required="required" value="{!! $tour_placevisit[$i-1]->pvisit_name !!}" />
                </div>
                <div class="form-group">
                  <label for="packagename">Place {!! $i !!} - Description</label>
                  <textarea rows="6" name="desc_{!! $i !!}" id="desc_{!! $i !!}" class="form-control" placeholder="Place {!! $i !!} Description">{!! $tour_placevisit[$i-1]->pvisit_description !!}</textarea>
                </div>
              </div>
              @endfor
              <div style="clear:both"></div>
              <div class="col-md-6 form-group">
                <input type="submit" class="btn btn-primary submit" name="btn_edit_tour_placevisit" id="btn_edit_tour_placevisit" value="Save">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection