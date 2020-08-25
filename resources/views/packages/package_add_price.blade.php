@extends('layouts.admin')
@section('title', 'Add Package Price')
@section('content')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<div class="container">
  <div class="breadcrumbs1">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home" aria-hidden="true"></i> <a href="{{ url('/dashboard') }}">Home</a></li>
      <li class="breadcrumb-item active">Add Package Price</li>
    </ol>
  </div>
  <div class="row">
    <div class="col-sm-12"> @if (session('status'))
      <div class="alert alert-success">{{ session('status') }}</div>
      @endif
      <div class="panel panel-default" id="panelbg">

        <div class="panel-body">

            <form method="post" name="frm_add_package_hotel" enctype="multipart/form-data">
              {{ csrf_field() }}
              <?php for($i=1;$i<=5;$i++){ ?>
            <div class="col-md-12">
              <input type="hidden" name="pid[]" value="<?php echo $i; ?>">
              <div class="col-md-4 form-line">
                <div class="form-group">
                  <label for="packagename">Package Type</label>
                  <input type="text" class="form-control" id="typeName_<?php echo $i; ?>" placeholder="Package type Name" name="typeName_<?php echo $i; ?>" required="required">
                </div>
              </div>
              <div class="col-md-4 form-line">
                <div class="form-group">
                  <div class="col-md-6" style="padding-left:0px;">
                    <label for ="txt_tour_rating">Price</label>
                    <input type="text" class="form-control" name="price_<?php echo $i; ?>" id="price_<?php echo $i; ?>" placeholder=" Enter price." min="0" max="999" value="0" required="required">
                  </div>
                  
                </div>
              </div>
            </div>           
          <?php } ?>     
          <div style="clear:both"></div>
          <div class="col-md-6 form-line">
            <div class="form-group">
              <input type="submit" class="btn btn-primary submit" name="btn_add_package_price" id="btn_add_package_price" value="Save and addNew">
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
