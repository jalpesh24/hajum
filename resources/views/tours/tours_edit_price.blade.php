@include('includes.newheader')
<div class="container">
<div class="breadcrumbs1">
<ol class="breadcrumb">
              <li class="breadcrumb-item"><i class="fa fa-home" aria-hidden="true"></i> <a href="{{ url('/dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active"> Edit Tour Price</li>
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
         
          <div class="col-md-12">
          <div>
              <p> 
				RP = Retail Price , CP = Cost Price
				Please provide your net rate (CP) below and input the commission rate (Gross Profit). To calculate retail price after commission, please select "Cal.RP."
				RP X Gross Profit = CP (for example, 100 X 20% = 80)
				RP is the price paid by the customer, Gross Profit is the percentage paid to Rezb2b, and CP is the price paid to the local operator.
				Gross Profit is always calculated based on the RP and added to the CP. 
			  </p>
			  
	</div>
            <form method="post" name="frm_add_tourprice" enctype="multipart/form-data">
              {{ csrf_field() }}
			  <link  rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<table  class="table table-hover small-text" id="tb">
<tr class="tr-header">
<th>Id</th>
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
@foreach($tour_price as $tourprice)
<tr> 
<td><input type="number" name="tour_price_id[]" class="form-control" value="{!! $tourprice->tour_price_id !!}" readonly></td>
<td><input type="text" name="tour_package_type[]" class="form-control" value="{!! $tourprice->tour_package_type !!}"></td>
<td><input type="number" name="tour_package_person[]" class="form-control" value="{!! $tourprice->person !!}" min="1" max="12"></td>
<td><input type="text" name="tour_person_price[]" class="form-control" value="{!! $tourprice->package_per_person !!}"></td>
<td>
<select name="tour_package_vehicle[]" class="form-control">
  <option value="">Select Vehicle</option>
    <option value="Maruti" <?php if($tourprice->vehicle == 'Maruti') {echo "selected";} ?>>Maruti</option>
    <option value="Suv" <?php if($tourprice->vehicle == 'Suv') {echo "selected";} ?>>Suv</option>
	<option value="Innova" <?php if($tourprice->vehicle == 'Innova') { echo "selected";} ?>>Innova</option>
	<option value="TT" <?php if($tourprice->vehicle == 'TT') { echo "selected";} ?>>TT</option>
	<option value="Mini Bus" <?php if($tourprice->vehicle == 'Mini Bus') { echo "selected";} ?>>Mini Bus</option>
</select></td>
<td><input type="text" name="tour_package_hotel[]" class="form-control" value="{!! $tourprice->hotel_name !!}"></td>
<td><input type="number" name="tour_package_hotel_rate[]" class="form-control" value="{!! $tourprice->hotel_star !!}" min="0" max="5"></td>
<td><select name="commition_type[]" class="form-control" id="types" >  
    <option value="Flat" <?php if($tourprice->commition_type == 'Flat') { echo "selected";} ?>>Flat</option>
    <option value="Percent" <?php if($tourprice->commition_type == 'Percent') { echo "selected";} ?>>Percent</option>	
</select></td>
<td><input id="commision" type="text" class="form-control" name="commision[]" value="{!! $tourprice->commision !!}" Placeholder="Enter % or Flat value" >   </td>
<td><input type="text" name="tour_package_adult_price[]" class="form-control" value="{!! $tourprice->extra_adult_price !!}"></td>
<td><input type="text" name="tour_package_child_price[]" class="form-control" value="{!! $tourprice->extra_child_price !!}"></td>
<td><input type="number" name="tour_package_free_child[]" class="form-control" value="{!! $tourprice->free_child_age !!}" min="1" max="6"></td>
<td><a href="{!! action('ToursController@deletetourprice', $tourprice->tour_price_id) !!}"><span class='glyphicon glyphicon-remove'></span></a></td>
</tr>
@endforeach
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
