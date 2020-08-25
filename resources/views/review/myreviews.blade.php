@extends('layouts.template')
@section('title','List of Tours')
@section('page_css')
<!-- DataTables CSS -->
<link href="{{ url('/datatables-plugins/dataTables.bootstrap.css') }}" rel="stylesheet">
<!-- DataTables Responsive CSS -->
<link href="{{ url('/datatables-responsive/dataTables.responsive.css') }}" rel="stylesheet">
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
              <li class="breadcrumb-item active">Tour Listing</li>
            </ol>
          </div>
          <div class="col-md-12">
            <table border="0" width="100%" id="tourslist" class="table">
              <thead style="background:#f5f5f5;color:#777;height:50px;">
                <tr>
                  <th>#</th>
                  <th>Client Name</th>
                  <th>Client Post</th>
                  <th>Client Rating</th>
                  <th>Client Comments</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1; ?>
              @foreach($testimonials as $testimonial)
              <tr>
                <td>{!! $i !!}</td>
                <td>{!! $testimonial->client_name !!}</td>
                <td>{!! $testimonial->client_post !!}</td>
                <td>{!! $testimonial->client_rating !!}</td>
                <td>{!! substr($testimonial->comments,0,100) !!}</td>                
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
	function delete_tour()
	{
		var conf = confirm("Are you sure want to delete this tour?");
		return conf;
	}
	</script>
@endsection