@include('includes.newheader')
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


<style type="text/css">
	.product-name, .total , .price { color:#999999 !important;}
	label{ color:#999999;}
	.panel-heading{color: #FFF;
background-color: #000000;
border-color: #000000;
height: 40px;	
	}
body {font-family: Arial, Helvetica, sans-serif;}

/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
    margin-bottom: auto;
    margin-left: 58%;
    margin-right: auto;
    margin-top: 10%;
    padding-bottom: 20px;
    padding-left: 17px;
    padding-right: 20px;
    position: absolute;
    width: 24%;
}
#childage{color:#000;}

/* The Close Button */
.close {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}
#hotels #myroomselect .modal-content {
    margin-top: 15%;
}
	</style>
	
<form action="{!! url('/payumoney.php') !!}" method="post" name="frm_checkout" id="frm_checkout">
<div class="container">
    <div class="row">
      <div class="breadcrumbs1 nw-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home" aria-hidden="true"></i> <a href="newhome.html">Home</a></li>
          <li class="breadcrumb-item active">Hotel Check Out</li>
        </ol>
      </div>
    </div>
  {{ csrf_field() }} 
    <div class="row">
      <div class="panel panel-default" id="panelbg">
        <div class="panel-body">
      <div class="col-md-4 col-sm-4 col-xs-12">
        <div class="panel panel-info">
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
        <div class="panel panel-info">
          <div class="panel-heading" id="headerbg">
           
              <div class="row">
                <div class="col-xs-12">
                  <h5><i class="fa fa-shopping-cart" aria-hidden="true"></i> Product Detail</h5>
                </div>
              
            </div>
          </div>
		    <?php 
		  
			$to = \Carbon\Carbon::createFromFormat('Y-m-d', $fromdate);
$from = \Carbon\Carbon::createFromFormat('Y-m-d', $todate);

$diff_in_days = $to->diffInDays($from);
$totalsvalue = ($diff_in_days * $hotel_room[0]->hotel_saleprice);
?>

          <div class="panel-body">
            <div class="row">
              <input type="hidden" name="key" id="key" value="gtKFFx" />
              <input type="hidden" name="hotel_id" id="hotel_id" value="{!! $hotel[0]->hotel_id !!}" />
              <input type="hidden" name="hotel_roomid" id="hotel_roomid" value="{!! $hotel_room[0]->hotel_room_id !!}" />
              <input type="hidden" name="surl" id="surl" value="{!! url('/hotel_success.php') !!}" />
              <input type="hidden" name="furl" id="furl" value="{!! url('/hotel_failure.php') !!}" />
              <input type="hidden" name="productinfo" id="productinfo" value="{!! $hotel[0]->hotel_name !!}" />
              
              <input type="hidden" name="no_of_persons" id="no_of_persons" value="<?php echo $_GET['adults']; ?>" >
              <input type="hidden" name="no_of_childs" id="no_of_childs" value="<?php echo $_GET['childs']; ?>" >
			   <?php if($_SESSION['curuid'] != 0){ 
				   $discount = ($totalsvalue * $_SESSION['catgorydicount'])/100 ;
					  $total = ($totalsvalue - $discount);
				   ?>
				   <input type="hidden" name="price_per_person" id="price_per_person" value="{!! $total !!}" />
				<input type="hidden" name="agent_id" id="agent_id" value="{!! $_SESSION['curuid'] !!}" />
			  <input type="hidden" name="discount" id="discount" value="{!! $_SESSION['catgorydicount'] !!}" />
			  <input type="hidden" name="disamount" id="disamount" value="{!! $discount !!}" />
			  <input type="hidden" name="newamount" id="newamount" value="{!! $total !!}" />
			  <input type="hidden" name="useramount" id="useramount" value="{!! $totalsvalue !!}" />
			    <input type="hidden" name="amount" id="amount" value="{!! $total !!}" />
				   <?php } else{ ?>	
				   <input type="hidden" name="agent_id" id="agent_id" value="0" />				  
			  <input type="hidden" name="discount" id="discount" value="0" />
			  <input type="hidden" name="disamount" id="disamount" value="0" />
			  <input type="hidden" name="newamount" id="newamount" value="0" />
			  <input type="hidden" name="useramount" id="useramount" value="0" />
			
				     <input type="hidden" name="amount" id="amount" value="{!! $hotel_room[0]->hotel_saleprice !!}" />
				   <?php } ?>
			  <input type="hidden" value="{!! $hotel_room[0]->hotel_extra_room !!}" id="price_extra_room" name="price_extra_room">
			  <input type="hidden" value="{!! $hotel_room[0]->hotel_extra_adult !!}" id="price_extra_adults" name="price_extra_adults">
			  <input type="hidden" value="{!! $hotel_room[0]->hotel_extra_child !!}" id="price_extra_child" name="price_extra_child">
              <input type="hidden" name="applied_coupon_code" id="applied_coupon_code" value="" />
              <input type="hidden" name="temp_amount" id="temp_amount" value="{!! $hotel_room[0]->hotel_saleprice !!}" />
			
              <input type="hidden" name="service_provider" value="payu_paisa" size="64" />
              <div class="col-xs-12 col-md-12" >
			  <?php $imgs = explode(',', $hotel_room[0]->hotel_image); 
					$images = $imgs[0]; 
			  ?>
                <div><img src="{{ url('/hotel_room_images/'.$images) }}" title="{!! $hotel[0]->hotel_name !!}" align="{!! $hotel[0]->hotel_name !!}" class="img-responsive"/></div>
                <h4><small>Hotel Name : {!! $hotel[0]->hotel_name !!}</small></h4>
                <h4><small>Location : {!! $hotel[0]->city_location !!}</small></h4>
                <h4><small>Duration : {!! $hotel[0]->checkin_time !!} To {!! $hotel[0]->checkout_time !!}</small></h4>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-sm-4 col-xs-12">
        <div class="panel panel-info">
           <div class="panel-heading" id="headerbg">
            <div class="row">
                <div class="col-xs-6">
                  <h5> Details</h5>
                </div>
            
            </div>
          </div>
		  <?php 
		  $fromdate =date("d-F-Y",strtotime($fromdate));
		  $todate =date("d-F-Y",strtotime($todate));
		  $totalguest = ($_GET['adults'] + $_GET['childs']);
		  ?>
          <div class="panel-body">
            <div class="row">
              <div class="col-xs-12 col-md-12">
			  <div class="col-xs-12 col-md-12" style="padding:0px">
                  <h4><b> Rs. {!! $hotel_room[0]->hotel_saleprice !!}</b> <span class="text-muted"><s>{!! $hotel_room[0]->hotel_price !!}</s>&nbsp;Per Night</span></h4>
				  <P style="background-color:#0f0;">You Save Rs. ({!! $hotel_room[0]->hotel_price - $hotel_room[0]->hotel_saleprice !!})
                </div>  
				<div class="clear:both;"></div>
				<div class="col-xs-12 col-md-12" style="padding:0px">
			  <div class="col-xs-6 col-md-6"  style="padding:0px">
              <input type="text" class="form-control datepicker" name="txt_checkin" id="txt_checkin" value="<?php echo $fromdate; ?>" required="required" placeholder="Choose your date" readonly />
               </div>      
			  <div class="col-xs-6 col-md-6"   style="padding:0px">
			  <input type="text" class="form-control datepicker" name="txt_checkout" id="txt_checkout" value="<?php echo $todate; ?>" required="required" placeholder="Choose your date" readonly /> 
				 </div>  
				</div>				 
				  </div>  
				 <div class="clear:both;"></div><br/>
				<div class="col-xs-12 col-md-12" style="padding:0px">
				<div class="col-xs-12 col-md-12"   style="padding:10px">
				<input type="hidden" name="room" id="room" class="form-control" value="<?php echo $_GET['room']; ?>" />
                 <input type="text" name="totalguest" id="totalguest" class="form-control" value="<?php echo $_GET['room']; ?> Room/<?php echo $totalguest; ?> Guests" />
				<div id="myroomselect" class="modal">
<div class="modal-content">
    <span class="close" id="closerooms">&times;</span>
			<select name="room" id="room" class="form-control">			
			<option value="<?php echo $_GET['room']; ?>" selected="selected" ><?php echo $_GET['room']; ?> Room</option>
			
			</select>
			<select name="adults" id="adults" class="form-control" onChange="getadults(this.value);">				
			<option value="<?php echo $_GET['adults']; ?>" ><?php echo $_GET['adults']; ?> Adult</option>
			</select>
			<select name="childrens" id="childrens" class="form-control" onChange="getchildages(this.value);">
			<option value="<?php echo $_GET['childs']; ?>" selected="selected"><?php echo $_GET['childs']; ?> Children</option>
			</select>
  	<?php if(is_array($chilage) && !empty($chilage)) { $i=1; foreach($chilage as $childsage){ ?>
              <div class="col-xs-12 col-md-12">  
				<div class="col-xs-6 col-md-6"  style="padding:0px">
                  <h4><small> Children Age<span class="text-muted"><?php echo $i; ?>&nbsp;x </span> </small></h4>
                </div>
				
                <div class="col-xs-5 col-md-5 text-right">	
					<select name="child_age[]" id="child_age" class="form-control">
					<option value="<?php echo $childsage; ?>"><?php echo $childsage; ?></option>
					</select>
                  </div>
              </div>
			  <?php $i++; }}else{ ?>
			  <select name="child_age[]" id="child_age" class="form-control">
					<option value="0">0</option>
					</select>
              <?php } ?>
  </div>	
  </div>
				</div>  
				 </div>  
			  
              <div class="col-xs-12 col-md-12 col-sm-12">
                <h4><small> Have a promo code?
                  <input type="text" class="form-control" name="txt_coupon_code" id="txt_coupon_code" placeholder="Coupon Code" />
                  </small></h4>
                <input type="button" name="btn_apply_couponcode" id="btn_apply_couponcode" class="btn btn-primary" value="Apply" />
              </div>
			   
              <div class="col-xs-12 col-md-12 col-sm-12">
                <div>
                  <h4><small> @if($hotel_room[0]->hotel_saleprice != '' && $hotel_room[0]->hotel_saleprice > 0)
					  <h4 class="text-right subtotal">Hotel Room Total: <strong class="subtotal">Rs <?php echo $totalsvalue; ?></strong></h4>
					  
					<h4 class="text-right useramount">User Total: <strong class="useramount">Rs. <?php echo $totalsvalue; ?></strong></h4>
					<h4 class="text-right dis">Discount: <strong class="disc">Rs. {!! ($discount) !!}</strong></h4>
                    <h4 class="text-right total">Total: <strong class="total">Rs {!! $totalsvalue - $discount !!}</strong></h4>
                    @else
					<h4 class="text-right subtotal">Hotel Room Total: <strong class="subtotal">Rs {!! $hotel_room[0]->hotel_saleprice !!}</strong></h4>
									
                    <h4 class="text-right total">Total: <strong class="total">Rs {!! $hotel_room[0]->hotel_saleprice !!}</strong></h4>
                    @endif </small></h4>
                </div>
              </div>
			   
              <div class="col-xs-12 col-md-12 col-sm-12" style="color:#000000;">
                <h4><small>
                  <input type="checkbox" name="chk_agree" id="chk_agree" required="required" />
                  &nbsp;I agree to the <a href="#">terms and conditions</a> and have reviewed the <a href="#">policies and Cancellation Rules</a>. </small></h4>
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
 
@include('includes.newfooter')
  

<script src="{{ url('newhtml/js/jquery.js') }}"></script>
<script src="{{ url('newhtml/js/jquery-ui.js') }}"></script>
<script src="{{ url('newhtml/js/jquery-migrate-1.js') }}"></script>
<script src="{{ url('newhtml/js/superfish.js') }}"></script>
<script src="{{ url('newhtml/js/select2.js') }}"></script>
<script src="{{ url('newhtml/js/jquery_002.js') }}"></script>
<script src="{{ url('newhtml/js/jquery_006.js') }}"></script>
<script src="{{ url('newhtml/js/jquery_003.js') }}"></script>
<script src="{{ url('newhtml/js/jquery_007.js') }}"></script>
<script src="{{ url('newhtml/js/scripts.js') }}"></script>
<script src="{{ url('newhtml/js/owl.carousel.min.js') }}"></script>
<script src="{{ url('newhtml/js/bootstrap.min.js') }}"></script>

<script>
	
	var date = new Date(); 
			$('#txt_checkout').datepicker(
			{
				format: "dd-mm-yy",
				autoclose: true,
				onSelect: function(date){ 
				}
			});
			
			$('#txt_checkin').datepicker(
			{
				format: "dd-mm-yy",
				autoclose: true,
				minDate: date,
				onSelect: function(date){ 
					var dt2 = $('#txt_checkout');
					var startDate = $(this).datepicker('getDate');
					startDate.setDate(startDate.getDate() + 1);
					var minDate = $(this).datepicker('getDate');
					minDate.setDate(minDate.getDate() + 1);
					
					dt2.datepicker('setDate', minDate);
					dt2.datepicker('option', 'minDate', minDate);
					dt2.open();
				}
			});
	
</script>
<script>
// Get the modal
var modal = document.getElementById('myroomselect');

// Get the button that opens the modal
var btn = document.getElementById("totalguest");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>


<script type="text/javascript">
$(document).ready(function() 
{
    var p = $("#price_per_person").val();
    $("#amount").val(p);
    
    $("#btn_apply_couponcode").click(function()
    {
        var coupon = $("#txt_coupon_code").val();
        
        if($.trim(coupon) != "")
        {
            var token = "{{ csrf_token() }}";
            var hotel_id = $("#hotel_id").val();
            var no_of_persons = $("#no_of_adults").val();			
			var extra_room = $("#no_of_extra_room").val();
			
            $.ajax(
            {
                url:"{{ url('/applyhotelcoupon') }}",
                method : 'POST',
                async: false,
                dataType: "json",
                data: { "_token":token,"coupon":coupon,"hotel_id":hotel_id},
                success: function(data) 
                {
                    if(data.success > 0)
                    {
                        var amount = $("#amount").val();
                        var total_amount = (amount-data.success);
                        
                        $("span.price").html(total_amount);
                        $("strong.total").html("Rs "+(total_amount));
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
	
	/* Jalpesh add extra adulsts */
    
    $( "#no_of_extra_adults" ).click(function() 
    {		
        persons = $(this).val();
        if(persons >= 0)
        {
            var price_extraroom = $("#price_extra_room").val();
            var no_of_extraroom = $("#no_of_extra_room").val();
			var amount = $("#temp_amount").val();
			var subtotal_extra_room = (parseInt(price_extraroom) * no_of_extraroom);
			var total = parseInt(amount) + parseInt(subtotal_extra_room);
			
			
			var price_extraadult = $("#price_extra_adults").val();
			var adult = persons;
			var no_of_extraadult = adult;
			var subtotal_extra_adult = (parseInt(price_extraadult) * no_of_extraadult);
			$("strong.extraadult").html('Rs '+subtotal_extra_adult);
			
			var price_extrachild = $("#price_extra_child").val();
			var child = $("#no_of_extra_child").val();
			var no_of_extrachild = child;
			var subtotal_extra_child = (parseInt(price_extrachild) * no_of_extrachild);
			var disc = $("#discount").val();			
			var totalsub = parseInt(amount) + parseInt(subtotal_extra_room) + parseInt(subtotal_extra_adult) + parseInt(subtotal_extra_child);
			
			if(disc > 0){
			var discount = (totalsub * disc)/100;				
			var totalpay = parseInt(amount) + parseInt(subtotal_extra_room) + parseInt(subtotal_extra_adult) + parseInt(subtotal_extra_child) - discount;
			$("#disamount").val(discount);
			$("#useramount").val(totalsub);	
			$("#amount").val(totalpay);
			$("strong.useramount").html('Rs '+totalsub);
			$("strong.disc").html('Rs '+discount);
			$("strong.total").html('Rs '+totalpay);
			}else{
			var total = parseInt(amount) + parseInt(subtotal_extra_room) + parseInt(subtotal_extra_adult) + parseInt(subtotal_extra_child);			
			$("#amount").val(total);
			$(".total").html('Total: Rs '+total);
			}				
			
        }
		else{
			$("strong.extraadult").html('Rs '+0);
		}
    });
    
    $( "#no_of_extra_adults" ).keyup(function() 
    {
        persons = $(this).val();
        
        if(persons >= 0)
        {
            var price_extraroom = $("#price_extra_room").val();
            var no_of_extraroom = $("#no_of_extra_room").val();
			var amount = $("#temp_amount").val();
			
			var subtotal_extra_room = (parseInt(price_extraroom) * no_of_extraroom);
			var total = parseInt(amount) + parseInt(subtotal_extra_room);			
			
			var price_extraadult = $("#price_extra_adults").val();
			var adult = persons;
			var no_of_extraadult = adult;
			var subtotal_extra_adult = (parseInt(price_extraadult) * no_of_extraadult);
			$("strong.extraadult").html('Rs '+subtotal_extra_adult);
			
			var price_extrachild = $("#price_extra_child").val();
			var child = $("#no_of_extra_child").val();
			var no_of_extrachild = child;
			var subtotal_extra_child = (parseInt(price_extrachild) * no_of_extrachild);
			
			var disc = $("#discount").val();
			
			var totalsub = parseInt(amount) + parseInt(subtotal_extra_room) + parseInt(subtotal_extra_adult) + parseInt(subtotal_extra_child);
			if(disc > 0){
			var discount = (totalsub * disc)/100;				
			var totalpay = parseInt(amount) + parseInt(subtotal_extra_room) + parseInt(subtotal_extra_adult) + parseInt(subtotal_extra_child) - discount;
			$("#disamount").val(discount);
			$("#useramount").val(totalsub);	
			$("#amount").val(totalpay);
			$("strong.useramount").html('Rs '+totalsub);
			$("strong.disc").html('Rs '+discount);
			$("strong.total").html('Rs '+totalpay);
			}else{
			var total = parseInt(amount) + parseInt(subtotal_extra_room) + parseInt(subtotal_extra_adult) + parseInt(subtotal_extra_child);			
			$("#amount").val(total);
			$(".total").html('Total: Rs '+total);
			}			
        }
		else{
			$("strong.extraadult").html('Rs '+0);
		}
    });
    
    $( "#no_of_extra_adults" ).keydown(function(e)
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
/* end extra adults */

/* Jalpesh add extra Children */
    
    $( "#no_of_extra_child" ).click(function() 
    {		
        children = $(this).val();
        if(children >= 0)
        {
            var price_extraroom = $("#price_extra_room").val();
            var no_of_extraroom = $("#no_of_extra_room").val();
			var amount = $("#temp_amount").val();
			var subtotal_extra_room = (parseInt(price_extraroom) * no_of_extraroom);
			var total = parseInt(amount) + parseInt(subtotal_extra_room);
			
			
			var price_extraadult = $("#price_extra_adults").val();
			var adult = $("#no_of_extra_adults").val();
			var no_of_extraadult = adult;
			var subtotal_extra_adult = (parseInt(price_extraadult) * no_of_extraadult);
			
			
			var price_extrachild = $("#price_extra_child").val();
			var child = children;
			var no_of_extrachild = child;
			var subtotal_extra_child = (parseInt(price_extrachild) * no_of_extrachild);
			$("strong.extrachildren").html('Rs '+subtotal_extra_child);
			
			var disc = $("#discount").val();
			var totalsub = parseInt(amount) + parseInt(subtotal_extra_room) + parseInt(subtotal_extra_adult) + parseInt(subtotal_extra_child);
			if(disc > 0){
			var discount = (totalsub * disc)/100;				
			var totalpay = parseInt(amount) + parseInt(subtotal_extra_room) + parseInt(subtotal_extra_adult) + parseInt(subtotal_extra_child) - discount;
			$("#disamount").val(discount);
			$("#useramount").val(totalsub);	
			$("#amount").val(totalpay);
			$("strong.useramount").html('Rs '+totalsub);
			$("strong.disc").html('Rs '+discount);
			$("strong.total").html('Rs '+totalpay);
			}else{
			var total = parseInt(amount) + parseInt(subtotal_extra_room) + parseInt(subtotal_extra_adult) + parseInt(subtotal_extra_child);			
			$("#amount").val(total);
			$(".total").html('Total: Rs '+total);
			}			
        }
		else{
			$("strong.extrachildren").html('Rs '+0);
		}
    });
    
    $( "#no_of_extra_child" ).keyup(function() 
    {
         children = $(this).val();
        if(children >= 0)
        {
            var price_extraroom = $("#price_extra_room").val();
            var no_of_extraroom = $("#no_of_extra_room").val();
			var amount = $("#temp_amount").val();
			var subtotal_extra_room = (parseInt(price_extraroom) * no_of_extraroom);
			var total = parseInt(amount) + parseInt(subtotal_extra_room);
			
			
			var price_extraadult = $("#price_extra_adults").val();
			var adult = $("#no_of_extra_adults").val();
			var no_of_extraadult = adult;
			var subtotal_extra_adult = (parseInt(price_extraadult) * no_of_extraadult);
			
			
			var price_extrachild = $("#price_extra_child").val();
			var child = children;
			var no_of_extrachild = child;
			var subtotal_extra_child = (parseInt(price_extrachild) * no_of_extrachild);
			$("strong.extrachildren").html('Rs '+subtotal_extra_child);
			
			var disc = $("#discount").val();
			var totalsub = parseInt(amount) + parseInt(subtotal_extra_room) + parseInt(subtotal_extra_adult) + parseInt(subtotal_extra_child);
			if(disc > 0){
			var discount = (totalsub * disc)/100;				
			var totalpay = parseInt(amount) + parseInt(subtotal_extra_room) + parseInt(subtotal_extra_adult) + parseInt(subtotal_extra_child) - discount;
			$("#disamount").val(discount);
			$("#useramount").val(totalsub);	
			$("#amount").val(totalpay);
			$("strong.useramount").html('Rs '+totalsub);
			$("strong.disc").html('Rs '+discount);
			$("strong.total").html('Rs '+totalpay);
			}else{
			var total = parseInt(amount) + parseInt(subtotal_extra_room) + parseInt(subtotal_extra_adult) + parseInt(subtotal_extra_child);			
			$("#amount").val(total);
			$(".total").html('Total: Rs '+total);
			}			
        }
		else{
			$("strong.extrachildren").html('Rs '+0);
		}
    });
    
    $( "#no_of_extra_child" ).keydown(function(e)
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
/* end extra adults */

/*Jalpes add room extra*/
		
		$( "#no_of_extra_room" ).click(function() 
    {
        room = $(this).val();
        
        if(room >= 0)
        {
            var price_extraroom = $("#price_extra_room").val();
            var no_of_extraroom = room;
			var amount = $("#temp_amount").val();
			var subtotal_extra_room = (parseInt(price_extraroom) * no_of_extraroom);
			var total = parseInt(amount) + parseInt(subtotal_extra_room);
			$("strong.extraroom").html('Rs '+subtotal_extra_room);
			
			var price_extraadult = $("#price_extra_adults").val();
			var adult = $("#no_of_extra_adults").val();
			var no_of_extraadult = adult;
			var subtotal_extra_adult = (parseInt(price_extraadult) * no_of_extraadult);
			
			var price_extrachild = $("#price_extra_child").val();
			var child = $("#no_of_extra_child").val();
			var no_of_extrachild = child;
			var subtotal_extra_child = (parseInt(price_extrachild) * no_of_extrachild);
			
			var disc = $("#discount").val();
			var totalsub = parseInt(amount) + parseInt(subtotal_extra_room) + parseInt(subtotal_extra_adult) + parseInt(subtotal_extra_child);
			if(disc > 0){
			var discount = (totalsub * disc)/100;				
			var totalpay = parseInt(amount) + parseInt(subtotal_extra_room) + parseInt(subtotal_extra_adult) + parseInt(subtotal_extra_child) - discount;
			$("#disamount").val(discount);
			$("#useramount").val(totalsub);	
			$("#amount").val(totalpay);
			$("strong.useramount").html('Rs '+totalsub);
			$("strong.disc").html('Rs '+discount);
			$("strong.total").html('Rs '+totalpay);
			}else{
			var total = parseInt(amount) + parseInt(subtotal_extra_room) + parseInt(subtotal_extra_adult) + parseInt(subtotal_extra_child);			
			$("#amount").val(total);
			$(".total").html('Total: Rs '+total);
			}			
        }
		else{
			$("strong.extraroom").html('Rs '+0);
		}
    });
    
    $( "#no_of_extra_room" ).keyup(function() 
    {
        room = $(this).val();
        
        if(room >= 0)
        {
            var price_extraroom = $("#price_extra_room").val();
            var no_of_extraroom = room;
			var amount = $("#temp_amount").val();
			var subtotal_extra_room = (parseInt(price_extraroom) * no_of_extraroom);
			var total = parseInt(amount) + parseInt(subtotal_extra_room);
			$("strong.extraroom").html('Rs '+subtotal_extra_room);
			
			var price_extraadult = $("#price_extra_adults").val();
			var adult = $("#no_of_extra_adults").val();
			var no_of_extraadult = adult;
			var subtotal_extra_adult = (parseInt(price_extraadult) * no_of_extraadult);
			
			var price_extrachild = $("#price_extra_child").val();
			var child = $("#no_of_extra_child").val();
			var no_of_extrachild = child;
			var subtotal_extra_child = (parseInt(price_extrachild) * no_of_extrachild);
			
			var disc = $("#discount").val();
			var totalsub = parseInt(amount) + parseInt(subtotal_extra_room) + parseInt(subtotal_extra_adult) + parseInt(subtotal_extra_child);
			if(disc > 0){
			var discount = (totalsub * disc)/100;				
			var totalpay = parseInt(amount) + parseInt(subtotal_extra_room) + parseInt(subtotal_extra_adult) + parseInt(subtotal_extra_child) - discount;
			$("#disamount").val(discount);
			$("#useramount").val(totalsub);	
			$("#amount").val(totalpay);
			$("strong.useramount").html('Rs '+totalsub);
			$("strong.disc").html('Rs '+discount);
			$("strong.total").html('Rs '+totalpay);
			}else{
			var total = parseInt(amount) + parseInt(subtotal_extra_room) + parseInt(subtotal_extra_adult) + parseInt(subtotal_extra_child);			
			$("#amount").val(total);
			$(".total").html('Total: Rs '+total);
			}			
        }
		else{
			$("strong.extraroom").html('Rs '+0);
		}
    });
    
    $( "#no_of_extra_room" ).keydown(function(e)
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
		
		
		/*end jalpesh added*/
      
	$("#chkout").click(function()
	{
		var firstname = $("#firstname").val();
		var lastname = $("#lastname").val();
		var email = $("#email").val();
		var phone = $("#phone").val();		
		var chk_agree = $('#chk_agree').is(":checked");
		
		if(firstname != '' && lastname != '' && email != '' && phone != '' && chk_agree == true)
		{
            	var token = "{{ csrf_token() }}";
            	var data = $('#frm_checkout').serializeArray();
            	var data1 = $('#frm_checkout').serialize();
      
           		$.ajax(
            	{
                		url:"{{ url('/newinserthotelorder') }}",
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
