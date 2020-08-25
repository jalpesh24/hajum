@extends('layouts.admin')
@section('title', 'Add cms')
@section('content')

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<a href="#" id="toTop" style="display: inline;"><span id="toTopHover"></span></a><div id="ui-datepicker-div" class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all"></div>
<div class="container">
  <div class="breadcrumbs1">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home" aria-hidden="true"></i> <a href="{{ url('/dashboard') }}">Home</a></li>
      <li class="breadcrumb-item active">Add New Cms</li>
    </ol>
  </div>
  <div class="row">
    <div class="col-sm-12"> @if (session('status'))
      <div class="alert alert-success">{{ session('status') }}</div>
      @endif
      <div class="panel panel-default" id="panelbg">

        <div class="panel-body">

          <div class="col-md-12">
             <form method="post" name="frm_add_cms" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="col-md-4 form-line">
                <div class="form-group">
                  <label for="packagename">Cms name</label>
                  <input type="text" class="form-control" id="title" placeholder="Package Name" name="title" required="required">
                </div>
              </div>
              <div class="col-md-4 form-line">
                <div class="form-group">
                  <label for="packagename">Display Content Location</label>
                  <select name="content_display_location" id="content_display_location" class="form-control input-lg dynamic" required>
                   <option value="">Select Country</option>                     
                   <option value="homepage" selected="select">homepage</option>                 
                 </select> 
               </div>
             </div>
             <div class="col-md-6 form-line">
              <div class="form-group">
                <label for="packagename">Description</label>
                <textarea rows="6" class="form-control" id="description" name="description" placeholder="Enter description" required ></textarea>
              </div>
            </div>
            <div class="col-md-12">
              <input type="submit" class="btn btn-primary submit" name="btn_add_cms" id="btn_add_cms" value="Save">
        </div>
          </form>
      </div>
    </div>
  </div>
</div>
</div>
</div>
@endsection

