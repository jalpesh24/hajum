<!DOCTYPE html>
<html class="csstransforms csstransforms3d csstransitions" lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>Hajum</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Your description">
<meta name="keywords" content="Your keywords">
<meta name="author" content="Your name">

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
<link href="{{ url('newhtml/css/bootstrap.css') }}" rel="stylesheet">
<link href="{{ url('newhtml/css/jquery-ui.css') }}" rel="stylesheet">
<link href="{{ url('newhtml/css/font-awesome.min.css') }}" rel="stylesheet">
<!-- <link href="{{ url('newhtml/css/camera.css') }}" rel="stylesheet"> -->
<!-- <link href="{{ url('newhtml/css/prettyPhoto.css') }}" rel="stylesheet"> -->
<!-- <link href="{{ url('newhtml/css/isotope.css') }}" rel="stylesheet"> -->
<!-- <link href="{{ url('newhtml/css/animate.css') }}" rel="stylesheet"> -->
<link href="{{ url('newhtml/css/select2.css') }}" rel="stylesheet">
<link href="{{ url('newhtml/css/jquery-ui-1.css') }}" rel="stylesheet">
<link href="{{ url('newhtml/css/style.css') }}" rel="stylesheet">
<link href="{{ url('newhtml/css/css.css') }}" rel="stylesheet">
<script type="text/javascript" src="{{ url('newhtml/js/jquery.js') }}"></script>
<style type="text/css">
  .gm-style {font: 400 11px Roboto, Arial, sans-serif; text-decoration: none; }
  .gm-style img { max-width: none; }
  .gm-style .gm-style-mtc label,.gm-style .gm-style-mtc div{font-weight:400}
  .gm-style .gm-style-cc span,.gm-style .gm-style-cc a,.gm-style .gm-style-mtc div{font-size:10px}
  @media  print {  .gm-style .gmnoprint, .gmnoprint {    display:none  }}
  @media  screen {  .gm-style .gmnoscreen, .gmnoscreen { display:none  }}
  .gm-style-pbc{transition:opacity ease-in-out;background-color:rgba(0,0,0,0.45);text-align:center}.gm-style-pbt{font-size:22px;color:white;font-family:Roboto,Arial,sans-serif;position:relative;margin:0;top:50%;-webkit-transform:translateY(-50%);-ms-transform:translateY(-50%);transform:translateY(-50%)}
</style>
</head>
<body class="onepage front" data-spy="scroll" data-target="#top1" data-offset="202">
  <div id="main">
    <div id="top1">
      <div id="top2-sticky-wrapper" class="sticky-wrapper" style="height: 100px;"><div class="top2_wrapper" id="top2">
        <div class="container">
          <div class="top2 clearfix">  
            <header>
              <div class="logo_wrapper margtop">
                <a href="{{ url('http://tripindia.online') }}" class="logo scroll-to">	
                  <img src="{{ url('newhtml/images/logo.png') }}" alt="" class="img-responsive">
                </a>
              </div>
            </header>
            <div class="navbar navbar_ navbar-default">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <div class="navbar-collapse navbar-collapse_ collapse">
                 <ul class="nav navbar-nav sf-menu clearfix sf-js-enabled">
      <li class=""><a href="{{ url('http://tripindia.online') }}">Home</a></li>
      <li class=""><a href="#services">services</a></li>
      <li class=""><a href="#partners">partners</a></li>
      <li class="sub-menu sub-menu-1"><a href="#">pages<em class="fa fa-angle-down"></em></a>
        <ul style="display: none;">
           <li><a href="{{ url('/newabout') }}">About Us</a></li>
		   <li><a href="{{ url('/newoffers') }}">Offers</a></li>
		   <li><a href="{{ url('/newtestimonial') }}">newtestimonial</a></li>
		    <li><a href="{{ url('/newquality') }}">Quality</a></li>
			<li><a href="{{ url('/newreview') }}">Review</a></li>
			<li><a href="{{ url('/newcontact') }}">contact</a></li>
        </ul>
      </li>
      <li><a href="{{ url('/newcontact') }}">contact</a></li>
	  @if(Auth::user())
		  <li><a href="{{ url('/dashboard') }}">dashboard</a> </li>
	  @else
	  <li><a href="{{ url('/login') }}">Login</a> </li>
	  @endif
    </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div id="home">
    <div id="slider_wrapper">
      <div id="slider_inner" class="clearfix">
        <div id="slider" class="clearfix">
          <div id="banner" class="banner" style="display: block; margin-bottom: 0px;">
	          <div id="myCarousel" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
              </ol>
              <div class="carousel-inner">
                <div class="item active">
                  <img src="{{ url('newhtml/images/slide04.jpg') }}" alt="Los Angeles" style="width:100%;">
                </div>
                <div class="item">
                  <img src="{{ url('newhtml/images/slide08.jpg') }}" alt="Chicago" style="width:100%;">
                </div>
                <div class="item">
                  <img src="{{ url('newhtml/images/slide09.jpg') }}" alt="New york" style="width:100%;">
                </div>
              </div>
	            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <i class="fa fa-chevron-left"></i>
              </a>
              <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <i class="fa fa-chevron-right"></i>
              </a>
            </div>
          </div>
	      </div>
	    </div>
	  </div>
	</div>	  
  <div class="slider_tabs">
    <div class="tabs1 ui-tabs ui-widget ui-widget-content ui-corner-all">
      <div class="tabs1_tabs">
        <div class="container">
          <ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all" role="tablist">
            <li class="ui-state-default ui-corner-top ui-tabs-active ui-state-active" role="tab" tabindex="0" aria-controls="tabs-5" aria-labelledby="ui-id-1" aria-selected="true" aria-expanded="true"><a href="#tabs-5" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-1">Tours</a></li>
            <li class="ui-state-default ui-corner-top" role="tab" tabindex="-1" aria-controls="tabs-1" aria-labelledby="ui-id-2" aria-selected="false" aria-expanded="false"><a href="#tabs-1" class="ui-tabs-anchor" role="presentation" tabindex="-1" id="ui-id-2">hotels</a></li>
          </ul>
        </div>
      </div>
      <div class="tabs1_content">
        <div class="container">
          <div id="tabs-1" aria-labelledby="ui-id-2" class="ui-tabs-panel ui-widget-content ui-corner-bottom" role="tabpanel" style="display: none;" aria-hidden="true">
             <form action="{{ url('/searchhotels') }}" class="form1" role="form" method="post" name="frm_hotels">
			{{ csrf_field() }}			
              <div class="row">
                <div class="col-sm-4 col-md-2">
                  <div class="select1_wrapper">
                    <label>City or Hotel Name</label>
                    <div class="select1_inner">
                      <input type="text" name="hotel_name_location" id="hotel_name_location" class="form-control" placeholder="Select City, Location or Hotel Name (Worldwide)" required="required" style="width:100%;" />                      
                    </div>
                  </div>
                </div>
                <div class="col-sm-4 col-md-2">
                  <div class="input1_wrapper">
                    <label>Check-In</label>
                    <div class="input1_inner">
					 <input type="text" name="checkin" id="fromdate" class="form-control datepicker" placeholder="Check-in" />
                     
                    </div>
                  </div>
                </div>
                <div class="col-sm-4 col-md-2">
                  <div class="input1_wrapper">
                    <label>Check-Out</label>
                    <div class="input1_inner">
					<input type="text" name="checkout" id="todate" class="form-control datepicker" placeholder="Check-out" />
                      
                    </div>
                  </div>
                </div>
                <div class="col-sm-4 col-md-2">
                  <div class="select1_wrapper">
                    <label>Adults</label>
                    <div class="select1_inner">
                      <input type="number" name="adults" class="input datepicker hasDatepicker" min="1" max="10" placeholder="1 Adult" style="width:100%;" />
					  </div>
                  </div>
                </div>
				
				<div class="col-sm-4 col-md-2">
                  <div class="select1_wrapper">
                    <label>Child</label>
                    <div class="select1_inner">
                      <input type="number" name="Child" class="input datepicker hasDatepicker"  min="0" max="5" placeholder="0 Child" style="width:100%;"  />
					  </div>
                  </div>
                </div>
				
				
                <div class="col-sm-4 col-md-2">
                  <div class="button1_wrapper">
                    <button type="submit" class="btn-default btn-form1-submit" ><i class="fa fa-search" ></i>search now</button>
                  </div>
                </div>
              </div>
            </form>
          </div>

            <div id="tabs-5" aria-labelledby="ui-id-1" class="ui-tabs-panel ui-widget-content ui-corner-bottom" role="tabpanel" aria-hidden="false" >
           <form action="{{ url('/newsearchtours') }}" class="form1" role="form" method="post" name="frm_tours">
             {{ csrf_field() }}             
			 <div class="row">        
                <div class="col-sm-4 col-md-2 col-md-offset-3">
                  <div class="select1_wrapper">
                    <label>Going To</label>
                    <div class="select1_inner">
					 <input class="form-control input-sm" type="text" placeholder="Going to" name="name_location" id="txt_tours_name_location" required="required">                     	
					 </div>
                  </div>
                </div>
                <div class="col-sm-4 col-md-2">
                  <div class="input1_wrapper">
                    <label>Month of Travel</label>
                    <div class="input1_inner">
                      <select class="select2 select select3 select2-hidden-accessible" style="width: 100%" tabindex="-1" aria-hidden="true"  name="tours_month" id="tours_month">
					<option value="" selected="selected">Month of Travel (Any)</option>
						<option value="2018-02">Feb-2018</option><option value="2018-03">Mar-2018</option><option value="2018-04">Apr-2018</option><option value="2018-05">May-2018</option><option value="2018-06">Jun-2018</option><option value="2018-07">Jul-2018</option><option value="2018-08">Aug-2018</option><option value="2018-09">Sep-2018</option><option value="2018-10">Oct-2018</option><option value="2018-11">Nov-2018</option><option value="2018-12">Dec-2018</option><option value="2019-01">Jan-2019</option><option value="2019-02">Feb-2019</option>            </select>
                    </div>
                  </div>
                </div>                
               
				
                <div class="col-sm-3 col-md-2">
                  <div class="button1_wrapper">				
                    <button type="submit" class="btn-default btn-form1-submit" name="btn_tours_search" id="btn_tours_search"><i class="fa fa-search"></i>search now</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="services">
  <div class="container">
      <div class="title1">why we are the best</div>
      <div class="title2">Lorem ipsum dolor sit amet, la france dio perpendum mobile, lacrimosa non troppo<br>vitae el mundo, abricoso trkae mundo la vita nova.</div>
      <br>
      <div class="row">
        <div class="col-sm-3">
          <div class="services1">
            <figure>
              <img src="{{ url('newhtml/images/services5.png') }}" alt="" class="img-responsive">
            </figure>
            <div class="caption">
              <div class="txt1">happy customers</div>
              <div class="txt2">Concateur a bravo durso, sit amet lacrimosa perpentum mobile la franco duro, saturno prio de la cruse.</div>
              <div class="txt3"><a href="#" class="btn-default btn0">view more</a></div>
            </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="services1">
            <figure>
              <img src="{{ url('newhtml/images/services6.png') }}" alt="" class="img-responsive">
            </figure>
            <div class="caption">
              <div class="txt1">our amazing tours</div>
              <div class="txt2">Concateur a bravo durso, sit amet lacrimosa perpentum mobile la franco duro, saturno prio de la cruse.</div>
              <div class="txt3"><a href="#" class="btn-default btn0">view more</a></div>
            </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="services1">
            <figure>
              <img src="{{ url('newhtml/images/services7.png') }}" alt="" class="img-responsive">
            </figure>
            <div class="caption">
              <div class="txt1">support cases</div>
              <div class="txt2">Concateur a bravo durso, sit amet lacrimosa perpentum mobile la franco duro, saturno prio de la cruse.</div>
              <div class="txt3"><a href="#" class="btn-default btn0">view more</a></div>
            </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="services1">
            <figure>
              <img src="{{ url('newhtml/images/services8.png') }}" alt="" class="img-responsive">
            </figure>
            <div class="caption">
              <div class="txt1">our cruises</div>
              <div class="txt2">Concateur a bravo durso, sit amet lacrimosa perpentum mobile la franco duro, saturno prio de la cruse.</div>
              <div class="txt3"><a href="#" class="btn-default btn0">view more</a></div>
            </div>
          </div>
        </div>
      </div>
   </div>
</div>

<div id="tours">
  <div class="clearfix">
    <div class="tour1 clearfix">
      <a href="#" class="clearfix">
        <figure>
          <img src="{{ url('newhtml/images/tour01.jpg') }}" alt="" class="img-responsive">
        </figure>
        <div class="caption">
          <div class="txt1">family tour in greece</div>
          <div class="txt2">
            <div class="stars1">
              <img src="{{ url('newhtml/images/star1.png') }}" alt="">
              <img src="{{ url('newhtml/images/star1.png') }}" alt="">
              <img src="{{ url('newhtml/images/star1.png') }}" alt="">
              <img src="{{ url('newhtml/images/star1.png') }}" alt="">
              <img src="{{ url('newhtml/images/star1.png') }}" alt="">
            </div>
            <div class="rev-num">325 Reviews</div>
          </div>
          <div class="txt3">$578</div>
        </div>
      </a>
    </div>
    <div class="tour1 clearfix">
      <a href="#" class="clearfix">
        <figure>
          <img src="{{ url('newhtml/images/tour02.jpg') }}" alt="" class="img-responsive">
        </figure>
        <div class="caption">
          <div class="txt1">family tour in greece</div>
          <div class="txt2">
            <div class="stars1">
              <img src="{{ url('newhtml/images/star1.png') }}" alt="">
              <img src="{{ url('newhtml/images/star1.png') }}" alt="">
              <img src="{{ url('newhtml/images/star1.png') }}" alt="">
              <img src="{{ url('newhtml/images/star1.png') }}" alt="">
              <img src="{{ url('newhtml/images/star1.png') }}" alt="">
            </div>
            <div class="rev-num">325 Reviews</div>
          </div>
          <div class="txt3">$578</div>
        </div>
      </a>
    </div>
    <div class="tour1 clearfix">
      <a href="#" class="clearfix">
        <figure>
          <img src="{{ url('newhtml/images/tour03.jpg') }}" alt="" class="img-responsive">
        </figure>
        <div class="caption">
          <div class="txt1">family tour in greece</div>
          <div class="txt2">
            <div class="stars1">
              <img src="{{ url('newhtml/images/star1.png') }}" alt="">
              <img src="{{ url('newhtml/images/star1.png') }}" alt="">
              <img src="{{ url('newhtml/images/star1.png') }}" alt="">
              <img src="{{ url('newhtml/images/star1.png') }}" alt="">
              <img src="{{ url('newhtml/images/star1.png') }}" alt="">
            </div>
            <div class="rev-num">325 Reviews</div>
          </div>
          <div class="txt3">$578</div>
        </div>
      </a>
    </div>
    <div class="tour1 clearfix">
      <a href="#" class="clearfix">
        <figure>
          <img src="{{ url('newhtml/images/tour04.jpg') }}" alt="" class="img-responsive">
        </figure>
        <div class="caption">
          <div class="txt1">family tour in greece</div>
          <div class="txt2">
            <div class="stars1">
              <img src="{{ url('newhtml/images/star1.png') }}" alt="">
              <img src="{{ url('newhtml/images/star1.png') }}" alt="">
              <img src="{{ url('newhtml/images/star1.png') }}" alt="">
              <img src="{{ url('newhtml/images/star1.png') }}" alt="">
              <img src="{{ url('newhtml/images/star1.png') }}" alt="">
            </div>
            <div class="rev-num">325 Reviews</div>
          </div>
          <div class="txt3">$578</div>
        </div>
      </a>
    </div>
    <div class="tour1 clearfix">
      <a href="#" class="clearfix">
        <figure>
          <img src="{{ url('newhtml/images/tour05.jpg') }}" alt="" class="img-responsive">
        </figure>
        <div class="caption">
          <div class="txt1">family tour in greece</div>
          <div class="txt2">
            <div class="stars1">
              <img src="{{ url('newhtml/images/star1.png') }}" alt="">
              <img src="{{ url('newhtml/images/star1.png') }}" alt="">
              <img src="{{ url('newhtml/images/star1.png') }}" alt="">
              <img src="{{ url('newhtml/images/star1.png') }}" alt="">
              <img src="{{ url('newhtml/images/star1.png') }}" alt="">
            </div>
            <div class="rev-num">325 Reviews</div>
          </div>
          <div class="txt3">$578</div>
        </div>
      </a>
    </div>
    <div class="tour1 clearfix">
      <a href="#" class="clearfix">
        <figure>
          <img src="{{ url('newhtml/images/tour06.jpg') }}" alt="" class="img-responsive">
        </figure>
        <div class="caption">
          <div class="txt1">family tour in greece</div>
          <div class="txt2">
            <div class="stars1">
              <img src="{{ url('newhtml/images/star1.png') }}" alt="">
              <img src="{{ url('newhtml/images/star1.png') }}" alt="">
              <img src="{{ url('newhtml/images/star1.png') }}" alt="">
              <img src="{{ url('newhtml/images/star1.png') }}" alt="">
              <img src="{{ url('newhtml/images/star1.png') }}" alt="">
            </div>
            <div class="rev-num">325 Reviews</div>
          </div>
          <div class="txt3">$578</div>
        </div>
      </a>
    </div>
    <div class="tour1 clearfix">
      <a href="#" class="clearfix">
        <figure>
          <img src="{{ url('newhtml/images/tour07.jpg') }}" alt="" class="img-responsive">
        </figure>
        <div class="caption">
          <div class="txt1">family tour in greece</div>
          <div class="txt2">
            <div class="stars1">
              <img src="{{ url('newhtml/images/star1.png') }}" alt="">
              <img src="{{ url('newhtml/images/star1.png') }}" alt="">
              <img src="{{ url('newhtml/images/star1.png') }}" alt="">
              <img src="{{ url('newhtml/images/star1.png') }}" alt="">
              <img src="{{ url('newhtml/images/star1.png') }}" alt="">
            </div>
            <div class="rev-num">325 Reviews</div>
          </div>
          <div class="txt3">$578</div>
        </div>
      </a>
    </div>
    <div class="tour1 clearfix">
      <a href="#" class="clearfix">
        <figure>
          <img src="{{ url('newhtml/images/tour08.jpg') }}" alt="" class="img-responsive">
        </figure>
        <div class="caption">
          <div class="txt1">family tour in greece</div>
          <div class="txt2">
            <div class="stars1">
              <img src="{{ url('newhtml/images/star1.png') }}" alt="">
              <img src="{{ url('newhtml/images/star1.png') }}" alt="">
              <img src="{{ url('newhtml/images/star1.png') }}" alt="">
              <img src="{{ url('newhtml/images/star1.png') }}" alt="">
              <img src="{{ url('newhtml/images/star1.png') }}" alt="">
            </div>
            <div class="rev-num">325 Reviews</div>
          </div>
          <div class="txt3">$578</div>
        </div>
      </a>
    </div>
  </div>
</div>

<div id="partners">
  <div class="container">
    <div class="title1">Our partners &amp; Investors</div>
    <div class="title2">Lorem ipsum dolor sit amet, la france dio perpendum mobile, lacrimosa non troppo<br>vitae el mundo, abricoso trkae mundo la vita nova.</div>
    <div class="row">
      <div class="col-sm-2">
        <div class="partner1">
          <a href="#" class="clearfix">
            <figure>
              <img src="{{ url('newhtml/images/partner1.jpg') }}" alt="" class="img-responsive">
              <img src="{{ url('newhtml/images/partner1_hover.jpg') }}" alt="" class="img-responsive hover">
            </figure>
          </a>
        </div>
      </div>
      <div class="col-sm-2">
        <div class="partner1">
          <a href="#" class="clearfix">
            <figure>
              <img src="{{ url('newhtml/images/partner2.jpg') }}" alt="" class="img-responsive">
              <img src="{{ url('newhtml/images/partner2_hover.jpg') }}" alt="" class="img-responsive hover">
            </figure>
          </a>
        </div>
      </div>
      <div class="col-sm-2">
        <div class="partner1">
          <a href="#" class="clearfix">
            <figure>
              <img src="{{ url('newhtml/images/partner3.jpg') }}" alt="" class="img-responsive">
              <img src="{{ url('newhtml/images/partner3_hover.jpg') }}" alt="" class="img-responsive hover">
            </figure>
          </a>
        </div>
      </div>
      <div class="col-sm-2">
        <div class="partner1">
          <a href="#" class="clearfix">
            <figure>
              <img src="{{ url('newhtml/images/partner4.jpg') }}" alt="" class="img-responsive">
              <img src="{{ url('newhtml/images/partner4_hover.jpg') }}" alt="" class="img-responsive hover">
            </figure>
          </a>
        </div>
      </div>
      <div class="col-sm-2">
        <div class="partner1">
          <a href="#" class="clearfix">
            <figure>
              <img src="{{ url('newhtml/images/partner5.jpg') }}" alt="" class="img-responsive">
              <img src="{{ url('newhtml/images/partner5_hover.jpg') }}" alt="" class="img-responsive hover">
            </figure>
          </a>
        </div>
      </div>
      <div class="col-sm-2">
        <div class="partner1">
          <a href="#" class="clearfix">
            <figure>
              <img src="{{ url('newhtml/images/partner6.jpg') }}" alt="" class="img-responsive">
              <img src="{{ url('newhtml/images/partner6_hover.jpg') }}" alt="" class="img-responsive hover">
            </figure>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="parallax1" class="parallax">
  <div class="bg1 parallax-bg bg-fixed" style="background-position: 50% -139px;"></div>
    <div class="overlay"></div>
    <div class="parallax-content">
      <div class="container">
        <div id="hot_wrapper">
          <div id="hot_inner">
            <div id="hot">
                <a class="hot_prev" href="#" style="display: block;"><span></span></a>
                <a class="hot_next" href="#" style="display: block;"><span></span></a>
                <div class="">
                  <div class="carousel-box">
                    <div class="inner">
                      <div class="carousel main">
                        <div class="caroufredsel_wrapper">
                          <ul>
                            <li style="width: 1170px;">
                            <div class="hot">
                              <div class="hot_inner">
    						  <a href="newtourdetail/429.html" class="clearfix">
                                <div class="txt1">abu tour</div></a>
                                <div class="txt2">from $20000</div>
                                <div class="txt3">( mount abu )</div>
                                <div class="txt4">
                                  <div class="stars2">
                                     <img src="{{ url('newhtml/images/star1.png') }}" alt="">
    								<img src="{{ url('newhtml/images/star1.png') }}" alt="">
    								<img src="{{ url('newhtml/images/star1.png') }}" alt="">
    								<img src="{{ url('newhtml/images/star1.png') }}" alt="">
    								<img src="{{ url('newhtml/images/star1.png') }}" alt="">
                                  </div>
                                </div>
    							
                                <div class="txt5"> <strong>( Jan 31 2018  To Feb 05 2018)</strong>  </div>
                              </div>
                            </div>
                          </li>
    					  						<li style="width: 1170px;">
                            <div class="hot">
                              <div class="hot_inner">
    						  <a href="newtourdetail/426.html" class="clearfix">
                                <div class="txt1">abcd</div></a>
                                <div class="txt2">from $4000</div>
                                <div class="txt3">( test )</div>
                                <div class="txt4">
                                  <div class="stars2">
                                     <img src="{{ url('newhtml/images/star1.png') }}" alt="">
    								<img src="{{ url('newhtml/images/star1.png') }}" alt="">
    								<img src="{{ url('newhtml/images/star1.png') }}" alt="">
    								<img src="{{ url('newhtml/images/star1.png') }}" alt="">
    								<img src="{{ url('newhtml/images/star1.png') }}" alt="">
                                  </div>
                                </div>
    							
                                <div class="txt5"> <strong>( Jan 25 2018  To Jan 26 2018)</strong>  </div>
                              </div>
                            </div>
                          </li>
    					  						<li style="width: 1170px;">
                            <div class="hot">
                              <div class="hot_inner">
    						  <a href="newtourdetail/415.html" class="clearfix">
                                <div class="txt1">test22</div></a>
                                <div class="txt2">from $5000</div>
                                <div class="txt3">(  )</div>
                                <div class="txt4">
                                  <div class="stars2">
                                     <img src="{{ url('newhtml/images/star1.png') }}" alt="">
    								<img src="{{ url('newhtml/images/star1.png') }}" alt="">
    								<img src="{{ url('newhtml/images/star1.png') }}" alt="">
    								<img src="{{ url('newhtml/images/star1.png') }}" alt="">
    								<img src="{{ url('newhtml/images/star1.png') }}" alt="">
                                  </div>
                                </div>
    							
                                <div class="txt5"> <strong>( Jan 23 2018  To Jan 26 2018)</strong>  </div>
                              </div>
                            </div>
                          </li>
    					  						<li style="width: 1170px;">
                            <div class="hot">
                              <div class="hot_inner">
    						  <a href="newtourdetail/412.html" class="clearfix">
                                <div class="txt1">new goa tour</div></a>
                                <div class="txt2">from $5000</div>
                                <div class="txt3">( banglore to goa )</div>
                                <div class="txt4">
                                  <div class="stars2">
                                     <img src="{{ url('newhtml/images/star1.png') }}" alt="">
    								<img src="{{ url('newhtml/images/star1.png') }}" alt="">
    								<img src="{{ url('newhtml/images/star1.png') }}" alt="">
    								<img src="{{ url('newhtml/images/star1.png') }}" alt="">
    								<img src="{{ url('newhtml/images/star1.png') }}" alt="">
                                  </div>
                                </div>
    							
                                <div class="txt5"> <strong>( Jan 25 2018  To Jan 31 2018)</strong>  </div>
                              </div>
                            </div>
                          </li>
    					  						<li style="width: 1170px;">
                            <div class="hot">
                              <div class="hot_inner">
    						  <a href="newtourdetail/405.html" class="clearfix">
                                <div class="txt1">Tribes and Temples Cent India 11 Days</div></a>
                                <div class="txt2">from $20000</div>
                                <div class="txt3">( Delhi - Madhya Pradesh - Chhattisgarh )</div>
                                <div class="txt4">
                                  <div class="stars2">
                                     <img src="{{ url('newhtml/images/star1.png') }}" alt="">
    								<img src="{{ url('newhtml/images/star1.png') }}" alt="">
    								<img src="{{ url('newhtml/images/star1.png') }}" alt="">
    								<img src="{{ url('newhtml/images/star1.png') }}" alt="">
    								<img src="{{ url('newhtml/images/star1.png') }}" alt="">
                                  </div>
                                </div>
    							
                                <div class="txt5"> <strong>( Jul 11 2017  To Dec 31 2019)</strong>  </div>
                              </div>
                            </div>
                          </li>
    					  						<li style="width: 1170px;">
                            <div class="hot">
                              <div class="hot_inner">
    						  <a href="newtourdetail/404.html" class="clearfix">
                                <div class="txt1">Khajuraho Dance Fest 7 Days</div></a>
                                <div class="txt2">from $15000</div>
                                <div class="txt3">( Delhi - Madhya Pradesh )</div>
                                <div class="txt4">
                                  <div class="stars2">
                                     <img src="{{ url('newhtml/images/star1.png') }}" alt="">
    								<img src="{{ url('newhtml/images/star1.png') }}" alt="">
    								<img src="{{ url('newhtml/images/star1.png') }}" alt="">
    								<img src="{{ url('newhtml/images/star1.png') }}" alt="">
    								<img src="{{ url('newhtml/images/star1.png') }}" alt="">
                                  </div>
                                </div>
    							
                                <div class="txt5"> <strong>( Jul 11 2017  To Dec 31 2019)</strong>  </div>
                              </div>
                            </div>
                          </li>
    					  						<li style="width: 1170px;">
                            <div class="hot">
                              <div class="hot_inner">
    						  <a href="newtourdetail/403.html" class="clearfix">
                                <div class="txt1">Mystical India Tour 17 Days</div></a>
                                <div class="txt2">from $35000</div>
                                <div class="txt3">( Mumbai - Gujarat - Rajasthan - Uttar Pradesh - Delhi )</div>
                                <div class="txt4">
                                  <div class="stars2">
                                     <img src="{{ url('newhtml/images/star1.png') }}" alt="">
    								<img src="{{ url('newhtml/images/star1.png') }}" alt="">
    								<img src="{{ url('newhtml/images/star1.png') }}" alt="">
    								<img src="{{ url('newhtml/images/star1.png') }}" alt="">
    								<img src="{{ url('newhtml/images/star1.png') }}" alt="">
                                  </div>
                                </div>
    							
                                <div class="txt5"> <strong>( Jul 11 2017  To Dec 31 2019)</strong>  </div>
                              </div>
                            </div>
                          </li>
    					  						<li style="width: 1170px;">
                            <div class="hot">
                              <div class="hot_inner">
    						  <a href="newtourdetail/402.html" class="clearfix">
                                <div class="txt1">Best of North India Tour 13 Days</div></a>
                                <div class="txt2">from $30000</div>
                                <div class="txt3">( Delhi - Punjab - Jaipur - Madhya Pradesh )</div>
                                <div class="txt4">
                                  <div class="stars2">
                                     <img src="{{ url('newhtml/images/star1.png') }}" alt="">
    								<img src="{{ url('newhtml/images/star1.png') }}" alt="">
    								<img src="{{ url('newhtml/images/star1.png') }}" alt="">
    								<img src="{{ url('newhtml/images/star1.png') }}" alt="">
    								<img src="{{ url('newhtml/images/star1.png') }}" alt="">
                                  </div>
                                </div>
    							
                                <div class="txt5"> <strong>( Jul 11 2017  To Dec 31 2019)</strong>  </div>
                              </div>
                            </div>
                          </li>
    					  					  </ul></div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

<div id="popular">
  <div class="container">
    <div class="title1">Most Popular Travel Countries</div>
    <div class="title2">Lorem ipsum dolor sit amet, la france dio perpendum mobile, lacrimosa.</div>
    <br><br>
    <div class="row">
      <div class="col-sm-6">
        <div class="row">
          <div class="col-sm-6">
            <div class="city1 clearfix">
              <a href="tour-details-map.html" class="clearfix">
                <figure>
                  <img src="{{ url('newhtml/images/i1.jpg') }}" alt="" class="img-responsive">
                </figure>
                <div class="over"></div>
                <div class="caption">
                  <div class="txt1">rome - 5 days</div>
                  <div class="txt2"><span>from $235</span> per person</div>
                </div>
              </a>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="city1 clearfix">
              <a href="tour-details-map.html" class="clearfix">
                <figure>
                  <img src="{{ url('newhtml/images/i2.jpg') }}" alt="" class="img-responsive">
                </figure>
                <div class="over"></div>
                <div class="caption">
                  <div class="txt1">pisa - 4 days</div>
                  <div class="txt2"><span>from $180</span> per person</div>
                </div>
              </a>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <div class="city1 clearfix">
              <a href="tour-details-map.html" class="clearfix">
                <figure>
                  <img src="{{ url('newhtml/images/i3.jpg') }}" alt="" class="img-responsive">
                </figure>
                <div class="over"></div>
                <div class="caption">
                  <div class="txt1">venice - 3 days</div>
                  <div class="txt2"><span>from $195</span> per person</div>
                </div>
              </a>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="city1 clearfix">
              <a href="tour-details-map.html" class="clearfix">
                <figure>
                  <img src="{{ url('newhtml/images/i4.jpg') }}" alt="" class="img-responsive">
                </figure>
                <div class="over"></div>
                <div class="caption">
                  <div class="txt1">whole italy - 12 days</div>
                  <div class="txt2"><span>from $550</span> per person</div>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="country country1">
          <div class="title3">italy, europe</div>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut 
            faucibus, ipsum vel dictum eleifend, risus neque dignissim nunc, quis 
            fermentum tortor felis tincidunt massa. Nunc velit massa, auctor vel 
            mauris nec, pretium vestibulum risus
          </p>
          <div class="title4">best tours</div>

          <div class="row">
            <div class="col-sm-4">
              <ul class="ul1">
                <li><a href="tour-details-map.html">Rome</a></li>
                <li><a href="tour-details-map.html">Milan</a></li>
                <li><a href="tour-details-map.html">Genoa</a></li>
                <li><a href="tour-details-map.html">Verona</a></li>
              </ul>
            </div>
            <div class="col-sm-4">
              <ul class="ul1">
                <li><a href="tour-details-map.html">Trieste</a></li>
                <li><a href="tour-details-map.html">Venice</a></li>
                <li><a href="tour-details-map.html">Bologna</a></li>
                <li><a href="tour-details-map.html">Florence</a></li>
              </ul>
            </div>
            <div class="col-sm-4">
              <ul class="ul1">
                <li><a href="tour-details-map.html">San Marino</a></li>
                <li><a href="tour-details-map.html">Siena</a></li>
                <li><a href="tour-details-map.html">Naples</a></li>
                <li><a href="tour-details-map.html">Palermo</a></li>
              </ul>
            </div>
          </div>

          <br><br>


          <p><a href="tours-link.html" class="btn-default btn1">view all places</a></p>

        </div>
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-sm-6">
        <div class="country country2">
          <div class="title3">france, europe</div>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut 
            faucibus, ipsum vel dictum eleifend, risus neque dignissim nunc, quis 
            fermentum tortor felis tincidunt massa. Nunc velit massa, auctor vel 
            mauris nec, pretium vestibulum risus
          </p>
          <div class="title4">best tours</div>

          <div class="row">
            <div class="col-sm-4">
              <ul class="ul1">
                <li><a href="tour-details-map.html">Paris</a></li>
                <li><a href="tour-details-map.html">Versalles</a></li>
                <li><a href="tour-details-map.html">Orleans</a></li>
                <li><a href="tour-details-map.html">Nantes</a></li>
              </ul>
            </div>
            <div class="col-sm-4">
              <ul class="ul1">
                <li><a href="tour-details-map.html">Lyon</a></li>
                <li><a href="tour-details-map.html">Bordeaux</a></li>
                <li><a href="tour-details-map.html">Toulouse</a></li>
                <li><a href="tour-details-map.html">Montpelier</a></li>
              </ul>
            </div>
            <div class="col-sm-4">
              <ul class="ul1">
                <li><a href="tour-details-map.html">Mont Blanc</a></li>
                <li><a href="tour-details-map.html">Marseille</a></li>
                <li><a href="tour-details-map.html">Cannes</a></li>
                <li><a href="tour-details-map.html">Nice</a></li>
              </ul>
            </div>
          </div>

          <br><br>


          <p><a href="tours-link.html" class="btn-default btn1">view all places</a></p>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="row">
          <div class="col-sm-6">
            <div class="city1 clearfix">
              <a href="tour-details-map.html" class="clearfix">
                <figure>
                  <img src="{{ url('newhtml/images/f1.jpg') }}" alt="" class="img-responsive">
                </figure>
                <div class="over"></div>
                <div class="caption">
                  <div class="txt1">paris - 5 days</div>
                  <div class="txt2"><span>from $215</span> per person</div>
                </div>
              </a>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="city1 clearfix">
              <a href="tour-details-map.html" class="clearfix">
                <figure>
                  <img src="{{ url('newhtml/images/f2.jpg') }}" alt="" class="img-responsive">
                </figure>
                <div class="over"></div>
                <div class="caption">
                  <div class="txt1">nice - 7 days</div>
                  <div class="txt2"><span>from $175</span> per person</div>
                </div>
              </a>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <div class="city1 clearfix">
              <a href="tour-details-map.html" class="clearfix">
                <figure>
                  <img src="{{ url('newhtml/images/f3.jpg') }}" alt="" class="img-responsive">
                </figure>
                <div class="over"></div>
                <div class="caption">
                  <div class="txt1">cannes - 7 days</div>
                  <div class="txt2"><span>from $150</span> per person</div>
                </div>
              </a>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="city1 clearfix">
              <a href="tour-details-map.html" class="clearfix">
                <figure>
                  <img src="{{ url('newhtml/images/f4.jpg') }}" alt="" class="img-responsive">
                </figure>
                <div class="over"></div>
                <div class="caption">
                  <div class="txt1">marseille - 4 days</div>
                  <div class="txt2"><span>from $290</span> per person</div>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="contacts">
  <div class="container">
    <div class="title1">get in touch</div>
    <div class="title7">contact information</div>
    <div class="row">
      <div class="col-sm-8">
        <div id="note"></div>
        <div id="fields">
		      <div class="alert alert-success" style="display:none;">	       
	      </div>
        <form id="ajax-contact-form" class="form-horizontal" action="#" method="post">		
            <input type="hidden" name="_token" value="2JbvXMdJW2Gr3nYwGmCisxOSePVgm6oa9qhF744P">
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                    <label for="inputName">Your Name</label>
                    <input class="form-control" placeholder="Your Name *" id="txt_contact_name" name="txt_contact_name" value="" required="" data-validation-required-message="Please enter your name." type="text">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                    <label for="inputEmail">Email</label>
                    <input class="form-control" placeholder="Your Email *" id="txt_contact_email" name="txt_contact_email" value="" required="" data-validation-required-message="Please enter your email address." type="email">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                    <label for="inputPhone">Phone</label>
                    <input class="form-control" placeholder="Your Phone *" id="txt_contact_phone" name="txt_contact_phone" value="" required="" data-validation-required-message="Please enter your phone number." type="text">
                </div>
              </div>
             
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                    <label for="inputMessage">Your Message</label>
                    <textarea class="form-control" placeholder="Your Message *" rows="11" id="txt_contact_message" name="txt_contact_message" required="" data-validation-required-message="Please enter a message."></textarea>
                </div>
              </div>
            </div>
            <button type="submit" id="btn_contactus_send" name="btn_contactus_send" class="btn-default btn-cf-submit">submit comment</button>
        </form>
      </div>
      </div>
      <div class="col-sm-4">
        <div class="title5">about us</div>
        <p>
          Trip India Hotels is an emerging group in the field of innovating affordable as well as luxury holiday packages to various destinations in India. From Kashmir to Kanyakumari, one can traverse through the diverse rich and varied cultural heritage of the country. Our country is home to the Great Himalayas, the Ganges, Qutub Minar, Red Fort, Golden Temple, India Gate, the Char Minar, Mysore Palace, Jantar Mantar, Victoria Memorial, Gateway of India, Howrah Bridge, Hawa Mahal, Taj Mahal, Goa Beach, etc.
        </p>
        <br>
        <div class="title5">contact info</div>
        <div class="smi phone1">Phone: +91 9910329129/9650119494</div>
        <div class="smi email1">Email us:  <a href="#">sales@tripindiahotels.com</a></div>
        <div class="smi address1">Address: B-29 , Ansal Chambers II,Bhikaji Cama Place,New Delhi - 110066.</div>
        <br>
        <div class="social_wrapper">
          <ul class="social clearfix">
            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
            <li><a href="#"><i class="fa fa-skype"></i></a></li>
            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
            <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
            <li><a href="#"><i class="fa fa-behance "></i></a></li>
          </ul>
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


<script type="text/javascript">
	$("#todate").datepicker().datepicker("setDate", new Date());
	$("#fromdate").datepicker().datepicker("setDate", new Date());
</script>

<script type="text/javascript">
	$(document).ready(function() 
	{
		$(".allregions").click(function()
		{
			$('#myModal').modal('show');
			return false;
		});
		
		$('#txt_tours_name_location').bootcomplete({
      		url:'/tourlocations',
			minLength : 1
    		});
		$('#hotel_name_location').bootcomplete({
      		url:'/gethotels',
			minLength : 1
    		});
		
		$('#txt_activity_name_location').bootcomplete({
      		url:'/getactivities',
			minLength : 1
    		});
		
				
		$(".myTab").click(function()
		{ 
			$(".myTab").removeClass("active");
			$(this).addClass("active");
		});
		
	});
	</script>
	<script type="text/javascript">
$( document ).ready(function()  
{
	
	$("#btn_contactus_send").click(function()
	{
		var name = $("#txt_contact_name").val();
		var email = $("#txt_contact_email").val();
		var phone = $("#txt_contact_phone").val();
		var message = $("#txt_contact_message").val();
		var token = $("input[name='_token']").val();
		var url = "{{ url('/contact') }}";
		
		$.ajax(
		{
			url: url,
			type: 'post',
			async: false,
			data: { "_token":token,"name":name,"email":email,"phone":phone,"message":message },
			success: function (data) 
			{
				$(".alert-success").show();
				$(".alert-success").html(data);
				$("#txt_contact_name").val('');
				$("#txt_contact_email").val('');
				$("#txt_contact_phone").val('');
				$("#txt_contact_message").val('');
				
			}
		});
		
		return false;
	});
});
</script>

<script type="text/javascript" src="{{ url('newhtml/js/jquery-ui.js') }}"></script>
<script type="text/javascript" src="{{ url('newhtml/js/jquery-migrate-1.js') }}"></script>
<script type="text/javascript" src="{{ url('newhtml/js/jquery_004.js') }}"></script>
<script type="text/javascript" src="{{ url('newhtml/js/superfish.js') }}"></script>
<script type="text/javascript" src="{{ url('newhtml/js/select2.js') }}"></script>
<script type="text/javascript" src="{{ url('newhtml/js/camera.js') }}"></script>
<script type="text/javascript" src="{{ url('newhtml/js/jquery_002.js') }}"></script>
<script type="text/javascript" src="{{ url('newhtml/js/jquery_006.js') }}"></script>
<script type="text/javascript" src="{{ url('newhtml/js/jquery_003.js') }}"></script>
<script type="text/javascript" src="{{ url('newhtml/js/jquery_008.js') }}"></script>
<script type="text/javascript" src="{{ url('newhtml/js/jquery_005.js') }}"></script>
<script type="text/javascript" src="{{ url('newhtml/js/jquery_011.js') }}"></script>
<script type="text/javascript" src="{{ url('newhtml/js/jquery_012.js') }}"></script>
<script type="text/javascript" src="{{ url('newhtml/js/jquery_007.js') }}"></script>
<script type="text/javascript" src="{{ url('newhtml/js/SmoothScroll.js') }}"></script>
<script type="text/javascript" src="{{ url('newhtml/js/jquery_010.js') }}"></script>
<script type="text/javascript" src="{{ url('newhtml/js/jquery_009.js') }}"></script>
<script type="text/javascript" src="{{ url('newhtml/js/cform.js') }}"></script>
<script type="text/javascript" src="{{ url('newhtml/js/googlemap.js') }}"></script>
<script type="text/javascript" src="{{ url('newhtml/js/js') }}"></script>
<script type="text/javascript" src="{{ url('newhtml/js/scripts.js') }}"></script>
<script type="text/javascript" type="text/javascript" src="{{ url('newhtml/js/bootstrap.js') }}"></script>
<script type="text/javascript" type="text/javascript" src="{{ url('newhtml/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ url('newhtml/js/jqBootstrapValidation.js') }}"></script>
<script type="text/javascript" src="{{ url('newhtml/js/clean-blog.min.js') }}"></script>
<script type="text/javascript" src="{{ url('newhtml/js/jquery.bootcomplete.js') }}"></script>
  
<script type="text/javascript" charset="UTF-8" src="{{ url('newhtml/js/common.js') }}"></script>
<script type="text/javascript" charset="UTF-8" src="{{ url('newhtml/js/util.js') }}"></script>
<script type="text/javascript" charset="UTF-8" src="{{ url('newhtml/js/stats.js') }}"></script>
<script type="text/javascript" charset="UTF-8" src="{{ url('newhtml/js/map.js') }}"></script>
<script type="text/javascript" charset="UTF-8" src="{{ url('newhtml/js/marker.js') }}"></script>
<script type="text/javascript" charset="UTF-8" src="{{ url('newhtml/js/onion.js') }}"></script>
<script type="text/javascript" charset="UTF-8" src="{{ url('newhtml/js/controls.js') }}"></script>
<a href="#" id="toTop" style="display: inline;"><span id="toTopHover"></span></a><div id="ui-datepicker-div" class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all"></div></body></html>