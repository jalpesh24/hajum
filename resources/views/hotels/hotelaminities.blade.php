@include('includes.newheader')
<div class="container">
<div class="breadcrumbs1">
<ol class="breadcrumb">
              <li class="breadcrumb-item"><i class="fa fa-home" aria-hidden="true"></i> <a href="{{ url('/newhome') }}">Home</a></li>
              <li class="breadcrumb-item active"> Add Hotel Aminities </li>
</ol>
</div>
  <div class="row">
    <div class="col-sm-12"> 
	@if(Session::has('success'))

	    <div class="alert alert-success">

	        {{ Session::get('success') }}

	        @php

	        Session::forget('success');

	        @endphp

	    </div>

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
              <li class="breadcrumb-item active">Add Hotel Aminities</li>
            </ol>
          </div>
         
          <div class="col-md-12">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('hotelaminities') }}">
        {{ csrf_field() }}
        
        <div class="form-group{{ $errors->has('catname') ? ' has-error' : '' }}">
          <label for="name" class="col-md-4 control-label">Category Name</label>
          <div class="col-md-4">
            <input id="aminity_name" type="text" class="form-control" name="aminity_name" value="{{ old('aminity_name') }}" required autofocus>
            @if ($errors->has('aminity_name')) <span class="help-block"> <strong>{{ $errors->first('aminity_name') }}</strong> </span> @endif </div>
        </div>
      
        <div class="form-group">
          <div class="col-md-6 col-md-offset-4">
            <button type="submit" class="btn btn-primary"> Add Aminities </button>
          </div>
        </div>
      </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
 @include('includes.newfooter')
<script src="{{ url('newhtml/js/jquery.js') }}"></script>
<script src="{{ url('newhtml/js/jquery-ui.js') }}"></script>
<script src="{{ url('newhtml/js/jquery-migrate-1.js') }}"></script>
<script src="{{ url('newhtml/js/superfish.js') }}"></script>
<script src="{{ url('newhtml/js/select2.js') }}"></script>
<script src="{{ url('newhtml/js/jquery_002.js') }}"></script>
<script src="{{ url('newhtml/js/jquery_006.js') }}"></script>
<script src="{{ url('newhtml/js/jquery_003.js') }}"></script>
<script src="{{ url('newhtml/js/jquery_007.js') }}"></script>
<script src="{{ url('newhtml/js/scripts.js') }}"></script>
<script src="{{ url('newhtml/js/owl.carousel.min.js') }}"></script>
<script src="{{ url('newhtml/js/bootstrap.min.js') }}"></script>

<a href="#" id="toTop" style="display: inline;"><span id="toTopHover"></span></a><div id="ui-datepicker-div" class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all"></div></body></html>