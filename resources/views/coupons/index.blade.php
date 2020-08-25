@include('includes.newheader')
<!-- DataTables CSS -->
<link href="{{ url('public/datatables-plugins/dataTables.bootstrap.css') }}" rel="stylesheet">
<!-- DataTables Responsive CSS -->
<link href="{{ url('public/datatables-responsive/dataTables.responsive.css') }}" rel="stylesheet">

<div class="container">
<div class="breadcrumbs1">
<ol class="breadcrumb">
              <li class="breadcrumb-item"><i class="fa fa-home" aria-hidden="true"></i> <a href="{{ url('/newhome') }}">Home</a></li>
              <li class="breadcrumb-item active">Coupon List</li>
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
          
          <div class="pull-right">
           	<a class="btn btn-primary" href="{{ url('coupons/csv') }}">Export to Csv </a> &nbsp; 
            <a href="{{ url('/coupons-add') }}" class="btn btn-primary pull-right">Create Coupon</a></div>
          <div class="col-md-12">
            <table border="0" width="100%" id="couponlist" class="table">
              <thead style="background:#f5f5f5;color:#777;height:50px;">
                <tr>
                  <th>#</th>
                  <th>Coupon Code</th>
                  <th>Coupon Amount</th>
                  <th>From Date</th>
                  <th>To Date</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1; ?>
              @foreach($coupons as $coupon)
              <tr>
                <td>{!! $i !!}</td>
                <td>{!! $coupon->coupon_code !!}</td>
                <td>{!! $coupon->coupon_amount !!}</td>
                <td>{!! $coupon->from_date !!}</td>
                <td>{!! $coupon->to_date !!}</td>
                <td>{!! $coupon->status !!}</td>
                <td><a href="{{ url('/coupons/delete/'.$coupon->coupon_id) }}" onclick="return delete_coupon();"><img src="{{ asset('public/img/delete.png') }}"/></a></td>

              </tr>
              <?php $i++; ?>
              @endforeach
              </tbody>
              
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@include('includes.newfooter')
<!-- DataTables JavaScript -->
<script src="{{ url('public/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('public/datatables-plugins/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ url('public/datatables-responsive/dataTables.responsive.js') }}"></script>
<script type="text/javascript">
	$(document).ready(function() 
	{
		$('#couponlist').DataTable({
            	responsive: true
      	});
    	});
	function delete_coupon()
	{
		var conf = confirm("Are you sure want to delete this coupon?");
		return conf;
	}
	</script>
<a href="#" id="toTop" style="display: inline;"><span id="toTopHover"></span></a><div id="ui-datepicker-div" class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all"></div></body></html>