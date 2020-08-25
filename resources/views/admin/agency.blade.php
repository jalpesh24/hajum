@extends('layouts.admin')
@section('title', 'Agency List')
@section('content')
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

<div class="container">
  <div class="breadcrumbs1">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home" aria-hidden="true"></i> <a href="{{ url('/dashboard') }}">Home</a></li>
      <li class="breadcrumb-item active">All Agency List</li>
    </ol>
  </div>
  <div class="row">
    <div class="col-sm-12"> @if (session('status'))
      <div class="alert alert-success">{{ session('status') }}</div>
      @endif
      <div class="panel panel-default" id="panelbg">

        <div class="panel-body">        	
       <!-- 
            <div class="pull-right">
           	<a class="btn btn-primary" href="{{ url('agencys/csv') }}">Export to Csv </a> 
            </div>
            <br /> -->

            <div class="col-md-12">
              <table border="0" width="100%" id="tourslist" class="table">
                <thead style="background:#f5f5f5;color:#777;height:50px;">
                  <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Phone No</th>				  
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i=1; ?>
                  @foreach($agences as $agency)
                  <tr>
                    <td>{!! $i !!}</td>
                    <td>{!! $agency->name !!}</td>
                    <td>{!! $agency->email !!}</td>
                    <td>{!! $agency->address !!}</td>
                    <td>{!! $agency->contact_number !!}</td>			
                    @if($agency->status == 'Active')
                      <td><i class="fa fa-toggle-on" aria-hidden="true" style="color:green;" title="Active"></i></td>
                      @else
                      <td><i class="fa fa-toggle-off" aria-hidden="true" style="color:red;" title="InActive"></i></td> 
                      @endif
                    <td>

                      <a href="{!! action('HomeController@activeagency', $agency->id) !!}"><i class="fa fa-check" aria-hidden="true" title="Active"></i></a>&nbsp;&nbsp;               
                      <a href="{!! action('HomeController@inactiveagency', $agency->id) !!}"><i class="fa fa-times" aria-hidden="true" title="InActive"></i></i></a>&nbsp;&nbsp;               
                      <a href="{!! action('HomeController@editagency', $agency->id) !!}"><img src="{{ asset('public/img/view.png') }}"/></a></td>
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
    <script type="text/javascript">
     $(document).ready(function() 
     {
      $('#userslist').DataTable({
       responsive: true
     });
    });

  </script>
  <a href="#" id="toTop" style="display: inline;"><span id="toTopHover"></span></a><div id="ui-datepicker-div" class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all"></div>