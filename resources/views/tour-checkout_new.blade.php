@extends('layouts.template')
@section('title','Checkout')
@section('keywords', 'Trip India')
@section('description', 'Trip India')

@section('page_css')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{ asset('/css/bootcomplete.css') }}">
<style type="text/css">
	.product-name, .total , .price { color:#999999 !important;}
	label{ color:#999999;}
	</style>
@endsection

@section('content')
<form action="{!! url('/payumoney.php') !!}" method="post" name="frm_checkout" id="frm_checkout">
<!-- <form class="form-horizontal" method="post" action="<?= route("frontend.checkout")?>"> -->
    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
    <input type="hidden" name="udf1" value="udf1" />
    <input type="hidden" name="udf2" value="udf2" />
    <input type="hidden" name="udf3" value="udf3" />
    <input type="hidden" name="udf4" value="udf4" />
    <input type="hidden" name="udf5" value="udf5" /> 
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
                    <textarea name="address" id="address" class="form-control" placeholder="Enter Address" cols="" rows="3"></textarea>
                  </div>
                  <div class="col-md-12">&nbsp;
                    <input type=" text"  name="city" id="city" class="form-control" placeholder="Enter City" value="" required="required"/>
                  </div>
                  <div class="col-md-12">&nbsp;
                    <input type=" text"  name="state" id="state" class="form-control" placeholder="Enter State" value="" required="required"/>
                  </div>
                  <div class="col-md-12">&nbsp;
                    <input type=" text"  name="country" id="phone" class="form-control" placeholder="Enter Country" value="" required="required"/>
                  </div>
                 <!--  <div class="col-md-12">&nbsp;
                    <input type=" text"  name="country_origin" id="country_origin" class="form-control" placeholder="Enter Country Origin" value="" required="required"/>
                  </div> -->
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
                  @if($tour[0]->sale_price != '' && $tour[0]->sale_price > 0)
                  <input type="hidden" name="price_per_person" id="price_per_person" value="{!! $tour[0]->sale_price !!}" />
                  <input type="hidden" name="amount" id="amount" value="{!! $tour[0]->sale_price !!}" />
                  @else
                  <input type="hidden" name="price_per_person" id="price_per_person" value="{!! $tour[0]->price_per_person !!}" />
                  <input type="hidden" name="amount" id="amount" value="{!! $tour[0]->price_per_person !!}" />
                  @endif
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
                  <div class="col-xs-12 col-md-12"> @if($tour[0]->sale_price != '' && $tour[0]->sale_price > 0)
                    <div class="col-xs-6 col-md-6"  style="padding:0px">
                      <h4><small> Per person: {!! $tour[0]->sale_price !!}<span class="text-muted">&nbsp;x</span> </small></h4>
                    </div>
                    @else
                    <div class="col-xs-6 col-md-6" >
                      <h4><small> Per person: {!! $tour[0]->price_per_person !!}<span class="text-muted">&nbsp;x</span> </small></h4>
                    </div>
                    @endif
                    <div class="col-xs-5 col-md-5 text-right">
                      <input type="number" class="form-control input-sm" value="1" id="no_of_persons" name="no_of_persons">
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
                  <div class="col-xs-12 col-md-12 col-sm-12">
                    <div>
                      <h4><small> @if($tour[0]->sale_price != '' && $tour[0]->sale_price > 0)
                        <h4 class="text-right total">Total: <strong class="total">INR {!! $tour[0]->sale_price !!}</strong></h4>
                        @else
                        <h4 class="text-right total">Total: <strong class="total">INR {!! $tour[0]->price_per_person !!}</strong></h4>
                        @endif </small></h4>
                    </div>
                  </div>
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
@endsection

@section('page_js')
<script type="text/javascript">
$(document).ready(function() 
{
	var minDate = "{!! date('d-m-Y',strtotime($tour[0]->fromdate)) !!}";
	var maxDate = "{!! date('d-m-Y',strtotime($tour[0]->todate)) !!}";
	
	$("#txt_tour_date" ).datepicker(
    	{
    		numberOfMonths: 1,
      	showButtonPanel: false,
	      changeMonth: true,
      	changeYear: true,
		
    	});
	
    	$( "#txt_tour_date" ).datepicker( "option", "dateFormat", "dd-mm-yy");
	$( "#txt_tour_date" ).datepicker( "option", "minDate", minDate);
	$( "#txt_tour_date" ).datepicker( "option", "maxDate", maxDate);
	
	$("#btn_apply_couponcode").click(function()
	{
		var coupon = $("#txt_coupon_code").val();
		
		if($.trim(coupon) != "")
		{
			var token = "{{ csrf_token() }}";
			var tour_id = $("#tour_id").val();
			var no_of_persons = $("#no_of_persons").val();
			
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
						$("#no_of_adults").val(no_of_persons);
						$("#applied_coupon_code").val(coupon);
						
						$("#no_of_persons").attr("disabled",true);
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
			var no_of_persons = $("#no_of_persons").val();
		
			var total = (price_per_person * no_of_persons);
			$("#amount").val(total);
			$(".total").html('Total: INR '+total);
		}
	});
	
	$( "#no_of_persons" ).keyup(function() 
	{
		persons = $(this).val();
		if(persons > 0)
		{
			var price_per_person = $("#price_per_person").val();
			var no_of_persons = $("#no_of_persons").val();
		
			var total = (price_per_person * no_of_persons);
			$("#amount").val(total);
			$(".total").html('Total: INR '+total);
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
	  
	$("#chkout").click(function() 
	{
		var firstname = $("#firstname").val();
		var lastname = $("#lastname").val();
		var email = $("#email").val();
		var phone = $("#phone").val();
		
		if(firstname != '' && lastname != '' && email != '' && phone != '')
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
@endsection