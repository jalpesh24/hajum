@extends('layouts.template')
@section('title','Checkout')
@section('keywords', 'Trip India')
@section('description', 'Trip India')
@section('page_css')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{ asset('public/css/bootcomplete.css') }}">
@endsection
@section('content')
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
                  <div class="col-md-12">
                    <input type=" text"  name="firstname" id="firstname" class="form-control" placeholder="Enter First Name" value="Test" required="required"/>
                  </div>
                  <div class="col-md-12">&nbsp;
                    <input type=" text"  name="lastname" id="lastname" class="form-control" placeholder="Enter Last Name" value="Test" required="required" />
                  </div>
                  <div class="col-md-12">&nbsp;
                    <input type=" text"  name="email" id="email" class="form-control" placeholder="Enter Email" value="nikunj@anibyte.net" required="required"/>
                  </div>
                  <div class="col-md-12">&nbsp;
                    <input type=" text"  name="phone" id="phone" class="form-control" placeholder="Enter Contact Number" value="8073721233" required="required"/>
                  </div>
                   <div class="col-md-12">&nbsp;
                    <textarea name="address" id="address" class="form-control" cols="" rows="3" placeholder="Enter Address">Address</textarea>
                  </div>
                  <div class="col-md-12">&nbsp;
                    <input type=" text"  name="city" id="city" class="form-control" placeholder="Enter City" value="Bangalore" required="required"/>
                  </div>
                  <div class="col-md-12">&nbsp;
                    <input type=" text"  name="state" id="state" class="form-control" placeholder="Enter State" value="Karnataka" required="required"/>
                  </div>
                  <div class="col-md-12">&nbsp;
                    <input type=" text"  name="country" id="country" class="form-control" placeholder="Enter Country" value="India" required="required"/>
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
                    <h5><i class="fa fa-shopping-cart" aria-hidden="true"></i> Product Detail</h5>
                  </div>
                </div>
              </div>
              <div class="panel-body">
                <div class="row">
                  <input type="hidden" name="key" id="key" value="gtKFFx" />
                  <input type="hidden" name="activities_id" id="activities_id" value="{!! $activity[0]->activities_id !!}" />
                  <input type="hidden" name="surl" id="surl" value="{!! url('/activity_success.php') !!}" />
                  <input type="hidden" name="furl" id="furl" value="{!! url('/activity_failure.php') !!}" />
                  <input type="hidden" name="productinfo" id="productinfo" value="{!! $activity[0]->activities_name !!}" />
                  <input type="hidden" name="no_of_persons" id="no_of_persons" value="" />
                  <input type="hidden" name="applied_coupon_code" id="applied_coupon_code" value="" />
                  <input type="hidden" name="price_per_person" id="price_per_person" value="{!! $activity[0]->activities_price !!}" />
                  <input type="hidden" name="amount" id="amount" value="{!! $activity[0]->activities_price !!}" />
                  <input type="hidden" name="service_provider" value="payu_paisa" size="64" />
                  <div class="col-xs-12 col-md-12" >
                    <div><img src="{{ url('/activities/') }}{!! '/'.$activity[0]->activities_image !!}" title="{!! $activity[0]->activities_name !!}" alt="{!! $activity[0]->activities_name !!}" class="img-responsive"/></div>
                    <h4><small>Activity Name : {!! $activity[0]->activities_name !!}</small></h4>
                    <h4><small>Location : {!! $activity[0]->activities_location !!}</small></h4>
                    <h4><small>Duration : {!! $activity[0]->activities_duration !!}</small></h4>
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
                  <div class="col-xs-12 col-md-12">
                    <div class="col-xs-6 col-md-6" style="padding:0px;">
                      <h4><small>Per person: {!! $activity[0]->activities_price !!}<span class="text-muted">&nbsp;x</span> </small></h4>
                    </div>
                    <div class="col-xs-5 col-md-5 text-right">
                      <input type="number" class="form-control input-sm" value="1" id="no_of_adults" name="no_of_adults">
                    </div>
                  </div>
                  <div class="col-xs-12 col-md-12 col-sm-12">
                    <h4><small>Your Travel Date :
                      <input type="text" class="form-control" name="txt_travel_date" id="txt_travel_date" value="" required="required" placeholder="Choose your date" />
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
                      <h4><small>
                        <h4 class="text-right total">Total: <strong class="total">INR {!! $activity[0]->activities_price !!}</strong></h4>
                        </small></h4>
                    </div>
                  </div>
                  <div class="col-xs-12 col-md-12 col-sm-12" style="color:#000000;">
                    <h4><small>
                      <input type="checkbox" name="chk_agree" id="chk_agree" required="required" />
                      &nbsp;
                      I agree to the <a href="#">terms and conditions</a> and have reviewed the <a href="#">policies and Cancellation Rules</a>. </small></h4>
                  </div>
                  <div class="col-xs-5">
                    <button type="button" style="font-size:12px;" class="btn btn-success btn-block" id="chkout"> Checkout </button>
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
	var d = new Date();
	minDate = d.getDate()+"-"+(d.getMonth()+1)+"-"+d.getFullYear();
	
	$("#txt_travel_date" ).datepicker(
    	{
    		numberOfMonths: 1,
      	showButtonPanel: false,
	      changeMonth: true,
      	changeYear: true,
	});
    	$( "#txt_travel_date" ).datepicker( "option", "dateFormat", "dd-mm-yy");
	$( "#txt_travel_date" ).datepicker( "option", "minDate", minDate);
		
	$("#btn_apply_couponcode").click(function()
	{
		var coupon = $("#txt_coupon_code").val();
		
		if($.trim(coupon) != "")
		{
			var token = "{{ csrf_token() }}";
			var activity_id = $("#activities_id").val();
			var no_of_persons = $("#no_of_adults").val();
			
			$.ajax(
			{
				url:"{{ url('/applyactivitycoupon') }}",
				method : 'POST',
				async: false,
				dataType: "json",
				data: { "_token":token,"coupon":coupon,"activity_id":activity_id},
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
						$("#no_of_persons").val(no_of_persons);
						$("#applied_coupon_code").val(coupon);
						
						$("#no_of_adults").attr("disabled",true);
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
	
	$( "#no_of_adults" ).click(function() 
	{
		persons = $(this).val();
		
		if(persons > 0)
		{
			var price_per_person = $("#price_per_person").val();
			var no_of_persons = persons;
		
			var total = (price_per_person * no_of_persons);
			$("#amount").val(total);
			$("strong.total").html('Total: INR '+total);
		}
	});
	
	$( "#no_of_adults" ).keyup(function() 
	{
		persons = $(this).val();
		
		if(persons > 0)
		{
			var price_per_person = $("#price_per_person").val();
			var no_of_persons = persons;
		
			var total = (price_per_person * no_of_persons);
			$("#amount").val(total);
			$("strong.total").html('Total: INR '+total);
		}
	});
	
	$( "#no_of_adults" ).keydown(function(e)
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
		var travel_date = $("#txt_travel_date").val();
    		var chk_agree = $('#chk_agree').is(":checked");
        //alert(chk_agree);
		if(firstname != '' && lastname != '' && email != '' && phone != '' && travel_date != '' &&chk_agree == true)
		{
            var token = "{{ csrf_token() }}";
            var data = $('#frm_checkout').serializeArray();
            var data1 = $('#frm_checkout').serialize();
            $.ajax(
			{
				url:"{{ url('/insertactivityorder') }}",
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