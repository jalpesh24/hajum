@extends('layouts.template')
@section('title','Travelar Edit')
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
              <li class="breadcrumb-item active">Edit Travelar</li>
            </ol>
          </div>
            
          <div class="col-md-12">
            <form method="post" name="frm_edit_category">
              {{ csrf_field() }}
              <div class="col-md-4">
              <label for="packagename">Name</label>
                  <input type="text" id="name" name="name" placeholder="name" style="color:#000000;"  value="{!! $traveldetail[0]->name !!}" readonly />	
				</div>	
				<div class="col-md-4">
				  <label for="packagename">Category Name</label>					
                  	<select id="catname" name="catid">
					<option value="0" <?php if($traveldetail[0]->catid ==0) { echo 'selected'; } ?> >Select category</option>
					@foreach($travelcats as $travelcat)	
					<option value="{!! $travelcat->cid !!}" <?php if($traveldetail[0]->catid ==$travelcat->cid) { echo 'selected'; } ?>>{!! $travelcat->catname !!}</option>
					@endforeach
					</select>
				</div>
                  <div style="clear:both"></div>
			 <div class="form-group">
              <input type="submit" class="btn btn-primary submit" name="btn_update" id="btn_update" value="Update">
            </div>						             
            </form>  
              
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
		$('#userslist').DataTable({
            	responsive: true
      	});
    });
	
	</script>
@endsection