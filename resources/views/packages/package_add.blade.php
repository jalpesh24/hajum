@extends('layouts.admin')
@section('title', 'Add Package')
@section('content')

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 
<a href="#" id="toTop" style="display: inline;"><span id="toTopHover"></span></a><div id="ui-datepicker-div" class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all"></div>
<div class="container">
  <div class="breadcrumbs1">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home" aria-hidden="true"></i> <a href="{{ url('/dashboard') }}">Home</a></li>
      <li class="breadcrumb-item active">Add New Package</li>
    </ol>
  </div>
  <div class="row">
    <div class="col-sm-12"> @if (session('status'))
      <div class="alert alert-success">{{ session('status') }}</div>
      @endif
      <div class="panel panel-default" id="panelbg">

        <div class="panel-body">

          <div class="col-md-12">
            <form method="post" name="frm_add_package" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="col-md-4 form-line">
                <div class="form-group">
                  <label for="packagename">Package name</label>
                  <input type="text" class="form-control" id="package_name" placeholder="Package Name" name="package_name" required="required">
                </div>
              </div>
              <div class="col-md-4 form-line">
                <div class="form-group">
                  <label for="packagename">Package Country</label>
                  <select name="country" id="country" class="form-control input-lg dynamic" required>
                     <option value="">Select Country</option>
                     @foreach($countries as $country)
                     <option value="{{ $country->name}}">{{ $country->name }}</option>
                     @endforeach
                    </select> 
                </div>
              </div>
              <div class="col-md-4 form-line">
                <div class="form-group">
                  <div class="col-md-6" style="padding-left:0px;">
                    <label for="fromdate">Valid From</label>
                    <input type="text" class="form-control datepicker"  name="fromdate" id="fromdate" placeholder="Valid from" value="{!! date('d-m-Y') !!}"  required="required">
                  </div>
                  <div class="col-md-6" style="padding-left:0px;">
                    <label for="todate">Valid To</label>
                    <input type="text" class="form-control datepicker" name="todate" id="todate" placeholder="Valid to" value="{!! date('d-m-Y') !!}"  required="required" />
                  </div>
                </div>
              </div>
           
            </div>

            <div style="clear:both"></div>
            <div class="col-md-12">
              <div class="col-md-4 form-line">
                <div class="form-group">
                  <label for="location" >Location</label>
                  <input type="text" class="form-control" placeholder=" Enter Location" name="city_location" id="city_location"  value="" required="required">
                </div>
              </div>
              <div class="col-md-4 form-line">
                <div class="form-group">
                  <div class="col-md-6" style="padding-left:0px;">
                    <label for ="price">Days</label>
                    <input type="number" class="form-control" name="days" id="days" placeholder="Enter Days." min="0" max="30" value="1"  required="required">
                  </div>
                  <div class="col-md-6" style="padding-left:0px;">
                    <label for ="price">Nights</label>
                    <input type="number" class="form-control" name="nights" id="nights" placeholder="Enter Days." min="0" max="30" value="1" required="required">
                  </div>
                </div>
              </div>
                 <div class="col-md-4 form-line">
                <div class="form-group">
                  <div class="col-md-6" style="padding-left:0px;">
                    <label for ="txt_tour_price">Price per person</label>
                    <input type="text" class="form-control" name="price_per_person" id="price_per_person" value="0"  min="0" max="100000000000" required="required">
                  </div>                 
                </div>               
              </div>
           
            </div>
            <div style="clear:both"></div>
            <div class="col-md-12">
             <div class="col-md-4 form-line">
              <div class="form-group">
                <div class="col-md-6" style="padding-left:0px;">
                  <label for="packagename">Image</label>
                  <input type="file" class="form-control" name="mainimg[]" id="media" multiple>
                </div>
              </div>
            </div>
            
            <div class="col-md-4 form-line">
              <div class="form-group">
                <div class="col-md-6" style="padding-left:0px;">
                  <label for="packagename">Transfer type</label>
                  <input type="text" class="form-control" name="package_transport_type" id="package_transport_type" value="" placeholder="air,bus,train">
                </div>
              </div>
            </div> 
            <div class="col-md-4 form-line">
              <div class="form-group">
                <div class="col-md-6" style="padding-left:0px;">
                <label for="location" >Transfer</label>
                <input type="text" class="form-control" placeholder=" Enter transfer loation" name="transfer" id="transfer"  value="" required="required">
              </div>
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
              <input type="submit" class="btn btn-primary submit" name="btn_add_package" id="btn_add_package" value="Save and Continue">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
</div>

<script type="text/javascript">
  $(document).ready(function() 
  {
     
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
          $("#todate").focus();
          dt2.open();
        }
      });
      $("#fromdate").datepicker("setDate", "0");
      $("#todate").datepicker("setDate", "1");
   
    
  });
  </script>
@endsection

