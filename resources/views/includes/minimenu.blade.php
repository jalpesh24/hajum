   <div class="row" >
     <ul class="nav navbar-nav sf-menu clearfix sf-js-enabled">
			
	@if((Auth::user()->ticketit_admin==0 AND Auth::user()->ticketit_agent==0 and Auth::user()->trip_agent==0))
		<li><a href="{{ url('/mybooking') }}" > My bookings</a></li>
	@endif
	  @if((Auth::user()->ticketit_admin==1))
		<!-- <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" >Category <span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
          <li><a href="{{ url('/allcategory') }}">Category Listing</a> </li>
          <li><a href="{{ url('/addcategory') }}">Add Category</a></li>
        </ul>
      </li> -->
      <li class="dropdown"> <a href="{{ url('/hotels-list') }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" >Hotels <span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
          <li><a href="{{ url('/hotels-list') }}">Hotel Listing</a> </li>
          <li><a href="{{ url('/hotel-add') }}">Add Hotel</a></li>
        </ul>
      </li>
      <li class="dropdown"> <a href="{{ url('/tours-list') }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" >Tours <span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
          <li><a href="{{ url('/tours-list') }}">Tour Listing</a> </li>
          <li><a href="{{ url('/addtour') }}">Add Tour</a></li>
        </ul>
      </li>
      <li class="dropdown"> <a href="{{ url('/activity-list') }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" >Activities <span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
          <li><a href="{{ url('/activity-list') }}">Activity Listing</a> </li>
          <li><a href="{{ url('/activity-add') }}">Add Activity</a></li>
        </ul>
      </li>
      @endif
	  @if((Auth::user()->ticketit_agent==1))
	  <li><a href="{{ url('/mybooking') }}" > My bookings</a></li>
	  @endif
      @if((Auth::user()->trip_agent==1))
	  <li><a href="{{ url('/mybooking') }}" > My bookings</a></li>
      <li class="dropdown"> <a href="{{ url('/hotels-list') }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" >Hotels <span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
          <li><a href="{{ url('/hotels-list') }}">Hotel Listing</a> </li>
          <li><a href="{{ url('/hotel-add') }}">Add Hotel</a></li>
		  <li><a href="{{ url('/hotelaminities') }}">Add Hotel Aminities</a></li>
		  <li><a href="{{ url('/hoteltype') }}">Add Hotel Type</a></li>
        </ul>
      </li>
      <li class="dropdown"> <a href="{{ url('/tours-list') }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" >Tours <span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
          <li><a href="{{ url('/tours-list') }}">Tour Listing</a> </li>
          <li><a href="{{ url('/addtour') }}">Add Tour</a></li>
		   <li><a href="{{ url('/tourbooked') }}">Tour Booked</a> </li>
        </ul>
      </li>
      <li class="dropdown"> <a href="{{ url('/activity-list') }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" >Activities <span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
          <li><a href="{{ url('/activity-list') }}">Activity Listing</a> </li>
          <li><a href="{{ url('/activity-add') }}">Add Activity</a></li>
        </ul>
      </li>
      @endif
	 
      <li><a href="{{ url('/tickets') }}">Tickets</a></li>
	      @if(Auth::user()->hotel_agent==1)
			  <li class="dropdown"> <a href="{{ url('/hotels-list') }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" >Hotels <span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
          <li><a href="{{ url('/hotels-list') }}">Hotel Listing</a> </li>
          <li><a href="{{ url('/hotel-add') }}">Add Hotel</a></li>
        </ul>
      </li>
	  @endif

      <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" > {{ Auth::user()->name }} <span class="caret"></span> </a>
        <ul class="dropdown-menu" role="menu">
          @if(Auth::user()->ticketit_admin==1)
          <li><a href="{{ url('/admins') }}"> Admins</a>
          <li><a href="{{ url('/users') }}"> Users</a>
          <li><a href="{{ url('/agents') }}"> Operator Agent</a> 
		      <!-- <li><a href="{{ url('/travelar') }}"> Travelar Agent </a> 		  	   -->
          <!-- <li><a href="{{ url('/bookings') }}"> Bookings</a>
          <li><a href="{{ url('/coupons') }}"> Coupons</a>
           --><li><a href="{{ url('/alltours') }}"> Tours</a>            
          <li><a href="{{ url('/allhotels') }}"> Hotels</a>
          <li><a href="{{ url('/allactivities') }}"> Activties</a> 
          
          @endif
		  @if((Auth::user()->ticketit_agent==1))
			<li><a href="{{ url('/agentuser-profile') }}" > My Profile</a></li>
		@else
          <li><a href="{{ url('/user-profile') }}" > My Profile</a></li>
		  @endif
          <li><a href="{{ url('/mytestimonials') }}" > My Testimonials</a></li>
          <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" > Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
            </form>
          </li>
        </ul>
      </li>
    </ul>
	</div>
 
