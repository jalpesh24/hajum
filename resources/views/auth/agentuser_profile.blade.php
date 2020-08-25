@include('includes.newheader')
<div class="container">
<div class="row">
      <div class="breadcrumbs1 nw-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home" aria-hidden="true"></i> <a href="newhome.html">Home</a></li>
          <li class="breadcrumb-item active">Agent User Profile</li>
        </ol>
      </div>
    </div>
  <div class="row">
    <div class="col-md-12"> @if (session('status'))
      <div class="alert alert-success">{{ session('status') }}</div>
      @endif
      <div class="panel panel-default" id="panelbg">
        <div class="panel-heading" id="headerbg"> @if (Auth::guest())              
          @else
          @include('includes.minimenu')              
          @endif </div>
        <div class="panel-body" >
       
          <div class="col-md-12">
            <form method="post" name="frm_agentuser_profile" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="col-md-6 form-line">
                <div class="form-group">
                  <label for="user_name">Name</label>
                  <input type="text" class="form-control" id="user_name" placeholder="Name" name="user_name" required="required" value="{!! $user_info[0]->name !!}">
                </div>
              </div>
              <div class="col-md-6 form-line">
                <div class="form-group">
                  <label for="user_email">Email</label>
                  <input type="email" class="form-control" name="user_email" id="user_email" placeholder="Email ID" required="required" value="{!! $user_info[0]->email !!}" />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for ="user_contact">Contact</label>
                  <input type="text" class="form-control" name="user_contact" id="user_contact" placeholder="Contact Number" value="{!! $user_info[0]->contact_number !!}">
                </div>
              </div>
              <div class="col-md-6 form-line">
                <div class="form-group">
                  <label for="user_address">Address</label>
                  <textarea rows="3" class="form-control" id="user_address" name="user_address" placeholder="Address" >{!! $user_info[0]->address !!}</textarea>
                </div>
              </div>
			    <div class="col-md-6 form-line">
                <div class="form-group">
                  <label for="user_address">Upload Document</label>
				  
				  <?php 
				  if($user_info[0]->document != ''){
				  $imgs = explode(',', $user_info->document); ?>
				  <ul>
					@foreach($imgs as $docimg)
					<li>
					<div><img src="{{ url('tours_images/'.$docimg) }}"></div>
					</li>
					@endforeach
					</ul>
                  <input type="file" class="form-control" name="filename[]" multiple autofocus>
				  <?php } else{ ?>
				  <input type="file" class="form-control" name="filename[]" multiple autofocus>
				  <?php } ?>
                </div>
              </div>
              <div class="col-md-6 form-line">
                <div class="form-group">
                  <input type="submit" class="btn btn-primary submit" name="btn_update_userprofile" id="btn_update_userprofile" value="Update">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

  @include('includes.newfooter')

<script src="{{ url('newhtml/js/bootstrap.js') }}"></script>
<script src="{{ url('newhtml/js/bootstrap.min.js') }}"></script>
<script src="{{ url('newhtml/js/jqBootstrapValidation.js') }}"></script>
<script src="{{ url('newhtml/js/clean-blog.min.js') }}"></script>
<script src="{{ url('newhtml/js/jquery.bootcomplete.js') }}"></script>
<a href="#" id="toTop" style="display: inline;"><span id="toTopHover"></span></a><div id="ui-datepicker-div" class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all"></div></body></html>