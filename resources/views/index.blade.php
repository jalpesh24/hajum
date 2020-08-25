@extends('layouts.front')
@section('title', 'Hajum')
@section('content')
<section class="home_banner" style="background-image:url({{ asset('public/images/home-banner.jpg') }})">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="search_perfect">
          <ul id="tabs" class="nav nav-tabs" role="tablist">
            <li class="nav-item"> <a id="tab-A" href="#pane-A" class="nav-link active" data-toggle="tab" role="tab">Umrah</a> </li>
            <li class="nav-item"> <a id="tab-B" href="#pane-B" class="nav-link" data-toggle="tab" role="tab">Hajj</a> </li>
            <li class="nav-item"> <a id="tab-C" href="#pane-C" class="nav-link" data-toggle="tab" role="tab">Tours</a> </li>
            <li class="nav-item"> <a id="tab-D" href="#pane-D" class="nav-link" data-toggle="tab" role="tab">Agencies</a> </li>
            <li class="nav-item"> <a id="tab-E" href="#pane-E" class="nav-link" data-toggle="tab" role="tab">Car Hire</a> </li>
            <li class="nav-item"> <a id="tab-F" href="#pane-F" class="nav-link" data-toggle="tab" role="tab">Flight</a> </li>
            <li class="nav-item"> <a id="tab-G" href="#pane-G" class="nav-link" data-toggle="tab" role="tab">Hotel</a> </li>
          </ul>
          <div id="content" class="tab-content" role="tablist">
            <div id="pane-A" class="card tab-pane fade show active" role="tabpanel" aria-labelledby="tab-A">
              <div class="card-header" role="tab" id="heading-A">
                <h5 class="mb-0"> <a data-toggle="collapse" href="#collapse-A" aria-expanded="true" aria-controls="collapse-A">Umrah</a> </h5>
              </div>
              <div id="collapse-A" class="collapse show" data-parent="#content" role="tabpanel" aria-labelledby="heading-A">
                <div class="card-body">
                  <div class="search_body">
                    <form action="{{ url('/searchpackage') }}" class="form-inline" role="form" method="post" name="frm_package">
                    	{{ csrf_field() }}
                      <div class="row">
                        <div class="col-12">
                          <h2>Search Perfect <strong>Umrah</strong> Packages</h2>
                        </div>
                        <div class="col-12 form-group">
                          <ul class="search_form">
                            <li>
                              <label>No of Days</label>
                              <select class="form-control" id="days" name="days">
                                <option value="">Select Days</option>
                                <option value="7">0 to 7 days</option>
                                <option value="15">8 to 15 days</option>
                								<option value="21">16 to 21 days</option>
                								<option value="28">22 to 28 days</option>
                								<option value="35">29 to 35 days</option>
                								<option value="36">36 Plus days</option>
								 
                              </select>
                            </li>
                            <li>
                              <label>Package Class</label>
                              <select class="form-control" id="starrate" name="starrate">
                                <option value="">Select Class</option>
                								<option value="5">5 Star</option>
                								<option value="4">4 Star</option>
                                <option value="3">3 Star</option>
                								<option value="2">2 Star</option>
                                <option value="1">Economy</option>
                              </select>
                            </li>        
                       
							<li>
                              <label>Package Country</label>
                              <select id="country" name="country" class="form-control">
                                <option value="">Select Country</option>
								                @foreach($countries as $country)
                                <option value="{!! $country->id !!}">{!! $country->name !!}</option>
								                @endforeach
                              </select>
                            </li>
                            <li>
                              <label>Movement City</label>
                              <select class="form-control  movecities" multiple="multiple" id="city" name="city">
                                <option value="1">Class City</option>
                                <option value="2">Saudi Arabia</option>
                                <option value="3">India</option>
                              </select>
                            </li>
                            <li>
              							<label for="amount">Price Range: <span id="amount"></span></label>
              						    <input type="hidden" id="amount1" name="amount1">
              						    <input type="hidden" id="amount2" name="amount2">
              								<div id="slider-range"></div>
                            </li>
                            
                            <li>
                              <button class="search_tour">Search</button>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <div id="pane-B" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-B">
              <div class="card-header" role="tab" id="heading-B">
                <h5 class="mb-0"> <a class="collapsed" data-toggle="collapse" href="#collapse-B" aria-expanded="false" aria-controls="collapse-B">Hajj</a> </h5>
              </div>
              <div id="collapse-B" class="collapse" data-parent="#content" role="tabpanel" aria-labelledby="heading-B">
                <div class="card-body">
                  <div class="search_body">
                    <form>
                      <div class="row">
                        <div class="col-12">
                          <h2>Search Perfect <strong>Hajj</strong> Packages</h2>
                        </div>
                        <div class="col-12 form-group">
                          <ul class="search_form">
                            <li>
                              <label>No of Days</label>
                              <select class="form-control selecto">
                                <option value="">Select Days</option>
                                <option value="7">0 to 7 days</option>
                                <option value="15">8 to 15 days</option>
								<option value="21">16 to 21 days</option>
								<option value="28">22 to 28 days</option>
								<option value="35">29 to 35 days</option>
								<option value="36">36 Plus days</option>
								 
                              </select>
                            </li>
                             <li>
                              <label>Package Class</label>
                              <select class="form-control selecto">
                                <option value="">Select Class</option>
								<option value="4">5 Star</option>
								<option value="4">4 Star</option>
                                <option value="3">3 Star</option>
								<option value="2">2 Star</option>
                                <option value="1">Economy</option>
                              </select>
                            </li> 
                            <li>
                              <label>Package Country</label>
                              <select id="" class="form-control selectcountry">
                                <option value="">Select Country</option>
								@foreach($countries as $country)
                                <option value="{!! $country->id !!}">{!! $country->name !!}</option>
								@endforeach
                              </select>
                            </li>
							<li>
                              <label>Package City</label>
                              <select class="form-control selecto">
                                <option value="">Class City</option>
                                <option value="">Saudi Arabia</option>
                                <option value="">India</option>
                              </select>
                            </li>
                            <li>
							<label for="amount">Price Range: <span id="hajjamount"></span></label>
        <input type="hidden" id="hajjamount1">
    <input type="hidden" id="hajjamount2">
		<div id="hajjslider-range"></div>
                            </li>
                            <li>
                              <button class="search_tour">Search</button>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <div id="pane-C" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-C">
              <div class="card-header" role="tab" id="heading-C">
                <h5 class="mb-0"> <a class="collapsed" data-toggle="collapse" href="#collapse-C" aria-expanded="false" aria-controls="collapse-C">Tours</a></h5>
              </div>
              <div id="collapse-C" class="collapse" role="tabpanel" data-parent="#content" aria-labelledby="heading-C">
                <div class="card-body">
                  <div class="search_body">
                    <form>
                      <div class="row">
                        <div class="col-12">
                          <h2>Search Perfect <strong>Tours</strong> Packages</h2>
                        </div>
                        <div class="col-12 form-group">
                          <ul class="search_form">
                            <li>
                              <label>No of Days</label>
                              <select class="form-control selecto">
                                <option value="">Country</option>
                                <option value="">Saudi Arabia</option>
                                <option value="">India</option>
                              </select>
                            </li>
                            <li>
                              <label>Package Class</label>
                              <select class="form-control selecto">
                                <option value="">Country</option>
                                <option value="">Saudi Arabia</option>
                                <option value="">India</option>
                              </select>
                            </li>
                            <li>
                              <label>Package City</label>
                              <select class="form-control selecto">
                                <option value="">Country</option>
                                <option value="">Saudi Arabia</option>
                                <option value="">India</option>
                              </select>
                            </li>
                            <li>
                              <label>Low Price</label>
                              <input type="text" placeholder="Low Price" class="form-control">
                            </li>
                            <li>
                              <label>High Price</label>
                              <input type="text" placeholder="High Price" class="form-control">
                            </li>
                            <li>
                              <button class="search_tour">Search</button>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <div id="pane-D" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-D">
              <div class="card-header" role="tab" id="heading-D">
                <h5 class="mb-0"> <a class="collapsed" data-toggle="collapse" href="#collapse-D" aria-expanded="false" aria-controls="collapse-D">Agencies</a></h5>
              </div>
              <div id="collapse-D" class="collapse" role="tabpanel" data-parent="#content" aria-labelledby="heading-D">
                <div class="card-body">
                  <div class="search_body">
                    <form>
                      <div class="row">
                        <div class="col-12">
                          <h2>Search Perfect <strong>Agencies</strong> Packages</h2>
                        </div>
                        <div class="col-12 form-group">
                          <ul class="search_form">
                            <li>
                              <label>No of Days</label>
                              <select class="form-control selecto">
                                <option value="">Country</option>
                                <option value="">Saudi Arabia</option>
                                <option value="">India</option>
                              </select>
                            </li>
                            <li>
                              <label>Package Class</label>
                              <select class="form-control selecto">
                                <option value="">Country</option>
                                <option value="">Saudi Arabia</option>
                                <option value="">India</option>
                              </select>
                            </li>
                            <li>
                              <label>Package City</label>
                              <select class="form-control selecto">
                                <option value="">Country</option>
                                <option value="">Saudi Arabia</option>
                                <option value="">India</option>
                              </select>
                            </li>
                            <li>
                              <label>Low Price</label>
                              <input type="text" placeholder="Low Price" class="form-control">
                            </li>
                            <li>
                              <label>High Price</label>
                              <input type="text" placeholder="High Price" class="form-control">
                            </li>
                            <li>
                              <button class="search_tour">Search</button>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <div id="pane-E" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-E">
              <div class="card-header" role="tab" id="heading-E">
                <h5 class="mb-0"> <a class="collapsed" data-toggle="collapse" href="#collapse-E" aria-expanded="false" aria-controls="collapse-E">Car Hire</a></h5>
              </div>
              <div id="collapse-E" class="collapse" role="tabpanel" data-parent="#content" aria-labelledby="heading-E">
                <div class="card-body">
                  <div class="search_body">
                    <form>
                      <div class="row">
                        <div class="col-12">
                          <h2>Search Perfect <strong>Car Hire</strong> Packages</h2>
                        </div>
                        <div class="col-12 form-group">
                          <ul class="search_form">
                            <li>
                              <label>No of Days</label>
                              <select class="form-control selecto">
                                <option value="">Country</option>
                                <option value="">Saudi Arabia</option>
                                <option value="">India</option>
                              </select>
                            </li>
                            <li>
                              <label>Package Class</label>
                              <select class="form-control selecto">
                                <option value="">Country</option>
                                <option value="">Saudi Arabia</option>
                                <option value="">India</option>
                              </select>
                            </li>
                            <li>
                              <label>Package City</label>
                              <select class="form-control selecto">
                                <option value="">Country</option>
                                <option value="">Saudi Arabia</option>
                                <option value="">India</option>
                              </select>
                            </li>
                            <li>
                              <label>Low Price</label>
                              <input type="text" placeholder="Low Price" class="form-control">
                            </li>
                            <li>
                              <label>High Price</label>
                              <input type="text" placeholder="High Price" class="form-control">
                            </li>
                            <li>
                              <button class="search_tour">Search</button>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <div id="pane-F" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-F">
              <div class="card-header" role="tab" id="heading-F">
                <h5 class="mb-0"> <a class="collapsed" data-toggle="collapse" href="#collapse-F" aria-expanded="false" aria-controls="collapse-E">Flight</a></h5>
              </div>
              <div id="collapse-F" class="collapse" role="tabpanel" data-parent="#content" aria-labelledby="heading-F">
                <div class="card-body">
                  <div class="search_body">
                    <form>
                      <div class="row">
                        <div class="col-12">
                          <h2>Search Perfect <strong>Flight</strong> Packages</h2>
                        </div>
                        <div class="col-12 form-group">
                          <ul class="search_form">
                            <li>
                              <label>No of Days</label>
                              <select class="form-control selecto">
                                <option value="">Country</option>
                                <option value="">Saudi Arabia</option>
                                <option value="">India</option>
                              </select>
                            </li>
                            <li>
                              <label>Package Class</label>
                              <select class="form-control selecto">
                                <option value="">Country</option>
                                <option value="">Saudi Arabia</option>
                                <option value="">India</option>
                              </select>
                            </li>
                            <li>
                              <label>Package City</label>
                              <select class="form-control selecto">
                                <option value="">Country</option>
                                <option value="">Saudi Arabia</option>
                                <option value="">India</option>
                              </select>
                            </li>
                            <li>
                              <label>Low Price</label>
                              <input type="text" placeholder="Low Price" class="form-control">
                            </li>
                            <li>
                              <label>High Price</label>
                              <input type="text" placeholder="High Price" class="form-control">
                            </li>
                            <li>
                              <button class="search_tour">Search</button>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <div id="pane-G" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-G">
              <div class="card-header" role="tab" id="heading-G">
                <h5 class="mb-0"> <a class="collapsed" data-toggle="collapse" href="#collapse-G" aria-expanded="false" aria-controls="collapse-G">Hotel</a></h5>
              </div>
              <div id="collapse-G" class="collapse" role="tabpanel" data-parent="#content" aria-labelledby="heading-G">
                <div class="card-body">
                  <div class="search_body">
                    <form>
                      <div class="row">
                        <div class="col-12">
                          <h2>Search Perfect <strong>Hotel</strong> Packages</h2>
                        </div>
                        <div class="col-12 form-group">
                          <ul class="search_form">
                            <li>
                              <label>No of Days</label>
                              <select class="form-control selecto">
                                <option value="">Country</option>
                                <option value="">Saudi Arabia</option>
                                <option value="">India</option>
                              </select>
                            </li>
                            <li>
                              <label>Package Class</label>
                              <select class="form-control selecto">
                                <option value="">Country</option>
                                <option value="">Saudi Arabia</option>
                                <option value="">India</option>
                              </select>
                            </li>
                            <li>
                              <label>Package City</label>
                              <select class="form-control selecto">
                                <option value="">Country</option>
                                <option value="">Saudi Arabia</option>
                                <option value="">India</option>
                              </select>
                            </li>
                            <li>
                              <label>Low Price</label>
                              <input type="text" placeholder="Low Price" class="form-control">
                            </li>
                            <li>
                              <label>High Price</label>
                              <input type="text" placeholder="High Price" class="form-control">
                            </li>
                            <li>
                              <button class="search_tour">Search</button>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="why_hajum">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-12 center-align">
        <h2 class="main_hedding">Why with <strong>hajum.net?</strong></h2>
      </div>
      <div class="col-lg-3 col-12 text-center">
        <div class="facility_hajum">
          <div class="facility_image"> <img src="{{ asset('public/images/travels-date.png') }}" /> </div>
          <h4>Set travel date, budget<br>
            and how many days</h4>
        </div>
      </div>
      <div class="col-lg-3 col-12 text-center">
        <div class="facility_hajum">
          <div class="facility_image"> <img src="{{ asset('public/images/prices.png') }}" /> </div>
          <h4>Set travel date, budget<br>
            and how many days</h4>
        </div>
      </div>
      <div class="col-lg-3 col-12 text-center">
        <div class="facility_hajum">
          <div class="facility_image"> <img src="{{ asset('public/images/hotel-car.png') }}" /> </div>
          <h4>Set travel date, budget<br>
            and how many days</h4>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="all_package">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-12"> <a href="#">
        <div class="tour_package" style="background-image:url({{ asset('public/images/HajjPackage.jpg') }})">
          <div class="caption_text">
            <h4>Hajj Package</h4>
            <p>190 country 1000 umrah packet</p>
          </div>
        </div>
        </a> </div>
      <div class="col-lg-6 col-12"> <a href="#">
        <div class="tour_package" style="background-image:url({{ asset('public/images/UmrahPackages.jpg') }})">
          <div class="caption_text">
            <h4>Umrah Packages</h4>
            <p>190 country 1000 umrah packet</p>
          </div>
        </div>
        </a> </div>
      <div class="col-lg-3 col-12">
        <div class="tour_package" style="background-image:url({{ asset('public/images/TourPackages.jpg') }})">
          <div class="caption_text">
            <h4>Tour Packages</h4>
            <p>190 country 1000 umrah packet</p>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-3 col-12"> <a href="#">
        <div class="tour_package" style="background-image:url({{ asset('public/images/TourAgencies.jpg') }})">
          <div class="caption_text">
            <h4>Tour Agencies</h4>
            <p>190 country 1000 umrah packet</p>
          </div>
        </div>
        </a> </div>
      <div class="col-lg-3 col-12"> <a href="#">
        <div class="tour_package" style="background-image:url({{ asset('public/images/RentCar.jpg') }})">
          <div class="caption_text">
            <h4>Rent a Car</h4>
            <p>190 country 1000 umrah packet</p>
          </div>
        </div>
        </a> </div>
      <div class="col-lg-3 col-12"> <a href="#">
        <div class="tour_package" style="background-image:url({{ asset('public/images/PlaneTickets.jpg') }})">
          <div class="caption_text">
            <h4>Plane Tickets</h4>
            <p>190 country 1000 umrah packet</p>
          </div>
        </div>
        </a> </div>
      <div class="col-lg-3 col-12"> <a href="#">
        <div class="tour_package" style="background-image:url({{ asset('public/images/HotelsWorldwide.jpg') }})">
          <div class="caption_text">
            <h4>Hotels Worldwide</h4>
            <p>190 country 1000 umrah packet</p>
          </div>
        </div>
        </a> </div>
    </div>
  </div>
</section>
@endsection