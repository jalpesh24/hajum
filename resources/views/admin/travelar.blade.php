@include('includes.newheader')
<!-- DataTables CSS -->
<link href="{{ url('public/datatables-plugins/dataTables.bootstrap.css') }}" rel="stylesheet">
<!-- DataTables Responsive CSS -->
<link href="{{ url('public/datatables-responsive/dataTables.responsive.css') }}" rel="stylesheet">

<div class="container">
<div class="breadcrumbs1">
<ol class="breadcrumb">
              <li class="breadcrumb-item"><i class="fa fa-home" aria-hidden="true"></i> <a href="{{ url('/newhome') }}">Home</a></li>
              <li class="breadcrumb-item active">All Travelar Agents List</li>
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
           	<a class="btn btn-primary" href="{{ url('travelar/csv') }}">Export to Csv </a> 
            </div>
         <br />

          <div class="col-md-12">
            <table border="0" width="100%" id="tourslist" class="table">
              <thead style="background:#f5f5f5;color:#777;height:50px;">
                <tr>
                  <th>No</th>
                  <th>Name</th>
                  <th>Email</th>
				  <th>Address</th>
				  <th>Phone No</th>
				  <th>Category</th>				  
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1; ?>
              @foreach($travelars as $travelar)
              <tr>
                <td>{!! $i !!}</td>
                <td>{!! $travelar->name !!}</td>
                <td>{!! $travelar->email !!}</td>
				<td>{!! $travelar->address !!}</td>
				<td>{!! $travelar->contact_number !!}</td>
				<td>{!! $travelar->catname !!}</td>				
                <td>{!! $travelar->status !!}</td>
                <td>
				<a href="{!! action('HomeController@activetravelagent', $travelar->id) !!}"><i class="fa fa-check" aria-hidden="true" title="Active"></i></a>&nbsp;&nbsp;               
                <a href="{!! action('HomeController@inactivetravel', $travelar->id) !!}"><i class="fa fa-times" aria-hidden="true" title="InActive"></i></i></a>&nbsp;&nbsp;               
                <a href="{!! action('HomeController@edittravel', $travelar->id) !!}"><img src="{{ asset('public/img/view.png') }}"/></a></td>
             
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
		$('#userslist').DataTable({
            	responsive: true
      	});
    });
	
	</script>
<a href="#" id="toTop" style="display: inline;"><span id="toTopHover"></span></a><div id="ui-datepicker-div" class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all"></div></body></html>