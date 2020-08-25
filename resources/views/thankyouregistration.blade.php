@extends('layouts.template')
@section('title','Dashboard')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
         <div class="panel panel-default" id="panelbg">
         <div class="panel-heading" id="headerbg">
         @if (Auth::guest())              
         @else
	     @include('includes.minimenu')              
         @endif 
          
        </div>
        
        <div class="panel-body" >
          <div class="col-sm-4">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><i class="fa fa-home" aria-hidden="true"></i> <a href="{{ url('/dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Thank You For Registrtion</li>
            </ol>
          </div>
          <div class="col-md-12"> Your Registration Successfull Account will be activated soon! </div>
          <a href="{{ url('/login') }}"> Back </a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection 