@extends('layouts.front')
@section('title', 'Agency Register')
@section('content')
<section id="agency-signup" class="content_inner">
  <div class="container">
    <div class="row">
      <div class="col-12 text-center">
        @if(Session::has('success'))

      <div class="alert alert-success">

          {{ Session::get('success') }}

          @php

          Session::forget('success');

          @endphp

      </div>

      @endif
        <div class="form_box">
            <h1>Agency</h1>
            <p>Create new agency account.</p>
             <form class="form-horizontal" role="form" method="POST" action="{{ url('/agency-register') }}">
            {{ csrf_field() }}  
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
               
                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Agency name" required autofocus>
                @if ($errors->has('name')) <span class="help-block"> <strong>{{ $errors->first('name') }}</strong> </span> @endif 
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                 
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Agency Email"  required>
                @if ($errors->has('email')) <span class="help-block"> <strong>{{ $errors->first('email') }}</strong> </span> @endif 
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                 
                    <input id="password" type="password" class="form-control" name="password" placeholder="Agency password" required>
                @if ($errors->has('password')) <span class="help-block"> <strong>{{ $errors->first('password') }}</strong> </span> @endif 
                </div>

                <div class="form-group">
                 
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Agency confirmation password" required>
                </div>

                <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                  
                     <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}" required autofocus> 
                     @if ($errors->has('phone')) <span class="help-block"> <strong>{{ $errors->first('phone') }}</strong> </span> @endif 
                </div>

                <div class="form-group">
                    <textarea rows="6" class="form-control" id="address" name="address" placeholder="Enter Address" ></textarea>      
                </div>

                <div class="form-group">
                  
                    <textarea rows="6" class="form-control" id="about" name="about" placeholder="Enter About us" ></textarea> 
                </div>

                <div class="form-group">
                    <select name="country" id="country" class="form-control input-lg dynamic" data-dependent="state" required>
                     <option value="">Select Country</option>
                     @foreach($countries as $country)
                     <option value="{{ $country->id}}">{{ $country->name }}</option>
                     @endforeach
                    </select> 
                </div>
                <div class="form-group">
                    <select name="state" id="state" class="form-control" style="width:350px" required>  </select>
                </div>
                <div class="form-group">
                    <select name="city" id="city" class="form-control" style="width:350px" required>
                </select> 
                </div>
               
                  <div class="form-group">
                    <input id="comp_url" type="text" class="form-control" name="comp_url" placeholder="Compnay url">
                </div>

              
                  <div class="form-group">
                    <input id="gsm" type="text" class="form-control" name="gsm" placeholder="Enter GSM">
                </div>

                
                  <div class="form-group">
                   <input id="cont_name" type="text" class="form-control" name="cont_name" placeholder="Enter Contact Name" >
                </div>
                <input id="status" type="hidden" name="status" value="Active">
                <button type="submit" class="btn btn-primary"> Register </button>

                <!-- <input type="submit" value="submit"> -->
            </form>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
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