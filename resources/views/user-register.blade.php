@extends('layouts.front')
@section('title', 'User Register')
@section('content')
<section id="signup" class="content_inner">
  <div class="container">
    <div class="row">
      <div class="col-12 text-center">
        <h1 class="section-heading">User Register</h1>
    
        @if(Session::has('success'))

      <div class="alert alert-success">

          {{ Session::get('success') }}

          @php

          Session::forget('success');

          @endphp

      </div>

      @endif
        <div class="form_box">
            <h1>Register</h1>
            <p>Use your personal email to create new account.</p>
             <form class="form-horizontal" role="form" method="POST" action="{{ url('user-register') }}">
        {{ csrf_field() }}
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                  <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Full Name" required autofocus>
                  @if ($errors->has('name')) <span class="help-block"> <strong>{{ $errors->first('name') }}</strong> </span> @endif                   
                </div>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                  <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email Address" required>
                  @if ($errors->has('email')) <span class="help-block"> <strong>{{ $errors->first('email') }}</strong> </span> @endif
                    
                </div>
             
                <div class="form-group">
                    <select name="country" id="country" class="form-control input-lg dynamic" data-dependent="state" required>
                     <option value="">Select Country</option>
                     @foreach($countries as $country)
                     <option value="{{ $country->id}}">{{ $country->name }}</option>
                     @endforeach
                    </select> 
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                 
                    <input id="password" type="password" class="form-control" name="password" placeholder="Agency password" required>
                @if ($errors->has('password')) <span class="help-block"> <strong>{{ $errors->first('password') }}</strong> </span> @endif 
                </div>
                 <div class="form-group">
                 
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirmation password" required>
                </div>

                <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                  
                     <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}" placeholder="phone no" required autofocus> 
                     @if ($errors->has('phone')) <span class="help-block"> <strong>{{ $errors->first('phone') }}</strong> </span> @endif 
                </div>

                <div class="form-group">
                    <textarea rows="6" class="form-control" id="address" name="address" placeholder="Enter Address" ></textarea>      
                </div>

               
                <input id="status" type="hidden" name="status" value="InActive">
                <button type="submit" class="btn btn-primary"> SIGN UP NOW </button>
               <!--  <input type="submit" value="SIGN UP NOW"> -->
            </form>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
