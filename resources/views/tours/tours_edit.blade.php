@include('includes.newheader')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<div class="container">
<div class="breadcrumbs1">
<ol class="breadcrumb">
              <li class="breadcrumb-item"><i class="fa fa-home" aria-hidden="true"></i> <a href="{{ url('/dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active"> Tour Edit </li>
</ol>
</div>
  <div class="row">
    <div class="col-sm-12">
      <div class="panel panel-default" id="panelbg">
        <div class="panel-heading" id="headerbg">
         @if (!Auth::guest())              
         @include('includes.minimenu')              
         @endif 
        </div>
        <div class="panel-body">
     
          <div class="col-md-12">
            <form method="post" name="frm_edit_tour" action="" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="col-md-4 form-line">
                <div class="form-group">
                  <label for="txt_tour_name">Tour package name</label>
                  <input type="text" class="form-control" id="txt_tour_name" placeholder="Package Name" name="txt_tour_name" value="{!! $tour[0]->tour_name!!}">
                </div>
              </div>
              <div class="col-md-4 form-line">
                <div class="form-group">
                  <div class="col-md-6" style="padding-left:0px;">
                    <label for="fromdate">Valid From</label>
                    <input type="text" class="form-control datepicker"  name="txt_tour_checkin" id="fromdate" placeholder="{!! date('d-m-Y',strtotime($tour[0]->fromdate)) !!}" value="{!! date('d-m-Y',strtotime($tour[0]->fromdate)) !!}">
                  	<input type="hidden" name="fromdate" value="{!! date('d-m-Y',strtotime($tour[0]->fromdate)) !!}">
                  </div>
                  <div class="col-md-6" style="padding-right:0px;">
                    <label for="todate">Valid To</label>
                    <input type="text" class="form-control datepicker" name="txt_tour_checkout" id="todate" placeholder="{!! date('d-m-Y',strtotime($tour[0]->todate)) !!}" value="{!! date('d-m-Y',strtotime($tour[0]->todate)) !!}" />
                  	<input type="hidden" name="todate" value="{!! date('d-m-Y',strtotime($tour[0]->todate)) !!}">
                  </div>
                </div>
              </div>
              <div class="col-md-4 form-line">
                <div class="form-group">
                  <div class="col-md-6" style="padding-left:0px;">
                    <label for ="txt_tour_price">Price per person</label>
                    <input type="text" class="form-control" name="txt_tour_price" id="txt_tour_price" placeholder=" Enter Price per person." value="{!! $tour[0]->price_per_person !!}">
                  </div>
                  <div class="col-md-6" style="padding-right:0px;">
                    <label for ="txt_tour_saleprice" >Sale Price</label>
                    <input type="text" class="form-control" name="txt_tour_saleprice" id="txt_tour_saleprice" placeholder="Enter Sale Price" value="{!! $tour[0]->sale_price !!}">
                  </div>
                </div>
              </div>
              <div style="clear:both"></div>
              <div class="col-md-4 form-line">
                <div class="form-group">
                  <label for="txt_tour_location">Location</label>
                  <input type="text" class="form-control" placeholder="Enter Location" name="txt_tour_location" id="txt_tour_location" value="{!! $tour[0]->city_location!!}">
                </div>
              </div>
              <div class="col-md-4 form-line">
                <div class="form-group">
                  <div class="col-md-6" style="padding-left:0px;">
                    <label for ="txt_tour_days">Days</label>
                    <input type="number" class="form-control" name="txt_tour_days" id="txt_tour_days" placeholder=" Enter Days." value="{!! $tour[0]->days !!}">
                  </div>
                  <div class="col-md-6" style="padding-right:0px;">
                    <label for ="txt_tour_nights">Nights</label>
                    <input type="number" class="form-control" name="txt_tour_nights" id="txt_tour_nights" placeholder=" Enter Days." value="{!! $tour[0]->nights !!}">
                  </div>
                </div>
              </div>
              <div class="col-md-4 form-line">
                <div class="col-md-6" style="padding-left:0px;">
                  <div class="form-group">
                    <label for ="txt_tour_rating">Rating</label>
                    <input type="number" class="form-control" name="txt_tour_rating" id="txt_tour_rating" placeholder=" Enter Rating between 1-5." value="{!! $tour[0]->rating !!}">
                  </div>
                </div>
                <div class="col-md-6" style="padding-right:0px;">
                  <label for ="txt_tour_places">Number of places</label>
                  <input type="number" class="form-control" name="txt_tour_places" id="txt_tour_places" placeholder="Number of places." value="{!! $tour[0]->no_places !!}">
                </div>
              </div>
              <div style="clear:both"></div>
              <div class="col-md-6 form-line">
                <div class="form-group">
                	<div class="col-md-6">
                  <label for="mainimg">Image</label>
				  <input type="file" class="form-control" name="mainimage[]" id="media" multiple>                  
                </div>
                </div>
              	<div class="col-md-6" style="padding-right:0px;">
                    <label for ="partofindia">Part of india</label>
                    <select name="partofindia" id="partofindia" class="form-control">
                      <option value="east" <?php if($tour[0]->partofindia == 'east') { echo 'selected="selected"'; } ?> >East</option>
                      <option value="west" <?php if($tour[0]->partofindia == 'west') { echo 'selected="selected"'; } ?>>West</option>
                      <option value="north" <?php if($tour[0]->partofindia == 'north') { echo 'selected="selected"'; } ?>>North</option>
                      <option value="south" <?php if($tour[0]->partofindia == 'south') { echo 'selected="selected"'; } ?>>South</option>
                    </select>
                  </div>
              </div>
              <label for="txt_tour_overview">Amenities</label>
              <div class="col-md-6 form-line">
                <div class="form-group">
                <?php
                  $arr_inclusion = array();
                  $arr=explode(',', $tour[0]->inclusion_select);
                  
                ?>
                @if($tour[0]->inclusion_select != "")
                <?php $info[]=explode(',',$tour[0]->inclusion_select); 

                      if(in_array('transfer', $info[0]))
                        {
                          $che_transfer="checked";
                        }else{$che_transfer= "";}
                        if(in_array('accomodation', $info[0]))
                        {
                          $che_accomodation="checked";
                        }else{$che_accomodation="";}
                        if(in_array('meals', $info[0]))
                        {
                          $che_meals="checked";
                        }else{$che_meals="";}
                        if(in_array('sightseen', $info[0]))
                        {
                          $che_sightseen="checked";
                        }else{$che_sightseen="";}
                        

                ?>
                  <div class="col-md-4 form-line">
                        
                         <input type="checkbox" name="chk_inclusion[]" value="transfer" <?=$che_transfer?>/>&nbsp;&nbsp;Hotel/Pick Up Location<br />
                        <input type="checkbox" name="chk_inclusion[]" value="accomodation" <?=$che_accomodation?>/>&nbsp;&nbsp;Accommodation<br />
                        <input type="checkbox" name="chk_inclusion[]" value="meals" <?=$che_meals?>/>&nbsp;&nbsp;Meals<br />
                        <input type="checkbox" name="chk_inclusion[]" value="sightseen" <?=$che_sightseen?>/>&nbsp;&nbsp;Sightseeing
                        <!--  @foreach(explode(',',$tour[0]->inclusion_select) as $info)
                           @if($info == "transfer")
                                <input type="checkbox" name="chk_inclusion[]" value="transfer" checked="checked"/>&nbsp;&nbsp;Transfer<br />
                            @else
                              <input type="checkbox" name="chk_inclusion[]" value="transfer"/>&nbsp;&nbsp;Transfer<br />     
                            @endif 
                           @if($info == "accomodation")
                                <input type="checkbox" name="chk_inclusion[]" value="accomodation" checked="checked"/>&nbsp;&nbsp;Accommodation<br />
                            @else
                              <input type="checkbox" name="chk_inclusion[]" value="accomodation"/>&nbsp;&nbsp;Accommodation<br />     
                            @endif
                            @if($info == "meals")
                                <input type="checkbox" name="chk_inclusion[]" value="meals" checked="checked"/>&nbsp;&nbsp;Meals<br />
                            @else
                              <input type="checkbox" name="chk_inclusion[]" value="meals"/>&nbsp;&nbsp;Meals<br />     
                            @endif
                            @if($info == "sightseen")
                                <input type="checkbox" name="chk_inclusion[]" value="sightseen" checked="checked"/>&nbsp;&nbsp;Sightseeing<br />
                            @else
                              <input type="checkbox" name="chk_inclusion[]" value="sightseen"/>&nbsp;&nbsp;Sightseeing<br />     
                            @endif
                           
                        @endforeach -->    
                   </div>
                @endif   
                </div>
            </div>
            
          <div class="col-md-6 form-line">
                
            <div class="col-md-6 form-line">
                <div class="form-group">
                  <div class="col-md-6" style="padding-left:0px;">
                    <label for ="gbooking">Min Guest Per Booking:</label>
                    <input type="number" class="form-control" name="txt_tour_guest" id="txt_tour_guest" placeholder="Enter Guest." value="{!! $tour[0]->guest_per_booking !!}">
                  </div>
                  <div class="col-md-6" style="padding-right:0px;">
                  <label for ="rbooking">Max Guest Per Room:</label>
                    <input type="number" class="form-control" name="txt_tour_room" id="txt_tour_room" placeholder="Enter Room." value="{!! $tour[0]->room_per_booking !!}">
                                     
                  </div>
                </div>
              </div>
              <div class="col-md-6 form-line">
                <div class="col-md-6" style="padding-left:0px;">
                  <div class="form-group">
                  <label for ="child">Max Allow Child Age:</label>
                    <input type="number" class="form-control" name="txt_child_age" id="txt_child_age" placeholder="Enter Child Age." value="{!! $tour[0]->rating !!}">
                  </div>
                </div>
            </div>
        </div>      
              <div class="col-md-6 form-line">
                <div class="form-group">
                  <label for="txt_tour_overview">Overview</label>
                  <textarea class="form-control" id="txt_tour_overview" name="txt_tour_overview" placeholder="Enter overview" >{!! $tour[0]->overview !!}</textarea>
                </div>
              </div>
              <div style="clear:both"></div>
              <div class="col-md-6 form-line">
                <div class="form-group">
                  <label for="txt_tour_inclusions">Tour Package Includes:</label>
                  <textarea class="form-control" id="txt_tour_inclusions" name="txt_tour_inclusions" placeholder="Enter Inclusions" >{!! $tour[0]->inclusions !!}</textarea>
                </div>
              </div>
              <div class="col-md-6 form-line">
                <div class="form-group">
                  <label for="txt_tour_exclusions">Tour Package Excludes:</label>
                  <textarea class="form-control" id="txt_tour_exclusions" name="txt_tour_exclusions" placeholder="Enter Exclusions" >{!! $tour[0]->exclusions !!}</textarea>
                </div>
              </div>
              <div style="clear:both"></div>
              <div class="col-md-6 form-line">
                <div class="form-group">
                  <label for="txt_tour_paymentpolicy">Payment Policy</label>
                  <textarea class="form-control" id="txt_tour_paymentpolicy" name="txt_tour_paymentpolicy" placeholder="Enter Payment Policy" >{!! $tour[0]->paymentpolicy !!}</textarea>
                </div>
              </div>
              <div class="col-md-6 form-line">
                <div class="form-group">
                  <label for="txt_tour_cancellationpolicy">Cancellation Policy</label>
                  <textarea class="form-control" id="txt_tour_cancellationpolicy" name="txt_tour_cancellationpolicy" placeholder="Enter Cancellation Policy" >{!! $tour[0]->cancellationpolicy !!}</textarea>
                </div>
              </div>
              <div style="clear:both"></div>
              <div class="col-md-12 form-line">
                <div class="form-group">
                  <label for="txt_tour_termsconditions">Terms-Conditions</label>
                  <textarea class="form-control" id="txt_tour_termsconditions" name="txt_tour_termsconditions" placeholder="Enter Terms - Conditions" >{!! $tour[0]->terms_conditions !!}</textarea>
                </div>
              </div>
              <div style="clear:both"></div>
              <div class="col-md-6 form-line">
                <div class="form-group">
                  <input type="submit" class="btn btn-primary submit" name="btn_edit_tour" id="btn_edit_tour" value="Save and Continue">
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

<a href="#" id="toTop" style="display: inline;"><span id="toTopHover"></span></a><div id="ui-datepicker-div" class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all"></div></body></html>
