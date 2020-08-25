@extends('layouts.template')
@section('title', 'Register New User')
@section('keywords', 'Register New User')
@section('description', 'Register New User')
@section('content')
<div class="container bg">
  <div class="row">
    <div class="col-md-12">
      <h1 class="section-heading">User Register</h1>
      <form class="form-horizontal" role="form" method="POST" action="{{ route('registeruser') }}">
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
        <input id="status" type="hidden" name="status" value="InActive">
        <div class="form-group">
          <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
          <div class="col-md-4">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
          </div>
        </div>
        
        <div class="form-group">
          <div class="col-md-6 col-md-offset-4">
            <button type="submit" class="btn btn-primary"> Register </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection 