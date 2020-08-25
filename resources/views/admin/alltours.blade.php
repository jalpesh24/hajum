@extends('layouts.admin')
@section('title', 'Tours List')
@section('content')
<!-- DataTables CSS -->
<link href="{{ asset('public/datatables-plugins/dataTables.bootstrap.css') }}" rel="stylesheet">
<!-- DataTables Responsive CSS -->
<link href="{{ asset('public/datatables-responsive/dataTables.responsive.css') }}" rel="stylesheet">

<div class="container">
<div class="breadcrumbs1">
<ol class="breadcrumb">
              <li class="breadcrumb-item"><i class="fa fa-home" aria-hidden="true"></i> <a href="{{ url('/dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">All Tours List</li>
</ol>
</div>
  <div class="row">
    <div class="col-sm-12"> @if (session('status'))
      <div class="alert alert-success">{{ session('status') }}</div>
      @endif
      <div class="panel panel-default" id="panelbg">
      
        <div class="panel-body">
         
  <!--         <div class="pull-right">
           	<a class="btn btn-primary" href="{{ url('alltours/csv') }}">Export to Csv </a> 
            </div><br /> -->
          <div class="col-md-12">
            <table border="0" width="100%" id="tourslist" class="table">
              <thead style="background:#f5f5f5;color:#777;height:50px;">
                <tr>
                  <th>Id</th>
                  <th>Package Name</th>
                  <th>Location</th>
                  <th>From Date</th>
                  <th>To Date</th>
                  <th>Price</th>         
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>                
              @foreach($tours as $tour)
              <tr>
                <td>{!! $tour->tour_id !!}</td>
                <td>{!! $tour->tour_name !!}</td>
                <td>{!! $tour->city_location !!}</td>
                <td>{!! $tour->fromdate !!}</td>
                <td>{!! $tour->todate !!}</td>
                <td>{!! $tour->price_per_person !!}</td>
                @if($tour->status == '1')
                      <td><i class="fa fa-toggle-on" aria-hidden="true" style="color:green;" title="Active"></i></td>
                      @else
                      <td><i class="fa fa-toggle-off" aria-hidden="true" style="color:red;" title="InActive"></i></td> 
                      @endif                         
                       
          
                <td>
                   @if($tour->status == '1')
                      <a href="{!! action('ToursController@inActivetour', $tour->tour_id) !!}">InActive</a>
                    @else
                      <a href="{!! action('ToursController@activetour', $tour->tour_id) !!}">Active</a>
                    @endif  
                 <a href="{!! url('/tour/'.$tour->tour_id) !!}"><img src="{{ asset('public/img/edit.png') }}"/></a>&nbsp;<a href="{!! action('ToursController@deletetour', $tour->tour_id) !!}" onclick="return delete_tour();"><img src="{{ asset('public/img/delete.png') }}"/></a></td>
              </tr>             
              @endforeach
              </tbody>              
            </table>
          </div>
          <?php echo $tours->render(); ?>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
<script type="text/javascript">
	$(document).ready(function() 
	{
		$('#tourslist').DataTable({
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