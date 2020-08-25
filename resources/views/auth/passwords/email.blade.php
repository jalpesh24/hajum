@include('includes.newheader')
<div class="container">
<div class="breadcrumbs1">
<ol class="breadcrumb">
              <li class="breadcrumb-item"><i class="fa fa-home" aria-hidden="true"></i> <a href="{{ url('/newhome') }}">Home</a></li>
              <li class="breadcrumb-item active">Forgot Password</li>
</ol>
</div>
  <div class="row">
    <div class="col-md-12">
      <h2 class="section-heading">Forgot Password</h2>
      @if (session('status'))
      <div class="alert alert-success"> {{ session('status') }} </div>
      @endif
      <form class="form-horizontal" role="form" method="POST" action="{{ route('password.email') }}">
        {{ csrf_field() }}
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
          <label for="email" class="col-md-4 control-label">E-Mail Address</label>
          <div class="col-md-4">
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
            @if ($errors->has('email')) <span class="help-block"> <strong>{{ $errors->first('email') }}</strong> </span> @endif </div>
        </div>
        <div class="form-group">
          <div class="col-md-6 col-md-offset-4">
            <button type="submit" class="btn btn-primary"> Send Password Reset Link </button>
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