@include('includes.newheader')
<div class="container">
<div class="breadcrumbs1">
<ol class="breadcrumb">
              <li class="breadcrumb-item"><i class="fa fa-home" aria-hidden="true"></i> <a href="{{ url('/newhome') }}">Home</a></li>
              <li class="breadcrumb-item active">Hotel Add Price</li>
</ol>
</div>
  <div class="row">
    <div class="col-sm-12"> @if (session('status'))
      <div class="alert alert-success">{{ session('status') }}</div>
      @endif
      <div class="panel panel-default" id="panelbg">
        <div class="panel-heading" id="headerbg">
         @if (Auth::guest())              
         @else
	     @include('includes.minimenu')              
         @endif 
        </div>
        <div class="panel-body">
          <div class="col-sm-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><i class="fa fa-home" aria-hidden="true"></i> <a href="{{ url('/dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{ url('/hotel-list') }}">Add New Hotel Price</a></li>
              <li class="breadcrumb-item active">Add New Hotel Price</li>
            </ol>
          </div>
                  
    <div class="col-md-12">
	<div>
              <p> 
				RP = Retail Price , CP = Cost Price
				Please provide your net rate (CP) below and input the commission rate (Gross Profit). To calculate retail price after commission, please select "Cal.RP."
				RP X Gross Profit = CP (for example, 100 X 20% = 80)
				RP is the price paid by the customer, Gross Profit is the percentage paid to TripIndia, and CP is the price paid to the local operator.
				Gross Profit is always calculated based on the RP and added to the CP. 
			  </p>
			  
	</div>
	<form method="post" name="frm_add_hotelprice" enctype="multipart/form-data">
              {{ csrf_field() }}
    <div class="row" style="float:left;width:50%;">
              <div class="col-md-6 form-line">
              <h2> Adults </h2>
                <div class="form-group">
                
                  <label for="adno">Number of units</label><br/>
                  <input class="units" type="text" value="0" id="adno" name="adno" placeholder="Number of units" style="color:#000000;" /><br/>
                  <label for="adprice">Cost Price to End Customer</label><br/>
				  <input class="price" type="text" value="0" id="adprice" name="adprice" placeholder="Unit price" style="color:#000000;"/><br/>
				  <label for="packagename">Commission to Trip India (%) </label><br/>
				  <input type="radio" name="adult" value="adpercentage" onclick="adpercentage()" checked="checked"> Percentage(%)
				  <input type="radio" name="adult" value="adflat" onclick="adflat()"> Flat Discount
				 <div id="perdiscount" style="display: show">
                  <input class="rate" type="number" max="100" min="0" id="addiscount" name="addiscount" placeholder="Discount rate %" style="color:#000000;" value="0" /><br/>
				  </div>
				  <div id="flatdiscount" style="display: none">
				  <input class="rate" type="text" value="0" id="adflatdiscount" name="adflatdiscount" placeholder="Flate Discount" style="color:#000000;"/>	<br/>	 
				 </div>						 
				
				  <label for="packagename">Amount to Operator</label><br/>
                  <input class="total" type="text" value="0" id="adtotal" name="adtotal" placeholder="Total" style="color:#000000;"/>
               
                </div>
              </div>
              </div>
              
              <div class="row"style="float:left;width:50%;">
              <div class="col-md-6 form-line">
              <h2> Childs </h2>
                <div class="form-group">
                  <label for="cdno">Number of units</label><br/>
                  <input class="units" type="text" id="cdno" value="0" name="cdno" placeholder="Number of units" style="color:#000000;"/><br/>
                  <label for="cdprice">Cost Price to End Customer</label><br/>
				  <input class="price" type="text" id="cdprice"value="0" name="cdprice" placeholder="Unit price" style="color:#000000;"/><br/>				 			 
				  <label for="packagename">Commission to Trip India %</label><br/>
				  <input type="radio" name="child" value="cdpercentage" onclick="cdpercentage()" checked="checked"> Percentage(%)
				  <input type="radio" name="child" value="cdflat" onclick="cdflat()"> Flat Discount				 
				  <div id="cdperdiscount" style="display: show">				  
                  <input class="rate" type="number" max="100" min="0" id="cddiscount" name="cddiscount" placeholder="Discount rate %" style="color:#000000;" value="0"/><br/>
				  </div>
				  <div id="cdflatdisc" style="display: none">
				  <input class="rate" type="text" id="cdflatdiscount" name="cdflatdiscount" placeholder="Flate Discount" style="color:#000000;" value="0"/><br/>
				 </div>	
                  <label for="cdtotal">Amount to Operator</label><br/>
                  <input class="total" type="text"  id="cdtotal" value="0" name="cdtotal" placeholder="Total" style="color:#000000;"/>
               
                </div>
              </div>
       
             </div> 
			 <div style="clear:both"></div>
			 <div class="form-group">
              <input type="submit" class="btn btn-primary submit" name="btn_add_hotelprice" id="btn_add_hotelprice" value="Save and continue">
            </div>
          </form>
      
   
    
</div>
</div>
      </div>
    </div>
  </div>
</div>
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
<script type="text/javascript">
function adpercentage() {
    document.getElementById('perdiscount').style.display = "block";
	document.getElementById('adflatdiscount').value = "0";
	document.getElementById('addiscount').value = "0";
    document.getElementById('flatdiscount').style.display = "none";
}
function adflat() {
    document.getElementById('flatdiscount').style.display = "block";
	document.getElementById('adflatdiscount').value = "0";
	document.getElementById('addiscount').value = "0";
    document.getElementById('perdiscount').style.display = "none";
}

function cdpercentage() {
    document.getElementById('cdperdiscount').style.display = "block";
	document.getElementById('cdflatdiscount').value = "0";
	document.getElementById('cddiscount').value = "0";
    document.getElementById('cdflatdisc').style.display = "none";
}
function cdflat() {
    document.getElementById('cdflatdisc').style.display = "block";
	document.getElementById('cdflatdiscount').value = "0";
	document.getElementById('cddiscount').value = "0";
    document.getElementById('cdperdiscount').style.display = "none";
}
</script>
<script type="text/javascript">

function calculate(units, price, discount) {
    if (discount) {
        if (discount < 0 || discount > 100) {
            discount = 0;
        }
    } else {
        discount = 0;
    }
    return (units * price) * (1 - (discount / 100));
}

$('input').on('change', function () {
    var scope = $(this).closest('.row'),
        units = $('.units', scope).val(),
        price = $('.price', scope).val(),
        discount = $('.rate', scope).val(),
        total = $('.total', scope);
    if ($.isNumeric(units) && $.isNumeric(price) && ($.isNumeric(discount) || discount === '')) {
        total.val(calculate(units, price, discount));
    } else {
        total.val('');
    }
});
</script>
<a href="#" id="toTop" style="display: inline;"><span id="toTopHover"></span></a><div id="ui-datepicker-div" class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all"></div></body></html>