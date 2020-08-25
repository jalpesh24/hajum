@extends('layouts.admin')
@section('title', 'Admin List')
@section('content')

<div class="container">
<div class="breadcrumbs1">
<ol class="breadcrumb">
              <li class="breadcrumb-item"><i class="fa fa-home" aria-hidden="true"></i> <a href="{{ url('/dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">All Admin List</li>
</ol>
</div>
  <div class="row">
    <div class="col-sm-12"> @if (session('status'))
      <div class="alert alert-success">{{ session('status') }}</div>
      @endif
     <div class="panel panel-default" id="panelbg">
       <div class="panel-body">
                <!-- <div class="pull-right">
           	<a class="btn btn-primary" href="{{ url('admins/csv') }}">Export to Csv </a> 
            </div><br /> -->

          <div class="col-md-12">
            <table border="0" width="100%" id="tourslist" class="table">
              <thead style="background:#f5f5f5;color:#777;height:50px;">
                <tr>
                  <th>No</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1; ?>
              @foreach($admins as $admin)
              <tr>
                <td>{!! $i !!}</td>
                <td>{!! $admin->name !!}</td>
                <td>{!! $admin->email !!}</td>
                <td>{!! $admin->status !!}</td>                
              </tr>
              <?php $i++; ?>
              @endforeach
              </tbody>
              
            </table>
          </div>
          <?php echo $admins->render(); ?>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
<script type="text/javascript">
	$(document).ready(function() 
	{
		$('#adminslist').DataTable({
            	responsive: true
      	});
    });
	
	</script>
<a href="#" id="toTop" style="display: inline;"><span id="toTopHover"></span></a><div id="ui-datepicker-div" class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all"></div>
