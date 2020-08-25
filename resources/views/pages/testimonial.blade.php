@extends('layouts.template')
@section('title', 'Testimonial')
@section('keywords', 'Trip India')
@section('description', 'Trip India')
@section('content')
<div class="container bg">
  <div class="row">
    <div class="col-md-12" style="padding-top:20px;">
      <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li class="active">Testimonial</li>
      </ol>
      <!--Section: Testimonials v.3-->
      <section class="section team-section">
        <!--Section heading-->
        <h2 class="section-heading">Testimonials</h2>
        <!--Section description-->
        <p class="section-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit, error amet numquam iure provident voluptate esse quasi, veritatis totam voluptas nostrum quisquam eum porro a pariatur accusamus veniam. Quia, minima?</p>
        <!--First row-->
        <div class="row text-center"> @foreach($testimonials as $testimonial)
          <!--First column-->
          <div class="col-md-4 mb-r">
            <div class="testimonial">
              <!--Avatar-->
              <div class="avatar"> @if($testimonial->client_image != '') <img src="{{ url('/testimonials/'.$testimonial->client_image) }}" alt="{!! $testimonial->client_name !!}" title="{!! $testimonial->client_name !!}" class="rounded-circle img-fluid" style="border-radius: 150px; width: 250px; height: 250px;"> @else <img src="{{ url('/testimonials/noimage.jpg') }}" alt="{!! $testimonial->client_name !!}" title="{!! $testimonial->client_name !!}" class="rounded-circle img-fluid" style="border-radius: 150px; width: 250px; height: 250px;"> @endif </div>
              <!--Content-->
              <h4>{!! $testimonial->client_name !!}</h4>
              <h5>{!! $testimonial->client_post !!}</h5>
              <div class="orange-text"> @for($i=1; $i <= $testimonial->client_rating; $i++) <i class="fa fa-star"> </i> @endfor </div>
              <p><i class="fa fa-quote-left"></i> {!! $testimonial->comments !!}</p>
              <!--Review-->
              <div>
                <p>&nbsp;</p>
              </div>
            </div>
          </div>
          <!--/First column-->
          @endforeach </div>
        <!--/First row-->
      </section>
      <!--/Section: Testimonials v.3-->
    </div>
  </div>
</div>
@endsection