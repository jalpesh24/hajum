@extends('layouts.template')
@section('title','Hotel Agent List')
@section('page_css')
<!-- DataTables CSS -->
<link href="{{ url('public/datatables-plugins/dataTables.bootstrap.css') }}" rel="stylesheet">
<!-- DataTables Responsive CSS -->
<link href="{{ url('public/datatables-responsive/dataTables.responsive.css') }}" rel="stylesheet">
@endsection
@section('content')
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
              <li class="breadcrumb-item active">All Hotel Agents List</li>
            </ol>
          </div>
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
				  <th>Banke name</th>
				  <th>Bank Account No</th>
				  <th>Bank Code</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1; ?>
              @foreach($hotelagents as $hotelagent)
              <tr>
                <td>{!! $i !!}</td>
                <td>{!! $hotelagent->name !!}</td>
                <td>{!! $hotelagent->email !!}</td>
				<td>{!! $hotelagent->address !!}</td>
				<td>{!! $hotelagent->contact_number !!}</td>
				<td>{!! $hotelagent->bname !!}</td>
				<td>{!! $hotelagent->baccno !!}</td>
				<td>{!! $hotelagent->bcode !!}</td>
                <td>{!! $hotelagent->status !!}</td>
                <td>
                <a href="{!! action('HomeController@activehotelagent', $hotelagent->id) !!}">Active</a>&nbsp;&nbsp;               
                <a href="#"><img src="{{ asset('public/img/view.png') }}"/></a></td>
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
@endsection 
@section('page_js')
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
@endsection