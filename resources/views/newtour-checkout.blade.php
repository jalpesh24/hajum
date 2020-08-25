@include('includes.newheader')
<style type="text/css">
	.product-name, .total , .price { color:#999999 !important;}
	label{ color:#999999;}
	.panel-heading{color: #FFF;
background-color: #000000;
border-color: #000000;
height: 40px;	
	}
	</style>
  <div class="container">
  <div class="breadcrumbs1">
<ol class="breadcrumb">
              <li class="breadcrumb-item"><i class="fa fa-home" aria-hidden="true"></i> <a href="{{ url('/newhome') }}">Home</a></li>
              <li class="breadcrumb-item active">Tour Checkout</li>
</ol>
</div>
<div class="col-md-8">
  <form action="{!! url('/payumoney.php') !!}" method="post" name="frm_checkout" id="frm_checkout">
  {{ csrf_field() }}
  <div class="container">
    <div class="row">
      <div class="panel panel-default" id="panelbg">
        <div class="panel-body">
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="panel">
              <div class="panel-heading" id="headerbg">
                <div class="row">
                  <div class="col-xs-6">
                    <h5> Personal Details</h5>
                  </div>
                </div>
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-12">&nbsp;
                    <input type=" text"  name="firstname" id="firstname" class="form-control" placeholder="Enter First Name" value="" required="required"/>
                  </div>
                  <div class="col-md-12">&nbsp;
                    <input type=" text"  name="lastname" id="lastname" class="form-control" placeholder="Enter Last Name" value="" required="required" />
                  </div>
                  <div class="col-md-12">&nbsp;
                    <input type=" text"  name="email" id="email" class="form-control" placeholder="Enter Email" value="" required="required"/>
                  </div>
                  <div class="col-md-12">&nbsp;
                    <input type=" text"  name="phone" id="phone" class="form-control" placeholder="Enter Contact Number" value="" required="required"/>
                  </div>
                  <div class="col-md-12">&nbsp;
                    <textarea name="address" id="address" class="form-control" cols="" rows="3" placeholder="Enter Address"></textarea>
                  </div>
                  <div class="col-md-12">&nbsp;
                    <input type=" text"  name="city" id="city" class="form-control" placeholder="Enter City" value="" required="required"/>
                  </div>
                  <div class="col-md-12">&nbsp;
                    <input type=" text"  name="state" id="state" class="form-control" placeholder="Enter State" value="" required="required"/>
                  </div>
                  <div class="col-md-12">&nbsp;
                    <input type=" text"  name="country" id="country" class="form-control" placeholder="Enter Country" value="" required="required"/>
                  </div> 
                </div>
              </div>
            </div>
          </div>
		    
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="panel">
              <div class="panel-heading" id="headerbg">
                <div class="row">
                  <div class="col-xs-12">
                    <h5><i class="fa fa-shopping-cart" aria-hidden="true"></i> Tour Detail</h5>
                  </div>
                </div>
              </div>
              <div class="panel-body">
                <div class="row">
				
                  <input type="hidden" name="key" id="key" value="gtKFFx" />
                  <input type="hidden" name="tour_id" id="tour_id" value="{!! $tour[0]->tour_id !!}" />	  
				  
                  <input type="hidden" name="surl" id="surl" value="{!! url('/success.php') !!}" />
                  <input type="hidden" name="furl" id="furl" value="{!! url('/failure.php') !!}" />
                  <input type="hidden" name="productinfo" id="productinfo" value="{!! $tour[0]->tour_name !!}" />
				
                  <input type="hidden" name="price_per_person" id="price_per_person" value="{!! $tour[0]->adprice !!}" />
				  <input type="hidden" name="price_per_child" id="price_per_child" value="{!! $tour[0]->cdprice !!}" />
                   <?php if($_SESSION['curuid'] != 0){ 
				    $discount = ($tour[0]->adprice + $tour[0]->cdprice) * $_SESSION['catgorydicount']/100 ;
				   ?>
				   <input type="hidden" name="agent_id" id="agent_id" value="{!! $_SESSION['curuid'] !!}" />
				   <input type="hidden" name="discount" id="discount" value="{!! $_SESSION['catgorydicount'] !!}" />
				   <input type="hidden" name="disamount" id="disamount" value="{!! ($tour[0]->adprice + $tour[0]->cdprice) * $_SESSION['catgorydicount']/100 !!}" />
				   <input type="hidden" name="amount" id="amount" value="{!! ($tour[0]->adprice + $tour[0]->cdprice) - $discount !!}" />
				   <input type="hidden" name="newamount" id="newamount" value="{!! ($tour[0]->adprice + $tour[0]->cdprice) - $discount !!}" />
				   <input type="hidden" name="useramount" id="useramount" value="{!! ($tour[0]->adprice + $tour[0]->cdprice) !!}" />
				   <?php } else{ ?>	
				  <input type="hidden" name="amount" id="amount" value="{!! ($tour[0]->adprice + $tour[0]->cdprice) !!}" />
				  <input type="hidden" name="newamount" id="newamount" value="{!! ($tour[0]->adprice + $tour[0]->cdprice) !!}" />
				   <?php } ?>                 
				 <input type="hidden" name="no_of_adults" id="no_of_adults" value="" />
                  <input type="hidden" name="applied_coupon_code" id="applied_coupon_code" value="" />
                  <input type="hidden" name="service_provider" value="payu_paisa" size="64" />
                  <div class="col-xs-12 col-md-12" >
                    <div><img src="{{ url('/tours_images/') }}{!! '/'.$tour[0]->tour_image !!}" title="{!! $tour[0]->tour_name !!}" align="{!! $tour[0]->tour_name !!}" class="img-responsive"/></div>
                    <h4><small>Package : {!! $tour[0]->tour_name !!}</small></h4>
                    <h4><small>Location : {!! $tour[0]->city_location !!}</small></h4>
                    <h4><small>Tour Duration : {!! $tour[0]->days.' Days - '.$tour[0]->nights.' Nights'; !!}</small></h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="panel">
              <div class="panel-heading" id="headerbg">
                <div class="row">
                  <div class="col-xs-6">
                    <h5> Details</h5>
                  </div>
                </div>
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-xs-12 col-md-12"> @if($tour[0]->adprice != '' && $tour[0]->adprice > 0)
                    <div class="col-xs-6 col-md-6"  style="padding:0px">
                      <h4><small> Per Adult: {!! $tour[0]->adprice !!}<span class="text-muted">&nbsp;x</span> </small></h4>
					  <h4><small> Per Child: {!! $tour[0]->cdprice !!}<span class="text-muted">&nbsp;x</span> </small></h4>
                    </div>
                    @else
                    <div class="col-xs-6 col-md-6" >
                      <h4><small> Per Adult: {!! $tour[0]->adprice !!}<span class="text-muted">&nbsp;x</span> </small></h4>
					  <h4><small> Per Child: {!! $tour[0]->cdprice !!}<span class="text-muted">&nbsp;x</span> </small></h4>
                    </div>
                    @endif
                    <div class="col-xs-5 col-md-5 text-right">
                      <input type="number" class="form-control input-sm" value="1" id="no_of_persons" name="no_of_persons" min="1" max="10">
                    </div>
					<div class="col-xs-5 col-md-5 text-right">
                      <input type="number" class="form-control input-sm" value="1" id="no_of_child" name="no_of_child" min="0" max="10">
                    </div>
                  </div>
                  <div class="col-xs-12 col-md-12 col-sm-12">
                    <h4><small>Your Travel Date :
                      <input type="text" class="form-control" name="txt_tour_date" id="txt_tour_date" value="" required="required" placeholder="Choose your date" />
                      </small></h4>
                  </div>
                  <div class="col-xs-12 col-md-12 col-sm-12">
                    <h4><small> Have a promo code?
                      <input type="text" class="form-control" name="txt_coupon_code" id="txt_coupon_code" placeholder="Coupon Code" />
                      </small></h4>
                    <input type="button" name="btn_apply_couponcode" id="btn_apply_couponcode" class="btn btn-primary" value="Apply" />
                  </div>
				  <?php if($_SESSION['curuid'] != 0){
					  $discount = ($tour[0]->adprice + $tour[0]->cdprice) * $_SESSION['catgorydicount']/100 ;
				  ?>
                  <div class="col-xs-12 col-md-12 col-sm-12">
                    <div>
                      <h4><small> @if($tour[0]->adprice != '' && $tour[0]->adprice > 0)
                        <h4 class="text-right totalpay">Total: <strong class="totalpay">Rs. {!! ($tour[0]->adprice + $tour[0]->cdprice) !!}</strong></h4>
                        <h4 class="text-right dis">Discount: <strong class="disc">Rs. {!! ($discount) !!}</strong></h4>
						<h4 class="text-right agttotal">Total pay: <strong class="agttotal">Rs. {!! ($tour[0]->adprice + $tour[0]->cdprice) - $discount !!}</strong></h4>
						@else
                        <h4 class="text-right totalpay">Total: <strong class="totalpay">Rs. {!! ($tour[0]->adprice + $tour[0]->cdprice) !!}</strong></h4>
                        <h4 class="text-right dis">Discount: <strong class="disc">Rs. {!! ($discount) !!}</strong></h4>
						<h4 class="text-right agttotal">Total pay: <strong class="agttotal">Rs. {!! ($tour[0]->adprice + $tour[0]->cdprice) - $discount !!}</strong></h4>
						@endif </small></h4>
                    </div>
                  </div>
				  <?php } else { ?>
					  <div class="col-xs-12 col-md-12 col-sm-12">
                    <div>
                      <h4><small> @if($tour[0]->adprice != '' && $tour[0]->adprice > 0)
                        <h4 class="text-right total">Total: <strong class="total">Rs. {!! ($tour[0]->adprice + $tour[0]->cdprice) !!}</strong></h4>
                        @else
                        <h4 class="text-right total">Total: <strong class="total">Rs. {!! ($tour[0]->adprice + $tour[0]->cdprice) !!}</strong></h4>
                        @endif </small></h4>
                    </div>
                  </div>
				 <?php } ?>
                  <div class="col-xs-12 col-md-12 col-sm-12" style="color:#000000;">
                    <h4><small>
                      <input type="checkbox" name="chk_agree" id="chk_agree" required="required" />
                      &nbsp;I agree to the <a href="#">terms and conditions</a> and have reviewed the <a href="#">policies and Cancellation Rules</a>. </small></h4>
                  </div>
                  <div class="col-xs-5">
                    <button type="submit" style="font-size:12px;" class="btn btn-success btn-block" id="chkout"> Checkout </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>

</div>



  
</div>


@include('includes.newfooter')
<script src="{{ url('newhtml/js/jquery.js') }}"></script>
<script src="{{ url('newhtml/js/bootstrap.min.js') }}"></script>
<script src="{{ url('newhtml/js/bootstrap.js') }}"></script>
<script src="{{ url('newhtml/js/jqBootstrapValidation.js') }}"></script>
<script src="{{ url('newhtml/js/clean-blog.min.js') }}"></script>
<script src="{{ url('newhtml/js/jquery.bootcomplete.js') }}"></script>

<script type="text/javascript">
	
	$( "#txt_tour_date" ).datepicker({ minDate: 0});
	
</script>
<script type="text/javascript">
$(document).ready(function() 
{
	var newamount = $("#newamount").val();
	$("#amount").val(newamount);
	  
	
	$("#btn_apply_couponcode").click(function()
	{
		var coupon = $("#txt_coupon_code").val();
		
		if($.trim(coupon) != "")
		{
			var token = "{{ csrf_token() }}";
			var tour_id = $("#tour_id").val();
			var no_of_persons = $("#no_of_persons").val();
			var no_of_child = $("#no_of_child").val();
			
			$.ajax(
			{
				url:"{{ url('/applycoupon') }}",
				method : 'POST',
				async: false,
				dataType: "json",
				data: { "_token":token,"coupon":coupon,"tour_id":tour_id},
				success: function(data) 
				{
					if(data.success > 0)
					{
						var amount = $("#amount").val();						
						var total_amount = (amount-data.success);
						$("span.price").html(total_amount);
						$("strong.total").html("INR "+(total_amount));
						$("#amount").val(total_amount);						
						$("#price_per_person").val(total_amount);
						$("#price_per_child").val(total_amount);
						$("#no_of_adults").val(no_of_persons);
						$("#no_of_child").val(no_of_child);
						$("#applied_coupon_code").val(coupon);
						
						$("#no_of_persons").attr("disabled",true);
						$("#no_of_child").attr("disabled",true);
						$("#txt_coupon_code").attr("readonly","readonly");
						$("#btn_apply_couponcode").attr("disabled",true);
					}
					else if(data.error != '')
					{
						alert(data.error);
					}
					
				}
			});
		}
		else 
		{
			alert("Please enter coupon code first");
			$("#txt_coupon_code").focus();
		}
	});
	
	$( "#no_of_persons" ).click(function() 
	{
		persons = $(this).val();
		if(persons > 0)
		{
			var price_per_person = $("#price_per_person").val();
			var price_per_child = $("#price_per_child").val();
			var no_of_persons = $("#no_of_persons").val();
			var no_of_child = $("#no_of_child").val();
			var disc = $("#discount").val();
					
			var totalpriceadult = (price_per_person * no_of_persons);
			var totalpricechild = (price_per_child * no_of_child);
			var total = totalpriceadult + totalpricechild;
			var totaldiscount = (totalpriceadult + totalpricechild) * disc/100;
			var amountpay = total - totaldiscount;
			var totalpay = amountpay;
			
			if(disc != 0){
			$("#amount").val(amountpay);
			$("#newamount").val(amountpay);
			$("#useramount").val(total);
			$("#disamount").val(totaldiscount);
			$(".disc").html('Total: INR '+totaldiscount);			
			$(".totalpay").html('Total: INR '+total);
			$(".agttotal").html('Total: INR '+totalpay);
			}else{		
			
			$("#amount").val(total);
			$(".total").html('Total: INR '+total);
			}
		}
	});
	
	$( "#no_of_persons" ).keyup(function() 
	{
		persons = $(this).val();
		if(persons > 0)
		{
			var price_per_person = $("#price_per_person").val();
			var price_per_child = $("#price_per_child").val();
			var no_of_persons = $("#no_of_persons").val();
			var no_of_child = $("#no_of_child").val();
			var disc = $("#discount").val();
			
		
			var totalpriceadult = (price_per_person * no_of_persons);
			var totalpricechild = (price_per_child * no_of_child);
			var total = totalpriceadult + totalpricechild;
			var totaldiscount = (totalpriceadult + totalpricechild) * disc/100;
			var amountpay = total - totaldiscount;
			var totalpay = amountpay;
			
			if(disc != 0){
			$("#amount").val(amountpay);
			$("#newamount").val(amountpay);
			$("#useramount").val(total);
			$("#disamount").val(totaldiscount);
			$(".disc").html('Total: INR '+totaldiscount);			
			$(".totalpay").html('Total: INR '+total);
			$(".agttotal").html('Total: INR '+totalpay);
			}else{		
			
			$("#amount").val(total);
			$(".total").html('Total: INR '+total);
			}
			
		}
	});
	
	$( "#no_of_persons" ).keydown(function(e)
      {
            var key = e.charCode || e.keyCode || 0;
            // allow backspace, tab, delete, enter, arrows, numbers and keypad numbers ONLY
            // home, end, period, and numpad decimal
            return (
                key == 8 || 
                key == 9 ||
                key == 13 ||
                key == 46 ||
                key == 110 ||
                key == 190 ||
                (key >= 35 && key <= 40) ||
                (key >= 48 && key <= 57) ||
                (key >= 96 && key <= 105));
        });
		
		$( "#no_of_child" ).click(function() 
	{
		child = $(this).val();
		if(child >= 0)
		{
			var price_per_person = $("#price_per_person").val();
			var price_per_child = $("#price_per_child").val();
			var no_of_persons = $("#no_of_persons").val();
			var no_of_child = $("#no_of_child").val();
			var disc = $("#discount").val();
		
			var totalpriceadult = (price_per_person * no_of_persons);
			var totalpricechild = (price_per_child * no_of_child);
			var total = totalpriceadult + totalpricechild;
			var totaldiscount = (totalpriceadult + totalpricechild) * disc/100;
			var amountpay = total - totaldiscount;
			var totalpay = amountpay;
			
			if(disc != 0){
			$("#amount").val(amountpay);
			$("#newamount").val(amountpay);
			$("#useramount").val(total);
			$("#disamount").val(totaldiscount);
			$(".disc").html('Total: INR '+totaldiscount);			
			$(".totalpay").html('Total: INR '+total);
			$(".agttotal").html('Total: INR '+totalpay);
			}else{		
			
			$("#amount").val(total);
			$(".total").html('Total: INR '+total);
			}
		}
	});
	
	$( "#no_of_child" ).keyup(function() 
	{
		child = $(this).val();
		if(child >= 0)
		{
			var price_per_person = $("#price_per_person").val();
			var price_per_child = $("#price_per_child").val();
			var no_of_persons = $("#no_of_persons").val();
			var no_of_child = $("#no_of_child").val();
			var disc = $("#discount").val();
		
			var totalpriceadult = (price_per_person * no_of_persons);
			var totalpricechild = (price_per_child * no_of_child);
			var total = totalpriceadult + totalpricechild;
			var totaldiscount = (totalpriceadult + totalpricechild) * disc/100;
			var amountpay = total - totaldiscount;
			var totalpay = amountpay;
			
			if(disc != 0){
			$("#amount").val(amountpay);
			$("#newamount").val(amountpay);
			$("#useramount").val(total);
			$("#disamount").val(totaldiscount);
			$(".disc").html('Total: INR '+totaldiscount);			
			$(".totalpay").html('Total: INR '+total);
			$(".agttotal").html('Total: INR '+totalpay);
			}else{		
			
			$("#amount").val(total);
			$(".total").html('Total: INR '+total);
			}
		}
	});
	  
	$("#chkout").click(function() 
	{
		var firstname = $("#firstname").val();
		var lastname = $("#lastname").val();
		var email = $("#email").val();
		var phone = $("#phone").val();
        var tour_date = $("#txt_tour_date").val();
        var chk_agree = $("#chk_agree").val();
        //alert(chk_agree);
    
		
		if(firstname != '' && lastname != '' && email != '' && phone != '' && tour_date != '')
		{
			var token = "{{ csrf_token() }}";
			var data = $('#frm_checkout').serializeArray();
			var data1 = $('#frm_checkout').serialize();
			$.ajax(
			{
				url:"{{ url('/insertorder') }}",
				method : 'GET',
				async: false,
				data: data1,
				success: function(data) {
					$("#frm_checkout").submit();
				}
			});
	  	  }
	  });
});

</script>
<a href="#" id="toTop" style="display: inline;"><span id="toTopHover"></span></a><div id="ui-datepicker-div" class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all"></div></body></html>