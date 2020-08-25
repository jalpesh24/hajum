@include('includes.newheader')
<!-- DataTables CSS -->
<link href="{{ url('public/datatables-plugins/dataTables.bootstrap.css') }}" rel="stylesheet">
<!-- DataTables Responsive CSS -->
<link href="{{ url('public/datatables-responsive/dataTables.responsive.css') }}" rel="stylesheet">

<div class="container">
<div class="breadcrumbs1">
<ol class="breadcrumb">
              <li class="breadcrumb-item"><i class="fa fa-home" aria-hidden="true"></i> <a href="{{ url('/newhome') }}">Home</a></li>
              <li class="breadcrumb-item active">Room List</li>
</ol>
</div>
  <div class="row">
    <div class="col-sm-12"> @if (session('status'))
      <div class="alert alert-success">{{ session('status') }}</div>
      @endif
      <div class="panel panel-default" id="panelbg">
         <div class="panel-heading" id="headerbg">
         @if (!Auth::guest())              
         	@include('includes.minimenu')              
         @endif
        </div>
		
        <div class="panel-body">
       <div class="col-sm-12">
                        <ol class="">
                            <li class="btn btn-primary"><a href="{{ url('/hotels-list') }}" style="color:#fff;">Home</a></li>
                            <li class="btn btn-primary"><a href="{{ url('/hotel/'.$hotelsrooms[0]->hotel_id) }}" style="color:#fff;">Basic</a></li>
							<li class="btn btn-primary"><a href="{{ url('/room-list/'.$hotelsrooms[0]->hotel_id) }}" style="color:#fff;">Room List</a></li>
							<li class="btn btn-primary"><a href="{{ url('/amenities-list/'.$hotelsrooms[0]->hotel_id) }}" style="color:#fff;">Amenities</a></li>
							
                                   
						</ol>
                    </div>
		  <div class="pull-right">
           	<a class="btn btn-primary" href="{{ url('myrooms/csv') }}">Export to Csv </a> 
            </div><br />
          <div class="col-md-12">
            <table border="0" width="100%" id="tourslist" class="table">
              <thead style="background:#f5f5f5;color:#777;height:50px;">
                <tr>
                  <th>Room Type</th>
                  <th>Price</th>                  
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1; ?>
              @foreach($hotelsrooms as $hotelsroom)
              <tr>
      
                <td>{!! $hotelsroom->hotel_roomtype !!}</td>
                <td>{!! $hotelsroom->hotel_saleprice !!}</td>  
				
                <td><a href="{{ url('/hotel-roomdata/'.$hotelsroom->hotel_room_id) }}"><img src="{{ asset('public/img/edit.png') }}"/></a>&nbsp;				
                <a href="{{ url('/deletehotel/'.$hotelsroom->hotel_room_id) }}" onclick="return delete_hotel();"><img src="{{ asset('public/img/delete.png') }}"/></a>&nbsp;
				<a href="{!! url('hoteldetail/'.$hotelsroom->hotel_room_id) !!}" target="_blank"><img src="{{ asset('public/img/view.png') }}"/></a>&nbsp;
				<a href="{!! url('/hotel-add-roomdata') !!}" target="_blank">Add New</a>&nbsp;
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
		$('#tourslist').DataTable({
            	responsive: true
      	});
    	});
	function delete_hotel()
	{
		var conf = confirm("Are you sure want to delete this hotel?");
		return conf;
	}
	</script>
<a href="#" id="toTop" style="display: inline;"><span id="toTopHover"></span></a><div id="ui-datepicker-div" class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all"></div></body></html>