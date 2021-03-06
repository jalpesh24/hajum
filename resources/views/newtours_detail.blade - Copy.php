@include('includes.newheader')

<style>
body{
	font:16px 'Source Sans Pro', Arial, Helvetica, sans-serif !important;
	font-size:15px !important;
	color:#abb1ba;
}
/*  bhoechie tab */
div.bhoechie-tab-container{
  z-index: 10;
  padding: 0 !important;
  border-radius: 4px;
  -moz-border-radius: 4px;
 
  margin-top: 20px;
  
  -webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175);
  box-shadow: 0 6px 12px rgba(0,0,0,.175);
  -moz-box-shadow: 0 6px 12px rgba(0,0,0,.175);
  background-clip: padding-box;
  opacity: 0.97;
  filter: alpha(opacity=97);
}
div.bhoechie-tab-menu{
  padding-right: 0;
  padding-left: 0;
  padding-bottom: 0;
}
div.bhoechie-tab-menu div.list-group{
  margin-bottom: 0;
}
div.bhoechie-tab-menu div.list-group>a{
  margin-bottom: 0;
}
div.bhoechie-tab-menu div.list-group>a .glyphicon,
div.bhoechie-tab-menu div.list-group>a .fa {
  color: #EA2330;
}
div.bhoechie-tab-menu div.list-group>a:first-child{
  border-top-right-radius: 0;
  -moz-border-top-right-radius: 0;
}
div.bhoechie-tab-menu div.list-group>a:last-child{
  border-bottom-right-radius: 0;
  -moz-border-bottom-right-radius: 0;
}
div.bhoechie-tab-menu div.list-group>a.active,
div.bhoechie-tab-menu div.list-group>a.active .glyphicon,
div.bhoechie-tab-menu div.list-group>a.active .fa{
  background-color: #EA2330;
  background-image: #EA2330;
  color: #ffffff;
}
div.bhoechie-tab-menu div.list-group>a.active:after{
  content: '';
  position: absolute;
  left: 100%;
  top: 50%;
  margin-top: -13px;
  border-left: 0;
  border-bottom: 13px solid transparent;
  border-top: 13px solid transparent;
  border-left: 10px solid #EA2330;
}

div.bhoechie-tab-content{ 
  /* border: 1px solid #eeeeee; */
  padding-left: 20px;
  padding-top: 0px;
}

div.bhoechie-tab div.bhoechie-tab-content:not(.active){
  display: none;
}
.nav-tabs > li > a.title {  
line-height:1.42857; margin-right:2px;  position:relative;color:#000 !important; 
}
.nav-tabs > li.active > a:focus, .nav-tabs > li.active { background-color: #fe9602 !important;}
.nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover { background-color: #fe9602 !important; }
.tab-content .tab-pane { color:#abb1ba !important; padding-top:10px; padding-bottom:5px; }

.list-group{width:130% !important;}
.flex-direction-nav{display:none;}

@import url(https://fonts.googleapis.com/css?family=Open+Sans:400,300,600);


ol, ul {
  list-style: none;
}

table {
  border-collapse: collapse;
  border-spacing: 0;
}

caption, th, td {
  text-align: left;
  font-weight: normal;
  vertical-align: middle;
}

q, blockquote {
  quotes: none;
}
q:before, q:after, blockquote:before, blockquote:after {
  content: "";
  content: none;
}

a img {
  border: none;
}

article, aside, details, figcaption, figure, footer, header, hgroup, main, menu, nav, section, summary {
  display: block;
}



h1 {
  text-align: center;
  font-size: 2em;
  padding-bottom: .5em;
}

#slider {
  width: 800px;
 
  margin: 0 auto 10px;
  overflow: hidden;
  position: relative;
}
#slider ul {
  overflow: hidden;
  *zoom: 1;
}
#slider ul li {
  font-size: 1.5em;
  color: #fff;  
  float: left;
  width: 800px;
  
  line-height: 300px;
}
#slider a {
  display: block;
  position: absolute;
  color: #fff;
  font-size: 2em;
  top: 50%;
  width: 30px;
  height: 30px;
  line-height: 30px;
  text-align: center;
  margin-top: -15px;
  text-decoration: none;
  background: #000;
}
#slider a#sliderNext {
  right: 0;
}
#slider a:hover {
  filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=50);
  opacity: 0.5;
}

#pager {
  text-align: center;
}
#pager a {
  display: inline-block;
  vertical-align: middle;
  *vertical-align: auto;
  *zoom: 1;
  *display: inline;
  cursor: pointer;
  -moz-transition-property: opacity;
  -o-transition-property: opacity;
  -webkit-transition-property: opacity;
  transition-property: opacity;
  -moz-transition-duration: 0.2s;
  -o-transition-duration: 0.2s;
  -webkit-transition-duration: 0.2s;
  transition-duration: 0.2s;
  -moz-transition-timing-function: ease-in;
  -o-transition-timing-function: ease-in;
  -webkit-transition-timing-function: ease-in;
  transition-timing-function: ease-in;
  padding:5px;
}
#pager a:hover, #pager a.active {
  filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=50);
  opacity: 0.5;
}

</style>
<link src="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.7.0/flexslider.min.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.7.0/jquery.flexslider-min.js" ></script>

<script type="text/javascript">
$(function(){
	var slider = $('#slider');
	var sliderWrap = $('#slider ul');
	var sliderImg = $('#slider ul li');
	var prevBtm = $('#sliderPrev');
	var nextBtm = $('#sliderNext');
	var length = sliderImg.length;
	var width = sliderImg.width();
	var thumbWidth = width/length;

	sliderWrap.width(width*(length+2));

	//Set up
	slider.after('<div id="' + 'pager' + '"></div>');
	var dataVal = 1;
	sliderImg.each(
		function(){
			$(this).attr('data-img',dataVal);
			$('#pager').append('<a data-img="' + dataVal + '"><img src=' + $('img', this).attr('src') + ' width=' + thumbWidth + '></a>');
		dataVal++;
	});
	
	//Copy 2 images and put them in the front and at the end
	$('#slider ul li:first-child').clone().appendTo('#slider ul');
	$('#slider ul li:nth-child(' + length + ')').clone().prependTo('#slider ul');

	sliderWrap.css('margin-left', - width);
	$('#slider ul li:nth-child(2)').addClass('active');

	var imgPos = pagerPos = $('#slider ul li.active').attr('data-img');
	$('#pager a:nth-child(' +pagerPos+ ')').addClass('active');


	//Click on Pager  
	$('#pager a').on('click', function() {
		pagerPos = $(this).attr('data-img');
		$('#pager a.active').removeClass('active');
		$(this).addClass('active');

		if (pagerPos > imgPos) {
			var movePx = width * (pagerPos - imgPos);
			moveNext(movePx);
		}

		if (pagerPos < imgPos) {
			var movePx = width * (imgPos - pagerPos);
			movePrev(movePx);
		}
		return false;
	});

	//Click on Buttons
	nextBtm.on('click', function(){
		moveNext(width);
		return false;
	});

	prevBtm.on('click', function(){
		movePrev(width);
		return false;
	});

	//Function for pager active motion
	function pagerActive() {
		pagerPos = imgPos;
		$('#pager a.active').removeClass('active');
		$('#pager a[data-img="' + pagerPos + '"]').addClass('active');
	}

	//Function for moveNext Button
	function moveNext(moveWidth) {
		sliderWrap.animate({
    		'margin-left': '-=' + moveWidth
  			}, 700, function() {
  				if (imgPos==length) {
  					imgPos=1;
  					sliderWrap.css('margin-left', - width);
  				}
  				else if (pagerPos > imgPos) {
  					imgPos = pagerPos;
  				} 
  				else {
  					imgPos++;
  				}
  				pagerActive();
  		});
	}

	//Function for movePrev Button
	function movePrev(moveWidth) {
		sliderWrap.animate({
    		'margin-left': '+=' + moveWidth
  			}, 900, function() {
  				if (imgPos==1) {
  					imgPos=length;
  					sliderWrap.css('margin-left', -(width*length));
  				}
  				else if (pagerPos < imgPos) {
  					imgPos = pagerPos;
  				} 
  				else {
  					imgPos--;
  				}
  				pagerActive();
  		});
	}

});
</script>
  <div class="container">
    <div class="breadcrumbs1">
<ol class="breadcrumb">
              <li class="breadcrumb-item"><i class="fa fa-home" aria-hidden="true"></i> <a href="{{ url('/newhome') }}">Home</a></li>
              <li class="breadcrumb-item active">Tour Detailed</li>
</ol>
</div>
@foreach ($tours as $tour)
<div class="col-md-12">
  <div class="package"><h2 style="text-align:center;">{!! ucwords(strtolower($tour->tour_name)) !!}</h2></div>
</div>
<div style="clear:both;"></div>
<div class="row" style="background:#f8f8f8;">
  <div class="col-md-9 col-sm-10 col-xs-12">
    <div class="top">
      <h2 id="tourname_{!! $tour->tour_id !!}">{!! ucwords(strtolower($tour->tour_name)) !!}</h2>
    </div>
    <div class="grid-img"> 
	<?php $imgs = explode(',', $tour->tour_image); ?>
	 <!-- Place somewhere in the <body> of your page -->

<div id="slider">
	<ul>
		@foreach($imgs as $tourimg)	  
	<li>
        <img src="{{ url('tours_images/'.$tourimg) }}" style="width:90%;height:auto;">
     </li>
	@endforeach
	</ul>
	<a href="#" id="sliderNext">></a>
	<a href="#" id="sliderPrev"><</a>
</div>
 

      <div class="details">        
        <div class="location"><i class="fa fa-map-marker" aria-hidden="true"></i> {!! $tour->city_location !!}</div>
        <div class="rating"> @for($r = 1; $r <= $tour->rating; $r++) <i class="fa fa-star" aria-hidden="true"></i> @endfor </div>
      </div>
    </div>
   
    @if($tour->inclusion_select != "")
          <div class="col-md-12">
          <ul class="option">
            @foreach(explode(',', $tour->inclusion_select) as $info) 
              @if($info == "accomodation")
               <li style="width: 15%;float: left;list-style: none;"><img src="{{ url('/img/stars-icon.png') }}" class="sign" style="width:25px;">
                  <p>Accommodation</p>
                </li>
              @endif  
              @if($info == "transfer") 
                <li style="width: 15%;float: left;list-style: none;"><img src="{{ url('/img/transfer-icon.png') }}" class="sign" style="width:25px;">
                 <p>Transfer</p>
                </li> 
              @endif
               @if($info == "meals") 
                <li style="width: 15%;float: left;list-style: none;"><img src="{{ url('/img/meals-icon.png') }}" class="sign" style="width:25px;">
                 <p>Meals</p>
                </li> 
              @endif
               @if($info == "sightseen") 
                <li style="width: 15%;float: left;list-style: none;"><img src="{{ url('/img/sight-icon.png') }}" class="sign" style="width:25px;">
                 <p>Sightseen</p>
                </li> 
              @endif
              
            @endforeach
             <li><p>{!! $tour->partofindia !!}</p></li>
        </ul>
		</div>
        @endif
        
    <div class="bootom-tag"> <span><img src="{{ url('newhtml/images/tag.png') }}" alt="Special offer" title="Special offer"/>
      <?php if(is_array($coupons)) {  echo 'Use <strong>'.$coupons[0]->coupon_code.'</strong> to book online & get Rs. '.$coupons[0]->coupon_amount.' off ';  } ?>
      </span> </div>
  </div>
    <div class="col-md-3">   
      <div class="grid-right" style="width:auto;"> 
       @if($tour->sale_price=="") 
       <span class="salePrice" style="text-align:center">Rs. <strike>{!! $tour->price_per_person; !!}</strike></span> 
		@else <span class="itemPrice" style="text-align:center">Rs. {!! $tour->sale_price; !!}</span> 
			  <span class="salePrice" style="text-align:center"><strike>Rs. {!! $tour->price_per_person; !!}</strike></span> 
		@endif
          <p style="text-align:center">Per person</p>       
          <p style="text-align:center">{!! $tour->days !!} days & {!! $tour->nights !!} Nights</p> <br /><br /> 
                
        <center>        
            <?php if($user = Auth::user())
{ ?>
    <a href="{{ url('/newtour-checkout') }}" class="checkout" tid="{!! $tour->tour_id !!}" data-token="{{ csrf_token() }}">
            <button class="btn-default btn1">Book Now</button>
            </a>
<?php } else { ?>
            		<a href="{{ url('/tour-checkout') }}" class="checkout" tid="{!! $tour->tour_id !!}" data-token="{{ csrf_token() }}">
            <button class="btn-default btn1">Book Now</button>
            </a>
<?php } ?>			        
		 	<a href="#" class="getacall" tid="{!! $tour->tour_id !!}">
	        <button class="btn-default btn1">Get A Callback</button>
    	    </a> 
       </center>
     </div>      
    </div> 
  
  @if($tour->overview != '' )
  <!--Overview starts-->
  <div style="clear:both;margin:20px; 0"><hr /></div>
  <div class="col-md-12 col-sm-12 col-xs-12">
    <h3>Overview</h3>
    <p align="justify">{!! $tour->overview !!}</p>
  </div>
  <!--Overview ends-->
  @endif
  
  @if(isset($tour_days[0]))
  <!--Tabbing starts here-->
  <div style="clear:both;margin:20px; 0"><hr /></div>
  <div class="col-md-12" style="margin-top:20px;">
  <h3> Tour Details Description </h3>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bhoechie-tab-container" >
      <div class="col-lg-1 col-md-1 col-sm-2 col-xs-4 bhoechie-tab-menu">
        <div class="list-group">
          <?php $i = 0; ?>
          @foreach($tour_days as $days)
          @if($i == 0) <a href="#" class="list-group-item active text-center"> Day - {{ $i = $i+1 }} </a> @else <a href="#" class="list-group-item   text-center"> Day - {{ $i = $i+1 }} </a> @endif
          @endforeach </div>
      </div>
      <div class="col-lg-11 col-md-11 col-sm-10 col-xs-8 bhoechie-tab">
        <?php $i = 0; ?>
        @foreach($tour_sightseeing as $sightseeing)
        @if($i == 0)
        <div class="bhoechie-tab-content active" >
          <div class="col-md-12 col-sm-12 col-xs-12" style="background:#FCFBFB !important;min-height:80px; height:auto;padding-top: 20px;" >
            <div style="float:left; padding:5px 35px 5px 0;"> <img src="{{ url('newhtml/images/hotel.png') }}" style="height:32px;"> </div>
            <div style="float:left;">
              <h5 style="color:#000;">{!! $sightseeing->travel !!}</h5>
            </div>
          </div>
          <div style="clear:both; padding-top:5px;"></div>
          <?php $sights = explode(" ### ",$sightseeing->sightseeing); ?>
          @if($sights[0])
          <div class="col-md-12 col-sm-12 col-xs-12" style="background:#FCFBFB !important;min-height:80px; height:auto;padding-top: 20px;" >
            <div style="float:left; padding:5px 35px 5px 0;"> <img src="{{ url('newhtml/images/sightseen.png') }}" style="height:32px;"> </div>
            <div style="float:left;">
              <h5 style="color:#000;">
                <ul style="padding:0px">
                  @foreach($sights as $sight)
                  <li style="float:left;padding-right:35px;">{!! trim($sight) !!}</li>
                  @endforeach
                </ul>
              </h5>
            </div>
          </div>
          <div style="clear:both; padding-top:5px;"></div>
          @endif
          <?php $meals = explode(",",$sightseeing->meal); ?>
          @if($meals[0])
          <div class="col-md-12 col-sm-12 col-xs-12" style="background:#FCFBFB !important;min-height:80px; height:auto;padding-top: 20px;" >
            <div style="float:left; padding:5px 35px 5px 0;"> <img src="{{ url('newhtml/images/meal.png') }}" style="height:32px;"> </div>
            <div style="float:left;">
              <h5 style="color:#000;">
                <ul style="padding:0px">
                  @foreach($meals as $meal)
                  <li style="float:left;padding-right:35px;">{!! ucfirst(trim($meal)) !!}</li>
                  @endforeach
                </ul>
              </h5>
            </div>
          </div>
          @endif 
</div>
        @else
        <div class="bhoechie-tab-content" >
          <div class="col-md-12 col-sm-12 col-xs-12" style="background:#FCFBFB !important;min-height:80px; height:auto;padding-top: 20px;" >
            <div style="float:left; padding:5px 35px 5px 0;"> <img src="{{ url('newhtml/images/hotel.png') }}" style="height:32px;"> </div>
            <div style="float:left;">
              <h5 style="color:#000;">{!! $sightseeing->travel !!}</h5>
            </div>
          </div>
          <div style="clear:both; padding-top:5px;"></div>
          <?php $sights = explode(" ### ",$sightseeing->sightseeing); ?>
          @if($sights[0])
          <div class="col-md-12 col-sm-12 col-xs-12" style="background:#FCFBFB !important;min-height:80px; height:auto;padding-top: 20px;" >
            <div style="float:left; padding:5px 35px 5px 0;"> <img src="{{ url('newhtml/images/sightseen.png') }}" style="height:32px;"> </div>
            <div style="float:left;">
              <h5 style="color:#000;">
                <ul style="padding:0px">
                  @foreach($sights as $sight)
                  <li style="float:left;padding-right:35px;">{!! trim($sight) !!}</li>
                  @endforeach
                </ul>
              </h5>
            </div>
          </div>
          <div style="clear:both; padding-top:5px;"></div>
          @endif
          <?php $meals = explode(",",$sightseeing->meal); ?>
          @if($meals[0])
          <div class="col-md-12 col-sm-12 col-xs-12" style="background:#FCFBFB !important;min-height:80px; height:auto;padding-top: 20px;" >
            <div style="float:left; padding:5px 35px 5px 0;"> <img src="{{ url('newhtml/images/meal.png') }}" style="height:32px;"> </div>
            <div style="float:left;">
              <h5 style="color:#000;">
                <ul style="padding:0px">
                  @foreach($meals as $meal)
                  <li style="float:left;padding-right:35px;">{!! ucfirst(trim($meal)) !!}</li>
                  @endforeach
                </ul>
              </h5>
            </div>
          </div>
          @endif </div>
        @endif
        <?php $i = $i + 1 ?>
        @endforeach </div>
    </div>
  </div>
  <!--Tabbing ends here-->
  @endif
  
  @if($tour->inclusions != '' )
  <!--Inclusions starst-->
<div style="clear:both;margin:20px; 0"><hr /></div>
  <div class="col-md-12">   
          <h3>Inclusions</h3>
          <p align="justify">{!! $tour->inclusions !!}</p>  
  </div>
  <!--Inclusions ends-->
  @endif
  
  @if($tour->exclusions != '' )
  <!--Exclusions starts-->
  <div style="clear:both;margin:20px; 0"><hr /></div>
  <div class="col-md-12">
          <h3>Exclusions</h3>
          <p align="justify">{!! $tour->exclusions !!}</p>        
  </div>
  <!--Exclusions ends-->
  @endif
  <!--Hr starts-->
  <!--Hr ends-->
  @if(isset($tour_days[0]))
  <!--Detailed itinery starts-->
  <div style="clear:both;margin:20px; 0"><hr /></div>
    <div class="col-md-12">
        <div style="padding-left:10px;">
          <h3>Detailed Day Wise Itinerary</h3>
          <?php $i=0; ?>
          @foreach($tour_days as $days)
          <div class="day"> <strong>Day {{ $i = $i+1 }} - {!! $days->itinerydata_title !!}</strong>
            <p align="justify">{!! $days->itinerydata_description !!}</p>
          </div>
          @endforeach </div>
    </div>
  <!--Detailed itinery ends-->  
  @endif
  
  @if(isset($tour_pvisits[0]))
  <!--About itinery starts-->  
  <div style="clear:both;margin:20px; 0"><hr /></div>
  <div class="col-md-12">
          <h3>About Itinerary</h3>
          <!-- Nav tabs -->
          <ul class="nav nav-tabs">
            <?php $i=0; ?>
            @foreach($tour_pvisits as $pvisit)
            @if($i==0)
            <li class="active"><a href="#pv{{ $i = $i+1 }}" data-toggle="tab" class="title">{!! $pvisit->pvisit_name !!}</a> </li>
            @else
            <li><a href="#pv{{ $i = $i+1 }}" data-toggle="tab" class="title">{!! $pvisit->pvisit_name !!}</a> </li>
            @endif
            @endforeach
          </ul>
          <!-- Tab panes -->
          <div class="tab-content">
            <?php $i=0; ?>
            @foreach($tour_pvisits as $pvisit)
            @if($i==0)
            <div class="tab-pane fade in active" id="pv{{ $i = $i+1 }}">
              <p align="justify">{!! $pvisit->pvisit_description !!}</p>
            </div>
            @else
            <div class="tab-pane fade" id="pv{{ $i = $i+1 }}">
              <p align="justify">{!! $pvisit->pvisit_description !!}</p>
            </div>
            @endif
            @endforeach </div>     
  </div>
  @endif
  <!--About itinery ends-->
  
  <!--Payment Policy starts-->
  @if($tour->paymentpolicy != '' )
  <div style="clear:both;margin:20px; 0"><hr /></div>
  <div class="col-md-6"> 
      <h3>Payment Policy</h3>
      <p align="justify">{!! $tour->paymentpolicy !!} </p>
  </div>
  @endif
  <!--Payment Policy ends-->
  @if($tour->cancellationpolicy != '')
  <!--Cancellation Policy starts-->  
  <div class="col-md-6">
        <h3>Cancellation Policy</h3>
        <p align="justify">{!! $tour->cancellationpolicy !!} </p>   
  </div>
  <!--Cancellation Policy ends-->
  @endif
</div>  
  
  @endforeach 
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel" style="color:#000000;">Get the Best Holiday Planned by us!</h4>
      </div>
      <div class="modal-body" style="color:#000000;">
        <form action="" method="post" name="frm_get_call">
          {{ csrf_field() }}
          <input type="hidden" name="tid" id="tid" value="" />
          <div class="col-md-8">
            <div class="col-md-12">
              <!-- <label for="txt_name">Name *:</label>-->
              <input type="text" name="txt_name" class="form-control" id="txt_name" required="required" value="" placeholder="Full Name" />
            </div>
            <div class="col-md-12">
              <!-- <label for="txt_email">Email *:</label>-->
              &nbsp;
              <input type="email" name="txt_email" class="form-control" id="txt_email" required="required" value="" placeholder="Email ID" />
            </div>
            <div class="col-md-12">
              <!--  <label for="txt_mobile">Mobile *:</label>-->
              &nbsp;
              <input type="number" name="txt_mobile" class="form-control" id="txt_mobile" required="required" value="" placeholder="Phone Number" />
            </div>
          </div>
          <div class="col-md-4"> <img src="{{ url('/tours_images/1.jpg') }}" class="img-responsive" id="modelimage" /><br />
            <span id="tourname">Get the Best Holiday Planned by us!</span> </div>
        </form>
      </div>
      <div class="modal-footer" style="border-top:none;">
        <div class="col-md-4" style="padding-top:20px;border-top:none;">
          <button type="button" class="btn btn-primary">Send</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div>
   
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->



</div>
<br/>


  
  @include('includes.newfooter')

<script src="{{ url('newhtml/js/bootstrap.js') }}"></script>
<script src="{{ url('newhtml/js/bootstrap.min.js') }}"></script>
<script src="{{ url('newhtml/js/jqBootstrapValidation.js') }}"></script>
<script src="{{ url('newhtml/js/clean-blog.min.js') }}"></script>
<script src="{{ url('newhtml/js/jquery.bootcomplete.js') }}"></script>
<script type="text/javascript">
$(document).ready(function() {
    $("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
        e.preventDefault();
        $(this).siblings('a.active').removeClass("active");
        $(this).addClass("active");
        var index = $(this).index();
        $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
        $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
    });
});

$(document).ready(function() 
{
	$(".getacall").click(function()
	{ 
		var id = $(this).attr("tid");
		var tourname = $("#tourname_"+id).html();
		var tourimage = $("#tourimage_"+id).attr("src");
		$("#myModalLabel").html(tourname);
		$("#modelimage").attr("src",tourimage);
		$("#tourname").html(tourname);
		$('#myModal').modal('show');
		return false;
	});
	$(".checkout").click(function()
	{
		var token = $(this).attr("data-token");
		var tour_id = $(this).attr("tid");
		$.ajax(
		{
			url:"{{ url('/checkoutorder') }}",
			method : 'POST',
			async: false,
			dataType: "json",
			data: { "_token":token,"tour_id":tour_id },
			success: function(data) {
			}
		});
		return true;
	});
});
</script>
<a href="#" id="toTop" style="display: inline;"><span id="toTopHover"></span></a><div id="ui-datepicker-div" class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all"></div></body></html>