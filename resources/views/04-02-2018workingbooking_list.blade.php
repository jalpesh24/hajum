@include('includes.newheader')
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
          @endif </div>
        <div class="panel-body">
          <div class="pull-right">
           	<a class="btn btn-primary" href="{{ url('mybookings/csv') }}">Export to Csv </a> 
            </div>
          <div class="col-md-8">
            <table border="0" width="100%" id="tourslist" class="table table-striped table-inverse">
              <thead style="background:#f5f5f5;color:#777;height:50px;">
                <tr>
                  <th>Order #</th>
                  <th>payu_id</th>
                  <th>Package Name</th>
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
                <td><a href="detailview/{!! $booking->order_id !!}"><img src="{{ asset('/img/view.png') }}"/></a>              
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
<script src="{{ url('/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('/datatables-plugins/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ url('/datatables-responsive/dataTables.responsive.js') }}"></script>
<script type="text/javascript">
	$(document).ready(function() 
	{
		$('#tourslist').DataTable({
            	responsive: true
      	});
    });
	
	</script>
@include('includes.newfooter')