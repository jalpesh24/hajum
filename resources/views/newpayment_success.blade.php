@include('includes.newheader')
<div class="container">
<div class="breadcrumbs1">
<ol class="breadcrumb">
              <li class="breadcrumb-item"><i class="fa fa-home" aria-hidden="true"></i> <a href="{{ url('/newhome') }}">Home</a></li>
              <li class="breadcrumb-item active">Payment Success</li>
</ol>
</div>
  <div class="row">
    <div class="col-sm-12"> @if (session('status'))
      <div class="alert alert-success">{{ session('status') }}</div>
      @endif
      <div class="panel panel-default" id="panelbg">     
        <div class="panel-body">          
          <div class="col-sm-4">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><i class="fa fa-home" aria-hidden="true"></i> <a href="{{ url('/dashboard') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ url('/mybooking') }}">My Booking</a></li>
              <li class="breadcrumb-item active">Payment success</li>
            </ol>
          </div>
          <div class="col-md-12">
            <div class="panel panel-default">
              <div class="container">
                <div class="row text-center">
                  <div class="col-sm-6 col-sm-offset-3"> <br>
                    <br>
                    <h2 style="color:#0fad00">Success</h2>
                    <img src="{{ url('newhtml/images/payu.png') }}" style="height:32px;">
                    <h3>Dear, User</h3>
                    <p style="font-size:20px;color:#5C5C5C;">Thank you for purchasing tour packaging.</p>
                    <br>
                    <br>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
  
  @include('includes.newfooter')


<a href="#" id="toTop" style="display: inline;"><span id="toTopHover"></span></a><div id="ui-datepicker-div" class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all"></div></body></html>
