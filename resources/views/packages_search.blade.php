@extends('layouts.front')
@section('title', 'Search Packages')
@section('content')
<section class="searchform">
<div class="container">
<div class="row">
<ul class="breadcrumb"><li><a href="">Home</a></li>
                <li class="active">Umrah Packages</li>
</ul>
</div>
<div class="row">
<div class="search_body ">
                    <form action="{{ url('/searchpackages') }}" method="POST" name="searchpackages">
					{{ csrf_field() }}
                      <div class="row">
                        <div class="col-12">
                          <h2>Search Perfect <strong>Umrah</strong> Packages</h2>
                        </div>
                        <div class="col-12 form-group">
                          <ul class="search_form formbox">
                           
                          </ul>
                        </div>
                      </div>
                    </form>
                  </div>
</div>
</div>
</section>
<section id="searchresult_section">
<div class="container">
<div class="row">
<div class="col-md-3">
<aside class="booking-filters booking-filters-white">
<h3>Filter By:</h3>
<ul class="list booking-filters-list">
<li><h5 class="booking-filters-title">Price</h5>
<span id="amount"></span>
<input type="hidden" id="amount1" name="minamount"/>
    <input type="hidden" id="amount2" name="maxamount"/>
		<div id="slider-range"></div>
</li>
<li><h5 class="booking-filters-title">Country</h5>
<select id="package_country" name="package_country" class="form-control selectcountry">
                                <option value="">Select Country</option>
								@foreach($countries as $country)
                                <option value="{!! $country->id !!}">{!! $country->name !!}</option>
								@endforeach
                              </select>
</li>
<li><h5 class="booking-filters-title">Movement City</h5>
<div class="list skin-square">
                <div>
                  <input tabindex="9" type="checkbox" id="square-checkbox-1">
                  <label for="square-checkbox-1">City 1</label>
                </div>
                <div>
                  <input tabindex="10" type="checkbox" id="square-checkbox-2" checked>
                  <label for="square-checkbox-2">City 2</label>
                </div>
	</div>			
</li>

<li><h5 class="booking-filters-title">Package Class</h5>
<div class="list skin-square">
                <div>
                  <input tabindex="9" type="checkbox" id="square-checkbox-1">
                  <label for="square-checkbox-1">5 Star</label>
                </div>
                <div>
                  <input tabindex="10" type="checkbox" id="square-checkbox-2" checked>
                  <label for="square-checkbox-2">4 Star</label>
                </div>
				<div>
                  <input tabindex="10" type="checkbox" id="square-checkbox-2" checked>
                  <label for="square-checkbox-2">3 Star</label>
                </div>
				<div>
                  <input tabindex="10" type="checkbox" id="square-checkbox-2" checked>
                  <label for="square-checkbox-2">2 Star</label>
                </div>
				<div>
                  <input tabindex="10" type="checkbox" id="square-checkbox-2" checked>
                  <label for="square-checkbox-2">Economy</label>
                </div>
                
              </div>
</li>

			  
<li><h5 class="booking-filters-title">No of Days</h5>
<div class="list skin-square">
                <div>
                  <input tabindex="9" type="checkbox" id="square-checkbox-1">
                  <label for="square-checkbox-1">0 to 7 days</label>
                </div>
                <div>
                  <input tabindex="10" type="checkbox" id="square-checkbox-2" checked>
                  <label for="square-checkbox-2">8 to 15 days</label>
                </div>
				<div>
                  <input tabindex="10" type="checkbox" id="square-checkbox-2" checked>
                  <label for="square-checkbox-2">16 to 21 days</label>
                </div>
				<div>
                  <input tabindex="10" type="checkbox" id="square-checkbox-2" checked>
                  <label for="square-checkbox-2">22 to 28 days</label>
                </div>
				<div>
                  <input tabindex="10" type="checkbox" id="square-checkbox-2" checked>
                  <label for="square-checkbox-2">29 to 35 days</label>
                </div>
				<div>
                  <input tabindex="10" type="checkbox" id="square-checkbox-2" checked>
                  <label for="square-checkbox-2">36 Plus days</label>
                </div>
                
              </div>
</li>

</aside>
</div>
<div class="col-md-9">

<div class="clearfix"></div>

<ul class="booking-list">
<span class="ajaxData">
<li>
	<a target="_blank" class="booking-item" href="#">
		<div class="row">
      @if(isset($packageList))
      @foreach ($packageList as $package)
			<div class="col-md-4">

				<div class="booking-item-img-wrap">
          <img src="{{ asset('public/packages_images/') }}{!! '/'.$package['package_image'] !!}" class="img-responsive" title="{!! ucwords(strtolower($package['package_name'])) !!}" alt="{!! ucwords(strtolower($package['package_name'])) !!}" id="packageimage_{!! $package['package_id'] !!}" style="display: inline" />

				</div>
				<div class="caption_list">
					<ul>
						<li> <span class="tooltip-s" original-title="Visa Processing Included">
                                            <img src="https://www.bookmyumrah.pk/addons/shared_addons/themes/bmu/img/visa.png">
                                            </span>
							<span class="tick_mark"><i class="fa fa-check-circle-o"></i></span>
						</li>
						<li> <span class="tooltip-s" original-title="Transportation Charges Included">
                                            <img src="https://www.bookmyumrah.pk/addons/shared_addons/themes/bmu/img/transport.png">
                                            </span>
							<span class="tick_mark"><i class="fa fa-check-circle-o"></i></span>
						</li>
						<li> <span class="tooltip-s" original-title="Air Ticket not Included">
                                            <img src="https://www.bookmyumrah.pk/addons/shared_addons/themes/bmu/img/ticket.png">
                                            </span>
							<span class="tick_mark_cross"><i class="fa fa-times-circle-o" style="color:red;"></i></span>
						</li>
						<li> <span class="tooltip-s" original-title="Ziyarat not Included">
                                            <img src="https://www.bookmyumrah.pk/addons/shared_addons/themes/bmu/img/ziarat.png">
                                            </span>
							<span class="tick_mark_cross"><i class="fa fa-times-circle-o" style="color:red;"></i></span>
						</li>
					</ul>
				</div>
			</div>
			<div class="col-md-8">
				<div class="booking-item-rating">
					<h3>

										   <span title="" class="tooltip-s" original-title="<?php echo $package['package_name']; ?> (Special Offer)- 5 Days">

										   	<h2 id="packagename_{!! $package['package_id'] !!}">{!! ucwords(strtolower($package['package_name'])) !!}</h2>
                                           </span>
                                            - <span style=" color:#ED8323;">(5 Star)</span></h3>
					<h4>

                                           	<img src="https://www.bookmyumrah.pk/addons/shared_addons/themes/bmu/img/company_name.png">

                                            Falcon Express Travels &amp; Tours Pvt Ltd
                                           </h4>
					<div class="col-md-12" style="padding:0">
						<div class="clearfix"></div>
            
            <div class="col-md-8 budget">
              @foreach ($package['photels'] as $photel)
              <span>{!! ucwords(strtolower($photel->ph_name)) !!}</span> - 
              @endforeach
            </div>
            
						<div class="col-md-4 budget">
							<h5>Budget in PKR</h5>
							<span>65,000</span> - <span>65,000</span>
						</div>
						<div class="col-md-8 best_btn" style="margin-top:18px">
							<ul>
								<li>Promotion Packages <i class="fa fa-check"></i>
								</li>
							</ul>
						</div>
						<div class="clearfix"></div>
						<div id="compare_btn" class="col-md-4">
							<button type="button" onclick="compare_package('5704')" id="5704" class="compare btn btn-primary btn-md">Add to Compare</button>
						</div>
					</div>
				</div>
			</div>
      @endforeach
			<div class="clearfix"></div>
       @endif
      
		</div>
	</a>
</li>
</span>
</ul>
</div>
</div>
</div>
</section>

@endsection