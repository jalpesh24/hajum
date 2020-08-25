@include('includes.newheader')
<div class="container">
<div class="breadcrumbs1">
<ol class="breadcrumb">
              <li class="breadcrumb-item"><i class="fa fa-home" aria-hidden="true"></i> <a href="{{ url('/dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active"> Add New Tour </li>
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
            <form method="post" name="frm_add_tour">
              {{ csrf_field() }}
              <div class="col-md-4 form-line">
                <div class="form-group">
                  <label for="exampleInputUsername">Tour package name</label>
                 <input type="text" class="form-control" id="txt_tour_name" placeholder="Package Name" name="txt_tour_name">
                  <label for="location" >Location</label>
                  <input type="text" class="form-control" placeholder=" Enter Location" name="txt_tour_location" id="txt_tour_location">
                </div>
              </div>
              <div class="col-md-4 form-line">
                <div class="form-group">
                  <label for="txt_tour_checkin">From Date</label>
                  <input type="text" class="form-control"  name="txt_tour_checkin" id="txt_tour_checkin" placeholder="From date" value="25-05-2017">
                  <label for="txt_tour_checkout">To Date</label>
                  <input type="text" class="form-control" name="txt_tour_checkout" id="txt_tour_checkout" placeholder="To date" value="30-05-2017" />
                </div>
              </div>
              <div class="col-md-4 form-line">
                <div class="form-group">
                  <label for ="txt_tour_price">Price per person</label>
                  <input type="text" class="form-control" name="txt_tour_price" id="txt_tour_price" placeholder=" Enter Price per person.">
                  <label for ="txt_tour_partofindia">Part of india</label>
                  <select name="partofindia" id="partofindia" class="form-control">
                    <option valu="east">East</option>
                    <option valu="west">west</option>
                    <option valu="north">North</option>
                    <option valu="south">South</option>
                  </select>
                </div>
              </div>
              <div class="col-md-4 form-line">
                <div class="form-group">
                  <div class="col-md-6" style="padding-left:0px;">
                    <label for ="price">Days</label>
                    <input type="text" class="form-control" name="txt_tour_days" id="txt_tour_days" placeholder=" Enter Days.">
                  </div>
                  <div class="col-md-6" style="padding-right:0px;">
                    <label for ="price">Nights</label>
                    <input type="text" class="form-control" name="txt_tour_nights" id="txt_tour_nights" placeholder=" Enter Days.">
                  </div>
                </div>
              </div>
              <div class="col-md-4 form-line">
                <div class="form-group">
                  <label for ="txt_tour_rating">Rating</label>
                  <input type="text" class="form-control" name="txt_tour_rating" id="txt_tour_rating" placeholder=" Enter Rating between 1-5.">
                  <br />
                  <input type="submit" class="btn btn-primary submit" name="btn_add_tour" id="btn_add_tour" value="Submit">
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

<a href="#" id="toTop" style="display: inline;"><span id="toTopHover"></span></a><div id="ui-datepicker-div" class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all"></div></body></html>

