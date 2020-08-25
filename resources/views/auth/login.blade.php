@include('includes.newheader')
<script type="text/javascript">
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

<!-- Styles -->
<div class="container">
<div class="breadcrumbs1">
<ol class="breadcrumb">
              <li class="breadcrumb-item"><i class="fa fa-home" aria-hidden="true"></i> <a href="{{ url('/newhome') }}">Home</a></li>
              <li class="breadcrumb-item active">Login</li>
</ol>
</div>
  <div class="row">
    <div class="col-md-12">
      <h1 class="section-heading">Login</h1>
      @if ($errors->has('email'))
      <div class="col-md-12">
        <div class="alert alert-danger"> <strong>{{ $errors->first('email') }}</strong></div>
      </div>
      @endif
      <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
          <label for="email" class="col-md-4 control-label" style="color:#FFF;">E-Mail Address</label>
          <div class="col-md-4">
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
          </div>
        </div>
        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
          <label for="password" class="col-md-4 control-label" style="color:#FFF;">Password</label>
          <div class="col-md-4">
            <input id="password" type="password" class="form-control" name="password" required>
            @if ($errors->has('password')) <span class="help-block"> <strong>{{ $errors->first('password') }}</strong> </span> @endif </div>
        </div>
        <div class="form-group">
          <div class="col-md-6 col-md-offset-4">
            <div class="checkbox">
              <label>
              <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
              <span style="color:#000;">Remember Me</span> </label>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-2 col-md-offset-4">
            <button type="submit" class="btn btn-primary"> Login </button>
          </div>
          <div class="col-md-2 "> 
          <a class="btn btn-link" href="{{ url('user-register') }}"> Signup User</a> 
          <!-- <a class="btn btn-link" href="{{ url('agent-register') }}"> Signup Operator Agent </a> 
          <a class="btn btn-link" href="{{ url('travelagent-register') }}"> Signup Travel Agent </a>
           --> 
           <a class="btn btn-link" href="{{ url('agency-register') }}"> Signup Agency</a>
								  <!-- <a class="btn btn-link" href="{{ url('hotelagent-register') }}"> Signup Hotel Agent </a> -->
                                  </div>   
          <div class="col-md-6  col-md-offset-6"> <a class="btn btn-link" href="{{ route('password.request') }}"> Forgot Password? </a> </div>
        </div>
      </form>
    </div>
  </div>
</div>

  @include('includes.newfooter')

  
<script src="{{ asset('public/newhtml/js/bootstrap.js') }}"></script>
<script src="{{ asset('public/newhtml/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/newhtml/js/jqBootstrapValidation.js') }}"></script>
<script src="{{ asset('public/newhtml/js/clean-blog.min.js') }}"></script>
<script src="{{ asset('public/newhtml/js/jquery.bootcomplete.js') }}"></script>
<a href="#" id="toTop" style="display: inline;"><span id="toTopHover"></span></a><div id="ui-datepicker-div" class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all"></div></body></html>