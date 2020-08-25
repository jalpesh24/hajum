@extends('layouts.admin')
@section('title', 'Activity List')
@section('content')

<div class="container">
  <div class="breadcrumbs1">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home" aria-hidden="true"></i> <a href="{{ url('/dashboard') }}">Home</a></li>
      <li class="breadcrumb-item active">All Activity List</li>
    </ol>
  </div>
  <div class="row">
    <div class="col-sm-12"> @if (session('status'))
      <div class="alert alert-success">{{ session('status') }}</div>
      @endif
      <div class="panel panel-default" id="panelbg">
        <div class="panel-body">
          
      <!--     <div class="pull-right">
           	<a class="btn btn-primary" href="{{ url('allactivities/csv') }}">Export to Csv </a> 
            </div><br /> -->

          <div class="col-md-12">
            <table border="0" width="100%" id="tourslist" class="table">
              <thead style="background:#f5f5f5;color:#777;height:50px;">
                <tr>
                  <th>Activities Name</th>
                  <th>Catgory</th>
                  <th>Location</th>                  
                  <th>Price</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1; ?>
              @foreach($activities as $activity)
              <tr>      
                <td>{!! $activity->activities_name !!}</td>
                <td>{!! $activity->activities_category !!}</td>
                <td>{!! $activity->activities_location !!}</td>
                <td>{!! $activity->activities_price !!}</td>                
                @if($activity->activities_status == 'Active')
                      <td><i class="fa fa-toggle-on" aria-hidden="true" style="color:green;" title="Active"></i></td>
                      @else
                      <td><i class="fa fa-toggle-off" aria-hidden="true" style="color:red;" title="InActive"></i></td> 
                      @endif
                <td>
                <a href="{{ url('/activity/'.$activity->activities_id) }}"><img src="{{ asset('public/img/edit.png') }}"/></a>&nbsp;&nbsp;
                <a href="{{ url('/deleteactivity/'.$activity->activities_id) }}" onclick="return delete_activity();"><img src="{{ asset('public/img/delete.png') }}"/></a>
                </td>
              </tr>
              <?php $i++; ?>
              @endforeach
              </tbody>
              
            </table>
          </div>
          <?php echo $activities->render(); ?>
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
	function delete_activity()
	{
		var conf = confirm("Are you sure want to delete this activity?");
		return conf;
	}
	</script>
