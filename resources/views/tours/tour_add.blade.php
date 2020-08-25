@extends('layouts.admin')
@section('title', 'Add Tour')
@section('content')
.<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<div class="container">
<div class="breadcrumbs1">
<ol class="breadcrumb">
              <li class="breadcrumb-item"><i class="fa fa-home" aria-hidden="true"></i> <a href="{{ url('/dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Add New Tour</li>
</ol>
</div>
  <div class="row">
    <div class="col-sm-12"> @if (session('status'))
      <div class="alert alert-success">{{ session('status') }}</div>
      @endif
      <div class="panel panel-default" id="panelbg">
     
        <div class="panel-body">
     
          <div class="col-md-12">
            <form method="post" name="frm_add_tour" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="col-md-4 form-line">
                <div class="form-group">
                  <label for="packagename">Tour package name</label>
                  <input type="text" class="form-control" id="txt_tour_name" placeholder="Package Name" name="txt_tour_name" required="required">
                </div>
              </div>
              <div class="col-md-4 form-line">
                <div class="form-group">
                  <div class="col-md-6" style="padding-left:0px;">
                    <label for="fromdate">Valid From</label>
                    <input type="text" class="form-control datepicker"  name="txt_tour_checkin" id="fromdate" placeholder="Valid from" value="{!! date('d-m-Y') !!}"  required="required">
                  </div>
                  <div class="col-md-6" style="padding-left:0px;">
                    <label for="todate">Valid To</label>
                    <input type="text" class="form-control datepicker" name="txt_tour_checkout" id="todate" placeholder="Valid to" value="{!! date('d-m-Y') !!}"  required="required" />
                  </div>
                </div>
              </div>
              <div class="col-md-4 form-line">
                <div class="form-group">
                  <div class="col-md-6" style="padding-left:0px;">
                    <label for ="txt_tour_price">Price per person</label>
                    <input type="number" class="form-control" name="txt_tour_price" id="txt_tour_price" value="0"  min="0" max="100000000000" required="required">
                  </div>
                  <div class="col-md-6" style="padding-left:0px;">
                    <label for="packagename">Sale Price</label>
                    <input type="number" class="form-control" name="txt_tour_saleprice" id="txt_tour_saleprice" placeholder="Sale price." value="" min="0" max="100000000">
                  </div>
                </div>
              </div>
              <div style="clear:both"></div>
              <div class="col-md-4 form-line">
                <div class="form-group">
                  <label for="location" >Location</label>
                  <input type="text" class="form-control" placeholder=" Enter Location" name="txt_tour_location" id="txt_tour_location"  value="" required="required">
                </div>
              </div>
              <div class="col-md-4 form-line">
                <div class="form-group">
                  <div class="col-md-6" style="padding-left:0px;">
                    <label for ="price">Days</label>
                    <input type="number" class="form-control" name="txt_tour_days" id="txt_tour_days" placeholder="Enter Days." min="0" max="30" value="1"  required="required">
                  </div>
                  <div class="col-md-6" style="padding-left:0px;">
                    <label for ="price">Nights</label>
                    <input type="number" class="form-control" name="txt_tour_nights" id="txt_tour_nights" placeholder="Enter Days." min="0" max="30" value="1" required="required">
                  </div>
                </div>
              </div>
              <div class="col-md-4 form-line">
                <div class="form-group">
                  <div class="col-md-6" style="padding-left:0px;">
                    <label for ="txt_tour_rating">Rating</label>
                    <input type="number" class="form-control" name="txt_tour_rating" id="txt_tour_rating" placeholder=" Enter Rating between 1-5." min="0" max="5" value="0" required="required">
                  </div>
                  <div class="col-md-6" style="padding-left:0px;">
                    <label for ="txt_tour_rating">Number of places</label>
                    <input type="number" class="form-control" name="txt_tour_places" id="txt_tour_places" placeholder="Number of places." min="0" max="50" value="" required="required">
                  </div>
                </div>
              </div>
              <div style="clear:both"></div>
              <div class="col-md-12 form-line">
			  <div class="col-md-4" style="padding-left:0px;">
                <div class="form-group">
                  <div class="col-md-6" style="padding-left:0px;">
                  <label for="packagename">Image</label>
				  <input type="file" class="form-control" name="mainimg[]" id="media" multiple>
                  </div>
                   </div>
				   </div>
                <div class="col-md-4" style="padding-left:0px;">
                    <label for ="txt_tour_partofindia">Part of india</label>
                    <select name="partofindia" id="partofindia" class="form-control"  required="required">
                      <option value="east" selected="selected">East</option>
                      <option value="west">West</option>
                      <option value="north">North</option>
                      <option value="south">South</option>
                    </select>
                    </div>
					<div class="col-md-4" style="padding-left:0px;">
					 <div class="form-group">
                  <div class="col-md-6" style="padding-left:0px;">
                  <label for="packagename">GST TAX</label>
				  <input type="text" class="form-control" name="gst" id="gst" value="0">
                  </div>
                   </div>
               </div> 
			   </div> 
			   <div style="clear:both"></div>
			   <div class="col-md-6" style="padding-left:0px;">
                <label>Themes</label>&nbsp; <div style="clear:both"></div> 
                <div class="col-md-4 form-line">
                <input type="checkbox" name="chk_themes[]" value="adventure,"/>&nbsp;&nbsp;Adventure<br />
                <input type="checkbox" name="chk_themes[]" value="art-culture"/>&nbsp;&nbsp;Art &amp; Culture<br />
                <input type="checkbox" name="chk_themes[]" value="family"  />&nbsp;&nbsp;Family<br />
                </div>
                <div class="col-md-4 form-line">    
                <input type="checkbox" name="chk_themes[]" value="fort-palaces"  />&nbsp;&nbsp;Fort &amp; Palaces<br />                
                <input type="checkbox" name="chk_themes[]" value="honeymoon"  />&nbsp;&nbsp;Honeymoon<br />                                                           
                <input type="checkbox" name="chk_themes[]" value="romantic"  />&nbsp;&nbsp;Romantic<br />                                                               
                </div>
                <div class="col-md-4 form-line">    
                <input type="checkbox" name="chk_themes[]" value="shopping"  />&nbsp;&nbsp;Shopping<br />                                                                
                <input type="checkbox" name="chk_themes[]" value="sightseen"  />&nbsp;&nbsp;Sightseen<br />                                                                
                <input type="checkbox" name="chk_themes[]" value="summer"  />&nbsp;&nbsp;Summer<br />                                                                
                </div>
              </div>
             
             
              <div style="clear:both"></div>
              
              <div class="col-md-6 form-line">
                <div class="form-group">
                <label for="packagename">Amenities</label>&nbsp; <div style="clear:both"></div>
                  <!-- <label for="packagename">Inclusions</label> -->
                  <!-- <textarea rows="6" class="form-control" id="txt_tour_inclusions" name="txt_tour_inclusions" placeholder="Enter Inclusions" ></textarea> -->
                <div class="col-md-4 form-line">
                <input type="checkbox" name="chk_inclusion[]" value="transfer"/>&nbsp;&nbsp;Hotel/Pick Up Location<br />
                <input type="checkbox" name="chk_inclusion[]" value="accomodation"/>&nbsp;&nbsp;Accommodation<br />
                <input type="checkbox" name="chk_inclusion[]" value="meals"  />&nbsp;&nbsp;Meals<br />
                <input type="checkbox" name="chk_inclusion[]" value="sightseen"  />&nbsp;&nbsp;Sightseeing<br />
                </div>

                </div>
              </div>
              
              <div class="col-md-6 form-line">
                <div class="form-group">
                  <div class="col-md-6">
                    <label for ="gbooking">Min Guest Per Booking:</label>
                    <input type="number" class="form-control" name="txt_tour_guest" id="txt_tour_guest" placeholder="Enter Guest." min="1" max="10" value="1"  required="required">
                  
                 	 <label for ="rbooking">Max Guest Per Room:</label>
                    <input type="number" class="form-control" name="txt_tour_room" id="txt_tour_room" placeholder="Enter Room." value="1" min="1" max="10" required="required">
                 
                    <label for ="child">Max Allow Child Age:</label>
                    <input type="number" class="form-control" name="txt_child_age" id="txt_child_age" placeholder="Enter Child Age." value="0" min="1" max="12">
                  </div>
                </div>
              </div>
              <div style="clear:both"></div> 
              <div class="col-md-6 form-line">
                <div class="form-group">
                  <label for="packagename">Overview</label>
                  <textarea rows="6" class="form-control" id="txt_tour_overview" name="txt_tour_overview" placeholder="Enter overview" ></textarea>
                </div>
              </div>
              
              <div class="col-md-6 form-line">
                <div class="form-group">
                  <label for="packagename">Tour Package Excludes:</label>
                  <textarea rows="6" class="form-control" id="txt_tour_exclusions" name="txt_tour_exclusions" placeholder="Enter Exclusions" ></textarea>
                </div>
              </div>
              <div style="clear:both"></div>
              <div class="col-md-6 form-line">
                <div class="form-group">
                  <label for="packagename">Payment Policy</label>
                  <textarea rows="6" class="form-control" id="txt_tour_paymentpolicy" name="txt_tour_paymentpolicy" placeholder="Enter Payment Policy" ></textarea>
                </div>
              </div>
              <div class="col-md-6 form-line">
                <div class="form-group">
                  <label for="packagename">Cancellation Policy</label>
                  <textarea rows="6" class="form-control" id="txt_tour_cancellationpolicy" name="txt_tour_cancellationpolicy" placeholder="Enter Cancellation Policy"></textarea>
                </div>
              </div>
              <div style="clear:both"></div>
              <div class="col-md-12 form-line">
                <div class="form-group">
                  <label for="packagename">Terms &amp; Conditions</label>
                  <textarea rows="6" class="form-control" id="txt_tour_termsconditions" name="txt_tour_termsconditions" placeholder="Enter Terms and Conditions" ></textarea>
                </div>
              </div>
              <div style="clear:both"></div>
              <div class="col-md-6 form-line">
                <div class="form-group">
                  <input type="submit" class="btn btn-primary submit" name="btn_add_tour" id="btn_add_tour" value="Save and Continue">
                </div>
              </div>
               </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

<script type="text/javascript">
	var date = new Date(); 
			$('#todate').datepicker(
			{
				dateformat: "dd-mm-yy",
				autoclose: true,
				onSelect: function(date){ 
				}
			});
			
			$('#fromdate').datepicker(
			{
				dateformat: "dd-mm-yy",
				autoclose: true,
				minDate: date,
				onSelect: function(date){ 
					var dt2 = $('#todate');
					var startDate = $(this).datepicker('getDate');
					startDate.setDate(startDate.getDate() + 1);
					var minDate = $(this).datepicker('getDate');
					minDate.setDate(minDate.getDate() + 1);
					
					dt2.datepicker('setDate', minDate);
					dt2.datepicker('option', 'minDate', minDate);
					//dt2.focus();
					$("#todate").focus();
					dt2.open();
				}
			});
</script>
<a href="#" id="toTop" style="display: inline;"><span id="toTopHover"></span></a><div id="ui-datepicker-div" class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all"></div>
