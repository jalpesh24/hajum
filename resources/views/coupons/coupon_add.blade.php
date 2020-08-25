@include('includes.newheader')
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<div class="container">
<div class="breadcrumbs1">
<ol class="breadcrumb">
              <li class="breadcrumb-item"><i class="fa fa-home" aria-hidden="true"></i> <a href="{{ url('/newhome') }}">Home</a></li>
              <li class="breadcrumb-item active">Add New Coupon</li>
</ol>
</div>
	<div class="row">
      	<div class="col-sm-12">
            	@if (session('status'))
                  <div class="alert alert-success">{{ session('status') }}</div>
                  @endif
                  
                  @foreach ($errors->all() as $error)
                    <p class="alert alert-danger">{{ $error }}</p>
                @endforeach
                  
                  <div class="panel panel-default" id="panelbg">
                  	<div class="panel-heading" id="headerbg">
                        	@if (!Auth::guest())
          					@include('includes.minimenu')
					@endif
				</div>
                        
                        <div class="panel-body">
                                                      
                              <div class="col-md-12">
                              <form method="post" name="frm_add_coupon" enctype="multipart/form-data">
                              	{{ csrf_field() }}
                                    <div class="col-md-6 form-line">
                                    	<div class="form-group">
                                          	<label for="generatecoupon">&nbsp;</label>
                                                &nbsp;
                                                <input type="button" class="btn btn-primary pull-left" name="generatecoupon" id="generatecoupon" value="Generate Coupon" style="margin-top:27px;">
                                                <span>&nbsp;</span>
                                                <input type="text" class="form-control" id="coupon_code"  name="coupon_code" style="width:335px;" required="required">
							</div>
						</div>
                                    
                                    <div class="col-md-2 form-line">
                                    	<div class="form-group">
                                          	<label for ="coupon_amount">Amount</label>
                                                <input type="text" class="form-control" id="coupon_amount" placeholder="Enter Amount" name="coupon_amount" required="required">
							</div>
						</div>
                                    
                                    <div class="col-md-4 form-line">
                                    	<div class="form-group">
                                          	<div class="col-md-6" style="padding-left:0px;">
                                                	<label for="fromdate">From Date</label>
                                                      <input type="text" class="form-control datepicker"  name="fromdate" id="fromdate" placeholder="From date" value="{!! date('d-m-Y') !!}"  required="required">
								</div>
                                                
                                                <div class="col-md-6" style="padding-right:0px;">
                                                	<label for="todate">To Date</label>
                                                      <input type="text" class="form-control datepicker" name="todate" id="todate" placeholder="To date" value="{!! date('d-m-Y') !!}"  required="required" />
								</div>
							</div>
						</div>
                                    
                                    <div class="col-md-6 form-line" style="padding-left:0px;">
                                    	<div class="form-group">
                                          	<label for="aht">Select Category</label><br />
                                                <input type="radio" value="1" name="aht" id="aht" checked="checked" />
                                                Activity&nbsp;&nbsp;
                                                <input type="radio" value="2" name="aht" id="aht" />
                                                Hotel&nbsp;&nbsp;
                                                <input type="radio" value="3" name="aht" id="aht" />
                                                Tour&nbsp;&nbsp;
							</div>
						</div>
                                    
                                    <div class="col-md-6 form-line" style="padding-left:0px;">
                                    	<div class="form-group">
                                          	<input type="submit" class="btn btn-primary submit" name="btn_add_tour" id="btn_add_tour" value="Save">
							</div>
						</div>
					</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@include('includes.newfooter')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
$(document).ready(function() 
{
	var d = new Date();
	var strDate = d.getDate() + "-" + (d.getMonth()+1) + "-" + d.getFullYear();
	var minDate=strDate;
	var maxDate=strDate;
	var dateFormat = "dd-mm-yy";
	var $from = $("#fromdate");
  	var $to = $("#todate");
  
	$("#todate" ).datepicker(
    	{
    		numberOfMonths: 1,
      	showButtonPanel: false,
	      changeMonth: true,
      	changeYear: true,
		onSelect: function(selected) {
			$from.datepicker("option", "maxDate", selected);
		}
    	});
    	$( "#todate" ).datepicker( "option", "dateFormat", "dd-mm-yy");
	$( "#todate" ).datepicker( "option", "minDate", minDate);
	
	$("#todate" ).on( "change", function() 
	{
		var date = $(this).val();
		strDate = $.datepicker.parseDate( dateFormat, date );
		maxDate = strDate.getDate() + "-" + (strDate.getMonth()+1) + "-" + strDate.getFullYear();
	});
	
	$("#fromdate" ).datepicker(
	{
		numberOfMonths: 1,
      	showButtonPanel: false,
	      changeMonth: true,
      	changeYear: true,
		onSelect: function(selected) {
			$to.datepicker("option", "minDate", selected);
		}
	});
	$( "#fromdate" ).datepicker( "option", "dateFormat", "dd-mm-yy");
	$( "#fromdate" ).datepicker( "option", "minDate", minDate);
	
	$("#fromdate" ).on( "change", function() 
	{
		var date = $(this).val();
		strDate = $.datepicker.parseDate( dateFormat, date );
		minDate = strDate.getDate() + "-" + (strDate.getMonth()+1) + "-" + strDate.getFullYear();
	});
	
	$("#generatecoupon").click(function() 
	{
		var token = $("input[name='_token']").val();
		$.ajax(
		{
			url:"{{ url('/coupons-generate') }}",
			method : 'POST',
			data: { "_token":token},
			success: function(data) {
				$("#coupon_code").val(data);
			}
		});
	});
});
</script>
<a href="#" id="toTop" style="display: inline;"><span id="toTopHover"></span></a><div id="ui-datepicker-div" class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all"></div></body></html>