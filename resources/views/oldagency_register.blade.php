@include('includes.newheader')
    <link rel="stylesheet" href="http://www.expertphp.in/css/bootstrap.css">    
    <script src="http://demo.expertphp.in/js/jquery.js"></script>
<div class="container">
<div class="breadcrumbs1">
<ol class="breadcrumb">
              <li class="breadcrumb-item"><i class="fa fa-home" aria-hidden="true"></i> <a href="{{ url('/newhome') }}">Home</a></li>
              <li class="breadcrumb-item active">Agency Register</li>
</ol>
</div>
  <div class="row">
    <div class="col-md-12">     
	
	@if(Session::has('success'))

	    <div class="alert alert-success">

	        {{ Session::get('success') }}

	        @php

	        Session::forget('success');

	        @endphp

	    </div>

	    @endif
		
          <form class="form-horizontal" role="form" method="POST" action="{{ url('/agency-register') }}">
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
			  <label for="country" class="col-md-4 control-label">Country</label>
			  <div class="col-md-4">
				<select name="country" id="country" class="form-control input-lg dynamic" data-dependent="state" required>
			     <option value="">Select Country</option>
			     @foreach($countries as $country)
			     <option value="{{ $country->id}}">{{ $country->name }}</option>
			     @endforeach
			    </select>         
			  </div>
			</div>

			<div class="form-group">
			  <label for="state" class="col-md-4 control-label">State</label>
			  <div class="col-md-4">
				<select name="state" id="state" class="form-control" style="width:350px" required>  </select>  
			  </div>
			</div>
			

			<div class="form-group">
			  <label for="city" class="col-md-4 control-label">City</label>
			  <div class="col-md-4">
				<select name="city" id="city" class="form-control" style="width:350px" required>
                </select>        
			  </div>
			</div>

      <div class="form-group">
        <label for="about" class="col-md-4 control-label">About us</label>
        <div class="col-md-4">
         <textarea rows="6" class="form-control" id="about" name="about" placeholder="Enter About us" ></textarea>          
        </div>
      </div>

       <div class="form-group">
              <label for="comp_url" class="col-md-4 control-label">Company Url</label>
              <div class="col-md-4">
                <input id="comp_url" type="text" class="form-control" name="comp_url">
              </div>
            </div>
			
       <div class="form-group">
              <label for="gsm" class="col-md-4 control-label">GSM</label>
              <div class="col-md-4">
                <input id="gsm" type="text" class="form-control" name="gsm">
              </div>
            </div>

             <div class="form-group">
              <label for="cont_name" class="col-md-4 control-label">Contact Name</label>
              <div class="col-md-4">
                <input id="cont_name" type="text" class="form-control" name="cont_name">
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-4 col-md-offset-4">     
                <input id="status" type="hidden" name="status" value="InActive">
                <button type="submit" class="btn btn-primary"> Register </button>
              </div>
            </div>
          </form>
        
    </div>
  </div>
</div>
@include('includes.newfooter')
<script type="text/javascript">
    $('#country').change(function(){
    var countryID = $(this).val();    
    if(countryID){
        $.ajax({
           type:"GET",
           url:"{{url('agency-register/get-state-list')}}?country_id="+countryID,
           success:function(res){               
            if(res){              
                $("#state").empty();
                $("#state").append('<option>Select</option>');
                $.each(res,function(key,value){
                   $("#state").append('<option value="'+value.id+'">'+value.name+'</option>');
                });
           
            }else{
               $("#state").empty();
            }
           }
        });
    }else{
        $("#state").empty();
        $("#city").empty();
    }      
   });
    $('#state').on('change',function(){
    var stateID = $(this).val();    
    if(stateID){
        $.ajax({
           type:"GET",
           url:"{{url('agency-register/get-city-list')}}?state_id="+stateID,
           success:function(res){               
            if(res){
                $("#city").empty();
                $.each(res,function(key,value){
                    $("#city").append('<option value="'+value.id+'">'+value.name+'</option>');
                });
           
            }else{
               $("#city").empty();
            }
           }
        });
    }else{
        $("#city").empty();
    }
        
   });
</script>

<script src="{{ asset('public/newhtml/js/bootstrap.js') }}"></script>
<script src="{{ asset('public/newhtml/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/newhtml/js/jqBootstrapValidation.js') }}"></script>
<script src="{{ asset('public/newhtml/js/clean-blog.min.js') }}"></script>
<script src="{{ asset('public/newhtml/js/jquery.bootcomplete.js') }}"></script>
<a href="#" id="toTop" style="display: inline;"><span id="toTopHover"></span></a><div id="ui-datepicker-div" class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all"></div></body></html>