<div class="col-md-2">
  <div class="row">Dashboard</div>
</div>
<div class="col-md-10">
  <div class="row">
    <ul class="nav navbar-nav navbar-right">
      
      <li><a href="{{ url('/mybooking') }}" > My bookings</a></li>
      @if((Auth::user()->trip_agent==1) || (Auth::user()->ticketit_admin==1))
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
      <li><a href="{{ url('/tickets') }}">Tickets</a></li>
      <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" > {{ Auth::user()->name }} <span class="caret"></span> </a>
        <ul class="dropdown-menu" role="menu">
          @if(Auth::user()->ticketit_admin==1)
          <li><a href="{{ url('/admins') }}"> Admins</a>
          <li><a href="{{ url('/users') }}"> Users</a>
          <li><a href="{{ url('/agents') }}"> Agents</a>          
          <li><a href="{{ url('/bookings') }}"> Bookings</a>
          <li><a href="{{ url('/coupons') }}"> Coupons</a>
          <li><a href="{{ url('/alltours') }}"> Tours</a>            
          <li><a href="{{ url('/allhotels') }}"> Hotels</a>
          <li><a href="{{ url('/allactivities') }}"> Activties</a> 
          
          @endif
          <li><a href="{{ url('/user-profile') }}" > My Profile</a></li>
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
</div>
