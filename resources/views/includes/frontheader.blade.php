<header id="main_header">
  <div class="top_strip">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 text-right">
          <ul class="main_ul">
            <li>
              <select id="mounth">
                <option value="">Country</option>
                <option value="">Saudi Arabia</option>
                <option value="">India</option>
              </select>
            </li>
            <li>
              <select id="mounth">
                <option value="">Currency</option>
                <option value="">USD</option>
                <option value="">INR</option>
              </select>
            </li>
            <li>
              <select id="mounth">
                <option value="">Language</option>
                <option value="">English</option>
              </select>
            </li>
          </ul>
          <p><a href="{{ url('/login') }}"><img src="{{ asset('public/images/lock-icon.png') }}"/> LOGIN/REGISTER</a></p>          
        </div>
      </div>
    </div>
  </div>
  <div class="header_manu">
    <div class="container">
      <div class="row center-align">
        <nav class="navbar navbar-light navbar-expand-lg ">
          <div class="logo"><a href="{{ url('/') }}"><img src="{{ asset('public/images/logo.png') }}" /></a></div>
          <button class="navbar-toggler bg-light" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item active"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
              <li class="nav-item"><a class="nav-link" href="{{ url('/about-us') }} ">About</a></li>
              <li class="nav-item"><a class="nav-link" href="#">Products</a></li>
              <li class="nav-item"><a class="nav-link" href="#">The Scoop</a></li>
              <li class="nav-item"><a class="nav-link" href="#">Departments</a></li>
              <li class="nav-item"><a class="nav-link" href="#">Contact Us</a></li>
            </ul>
          </div>
          <div class="text-right"> <a href="#" class="agency-console"><img src="{{ asset('public/images/agency-console.png') }}">&nbsp; Agency console</a> </div>
        </nav>
      </div>
    </div>
  </div>
</header>