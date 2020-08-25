@extends('layouts.admin')
@section('title', 'Cms List')

@section('content')
<div class="container">
<div class="breadcrumbs1">
<ol class="breadcrumb">
    <li class="breadcrumb-item"><i class="fa fa-home" aria-hidden="true"></i> <a href="{{ url('/dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Dashboard</li>
</ol>
</div>
  <div class="row">
    <div class="col-sm-12"> @if (session('status'))
      <div class="alert alert-success">{{ session('status') }}</div>
      @endif
      <div class="panel panel-default" id="panelbg">
       
        <div class="panel-body">
        
          <div class="col-md-12">
            <table border="0" width="100%" id="tourslist" class="table">
              <thead style="background:#f5f5f5;color:#777;height:50px;">
                <tr>
                  <th>Page ID</th>
                  <th>Page Name</th>
                  <th>Location</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1; ?>
              @foreach($cmsLists as $cmsList)
              <tr>
                <td>{!! $cmsList->cms_id !!}</td>
                <td>{!! $cmsList->title !!}</td>
                <td>{!! $cmsList->content_display_location !!}</td>   
				@if($cmsList->status == 1)
                <td><i class="fa fa-toggle-on" aria-hidden="true" style="color:green;"></i></td>
				@else
				<td><i class="fa fa-toggle-off" aria-hidden="true" style="color:red;"></i></td>	
				@endif
                <td><a href="{{ url('/update-cms-status/'.$cmsList->cms_id.'/'.$cmsList->status) }}"><img src="{{ asset('public/img/edit.png') }}" title ="change status"/></a>&nbsp;				
                <a href="{{ url('/delete-cms/'.$cmsList->cms_id) }}" onclick="return delete_cms();"><img src="{{ asset('public/img/delete.png') }}"/></a>&nbsp;
				<a href="{!! url('cms-detail-for-update/'.$cmsList->cms_id) !!}" target="_blank"><img src="{{ asset('public/img/view.png') }}"/></a>&nbsp;
				</td>
              </tr>
              <?php $i++; ?>
              @endforeach
              </tbody>
              
            </table>
          </div>
          <?php echo $cmsLists->render(); ?>
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
	function delete_cms()
	{
		var conf = confirm("Are you sure want to delete this cms?");
		return conf;
	}
	</script>

<a href="#" id="toTop" style="display: inline;"><span id="toTopHover"></span></a><div id="ui-datepicker-div" class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all"></div>