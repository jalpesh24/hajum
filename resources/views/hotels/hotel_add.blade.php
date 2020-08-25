@extends('layouts.admin')
@section('title', 'Add Hotel')
@section('content')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<div class="container">
<div class="breadcrumbs1">
<ol class="breadcrumb">
              <li class="breadcrumb-item"><i class="fa fa-home" aria-hidden="true"></i> <a href="{{ url('/dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Add New Hotel</li>
</ol>
</div>
  <div class="row">
    <div class="col-sm-12"> @if (session('status'))
      <div class="alert alert-success">{{ session('status') }}</div>
      @endif
    @if (session('fail'))
      <div class="alert alert-fail">{{ session('fail') }}</div>
      @endif
      <div class="panel panel-default" id="panelbg">      
        <div class="panel-body">          
          <div class="col-md-12">
            <form method="post" name="frm_add_hotel" enctype="multipart/form-data">
              {{ csrf_field() }}
        <div class="col-md-12"><p style="background-color:rgb(88, 151, 69);font-size:18px;color:#fff;">  Basic Info </p></div>
              <div class="col-md-6 form-line">
                <div class="form-group">
                  <label for="packagename">Hotel name</label>
                  <input type="text" class="form-control" id="hotel_name" placeholder="Hotel Name" name="hotel_name" required="required">
                </div>
              </div>
        <div class="col-md-6 form-line">
                <div class="form-group">
                  <label for="packagename">Hotel code</label>
                  <input type="text" class="form-control" id="hotel_code" placeholder="Hotel Code" name="hotel_code" required="required">
                </div>
              </div>
         <div class="col-md-6 form-line">
                <div class="form-group">
                  <label for="packagename">Hotel Type</label>
          
          <select name="hotel_type" id="hotel_type" class="form-control">
          <option value="">Select Hotel Type</option>
          @foreach($hoteltypes as $hoteltype)
          <option value="{!! $hoteltype->hoteltypename !!}">{!! $hoteltype->hoteltypename !!}</option>                 
          @endforeach
          </select>
                </div>
              </div>
        <div class="col-md-6 form-line">
                <div class="form-group">
                  <label for="packagename">Hotel Chain</label>                  
          <select name="hotel_chain" id="hotel_chain" class="form-control">
          <option value="">Select Hotel Chain</option>
          @foreach($hotelchainttypes as $hotelchainttype)
          <option value="{!! $hotelchainttype->hotelchainname !!}">{!! $hotelchainttype->hotelchainname !!}</option>                 
          @endforeach
          </select>
                </div>
              </div>
         <div class="col-md-6 form-line">
                <div class="form-group">
                  <label for="packagename">Star Rating</label>
                  <input type="number" class="form-control" id="hotel_star" placeholder="Hotel Star Rating" min="1" max="5" value="1" name="hotel_star" required="required">
                </div>
              </div>
        <div class="col-md-6 form-line">
                <div class="form-group">
                  <label for="packagename">No. of Restaurant:</label>
                  <input type="number" class="form-control" id="hotel_restaurant" placeholder="Hotel Restaurant" min="1" max="5" value="1" name="hotel_restaurant" required="required">
                </div>
              </div>
      
              <div class="col-md-6 form-line">
                <div class="form-group">
                  <div class="col-md-6" style="padding-left:0px;">
                    <label for="fromdate">Valid From</label>
                    <input type="text" class="form-control datepicker"  name="hotel_checkin" id="fromdate" placeholder="Valid From" value="{!! date('d-m-Y') !!}"  required="required">
                  </div>
          </div>
              </div>
        <div class="col-md-6 form-line">
                <div class="form-group">
                  <div class="col-md-6" style="padding-left:0px;">
                    <label for="todate">Valid To</label>
                    <input type="text" class="form-control datepicker" name="hotel_checkout" id="todate" placeholder="Valid To" value="{!! date('d-m-Y') !!}"  required="required" />
                  </div>
                </div>
              </div>
              
              <div class="col-md-6 form-line">
        <div class="form-group">
                  <label for="floor">Hotel Total No Of Floors:</label>
                  <input type="number" class="form-control" min="1" name="totalfloor" id="totalfloor" placeholder="Enter Total Floors" value="1" >
                </div>
        </div>
              
              <div class="col-md-6 form-line">
        <div class="form-group">
                  <label for="room">Hotel Total Room</label>
                  <input type="number" class="form-control" min="1" name="totalroom" id="totalroom" placeholder="Enter Total Room" value="1" >
                </div>
        </div>
              
              <div class="col-md-6 form-line">
                <div class="form-group">
                  <label for="address">Address</label>
                  <textarea rows="4" class="form-control" id="hotel_address" name="hotel_address" placeholder="Enter Address" ></textarea>
                </div>
        </div>
              
              <div class="col-md-6 form-line">
        <div class="form-group">
                  <label for="location" >City Location</label>
                  <input type="text" class="form-control" placeholder=" Enter City Location" name="hotel_location" id="hotel_location"  required="required">
                </div>
        </div>
              
              <div class="col-md-6 form-line">
        <div class="form-group">
                  <label for="location" >State Stae Location</label>
                  <input type="text" class="form-control" placeholder=" Enter State Location" name="hotel_state_location" id="hotel_state_location"  required="required">
                </div>
        </div>
              
              <div class="col-md-6 form-line">
        <div class="form-group">
                  <label for="location" >Country Country Location</label>
                  <input type="text" class="form-control" placeholder=" Enter country Location" name="hotel_country_location" id="hotel_state_location"  required="required">
                </div>
        </div>
              
              <div class="col-md-6 form-line">
        <div class="form-group">
                  <label for ="price">Pincode</label>
                  <input type="number" class="form-control" name="hotel_pincode" id="hotel_pincode" placeholder="Enter Pincode." onkeypress="return isNumberKey(event)" >
                </div>
        </div>
              
              <div class="col-md-6 form-line">
        <div class="form-group">
                  <label for ="price">Currency</label>
                  <input type="text" class="form-control" name="hotel_currency" id="hotel_currency" placeholder="Enter Currency." >
                </div>
              </div>
        
            
              <div class="col-md-6 form-line">        
                <div class="form-group">
                  <label for="location" >Check-in Time</label>
                  <select class="form-group" name="hotel_checkin_time" id="hotel_checkin_time">
                      @for($i=0;$i<25;$i++)
                      <option value="<?=$i.":00"?>"><?=$i.":00"?></option>
                      @endfor
                  </select>         
                  <select class="form-group" name="hotel_checkin_ampm" id="hotel_checkin_ampm">
                      <option value="AM" selected="select">AM</option>
            <option value="AM">PM</option>
                  </select>
                  <!-- <input type="text" class="form-control" placeholder="12:00 PM or Flexible" name="hotel_checkin_time" id="hotel_checkin_time" > -->
                </div>
        </div>
              
              <div class="col-md-6 form-line">
                <div class="form-group">
                  <label for="location" >Check-out Time</label>
                   <select class="form-group" name="hotel_checkout_time" id="hotel_checkout_time">
                      @for($i=0;$i<25;$i++)
                      <option value="<?=$i.":00"?>"><?=$i.":00"?></option>
                      @endfor
                  </select>        
                  <select class="form-group" name="hotel_checkout_ampm" id="hotel_checkout_ampm">
                      <option value="AM" selected="select">AM</option>
            <option value="AM">PM</option>
                  </select>
                  <!-- <input type="text" class="form-control" placeholder="12:00 PM or Flexible" name="hotel_checkout_time" id="hotel_checkout_time"> -->
                </div>
              </div>
        
              <div class="col-md-6 form-line"> 
            <div class="form-group">
                      <label for="location" >Hotel Contact Name</label>
                      <input type="text" class="form-control" placeholder=" Enter Contact" name="hotel_contact_name" id="hotel_contact_name"   required="required">
                    </div>
            </div>
              
              <div class="col-md-6 form-line">
            <div class="form-group">
                      <label for="location" >Hotel Contact No</label>
                      <input type="text" class="form-control" placeholder=" Enter Contact" name="hotel_contact" id="hotel_contact" onkeypress="return isNumberKey(event)" >
                    </div>
            </div>
              
              <div class="col-md-6 form-line">
            <div class="form-group">
                      <label for="location" >Hotel Mobile No</label>
                      <input type="text" class="form-control" placeholder=" Enter Contact" name="hotel_mobile" id="hotel_mobile" onkeypress="return isNumberKey(event)">
                    </div>
              </div>
              
              <div class="col-md-6 form-line">
                    <div class="form-group">
                      <label for="location" >Hotel Email</label>
                      <input type="text" class="form-control" placeholder=" Enter Email" name="hotel_email" id="hotel_email"  required="required">
                    </div>
            </div>
              
              <div class="col-md-6 form-line">
            <div class="form-group">
                      <label for="location" >Hotel FAX</label>
                      <input type="text" class="form-control" placeholder=" Enter Fax" name="hotel_fax" id="hotel_fax" onkeypress="return isNumberKey(event)" >
                    </div>
            </div>
              
              <div class="col-md-6 form-line">
            <div class="form-group">
                      <label for="location" >Hotel Website</label>
                      <input type="text" class="form-control" placeholder=" Enter Website" name="hotel_website" id="hotel_website" >
                    </div>
              </div>
              
             
             <div class="col-md-6">
                  <div class="form-group">
                    <label for="location">Upload Hotel Image</label>
            <p> Browse your files and select the pictures to upload. Check the message on the image to identify their quality.
</p><p>
    Low resolution image (below 500*400 pixels)
    Medium resolution image (in between 500*400 and 500*400 pixels)
    High resolution image (above 1536x2048 pixels) 
</p><p>
Tip : High resolution images (at least 500*400 pixels) will help your hotel convert better, which means even more bookings!

Note:
</p><p>
    You can edit Image after upload also.
    To make an image as master image drag it to the first location.
    Max Image Size Limit : 10MB
</p>
                    <input type="file" class="form-control" name="hotel_image[]" id="hotel_image" multiple>
                 </div>
               </div>
               
                
               
              <div class="col-md-12 form-line">
                <div class="form-group">
                  <label>Amenities</label>
                  &nbsp;
          
                  <div style="clear:both;"></div>
          <div class="col-md-12">
          <ul>
          @foreach($hotelaminities as $hotelaminitie)
          <li style="float:left;margin:10px;list-style:none;">
                  <input type="checkbox" name="amenities[]" value="{!! $hotelaminitie->aminity_name !!}"/>
                    &nbsp;&nbsp;{!! $hotelaminitie->aminity_name !!}      
          </li>
                  @endforeach
          </ul>
        </div>
            
                </div>
              </div>
         <div style="clear:both"></div>
        <div class="col-md-12 form-line">
        <p style="background-color:rgb(88, 151, 69);font-size:18px;color:#fff;">  BANK & ACCOUNT DETAILS </p></div>
           <div style="clear:both"></div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="highlights">Account Name</label>
                      <input type="text" class="form-control" id="hotel_bank_accountname" value="" name="hotel_bank_accountname" placeholder="Enter Account Name" >
                    </div>
                </div>
          <div class="col-md-6">
                    <div class="form-group">
                      <label for="highlights">Account Number</label>
              <input type="text" class="form-control" id="hotel_bank_accountno" value="" name="hotel_bank_accountno" placeholder="Enter hotel accountno">                    
                    </div>
                </div>
          <div class="col-md-6">
                    <div class="form-group">
                      <label for="highlights">Pan Number:</label>
              <input type="text" class="form-control" id="hotel_panno" value="" name="hotel_panno" placeholder="Enter Pan Number">                     
                    </div>
                </div>
          <div class="col-md-6">
                    <div class="form-group">
                      <label for="highlights">Name On Pan Card:</label>
              <input type="text" class="form-control" id="hotel_pancardname" value="" name="hotel_pancardname" placeholder="Enter Pan Card Name">                    
                    </div>
                </div>
          <div class="col-md-6">
                    <div class="form-group">
                      <label for="highlights">Service Tax No.:</label>
              <input type="text" class="form-control" id="hotel_servicetaxno" value="" name="hotel_servicetaxno" placeholder="Enter Service Tax number">                     
                    </div>
                </div>
          <div class="col-md-6">
                    <div class="form-group">
                      <label for="highlights">Bank Name and Branch Name</label>
                      <input type="text" class="form-control" id="hotel_bankname" value="" name="hotel_bankname" placeholder="Enter bankname" >
                    </div>
                </div>
          <div class="col-md-6">
                    <div class="form-group">
                      <label for="highlights">Bank Address</label>
                      <input type="text" class="form-control" id="hotel_bankdetail" value="" name="hotel_bankdetail" placeholder="Enter bank address" >
                    </div>
                </div>          
          <div class="col-md-6">
                    <div class="form-group">
                      <label for="highlights">State/Province</label>
                      <input type="text" class="form-control" id="hotel_bank_state" value="" name="hotel_bank_state" placeholder="Enter bank state" >
                    </div>
                </div>
          <div class="col-md-6">
                    <div class="form-group">
                      <label for="highlights">RTGS/NEFT Code</label>
                      <input type="text" class="form-control" id="hotel_bank_code" value="" name="hotel_bank_code" placeholder="Enter Bank NEFT/IFSC Code" >
                    </div>
                </div>
          
            <div class="col-md-6">
                  <div class="form-group">
                    <label for="location">Upload Document</label>
            <p> Upload your Pan Card, Aadhar Card and Hotel GST Info Documents </p>
                    <input type="file" class="form-control" name="hotel_docs[]" id="hotel_docs" multiple>
                 </div>
               </div>
         <div style="clear:both"></div>
          <div class="col-md-12 form-line">
        <p style="background-color:rgb(88, 151, 69);font-size:18px;color:#fff;">  GST Info </p></div>
        
        <div class="col-md-6">
                    <div class="form-group">
                      <label for="highlights">GST Number:</label>
                      <input type="text" class="form-control" id="hotel_gst_no" value="" name="hotel_gst_no" placeholder="Enter GST Number" >
                    </div>
                </div>
           <div class="col-md-6">
                    <div class="form-group">
                      <label for="highlights">GST Name:</label>
                      <input type="text" class="form-control" id="hotel_gst_name" value="" name="hotel_gst_name" placeholder="Enter GST Name" >
                    </div>
                </div>
          <div class="col-md-6">
                    <div class="form-group">
                      <label for="highlights">GST Address:</label>
                      <input type="text" class="form-control" id="hotel_gst_address" value="" name="hotel_gst_address" placeholder="Enter GST Address" >
                    </div>
                </div>
          <div class="col-md-6">
                    <div class="form-group">
                      <label for="highlights">GST State:</label>
                      <input type="text" class="form-control" id="hotel_gst_state" value="" name="hotel_gst_state" placeholder="Enter GST State" >
                    </div>
                </div>
          <div class="col-md-6">
                    <div class="form-group">
                      <label for="highlights">GST PIN Code:</label>
                      <input type="text" class="form-control" id="hotel_gst_pincode" value="" name="hotel_gst_pincode" placeholder="Enter GST PIN Code" >
                    </div>
                </div>
          <div class="col-md-6">
                    <div class="form-group">
                      <label for="highlights">GST Contact No:</label>
                      <input type="text" class="form-control" id="hotel_gst_contact" value="" name="hotel_gst_contact" placeholder="Enter GST Contact" >
                    </div>
                </div>
          <div class="col-md-6">
                    <div class="form-group">
                      <label for="highlights">GST E-Mail:</label>
                      <input type="text" class="form-control" id="hotel_gst_email" value="" name="hotel_gst_email" placeholder="Enter GST E-Mail" >
                    </div>
                </div>
          <div class="col-md-6">
                    <div class="form-group">
                      <label for="highlights">GST Designation:</label>
                      <input type="text" class="form-control" id="hotel_gst_designation" value="" name="hotel_gst_designation" placeholder="Enter GST Designation" >
                    </div>
                </div>
        
          <div class="col-md-12 form-line">
        <p style="background-color:rgb(88, 151, 69);font-size:18px;color:#fff;">  Policy Info </p></div>
              <div style="clear:both;margin-bottom:10px;"></div>
              <div class="col-md-6 form-line">
                <div class="form-group">
                  <label for="highlights">Highlights</label>
                  <textarea rows="3" class="form-control" id="hotel_highlights" name="hotel_highlights" placeholder="Enter highlights" ></textarea>
                </div>
              </div>
              <div class="col-md-6 form-line">
                <div class="form-group">
                <label for="nearestplace">Nearest Places</label>
                <textarea rows="3" class="form-control" id="hotel_nearestplace" name="hotel_nearestplace" placeholder="Nearest Places data" ></textarea>
                </div>
              </div>
                <!-- <div class="col-md-6 form-line">
                <div class="form-group">
                <label for="cancellationfees">Cancellation Fees</label>
                <textarea rows="3" class="form-control" id="hotel_cancellationfees" name="hotel_cancellationfees" placeholder="Cancellation fees data" ></textarea>
                </div>
              </div> -->
              <div style="clear:both"></div>          
              <div class="col-md-6 form-line">
                <div class="form-group">
                  <label for="paymentpolicy">Payment Policy</label>
                  <textarea rows="4" class="form-control" id="hotel_paymentpolicy" name="hotel_paymentpolicy" placeholder="Enter Payment Policy" ></textarea>
                </div>
              </div>
              <div class="col-md-6 form-line">
                <div class="form-group">
                  <label for="packagename">Cancellation Policy</label>
                  <textarea rows="4" class="form-control" id="hotel_cancellationpolicy" name="hotel_cancellationpolicy" placeholder="Enter Cancellation Policy"></textarea>
                </div>
              </div>
              <div style="clear:both"></div>
              <div class="col-md-12 form-line">
                <div class="form-group">
                  <label for="packagename">Terms &amp; Conditions</label>
                  <textarea rows="4" class="form-control" id="hotel_termsconditions" name="hotel_termsconditions" placeholder="Enter Terms and Conditions" ></textarea>
                </div>
              </div>
              <div style="clear:both"></div>
              <div class="col-md-6 form-line">
                <div class="form-group">
                  <input type="submit" class="btn btn-primary submit" name="btn_add_hotel" id="btn_add_tour" value="Save and Continue">
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
<script src="{{ asset('public/newhtml/js/jquery.js') }}"></script>
<script src="{{ asset('public/newhtml/js/jquery-ui.js') }}"></script>
<script src="{{ asset('public/newhtml/js/jquery-migrate-1.js') }}"></script>
<script src="{{ asset('public/newhtml/js/superfish.js') }}"></script>
<script src="{{ asset('public/newhtml/js/select2.js') }}"></script>
<script src="{{ asset('public/newhtml/js/jquery_002.js') }}"></script>
<script src="{{ asset('public/newhtml/js/jquery_006.js') }}"></script>
<script src="{{ asset('public/newhtml/js/jquery_003.js') }}"></script>
<script src="{{ asset('public/newhtml/js/jquery_007.js') }}"></script>
<script src="{{ asset('public/newhtml/js/scripts.js') }}"></script>
<script src="{{ asset('public/newhtml/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('public/newhtml/js/bootstrap.min.js') }}"></script>

<script type="text/javascript">
  
  var date = new Date(); 
      $('#todate').datepicker(
      {
        format: "dd-mm-yy",
        autoclose: true,
        onSelect: function(date){ 
        }
      });
      
      $('#fromdate').datepicker(
      {
        format: "dd-mm-yy",
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
<script type="text/javascript">
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}    
</script>

<a href="#" id="toTop" style="display: inline;"><span id="toTopHover"></span></a><div id="ui-datepicker-div" class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all"></div>