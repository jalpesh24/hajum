@include('includes.newheader')
<div class="container">
<div class="breadcrumbs1">
<ol class="breadcrumb">
              <li class="breadcrumb-item"><i class="fa fa-home" aria-hidden="true"></i> <a href="{{ url('/newhome') }}">Home</a></li>
              <li class="breadcrumb-item active">Add Testimonial</li>
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
          <div class="col-sm-4">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><i class="fa fa-home" aria-hidden="true"></i> <a href="{{ url('/dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{ url('/testimonial-listing') }}">Testimonial</a></li>
              <li class="breadcrumb-item active">Add New Testimonial</li>
            </ol>
          </div>
          <div class="col-md-12">
            <form method="post" name="frm_add_tour" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="col-md-4 form-line"><div class="form-group">
                  <label for="packagename">Designation</label>
                  <input type="text" class="form-control" id="txt_post" placeholder="Enter your post" name="txt_post">
                </div>
              </div>
              
              <div class="col-md-4 form-line"><div class="form-group">               
                    <label for ="txt_tour_rating">Rating</label>
                   <input type="number" class="form-control" id="txt_rating" placeholder="Give your rating" name="txt_rating" max="5">             
                </div>
              </div> 
                           
              <div class="col-md-4 form-line"><div class="form-group">
                  <label for="packagename">Upload your image</label>
                  {!! Form::file('mainimg', array('id'=>'mainimage')) !!}
                   </div>
                </div>
              
              <div class="col-md-12 form-line">
                <div class="form-group">
                  <label for="packagename">Review</label>
                  <textarea rows="6" class="form-control" id="txt_comment" name="txt_comment" placeholder="Enter your review" ></textarea>
                </div>
               <div class="form-group">
                  <input type="submit" class="btn btn-primary submit" name="btn_add_tour" id="btn_add_tour" value="Save">
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

