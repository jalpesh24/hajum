<!-- Navigation -->
<div class="container-fluid">
<style>
@media screen and (min-width: 768px) {		
	#nav { padding-top:20px;} 
	#topmenu {display:none;}
}
</style>  
<div id="nav">
  <nav class="navbar" id="topmenu">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i> </button>
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" >
            <ul class="nav navbar-nav" >
              <li><a href="{{ url('/newabout') }}">ABOUT US </a></li>
              <li><a href="{{ url('/newoffers') }}">OFFERS</a></li>
              <li><a href="{{ url('/newtestimonial') }}">TESTIMONIALS</a></li>
              <li><a href="{{ url('/tickets') }}">SUPPORT</a></li>
              <li><a href="{{ url('/login') }}">TRAVEL AGENTS</a></li>
              <li><a href="{{ url('/') }}">RED BUS</a></li>
            </ul>
          </div>
        </nav>
</div>        
    <div class="col-sm-2" >
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header page-scroll" style="display:none;">
        <div class="dropdown first caret-tab">
          <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown"> EN <span class="caret"></span> </button>
          <ul class="dropdown-menu">
            <li><a href="#">EN</a></li>
            <li><a href="#">FR</a></li>
            <li><a href="#">DE</a></li>
            <li><a href="#">HI</a></li>
          </ul>
        </div>
        <!--img src="img/seperator.png" align="left" ;-->
        <div class="dropdown caret-tab">
          <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown"> USD <span class="caret"></span> </button>
          <ul class="dropdown-menu">
            <li><a href="#">USD</a></li>
            <li><a href="#">AUD</a></li>
            <li><a href="#">EUR</a></li>
            <li><a href="#">INR</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-sm-2 where-go"> 
      <div class="dropdown" id="india" style="float:left;display:inline-block"><small>Where do you want to go?</small>
        <form action="{{ url('/search') }}">
        	<input type="text" name="txt_search_india" id="txt_search_india" class="form-control" placeholder="Where do you want to go?" />
      	</form>
      </div>
    </div>
    <div class="col-sm-4 social" align="center"> 
    <img src="{{ url('public/img/facebook.png') }}"> 
    <img src="{{ url('public/img/youtube.png') }}"> 
    <img src="{{ url('public/img/googleplus.png') }}"> 
    <img src="{{ url('public/img/instagram.png') }}"> 
    <img src="{{ url('public/img/linkedin.png') }}"> 
    <img src="{{ url('public/img/pinterest.png') }}"> </div>
    <div class="col-sm-3 call-us"> <small class="enquiry">Call Us for enquiries:</small>
      <big>1 800 707-44-09</big> 
     <!--Search box start  -->
    <style>.search-form .form-group {
  float: right !important;
  transition: all 0.35s, border-radius 0s;
  width: 32px;
  height: 32px;
 
  box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
  border-radius: 25px;
 
}
.search-form .form-group input.form-control {
  padding-right: 20px;
  border: 0 none;
  background: transparent;
  box-shadow: none;
  display:block;
}
.search-form .form-group input.form-control::-webkit-input-placeholder {
  display: none;
}
.search-form .form-group input.form-control:-moz-placeholder {
  /* Firefox 18- */
  display: none;
}
.search-form .form-group input.form-control::-moz-placeholder {
  /* Firefox 19+ */
  display: none;
}
.search-form .form-group input.form-control:-ms-input-placeholder {
  display: none;
}
.search-form .form-group:hover,
.search-form .form-group.hover {
  width: 100%;
 
   background-color: #fff;
}
.search-form .form-group span.form-control-feedback {
  position: absolute;
  top: -1px;
  right: -2px;
  z-index: 2;
  display: block;
  width: 34px;
  height: 34px;
  line-height: 34px;
  text-align: center;
  color: #3596e0;
  left: initial;
  font-size: 14px;
}

	</style>    
            <form action="{{ url('/search') }}" class="search-form">
                <div class="form-group has-feedback">            		
            		<input type="text" class="form-control" name="search" id="search" placeholder="search">
              		<img src="{{ url('public/img/search.png') }}"  class="search-img" align="right"> 
            	</div>
            </form>
       
     <!--Search box ends -->      
      
      </div>
    <div class="col-md-1 last-border">
     <a href="{{ url('/login') }}"><img src="{{ url('public/img/default_avatar.png') }}"  class="sign" align="right"></a> </div>
  </div>
  <!-- /.container -->
  <hr />


<!-- Page Header -->
<div style="clear:both;"></div>
<!-- Set your background image for this header on the line below. -->

@section('page_js')
<script type="text/javascript">
$(document).ready(function() 
{
	$( "#txt_search_india" ).on( "keydown", function(event) {
      
    });
});	
</script>
@endsection