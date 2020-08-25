@include('includes.newheader')
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<div class="container">
<div class="breadcrumbs1">
<ol class="breadcrumb">
              <li class="breadcrumb-item"><i class="fa fa-home" aria-hidden="true"></i> <a href="{{ url('/newhome') }}">Home</a></li>
              <li class="breadcrumb-item active">Hotel Edit</li>
</ol>
</div>
	<div class="row">
      	<div class="col-sm-12">
            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
			@endif
            <div class="panel panel-default" id="panelbg">
                <div class="panel-heading" id="headerbg">
                    @if (!Auth::guest())
                        @include('includes.minimenu')
					@endif
                </div>
				 
                <div class="panel-body">
                    <div class="col-sm-12">
                        <ol class="">
                            <li class="btn btn-primary"><a href="{{ url('/hotels-list') }}" style="color:#fff;">Home</a></li>
                            <li class="btn btn-primary"><a href="{{ url('/hotel/'.$hotel[0]->hotel_id) }}" style="color:#fff;">Basic</a></li>
							<li class="btn btn-primary"><a href="{{ url('/room-list/'.$hotel[0]->hotel_id) }}" style="color:#fff;">Room List</a></li>
							<li class="btn btn-primary"><a href="{{ url('/amenities-list/'.$hotel[0]->hotel_id) }}" style="color:#fff;">Amenities</a></li>
							
                                   
						</ol>
                    </div>
                              
                              <div class="col-md-12">
                              <form method="post" name="frm_edit_hotel" enctype="multipart/form-data">
                              	{{ csrf_field() }}
								<div class="col-md-12 form-line">
								<p style="background-color:rgb(88, 151, 69);font-size:18px;color:#fff;">  Basic Info </p></div>
                                    <div class="col-md-6 form-line">
                                    	<div class="form-group">
                                          	<label for="hotel_name">Hotel name</label>
                                                <input type="text" class="form-control" id="hotel_name" placeholder="Hotel Name" name="hotel_name" required="required" value="{!! $hotel[0]->hotel_name !!}">
										</div>
									</div>
									                                    
                                    <div class="col-md-6 form-line">
                                    	<div class="form-group">
                                          	<div class="col-md-6" style="padding-left:0px;">
                                                	<label for="fromdate">Valid From</label>
                                                      <input type="text" class="form-control datepicker"  name="fromdate" id="fromdate" placeholder="{!! date('d-m-Y',strtotime($hotel[0]->fromdate)) !!}" value="{!! date('d-m-Y',strtotime($hotel[0]->fromdate)) !!}" >
													 
                                                </div>
                                                </div>
												</div>
												<div class="col-md-6 form-line">
																<div class="form-group">
                                                <div class="col-md-6" style="padding-left:0px;">
                                                	<label for="todate"> Valid To</label>
                                                      <input type="text" class="form-control datepicker" name="todate" id="todate" placeholder="{!! date('d-m-Y',strtotime($hotel[0]->todate)) !!}" value="{!! date('d-m-Y',strtotime($hotel[0]->todate)) !!}"  />
									
                                                </div>
							</div>
						</div>
                                    
                                    <div style="clear:both"></div>
                                    <div class="col-md-6 form-line">
                                    	<div class="form-group">
                                          	<label for="hotel_address">Address</label>
                                                <textarea rows="4" class="form-control" id="hotel_address" name="hotel_address" placeholder="Enter Address" >{!! $hotel[0]->hotel_address !!}</textarea>
							</div>
						</div>
                                    
                                    <div class="col-md-3 form-line">
                                    	<div class="form-group">
                                          	<label for="location" >Location</label>
                                                <input type="text" class="form-control" placeholder=" Enter City Location" name="hotel_location" id="hotel_location"  required="required" value="{!! $hotel[0]->city_location !!}">
							</div>
							<div class="form-group">
                                          	<label for="location" >Check-in Time</label>
                                                <input type="text" class="form-control" placeholder="12:00 PM or Flexible" readonly name="hotel_checkin_time" id="hotel_checkin" value="{!! $hotel[0]->checkin_time !!}">
												<select class="form-group" name="hotel_checkin_time" id="hotel_checkin_time">
												<?php $checkin = explode(" ",trim($hotel[0]->checkin_time)); ?>
												 <option value="{!! $checkin[0] !!}" selected="select">{!! $checkin[0] !!} </option>
                      @for($i=0;$i<25;$i++)
                      <option value="<?=$i.":00"?>"><?=$i.":00"?></option>
                      @endfor
                  </select>				  
                  <select class="form-group" name="hotel_checkin_ampm" id="hotel_checkin_ampm">
				  <option value="{!! $checkin[1] !!}" selected="select"> {!! $checkin[1] !!} </option>
                      <option value="AM" selected="select">AM</option>
					  <option value="AM">PM</option>
                  </select>
							</div>
						</div>
                                    
                                    <div class="col-md-3 form-line">
                                    	<div class="form-group">
                                          	<label for ="price">Pincode</label>
                                                <input type="number" class="form-control" name="hotel_pincode" id="hotel_pincode" placeholder="Enter Pincode." value="{!! $hotel[0]->hotel_pincode !!}">
							</div>
                                          <div class="form-group">
                                          	<label for="location" >Check-out Time</label>
                                                <input type="text" class="form-control" readonly placeholder="12:00 PM or Flexible" name="hotel_checkout" id="hotel_checkout" value="{!! $hotel[0]->checkout_time !!}">
												 <select class="form-group" name="hotel_checkout_time" id="hotel_checkout_time">
												 <?php $checkout = explode(" ",trim($hotel[0]->checkout_time)); ?>
												 <option value="{!! $checkout[0] !!}"> {!! $checkout[0] !!} </option>
                      @for($i=0;$i<25;$i++)
                      <option value="<?=$i.":00"?>"><?=$i.":00"?></option>
                      @endfor
                  </select>				 
                  <select class="form-group" name="hotel_checkout_ampm" id="hotel_checkout_ampm">
						<option value="{!! $checkout[1] !!}" selected="select"> {!! $checkout[1] !!} </option>
                      <option value="AM" >AM</option>
					  <option value="AM">PM</option>
                  </select>
							</div>
						</div>
                                    
                                    <div style="clear:both"></div>
                                    <div class="col-md-6">
                                    	<div class="form-group">
                                          	<label for="location">Upload image</label>
                                                <input type="file" class="form-control" name="hotel_image[]" id="hotel_image" value="{!! $hotel[0]->hotel_image !!}" multiple>
                                          </div>
                                    </div>
                                    <div class="col-md-6">
									 @if($hotel[0]->hotel_image != '')
							<?php $hotelimages = explode(",",trim($hotel[0]->hotel_image)); ?>
							@foreach($hotelimages as $hotelimage)
							<?php if(in_array($hotelimage,$hotelimages)) { ?>
                            <img src="{{ asset('/hotel_images/'.$hotelimage) }}" height="50" width="50" />
                            <input type="hidden" name="old_hotel_image" id="old_hotel_image" value="{!! $hotel[0]->hotel_image !!}" />
							<?php } else { echo "no image match"; }?>
							@endforeach
                        @endif	
                                    </div>
                                     <div style="clear:both"></div>
                                    <div class="col-md-6">
                                          <div class="form-group">
                                                <label for="location">Upload Document</label>
                                                <input type="file" class="form-control" name="hotel_docs[]" id="hotel_docs" value="{!! $hotel[0]->hotel_docs !!}" multiple>
                                          </div>
                                    </div>
									<div class="col-md-6">
									 @if($hotel[0]->hotel_docs != '')
							<?php $hotelimages = explode(",",trim($hotel[0]->hotel_docs)); ?>
							@foreach($hotelimages as $hotelimage)
							<?php if(in_array($hotelimage,$hotelimages)) { ?>
                            <img src="{{ asset('/hotel_docs/'.$hotelimage) }}" height="50" width="50" />
                            <input type="hidden" name="old_hotel_docs" id="old_hotel_docs" value="{!! $hotel[0]->hotel_docs !!}" />
							<?php } else { echo "no image match"; }?>
							@endforeach
                        @endif
                                    	
                                    </div>
                               
                                    <div style="clear:both"></div>
									<div class="col-md-12 form-line">
								<p style="background-color:rgb(88, 151, 69);font-size:18px;color:#fff;">  Hotel Contact Info </p></div>
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                <label for="highlights">Bank Details</label>
                                                <textarea rows="3" class="form-control" id="hotel_bankdetail" name="hotel_bankdetail" placeholder="Enter bankdetail" >{!! $hotel[0]->hotel_bankdetail !!}</textarea>
                                              </div>
                                          </div>										
										  <div class="col-md-3 form-line">
                                              <div class="form-group">
                                                <label for="location" >Hote Contact Name</label>
                                                <input type="text" class="form-control" placeholder=" Enter Contact" name="hotel_contact_name" id="hotel_contact_name"  required="required" value="{!! $hotel[0]->hotel_contact_name !!}">
                                              </div>
                                          </div>
										   <div class="col-md-3 form-line">
                                              <div class="form-group">
                                                <label for="location" >Hote Contact Mobile</label>
                                                <input type="text" class="form-control" placeholder=" Enter Contact Mobile" name="hotel_mobile" id="hotel_mobile"  required="required" value="{!! $hotel[0]->hotel_mobile !!}">
                                              </div>
                                          </div>
                                          <div class="col-md-3 form-line">
                                              <div class="form-group">
                                                <label for="location" >Contact</label>
                                                <input type="text" class="form-control" placeholder=" Enter Contact Landline" name="hotel_contact" id="hotel_contact"  required="required" value="{!! $hotel[0]->hotel_contact !!}">
                                              </div>
                                          </div>
                                          <div class="col-md-3 form-line">
                                              <div class="form-group">
                                                <label for="location" >Email</label>
                                                <input type="text" class="form-control" placeholder=" Enter Email" name="hotel_email" id="hotel_email"  required="required" value="{!! $hotel[0]->hotel_email !!}">
                                              </div>
                                          </div>      
                                    <div class="col-md-12 form-line">
                                    	<div class="form-group">
                                          	<label>Hotel Amenities</label>&nbsp;
                                                <div style="clear:both;"></div>
                                                @if($hotel[0]->hotel_amenities != '')
                                                <?php $amenities = explode(",",trim($hotel[0]->hotel_amenities)); ?>
										<div class="col-md-4 form-line">
									<?php if(in_array("wifi",$amenities)) { ?>
                                                      <input type="checkbox" name="amenities[]" id="wifi" value="wifi" checked="checked"/>
                                                      <label for="wifi">&nbsp;&nbsp;Wifi</label><br />
                                                      <?php } else { ?>
                                                      <input type="checkbox" name="amenities[]" id="wifi" value="wifi" />
                                                      <label for="wifi">&nbsp;&nbsp;Wifi</label><br />
                                                      <?php } if(in_array("parking",$amenities)) { ?>
                                                      <input type="checkbox" name="amenities[]" id="parking" value="parking" checked="checked"/>
                                                      <label for="parking">&nbsp;&nbsp;Parking</label><br />
                                    			<?php } else { ?>
                                                      <input type="checkbox" name="amenities[]" id="parking" value="parking" />
                                                      <label for="parking">&nbsp;&nbsp;Parking</label><br />
                                                      <?php } if(in_array("roomservice",$amenities)) { ?>
                                                      <input type="checkbox" name="amenities[]" id="roomservice" value="roomservice" checked="checked"/>
                                                      <label for="roomservice">&nbsp;&nbsp;Room service</label><br />
                                                      <?php } else { ?>
                                                      <input type="checkbox" name="amenities[]" id="roomservice" value="roomservice" />
                                                      <label for="roomservice">&nbsp;&nbsp;Room service</label><br />
                                                      <?php } ?>
                                                </div>
                                                
                                                <div class="col-md-4 form-line">
									<?php if(in_array("restaurant",$amenities)) { ?>
                                                      <input type="checkbox" name="amenities[]" id="restaurant" value="restaurant" checked="checked"/>
                                                      <label for="restaurant">&nbsp;&nbsp;Restaurant</label><br />
                                                      <?php } else { ?>
                                                      <input type="checkbox" name="amenities[]" id="restaurant" value="restaurant" />
                                                      <label for="restaurant">&nbsp;&nbsp;Restaurant</label><br />
                                                      <?php } if(in_array("Gym",$amenities)) { ?>
                                                      <input type="checkbox" name="amenities[]" id="gym" value="Gym" checked="checked"/>
                                                      <label for="gym">&nbsp;&nbsp;Gym</label><br />
                                    			<?php } else { ?>
                                                      <input type="checkbox" name="amenities[]" id="gym" value="Gym" />
                                                      <label for="gym">&nbsp;&nbsp;Gym</label><br />
                                                      <?php } if(in_array("telephone",$amenities)) { ?>
                                                      <input type="checkbox" name="amenities[]" id="telephone" value="telephone" checked="checked"/>
                                                      <label for="telephone">&nbsp;&nbsp;Access Telephone</label><br />
                                                      <?php } else { ?>
                                                      <input type="checkbox" name="amenities[]" id="telephone" value="telephone" />
                                                      <label for="telephone">&nbsp;&nbsp;Access Telephone</label><br />
                                                      <?php } ?>
                                                </div>
                                                
                                                <div class="col-md-4 form-line">
									<?php if(in_array("refrigerator",$amenities)) { ?>
                                                      <input type="checkbox" name="amenities[]" id="refrigerator" value="refrigerator" checked="checked"/>
                                                      <label for="refrigerator">&nbsp;&nbsp;Refrigerator</label><br />
                                                      <?php } else { ?>
                                                      <input type="checkbox" name="amenities[]" id="refrigerator" value="refrigerator" />
                                                      <label for="refrigerator">&nbsp;&nbsp;Refrigerator</label><br />
                                                      <?php } if(in_array("newspaper",$amenities)) { ?>
                                                      <input type="checkbox" name="amenities[]" id="newspaper" value="newspaper" checked="checked"/>
                                                      <label for="newspaper">&nbsp;&nbsp;Newspaper</label><br />
                                    			<?php } else { ?>
                                                      <input type="checkbox" name="amenities[]" id="newspaper" value="newspaper" />
                                                      <label for="newspaper">&nbsp;&nbsp;Newspaper</label><br />
                                                      <?php } if(in_array("safe",$amenities)) { ?>
                                                      <input type="checkbox" name="amenities[]" id="safe" value="safe" checked="checked"/>
                                                      <label for="safe">&nbsp;&nbsp;Safe</label><br />
                                                      <?php } else { ?>
                                                      <input type="checkbox" name="amenities[]" id="safe" value="safe" />
                                                      <label for="safe">&nbsp;&nbsp;Safe</label><br />
                                                      <?php } ?>
                                                </div>
                                                @endif
							</div>
						</div>
                                    
                                    <div style="clear:both;margin-bottom:10px;"></div>
                                    <div class="col-md-6 form-line">
                                    	<div class="form-group">
                                          	<label for="highlights">Highlights</label>
                                                <textarea rows="3" class="form-control" id="hotel_highlights" name="hotel_highlights" placeholder="Enter highlights" >{!! $hotel[0]->hotel_highlights !!}</textarea>
							</div>
						</div>
                                    <div class="col-md-6 form-line">
                                          <div class="form-group">
                                                <label for="nearestplace">Nearest Places</label>
                                                <textarea rows="3" class="form-control" id="hotel_nearestplace" name="hotel_nearestplace" placeholder="Nearest Places data" >{!! $hotel[0]->hotel_nearestplace !!}</textarea>
                                          </div>
                                    </div>
                                    <!-- <div class="col-md-6 form-line">
                                    	<div class="form-group">
                                          	<label for="cancellationfees">Cancellation Fees</label>
                                                <textarea rows="3" class="form-control" id="hotel_cancellationfees" name="hotel_cancellationfees" placeholder="Cancellation fees data" >{!! $hotel[0]->hotel_cancellationfees !!}</textarea>
							</div>
						</div> -->
                                    <div style="clear:both"></div>
                                    
                                    <div class="col-md-6 form-line">
                                    	<div class="form-group">
                                          	<label for="paymentpolicy">Payment Policy</label>
                                                <textarea rows="4" class="form-control" id="hotel_paymentpolicy" name="hotel_paymentpolicy" placeholder="Enter Payment Policy" >{!! $hotel[0]->hotel_paymentpolicy !!}</textarea>
							</div>
						</div>
                                    
                                    <div class="col-md-6 form-line">
                                    	<div class="form-group">
                                          	<label for="packagename">Cancellation Policy</label>
                                                <textarea rows="4" class="form-control" id="hotel_cancellationpolicy" name="hotel_cancellationpolicy" placeholder="Enter Cancellation Policy">{!! $hotel[0]->hotel_cancellationpolicy !!}</textarea>
							</div>
						</div>
                                    <div style="clear:both"></div>
                                    
                                    <div class="col-md-12 form-line">
                                    	<div class="form-group">
                                          	<label for="packagename">Terms &amp; Conditions</label>
                                                <textarea rows="4" class="form-control" id="hotel_termsconditions" name="hotel_termsconditions" placeholder="Enter Terms and Conditions" >{!! $hotel[0]->hotel_terms_conditions !!}</textarea>
							</div>
						</div>
                                    
                                    <div style="clear:both"></div>
                                    <div class="col-md-6 form-line">
                                    	<div class="form-group">
                                    		<input type="submit" class="btn btn-primary submit" name="btn_add_hotel" id="btn_add_tour" value="Save">
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


<a href="#" id="toTop" style="display: inline;"><span id="toTopHover"></span></a><div id="ui-datepicker-div" class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all"></div></body></html>