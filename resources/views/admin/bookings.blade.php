@include('includes.newheader')
<!-- DataTables CSS -->
<link href="{{ url('public/datatables-plugins/dataTables.bootstrap.css') }}" rel="stylesheet">
<!-- DataTables Responsive CSS -->
<link href="{{ url('public/datatables-responsive/dataTables.responsive.css') }}" rel="stylesheet">

<div class="container">
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
          <div class="col-sm-4">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><i class="fa fa-home" aria-hidden="true"></i> <a href="{{ url('/dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{ url('/mybooking') }}">Bookings</a></li>
              <li class="breadcrumb-item active">Booking List</li>
            </ol>
          </div>
          <div class="pull-right">
           	<a class="btn btn-primary" href="{{ url('admins/bookings/csv') }}">Export to Csv </a> 
            </div><br />

          <div class="col-md-12">
            <table border="0" width="100%" id="tourslist" class="table">
              <thead style="background:#f5f5f5;color:#777;height:50px;">
                <tr>
                  <th>Order #</th>
                  <th>payu_id</th>
                  <th width="250">Package Name</th>
                  <th>Email</th>
                  <th>Amount</th>
                  <td>Action</td>
                </tr>
              </thead>
              <tbody>
                <?php $i=1; ?>
              @foreach($bookings as $booking)
              <tr>
                <td>{!! $booking->order_id !!}</td>
                <td>{!! $booking->payu_id !!}</td>
                <td>{!! $booking->tour_name !!}</td>
                <td>{!! $booking->email !!}</td>
                <td>{!! $booking->amount !!}</td>
                <td><a href="detailview/{!! $booking->order_id !!}"><img src="{{ asset('public/img/view.png') }}"/></a></td>
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
	
	</script>
@include('includes.newfooter')