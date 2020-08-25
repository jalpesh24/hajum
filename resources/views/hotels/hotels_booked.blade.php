@include('includes.newheader')

<!-- DataTables CSS -->
<link href="{{ url('public/datatables-plugins/dataTables.bootstrap.css') }}" rel="stylesheet">
<!-- DataTables Responsive CSS -->
<link href="{{ url('public/datatables-responsive/dataTables.responsive.css') }}" rel="stylesheet">
<div class="container">
<div class="breadcrumbs1">
<ol class="breadcrumb">
              <li class="breadcrumb-item"><i class="fa fa-home" aria-hidden="true"></i> <a href="{{ url('/dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active"> Hotel Booked </li>
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
           	<a class="btn btn-primary" href="{{ url('mytours/csv') }}">Export to Csv </a> 
            </div><br />
          <div class="col-md-12">
            <table border="0" width="100%" id="hotellist" class="table">
              <thead style="background:#f5f5f5;color:#777;height:50px;">
                <tr>
                  <th>#</th>
                  <th>Customer</th>
                  <th>Package</th>   
				  <th>Status</th>  
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1; ?>
              @foreach($hotelbooked as $hotel)
              <tr>
                <td>{!! $i !!}</td>
                <td>{!! $hotel->firstname !!}</td>
                <td>{!! $hotel->tour_name!!}</td>  
				<td>{!! $hotel->orderstatus!!}</td>  				
                <td>               
                
                <a href="{!! url('hoteldetailview/'.$hotel->order_id) !!}"><img src="{{ asset('public/img/view.png') }}"/></a>&nbsp;
               
                
                </td>
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
<script src="{{ url('public/ewhtml/js/jquery.js') }}"></script>
<script src="{{ url('public/ewhtml/js/jquery-ui.js') }}"></script>
<script src="{{ url('public/ewhtml/js/jquery-migrate-1.js') }}"></script>
<script src="{{ url('public/ewhtml/js/superfish.js') }}"></script>
<script src="{{ url('public/ewhtml/js/select2.js') }}"></script>
<script src="{{ url('public/ewhtml/js/jquery_002.js') }}"></script>
<script src="{{ url('public/ewhtml/js/jquery_006.js') }}"></script>
<script src="{{ url('public/ewhtml/js/jquery_003.js') }}"></script>
<script src="{{ url('public/ewhtml/js/jquery_007.js') }}"></script>
<script src="{{ url('public/ewhtml/js/scripts.js') }}"></script>
<script src="{{ url('public/ewhtml/js/owl.carousel.min.js') }}"></script>
<script src="{{ url('public/ewhtml/js/bootstrap.min.js') }}"></script>


<!-- DataTables JavaScript -->
<script src="{{ url('public/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('public/datatables-plugins/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ url('public/datatables-responsive/dataTables.responsive.js') }}"></script>
<script type="text/javascript">
	$(document).ready(function() 
	{
		$('#hotellist').DataTable({
            	responsive: true
      	});
    	});
	function delete_tour()
	{
		var conf = confirm("Are you sure want to delete this tour?");
		return conf;
	}
	</script>

<a href="#" id="toTop" style="display: inline;"><span id="toTopHover"></span></a><div id="ui-datepicker-div" class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all"></div></body></html>
