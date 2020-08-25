<div style="clear:both;"></div>
<!-- Footer -->
<hr>
<footer>
  <div class="container">
    <div class="row">
      <div class="col-md-3 col-sm-4 col-xs-4">
        <label style="border-bottom:1px solid">Company</label>
        <ul class="box">
          <li><a href="{{ url('/about-us') }}">About us</a></li>
          <li><a href="{{ url('/offers') }}">Offers</a></li>
          <li><a href="{{ url('/blog') }}">Blog</a></li>
          <li><a href="{{ url('/quality') }}">Quality</a></li>
          <li><a href="{{ url('/testimonial') }}">Testimonials</a></li>
        </ul>
      </div>
      <div class="col-md-3 col-sm-4 col-xs-4" >
        <label style="border-bottom:1px solid">Services</label>
        <ul class="box">
          <li><a href="{{ url('/tours') }}">Tours</a></li>
          <li><a href="{{ url('/') }}">Hotels</a></li>
          <li><a href="{{ url('/') }}">Transport</a></li>
          <li><a href="{{ url('/agent-register') }}">Register Agents</a></li>
          <li><a href="{{ url('/faq') }}">Help / Faq</a></li>
        </ul>
      </div>
       <div class="col-md-3 col-sm-4 col-xs-4">
        <label style="border-bottom:1px solid">Help</label>
        <ul class="box">
          <li><a href="{{ route('contact') }}">Contact us</a></li>
          <li><a href="{{ url('/tickets') }}">Support</a></li>
          <li><a href="{{ url('/return-policy') }}">Return Policy</a></li>
          <li><a href="{{ url('/privacy-policy') }}">Privacy Policy</a></li>
          <li><a href="{{ url('/terms-conditions') }}">Terms &amp; Conditions</a></li>          
        </ul>
      </div>
      <div class="col-md-3 col-sm-8 col-xs-8" >
        <label style="border-bottom:1px solid">News letter</label>
        <form name="newsletter" id="newsletter" method="post" action="{{ url('/newsletter') }}" class="form-horizontal">{{ csrf_field() }}
          @if(session()->has('newsletter'))
          <div class="alert alert-success"> {{ session()->get('newsletter') }} </div>
          @endif <span class="error_validate errors alert" id="errmsg1"></span>
          <input name="txt_newsletter" id="txt_newsletter" class="form-control" required="required" value="" placeholder="Email address" type="email">
          <br>
          <input name="btn_subscribe" id="btn_subscribe" placeholder="Enter your Email" value="Subscribe" class="btn-primary btn btn-md" type="submit">
        </form>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
        <p class="copyright" style="text-align:center">Copyright &copy; {!! date("Y"); !!} Trip India | All rights reserved.</p>
      </div>
    </div>
  </div>
</footer>
@section('page_js')
<script type="text/javascript">
$( document ).ready(function()  
{
	$('#errmsg1').hide();
	$('#errmsg1').removeClass("alert-danger");
	$('#errmsg1').removeClass("alert-success");
  	
	$("#btn_subscribe").click(function()
	{
		
	});
});
</script>
@endsection 