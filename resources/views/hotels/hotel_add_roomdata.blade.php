@include('includes.newheader')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<div class="container">
  <div class="breadcrumbs1">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home" aria-hidden="true"></i> <a href="{{ url('/newhome') }}">Home</a></li>
      <li class="breadcrumb-item active">Add Room Data </li>
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
          <form method="post" name="frm_add_hotel_roomdata" enctype="multipart/form-data">
            {{ csrf_field() }}									
            <div class="col-md-6 form-line">
              <div class="form-group">
                <label for="Enter Room Type">Enter Room Type</label>
                <input type="text" class="form-control" placeholder="Enter room type" name="new_room_type" id="new_room_type">
              </div>
            </div>
            <div class="col-md-6 form-line">
              <div class="form-group">
                <label for="Enter Room View">Enter Room View</label>
                <select name="new_room_view" id="new_room_view" class="form-control">
                  <option value="">Select Room View</option>
                  @foreach($roomviews as $roomview)
                  <option value="{!! $roomview->roomviewname !!}">{!! $roomview->roomviewname !!}</option>                 
                  @endforeach
                </select>
              </div>
            </div>
            
            <div class="col-md-6 form-line">
              <div class="form-group">
                <label for="Enter Room Type">Enter Room Description</label>
                <textarea class="form-control" placeholder="Enter room description" name="new_room_desc" id="new_room_desc"></textarea>
              </div>
            </div>  	
            <div class="col-md-6 form-line">
              <div class="form-group">
                <label for="Enter Bed Type">Enter Bed Type</label>
                <select name="new_bed_type" id="new_bed_type" class="form-control">
                  <option value="">Select Bed Type</option>
                  @foreach($bedtypes as $bedtype)
                  <option value="{!! $bedtype->bedtypename !!}">{!! $bedtype->bedtypename !!}</option>                 
                  @endforeach
                </select>
              </div>
            </div> 
            <div class="col-md-6 form-line">
              <div class="form-group">
                <label for="Enter Extra Bed Type">Enter Extra Bed Type</label>
                <select name="new_extrabed_type" id="new_extrabed_type" class="form-control">
                  <option value="">Select Extra Bed Type</option>
                  @foreach($extrabedtypes as $extrabedtype)
                  <option value="{!! $extrabedtype->extrabedtypename !!}">{!! $extrabedtype->extrabedtypename !!}</option>                 
                  @endforeach
                </select>
              </div>
            </div> 
            <div class="col-md-6 form-line">
              <div class="form-group">
                <label for="Enter room size">Enter Room Size</label>
                <input type="text" class="form-control" placeholder="Enter Room Size" name="new_room_size" id="new_room_size">
              </div>
            </div>
            <div style="clear:both"></div>  
            
            <div class="col-md-3 form-line">
             <div class="form-group">
               <label for="max_adult" >Max adult</label>
               <input type="number" class="form-control" onkeypress="return isNumberKey(event)" placeholder="Enter max adult" name="max_adult[]" id="max_adult_1" min="0" max="10"  value="">
             </div>
           </div>
           
           <div class="col-md-3 form-line">
             <div class="form-group">
               <label for="max_child" >Max child</label>
               <input type="number" class="form-control" onkeypress="return isNumberKey(event)" placeholder="Enter max child" name="max_child[]" id="max_child_1" min="0" max="10"  value="">
             </div>
           </div>
           <div class="col-md-3 form-line">
             <div class="form-group">
               <label for="max_child" >Free child Age</label>
               <input type="number" class="form-control" onkeypress="return isNumberKey(event)" placeholder="Enter child free age" name="child_free[]" id="child_free" min="0" max="5"  value="">
             </div>
           </div>
           
           <div class="col-md-3 form-line">
             <div class="form-group">
               <label for="max_child" >Extra Room Price</label>
               <input type="text" class="form-control" onkeypress="return isNumberKey(event)" placeholder="Enter extra room Price" name="extra_room[]" id="extra_room"  value="">
             </div>
           </div>
           <div class="col-md-3 form-line">
             <div class="form-group">
               <label for="max_child" >Extra Adult Price</label>
               <input type="text" class="form-control" onkeypress="return isNumberKey(event)" placeholder="Enter extra Adult Price" name="extra_adult[]" id="extra_adult"  value="">
             </div>
           </div>
           
           <div class="col-md-3 form-line">
             <div class="form-group">
               <label for="max_child" >Extra Child Price</label>
               <input type="text" class="form-control" onkeypress="return isNumberKey(event)" placeholder="Enter extra child Price" name="extra_child[]" id="extra_child"  value="">
             </div>
           </div>
           <div class="col-md-3 form-line">
             <div class="form-group">
               <label for="max_child" >Child Age</label>
               <input type="number" class="form-control" onkeypress="return isNumberKey(event)" placeholder="Enter child Age" name="child_age[]" id="child_age" min="0" max="13" value="">
             </div>
           </div>
           <div class="col-md-3 form-line">
             <div class="form-group">
               <label for="max_child" >From Date</label>
               <input type="text" class="form-control" placeholder="Enter from date" name="roomfromdate[]" id="roomfromdate"  value="">
             </div>
           </div>
           <div class="col-md-3 form-line">
             <div class="form-group">
               <label for="max_child" >To Date</label>
               <input type="text" class="form-control"  placeholder="Enter to date" name="roomtodate[]" id="roomtodate"  value="">
             </div>
           </div>
           
           
           <div class="col-md-3 form-line">
             <div class="form-group">
               <label for="price">Price</label>
               <input type="text" class="form-control" onkeypress="return isNumberKey(event)" placeholder="Price per person" name="price[]" id="price_1"  value="">
             </div>
           </div>
           
           <div class="col-md-3 form-line">
             <div class="form-group">
               <label for="saleprice">Sale Price</label>
               <input type="text" class="form-control" onkeypress="return isNumberKey(event)" placeholder="Sale Price" name="saleprice[]" id="saleprice_1"  value="">
             </div>
           </div>
           <div style="clear:both"></div>
           <div class="col-md-6">
            <div class="form-group">
              <label for="location">Upload image</label><p> Upload 5 Images </p>	
              <p> Browse your files and select the pictures to upload. Check the message on the image to identify their quality.
              </p><p>
                Low resolution image (below 800x1200 pixels)
                Medium resolution image (in between 800x1200 and 1536x2048 pixels)
                High resolution image (above 1536x2048 pixels) 
              </p>				  
              <input type="file" class="form-control" name="hotel_image[]" id="hotel_image" multiple>
            </div>
          </div>
          <div class="col-md-12 form-line">
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
          <div style="clear:both"></div>
          
          <div style="clear:both"></div>
          
          <div class="col-md-6 form-line">
           <div class="form-group">
             <input type="submit" class="btn btn-primary submit" name="btn_add_hotel" id="btn_add_hotel" value="Save">
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
 $('#roomtodate').datepicker(
 {
  format: "dd-mm-yy",
  autoclose: true,
  minDate: date,
  onSelect: function(date){ 
   
    
  }
});
 
 $('#roomfromdate').datepicker(
 {
  format: "dd-mm-yy",
  autoclose: true,
  minDate: date,
  onSelect: function(date){ 
   var dt2 = $('#roomtodate');
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

<script type="text/javascript">
  function changeTextBox(dropDown) {

    switch (dropDown.value) {
      case 'addmore': {
       $('#new_room_type').removeAttr("disabled");
     }
     default: {
       $('#new_room_type').addAttr('disabled', 'disabled');
     }
   }
 }

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