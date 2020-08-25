@extends('layouts.template')
@section('title', 'Review')
@section('keywords', 'Trip India')
@section('description', 'Trip India')
@section('content')
<div class="container bg">
  <div class="row">
    <div class="col-md-12" style="padding-top:20px;">
      <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li class="active">Review</li>
      </ol>
      <!--Section: Reviews v.3-->
      <section class="section team-section">
        <!--Section heading-->
        <h2 class="section-heading">Reviews</h2>
        <!--Section description-->
       <!--  <p class="section-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit, error amet numquam iure provident voluptate esse quasi, veritatis totam voluptas nostrum quisquam eum porro a pariatur accusamus veniam. Quia, minima?</p> -->
        <!--First row-->
        <div class="row text-center"> @foreach($reviews as $review)
          <!--First column-->
          <div class="col-md-4 mb-r">
            <div class="review">
              <!--Avatar-->
              
              <!--Content-->
              <!-- <h4>{!! $review->client_name !!}</h4> -->
              <h5>{!! $review->client_post !!}</h5>
              <div class="orange-text"> @for($i=1; $i <= $review->client_rating; $i++) <i class="fa fa-star"> </i> @endfor </div>
              <p><i class="fa fa-quote-left"></i> {!! $review->comments !!}</p>
              <!--Review-->
              <div>
                <p>&nbsp;</p>
              </div>
            </div>
          </div>
          <!--/First column-->
          @endforeach </div>
        <!--/First row-->
        <p><a href="{{ url('reviewall') }}">Read all reviews</a> | <a href="{{ url('review-add') }}">Add review</a> </p>
      </section>
      <!--/Section: Reviews v.3-->
    </div>
  </div>
</div>
@endsection