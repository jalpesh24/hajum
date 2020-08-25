@include('includes.newheader')
<div class="container">
<div class="breadcrumbs1">
<ol class="breadcrumb">
              <li class="breadcrumb-item"><i class="fa fa-home" aria-hidden="true"></i> <a href="{{ url('/newhome') }}">Home</a></li>
              <li class="breadcrumb-item active">Hotel Room Edit</li>
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
            <div class="col-md-12">
                <form method="post" name="frm_edit_hotel_roomdata" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <?php $i=1; ?>
                    @if(!empty($hotels_roomdata))
                        @foreach($hotels_roomdata as $roomdata)
                            <input type="hidden" name="hotel_room_id" value="{!! $roomdata->hotel_room_id !!}" />
							<input type="hidden" name="hotel_id" value="{!! $roomdata->hotel_id !!}" />
                            <div class="col-md-6 form-line">
                                <div class="form-group">
                                    <label for="room_type">Room Type</label>
									<input type="text" name="hotel_roomtype" value="{!! $roomdata->hotel_roomtype !!}" />
                                </div>
                            </div>
                            <div style="clear:both"></div>
                            <div class="col-md-3 form-line">
                                <div class="form-group">
                                    <label for="max_adult_{{ $i }}" >Max adult</label>
                                    <input type="text" class="form-control" placeholder="Enter max adult" name="max_adult" id="max_adult_{{ $i }}"  value="{!! $roomdata->hotel_max_adult !!}">
                                </div>
                            </div>
                            <div class="col-md-3 form-line">
                                <div class="form-group">
                                    <label for="max_child_{{ $i }}" >Max child</label>
                                    <input type="text" class="form-control" placeholder="Enter max child" name="max_child" id="max_child_{{ $i }}"  value="{!! $roomdata->hotel_max_child !!}">
                                </div>
                            </div>
							<div class="col-md-3 form-line">
                                    	<div class="form-group">
                                          	<label for="max_child" >Extra Room Price</label>
                                                <input type="text" class="form-control" onkeypress="return isNumberKey(event)" placeholder="Enter extra room Price" name="extra_room" id="extra_room"  value="{!! $roomdata->hotel_extra_room !!}">
							</div>
						</div>
						<div class="col-md-3 form-line">
                                    	<div class="form-group">
                                          	<label for="max_child" >Extra Adult Price</label>
                                                <input type="text" class="form-control" onkeypress="return isNumberKey(event)" placeholder="Enter extra Adult Price" name="extra_adult" id="extra_adult"  value="{!! $roomdata->hotel_extra_adult !!}">
							</div>
						</div>
						
						<div class="col-md-3 form-line">
                                    	<div class="form-group">
                                          	<label for="max_child" >Extra Child Price</label>
                                                <input type="text" class="form-control" onkeypress="return isNumberKey(event)" placeholder="Enter extra child Price" name="extra_child" id="extra_child"  value="{!! $roomdata->hotel_extra_child !!}">
							</div>
						</div>
						<div class="col-md-3 form-line">
                                    	<div class="form-group">
                                          	<label for="max_child" >Child Age</label>
                                                <input type="number" class="form-control" onkeypress="return isNumberKey(event)" placeholder="Enter child Age" name="child_age" id="child_age" min="0" max="13" value="{!! $roomdata->child_age !!}">
							</div>
						</div>
						<div class="col-md-3 form-line">
                                    	<div class="form-group">
                                          	<label for="max_child" >Free Child Age</label>
                                                <input type="number" class="form-control" onkeypress="return isNumberKey(event)" placeholder="Enter Free child Age" name="free_child_age" id="free_child_age" min="0" max="6" value="{!! $roomdata->hotel_child_free_age !!}">
							</div>
						</div>
							<div class="col-md-3 form-line">
                                    	<div class="form-group">
                                          	<label for="max_child" >From Date</label>
                                                <input type="text" class="form-control" placeholder="Enter from date" name="roomfromdate" id="roomfromdate"  value="{!! $roomdata->room_fromdate !!}">
							</div>
						</div>
						<div class="col-md-3 form-line">
                                    	<div class="form-group">
                                          	<label for="max_child" >To Date</label>
                                                <input type="text" class="form-control"  placeholder="Enter to date" name="roomtodate" id="roomtodate"  value="{!! $roomdata->room_todate !!}">
							</div>
						</div>
                            <div class="col-md-3 form-line">
                                <div class="form-group">
                                    <label for="price_{{ $i }}" >Price</label>
                                    <input type="text" class="form-control" placeholder="Price per person" name="price" id="price_{{ $i }}"  value="{!! $roomdata->hotel_price !!}">
                                </div>
                            </div>
                            <div class="col-md-3 form-line">
                                <div class="form-group">
                                    <label for="saleprice_{{ $i }}" >Sale Price</label>
                                    <input type="text" class="form-control" placeholder="Sale Price" name="saleprice" id="saleprice_{{ $i }}"  value="{!! $roomdata->hotel_saleprice !!}">
                                </div>
                            </div>
                            <div class="col-md-12 form-line">
                                 <div class="form-group">
                                    <label>Amenities</label>&nbsp;
                                    <div style="clear:both;"></div>
									<div class="col-md-10 form-line">
                                    @if($hotels_roomdata[0]->hotel_amenities != '')
                                        <?php $amenities = explode(",",trim($hotels_roomdata[0]->hotel_amenities)); ?>
									@foreach($roomaminities as $roomaminitie)
									  <li style="float:left;margin:10px;list-style:none;">										  
									  <input type="checkbox" name="amenities[]" value="{!! $roomaminitie->aminity_name !!}" <?php if(in_array($roomaminitie->aminity_name,$amenities)) { echo "checked='checked'"; } ?> id="ac"  />
										&nbsp;&nbsp;{!! $roomaminitie->aminity_name !!}      
									  </li>
									@endforeach									
                                     @endif
									 </div>
								</div>
							</div>
                            <div style="clear:both"></div>
                            <?php $i++; ?>
                        @endforeach
                    @endif
                <div style="clear: both"></div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="location">Upload image</label>
                            <input type="file" class="form-control" name="hotel_image[]" id="hotel_image" multiple>
                        </div>
                    </div>
                    <div class="col-md-6">
                        @if($hotels_roomdata[0]->hotel_image != '')
							<?php $hotelimages = explode(",",trim($hotels_roomdata[0]->hotel_image)); ?>
							@foreach($hotelimages as $hotelimage)
                            <img src="{{ asset('/hotel_room_images/'.$hotelimage) }}" height="150" width="150" />
                            <input type="hidden" name="old_hotel_image" id="old_hotel_image" value="{!! $hotels_roomdata[0]->hotel_image !!}" />
							@endforeach
                        @endif
                    </div>
                    <div style="clear:both"></div>
                     <!-- Add Hotel Extra Room-->
                    
                     <div style="clear:both"></div>                       
                        <div style="clear:both"></div>
                     <div class="col-md-6 form-line">
                            <div class="form-group">
							<input type="submit" class="btn btn-primary submit" name="btn_edit_hotel_rooms" id="btn_edit_hotel_rooms" value="Save">
							<input type="submit" class="btn btn-primary submit" name="btn_add_new_hotel" id="btn_add_new_hotel" value="Save & Add New">
					
                            </div>
                        </div>
                </form>
                </div>
                </div>
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
	$("#roomfromdate").datepicker().datepicker("setDate", new Date());
	$("#roomtodate").datepicker().datepicker("setDate", new Date());
	
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