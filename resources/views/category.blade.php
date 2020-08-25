@include('includes.newheader')
<div class="container">
<div class="breadcrumbs1">
<ol class="breadcrumb">
              <li class="breadcrumb-item"><i class="fa fa-home" aria-hidden="true"></i> <a href="{{ url('/newhome') }}">Home</a></li>
              <li class="breadcrumb-item active">Add Category</li>
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
                 
          <div class="col-md-12">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('addcategory') }}">
        {{ csrf_field() }}
        
        <div class="form-group{{ $errors->has('catname') ? ' has-error' : '' }}">
          <label for="name" class="col-md-4 control-label">Category Name</label>
          <div class="col-md-4">
            <input id="catname" type="text" class="form-control" name="catname" value="{{ old('name') }}" required autofocus>
            @if ($errors->has('catname')) <span class="help-block"> <strong>{{ $errors->first('catname') }}</strong> </span> @endif </div>
        </div>
         <div class="form-group{{ $errors->has('catdiscount') ? ' has-error' : '' }}">
          <label for="catdiscount" class="col-md-4 control-label">Category Discount</label>
          <div class="col-md-4">
            <input id="catdiscount" type="number" class="form-control" name="catdiscount" required>
            @if ($errors->has('catdiscount')) <span class="help-block"> <strong>{{ $errors->first('catdiscount') }}</strong> </span> @endif </div>
        </div>
       
        <div class="form-group">
          <div class="col-md-6 col-md-offset-4">
            <button type="submit" class="btn btn-primary"> Add Category </button>
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