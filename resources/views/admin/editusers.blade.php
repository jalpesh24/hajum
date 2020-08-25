@include('includes.newheader')
<!-- DataTables CSS -->
<link href="{{ url('/datatables-plugins/dataTables.bootstrap.css') }}" rel="stylesheet">
<!-- DataTables Responsive CSS -->
<link href="{{ url('/datatables-responsive/dataTables.responsive.css') }}" rel="stylesheet">

<div class="container">
<div class="breadcrumbs1">
<ol class="breadcrumb">
              <li class="breadcrumb-item"><i class="fa fa-home" aria-hidden="true"></i> <a href="{{ url('/newhome') }}">Home</a></li>
              <li class="breadcrumb-item active">Edit Profile</li>
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
                     
          <div class="col-md-12">
            <form method="post" name="frm_edit_tour_price">
              {{ csrf_field() }}
              
              <label for="packagename">Name</label>
                  <input type="text" id="name" name="name" placeholder="name" style="color:#000000;"  value="{!! $user_detail[0]->name !!}" />							             <label for="packagename">Email</label>
                  <input type="text" id="email" name="email" placeholder="email" style="color:#000000;"  value="{!! $user_detail[0]->email !!}" disabled/>							             
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
@include('includes.newfooter')
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

<a href="#" id="toTop" style="display: inline;"><span id="toTopHover"></span></a><div id="ui-datepicker-div" class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all"></div></body></html>