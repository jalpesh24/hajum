<!-- Footer -->  <br />
<hr />
<footer>
  <div class="container">
    <div class="row">   
      <div class="col-md-3 col-sm-4 col-xs-4">
        <label style="border-bottom:1px solid">Company</label>        
        <ul class="box">
          <li><a href="{{ route('aboutus') }}">About us</a></li>
          <li><a href="#">Blog</a></li>
          <li><a href="{{ url('/newquality') }}">Quality</a></li>
          <li><a href="{{ url('/newtestimonial') }}">Testimonials</a></li>
          <li><a href="{{ url('/newreview') }}">Reviews</a></li>
        </ul>
      </div>
      <div class="col-md-3 col-sm-4 col-xs-4" >
        <label style="border-bottom:1px solid">Services</label>
        <ul class="box">
          <?php if(isset($index)) { ?>
          <?php } else { ?>
          <?php } ?>
          <li><a href="{{ route('newoffers') }}">Offers</a></li>
          <li><a href="{{ url('/tickets') }}">Support</a></li>
           <li><a href="#">Register Agents</a></li>
           <li><a href="{{ url('/faq') }}">Help / Faq</a></li>
        </ul>
      </div>
      <div class="col-md-3 col-sm-4 col-xs-4">
        <label style="border-bottom:1px solid">Help</label>
        <ul class="box">
          <li><a href="{{ route('newcontact') }}">Contact us</a></li>
          <li><a href="{{ url('/return-policy') }}">Return Policy</a></li>          
          <li><a href="{{ url('/privacy-policy') }}">Privacy Policy</a></li>          
          <li><a href="{{ url('/terms-conditions') }}">Terms &amp; Conditions</a></li>          
        </ul>
      </div>
      <div class="col-md-3 col-sm-8 col-xs-8" >
        <label style="border-bottom:1px solid">News letter</label>
       <form name="newsletter" id="newsletter" method="post" action="{{ url('/newsletter') }}" class="form-horizontal">{{ csrf_field() }}
      @if(session()->has('newsletter'))
    <div class="alert alert-success">
        {{ session()->get('newsletter') }}
    </div>
@endif
      <span class="error_validate errors alert" id="errmsg1"></span>
      <input type="email" name="txt_newsletter" id="txt_newsletter" class="form-control" required="required" value="" placeholder="Email address" /> <br />
      <input name="btn_subscribe" id="btn_subscribe" type="submit" placeholder="Enter your Email" value="Subscribe" class="btn-primary btn btn-md" />
      </form>  
      </div>
    </div>
    <div class="row">
      <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
        <p class="copyright">Copyright &copy; {!! date("Y"); !!} Trip India | All rights reserved.</p>
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