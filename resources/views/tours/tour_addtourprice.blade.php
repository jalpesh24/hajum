@include('includes.newheader')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<style>
.valuesize{width:10%;}
.intvaluesize{width:7%;}
</style>
  
<div class="container">
<div class="breadcrumbs1">
<ol class="breadcrumb">
              <li class="breadcrumb-item"><i class="fa fa-home" aria-hidden="true"></i> <a href="{{ url('/dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active"> Add New Tour Price </li>
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
    	
	<form method="post" name="frm_add_tourprice" enctype="multipart/form-data">
              {{ csrf_field() }}
			  <link  rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<table  class="table table-hover small-text" id="tb" width="100%;">
<tr class="tr-header">
<th>Tour Type Name</th>
<th>Person</th>
<th>price.</th>
<th>Vehicle</th>
<th>Hotel Name</th>
<th>Hotel Star Rate</th>
<th>Commision Type</th>
<th>Commision</th>
<th>Extra Adult Price</th>
<th>Extra Child Price</th>
<th>Free Child Age</th>

<th><a href="javascript:void(0);" style="font-size:18px;" id="addMore" title="Add More Person"><span class="glyphicon glyphicon-plus"></span></a></th>
<tr>
<td class="valuesize"><input type="text" name="tour_package_type[]" class="form-control" value="standard"></td>
<td class="intvaluesize"><input type="number" name="tour_package_person[]" class="form-control" value="1" min="1" max="12"></td>
<td class="valuesize"><input type="text" name="tour_person_price[]" class="form-control" value="0"></td>
<td class="valuesize"><select name="tour_package_vehicle[]" class="form-control"  >  
    @foreach($tourvehicle as $vehicle)
	<option value="{!! $vehicle->vehiclename !!}">{!! $vehicle->vehiclename !!}</option>
    @endforeach
</select></td>
<td class="valuesize"><input type="text" name="tour_package_hotel[]" class="form-control" value="hotel"></td>
<td class="intvaluesize"><input type="number" name="tour_package_hotel_rate[]" class="form-control" value="0" min="0" max="5"></td>
<td class="valuesize"><select name="commition_type[]" class="form-control" id="types" >  
    <option value="Flat" selected>Flat</option>
    <option value="Percent">Percent</option>	
</select></td>
<td class="valuesize"><input id="commision" type="text" class="form-control" name="commision[]" value="0" Placeholder="Enter % or Flat value" >   </td>
<td class="valuesize" ><input type="text" name="tour_package_adult_price[]" class="form-control" value="0"></td>
<td class="valuesize"><input type="text" name="tour_package_child_price[]" class="form-control" value="0"></td>
<td class="intvaluesize" ><input type="number" name="tour_package_free_child[]" class="form-control" value="0" min="1" max="6"></td>
<td><a href='javascript:void(0);'  class='remove'><span class='glyphicon glyphicon-remove'></span></a></td>
</tr>
</table>
	
		<div class="col-md-3">     
        <div class="form-group">
          <div class="col-md-3">
            <button type="submit" class="btn btn-primary">Submit </button>
          </div>
        </div>
		</div>
      </form>
    </div>
</div>

      </div>
    </div>
  </div>

@include('includes.newfooter')

<script>
$(function(){
    $('#addMore').on('click', function() {
              var data = $("#tb tr:eq(1)").clone(true).appendTo("#tb");
              data.find("input").val('');
     });
     $(document).on('click', '.remove', function() {
         var trIndex = $(this).closest("tr").index();
            if(trIndex>1) {
             $(this).closest("tr").remove();
           } else {
             alert("Sorry!! Can't remove first row!");
           }
      });
});      
</script>


<a href="#" id="toTop" style="display: inline;"><span id="toTopHover"></span></a><div id="ui-datepicker-div" class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all"></div></body></html>
