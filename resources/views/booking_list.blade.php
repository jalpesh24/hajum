@include('includes.newheader')
<div class="container">
<div class="breadcrumbs1">
<ol class="breadcrumb">
              <li class="breadcrumb-item"><i class="fa fa-home" aria-hidden="true"></i> <a href="{{ url('/newhome') }}">Home</a></li>
              <li class="breadcrumb-item active">Booking List</li>
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
          @endif </div>
        <div class="panel-body">          
		  <div class="pull-right">
           	<a class="btn btn-primary" href="{{ url('mybookings/csv') }}">Export to Csv </a> 
            </div><br />
          <div class="col-md-12">
            <table border="0" width="100%" id="tourslist" class="table table-striped table-inverse">
              <thead style="background:#f5f5f5;color:#777;height:50px;">
                <tr>
                  <th>ID #</th>                  
                  <th>Package</th>
                  <td>Action</td>
                </tr>
              </thead>
              <tbody>
                <?php $i=1; ?>
              @foreach($bookings as $booking)
              <tr>
                <td><a href="detailview/{!! $booking->order_id !!}">{!! $booking->order_id !!}</a></td>
                <td><a href="detailview/{!! $booking->order_id !!}">{!! $booking->tour_name !!}</a></td>
                <td><a href="detailview/{!! $booking->order_id !!}"><img src="{{ asset('public/img/view.png') }}"/></a>              
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

<script type="text/javascript">
	$(document).ready(function() 
	{
		$('#tourslist').DataTable({
            	responsive: true
      	});
    });
	
	</script>
  

<a href="#" id="toTop" style="display: inline;"><span id="toTopHover"></span></a><div id="ui-datepicker-div" class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all"></div></body></html>