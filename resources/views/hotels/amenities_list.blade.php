@include('includes.newheader')
<!-- DataTables CSS -->
<link href="{{ url('public/datatables-plugins/dataTables.bootstrap.css') }}" rel="stylesheet">
<!-- DataTables Responsive CSS -->
<link href="{{ url('public/datatables-responsive/dataTables.responsive.css') }}" rel="stylesheet">

<div class="container">
<div class="breadcrumbs1">
<ol class="breadcrumb">
              <li class="breadcrumb-item"><i class="fa fa-home" aria-hidden="true"></i> <a href="{{ url('/newhome') }}">Home</a></li>
              <li class="breadcrumb-item active">Amenities Listing</li>
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
          <div class="col-sm-4">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><i class="fa fa-home" aria-hidden="true"></i> <a href="{{ url('/dashboard') }}">Home</a></li>              
              <li class="breadcrumb-item active">Amenities Listing</li>
            </ol>
          </div><div class="pull-right">
           	<a class="btn btn-primary" href="#">Export to Csv </a> 
            </div><br />
          <div class="col-md-12">
            <table border="0" width="100%" id="tourslist" class="table">
              <thead style="background:#f5f5f5;color:#777;height:50px;">
                <tr>
                  <th>Id</th>
                  <th>aminity_name</th>                  
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1; ?>
              @foreach($amenitieslists as $amenitieslist)
              <tr>
      
                <td>{!! $amenitieslist->aid !!}</td>
                <td>{!! $amenitieslist->aminity_name !!}</td>  
				
                <td><a href="#"><img src="{{ asset('public/img/edit.png') }}"/></a>&nbsp;				
                <a href="#" onclick="return delete_hotel();"><img src="{{ asset('public/img/delete.png') }}"/></a>&nbsp;
				<a href="#" target="_blank"><img src="{{ asset('public/img/view.png') }}"/></a>&nbsp;
				<a href="{!! url('/hotelaminities') !!}" target="_blank">Add New Amenities</a>&nbsp;
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
@include('includes.newfooter')