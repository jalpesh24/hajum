@include('includes.newheader')
<div class="container">
<div class="breadcrumbs1">
<ol class="breadcrumb">
              <li class="breadcrumb-item"><i class="fa fa-home" aria-hidden="true"></i> <a href="{{ url('/newhome') }}">Home</a></li>
              <li class="breadcrumb-item active">Register</li>
</ol>
</div>
  <div class="row">
    <div class="col-md-12"> 
    <h2 class="section-heading">Travel Agent Register</h2>  
		@if(Session::has('success'))

	    <div class="alert alert-success">

	        {{ Session::get('success') }}

	        @php

	        Session::forget('success');

	        @endphp

	    </div>

	    @endif	
          <form class="form-horizontal" role="form" method="POST" action="{{ url('/travelagent-register') }}" enctype="multipart/form-data">
            {{ csrf_field() }}     
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
              <label for="name" class="col-md-4 control-label">Name</label>
              <div class="col-md-4">
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                @if ($errors->has('name')) <span class="help-block"> <strong>{{ $errors->first('name') }}</strong> </span> @endif </div>
            </div>
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              <label for="email" class="col-md-4 control-label">E-Mail Address</label>
              <div class="col-md-4">
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                @if ($errors->has('email')) <span class="help-block"> <strong>{{ $errors->first('email') }}</strong> </span> @endif </div>
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
              <label for="password" class="col-md-4 control-label">Password</label>
              <div class="col-md-4">
                <input id="password" type="password" class="form-control" name="password" required>
                @if ($errors->has('password')) <span class="help-block"> <strong>{{ $errors->first('password') }}</strong> </span> @endif </div>
            </div>
            <div class="form-group">
              <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
              <div class="col-md-4">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
              </div>
            </div>
			
			<div class="form-group">
			  <label for="address" class="col-md-4 control-label">Address</label>
			  <div class="col-md-4">
				 <textarea rows="6" class="form-control" id="address" name="address" placeholder="Enter Address" ></textarea>          
			  </div>
			</div>
		
			<div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
			  <label for="phone" class="col-md-4 control-label">Phone No</label>
			  <div class="col-md-4">
			   <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}" required autofocus> 
				@if ($errors->has('phone')) <span class="help-block"> <strong>{{ $errors->first('phone') }}</strong> </span> @endif </div>
			</div>
			
			<div class="form-group">
			  <label for="bankdetails" class="col-md-4 control-label">Bank Details</label>			
			</div>
			
			<div class="form-group">
			  <label for="bankdetails" class="col-md-4 control-label">Bank Name</label>
			  <div class="col-md-4">
				 <input type="text" rows="6" class="form-control" id="bankname" name="bankname" placeholder="Enter bankname" >   
			  </div>
			</div>
			<div class="form-group">
			  <label for="bankdetails" class="col-md-4 control-label">Bank Account No</label>
			  <div class="col-md-4">
				 <input type="text" rows="6" class="form-control" id="baccno" name="baccno" placeholder="Enter acc no" >   
			  </div>
			</div>
			
			<div class="form-group">
			  <label for="bankdetails" class="col-md-4 control-label">Bank IFSC Code</label>
			  <div class="col-md-4">
				 <input type="text" rows="6" class="form-control" id="bankcode" name="bankcode" placeholder="Enter ifsccode" >   
			  </div>
			</div>
			
			<div class="form-group">
			  <label for="bankdetails" class="col-md-4 control-label">Upload Documents</label>
			  <div class="col-md-4">
				 <input type="file" class="form-control" name="filename[]" multiple autofocus>
			  </div>
			</div>
			
            <div class="form-group">
              <div class="col-md-4 col-md-offset-4">
                <input id="ticketit_agent" type="hidden" name="ticketit_agent" value="1">
                <input id="status" type="hidden" name="status" value="InActive">
                <button type="submit" class="btn btn-primary"> Register </button>
              </div>
            </div>
          </form>
        
    </div>
  </div>
</div>

  
  @include('includes.newfooter')

<script src="{{ url('newhtml/js/bootstrap.js') }}"></script>
<script src="{{ url('newhtml/js/bootstrap.min.js') }}"></script>
<script src="{{ url('newhtml/js/jqBootstrapValidation.js') }}"></script>
<script src="{{ url('newhtml/js/clean-blog.min.js') }}"></script>
<script src="{{ url('newhtml/js/jquery.bootcomplete.js') }}"></script>
<a href="#" id="toTop" style="display: inline;"><span id="toTopHover"></span></a><div id="ui-datepicker-div" class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all"></div></body></html> 