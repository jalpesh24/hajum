@extends('layouts.template_tours')
@section('title','Detail Tours')
@section('keywords', 'Trip India')
@section('description', 'Trip India')
@section('page_css')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<style>
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
  color: #fe9602;
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
  background-color: #fe9602;
  background-image: #fe9602;
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
  border-left: 10px solid #fe9602;
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
line-height:1.42857; margin-right:2px;  position:relative;color:#fff !important; 
}
.nav-tabs > li.active > a:focus, .nav-tabs > li.active { background-color: #fe9602 !important;}
.nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover { background-color: #fe9602 !important; }
.tab-content .tab-pane { color:#fff !important; padding-top:10px; padding-bottom:5px; }



.panel-body{
	color:#999999;
}
.panel-heading {
  padding: 0;
	border:0;
}
.panel-title>a, .panel-title>a:active{
	display:block;
	padding:10px;
  color:#555;
  font-size:16px;
  font-weight:bold;
	text-transform:uppercase;
	letter-spacing:1px;
  word-spacing:3px;
	text-decoration:none;
}
.panel-heading  a:before {
   font-family: 'Glyphicons Halflings';
   content: "\e114";
   float: right;
   transition: all 0.5s;
}
.panel-heading.active a:before {
	-webkit-transform: rotate(180deg);
	-moz-transform: rotate(180deg);
	transform: rotate(180deg);
} 
</style>
@endsection
@section('content')
<div class="container">
@foreach ($tours as $tour)
<div class="col-md-12" style="margin:50px 0">
  <div class="package">{!! ucwords(strtolower($tour->tour_name)) !!}</div>
</div>
<div style="clear:both;"></div>
<div class="row" style="border:1px solid #333333;background: rgba(0, 18, 28, 0.45) none repeat scroll 0 0;">
  <div class="col-md-10 col-sm-10 col-xs-12">
    <div class="top">
      <h2 id="tourname_{!! $tour->tour_id !!}">{!! ucwords(strtolower($tour->tour_name)) !!}</h2>
    </div>
    <div class="grid-img"> <img src="{{ url('public/tours_images/') }}{!! '/'.$tour->tour_image !!}" class="img-responsive" title="{!! ucwords(strtolower($tour->tour_name)) !!}" alt="{!! ucwords(strtolower($tour->tour_name)) !!}" id="tourimage_{!! $tour->tour_id !!}" />
      <div class="details">
        <div class="company-name"><a href="#" title="{!! ucwords(strtolower($tour->tour_name)) !!}">{!! ucwords(strtolower($tour->tour_name)) !!}</a></div>
        <div class="location"><i class="fa fa-map-marker" aria-hidden="true"></i> {!! $tour->city_location !!}</div>
        <div class="rating"> @for($r = 1; $r <= $tour->rating; $r++) <i class="fa fa-star" aria-hidden="true"></i> @endfor </div>
      </div>
    </div>
    <!-- <h4 class="inclusions">Inclusions</h4> -->
    <!-- <ul class="option">
      <li><img src="{{ url('public/img/transfer-icon.png') }}" class="sign">
        <p>Transfer</p>
      </li>
      <li><img src="{{ url('public/img/stars-icon.png') }}" class="sign">
        <p>Accommodation</p>
      </li>
      <li><img src="{{ url('public/img/meals-icon.png') }}">
        <p>Meals</p>
      </li>
      <li><img src="{{ url('public/img/sight-icon.png') }}" class="sign">
        <p>Sightseeing</p>
      </li>
    </ul> -->
    @if($tour->inclusion_select != "")
          <ul class="option">
            @foreach(explode(',', $tour->inclusion_select) as $info) 
              @if($info == "accomodation")
               <li><img src="{{ url('public/img/stars-icon.png') }}" class="sign">
                  <p>Accommodation</p>
                </li>
              @endif  
              @if($info == "transfer") 
                <li><img src="{{ url('public/img/transfer-icon.png') }}" class="sign">
                 <p>Transfer</p>
                </li> 
              @endif
               @if($info == "meals") 
                <li><img src="{{ url('public/img/meals-icon.png') }}" class="sign">
                 <p>Meals</p>
                </li> 
              @endif
               @if($info == "sightseen") 
                <li><img src="{{ url('public/img/sight-icon.png') }}" class="sign">
                 <p>Sightseen</p>
                </li> 
              @endif
              
            @endforeach
             <li><p>{!! $tour->partofindia !!}</p></li>
        </ul>
        @endif
        
    <div class="bootom-tag"> <span><img src="{{ url('public/img/tag.png') }}" alt="Special offer" title="Special offer"/>
      <?php if(is_array($coupons)) {  echo 'Use <strong>'.$coupons[0]->coupon_code.'</strong> to book online & get Rs. '.$coupons[0]->coupon_amount.' off ';  } ?>
      </span> </div>
  </div>
  <div class="col-md-2 col-sm-12 col-xs-12">
    <div class="grid-right" style="width:auto;"> 
    @if($tour->sale_price=="") <span class="salePrice" style="text-align:center">Rs. <strike>{!! $tour->price_per_person; !!}</strike></span> @else <span class="itemPrice" style="text-align:center">Rs. {!! $tour->sale_price; !!}</span> <span class="salePrice" style="text-align:center"><strike>Rs. {!! $tour->price_per_person; !!}</strike></span> @endif
      <p style="text-align:center">Per person</p>
      <p style="text-align:center">{!! $tour->days !!} days &amp; {!! $tour->nights !!} Nights</p><br /><br />
      <div style="clear:both;"></div>
      <center>        
        <a href="{{ url('/tour-checkout') }}" class="checkout" tid="{!! $tour->tour_id !!}" data-token="{{ csrf_token() }}">
          <button class="btn btn-lg btn-detail" style="text-align:center">Book Now</button>
          </a>    
       <a class="getacall"  tid="{!! $tour->tour_id !!}">
        <button class="btn btn-lg claa">Get A Callback</button>
        </a>
      </center> 
        
    </div>
  </div>
  
  <div style="clear:both"></div>
  <!--  jalpesh added -->
  
<div class="wrapper center-block">
  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading active" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          <h5>Overview</h5>
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
        @if($tour->overview != '' )
  <!--Overview starts-->
  <div style="clear:both;margin:20px; 0"><hr /></div>
  <div class="col-md-12 col-sm-12 col-xs-12">
    
    <p align="justify">{!! $tour->overview !!}</p>
  </div>
  <!--Overview ends-->
  @endif
  
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          <h5> Tour Details Description </h5>
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">
        @if(isset($tour_days[0]))
  <!--Tabbing starts here-->
  <div style="clear:both;margin:20px; 0"><hr /></div>
  <div class="col-md-12" style="margin-top:20px;">
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
          <div class="col-md-12 col-sm-12 col-xs-12" style="background:#001421 !important;min-height:80px; height:auto;padding-top: 20px;" >
            <div style="float:left; padding:5px 35px 5px 0;"> <img src="{{ url('public/img/hotel.png') }}" style="height:32px;"> </div>
            <div style="float:left;">
              <h5 style="color:#fff;">{!! $sightseeing->travel !!}</h5>
            </div>
          </div>
          <div style="clear:both; padding-top:5px;"></div>
          <?php $sights = explode(" ### ",$sightseeing->sightseeing); ?>
          @if($sights[0])
          <div class="col-md-12 col-sm-12 col-xs-12" style="background:#001421 !important;min-height:80px; height:auto;padding-top: 20px;" >
            <div style="float:left; padding:5px 35px 5px 0;"> <img src="{{ url('public/img/sightseen.png') }}" style="height:32px;"> </div>
            <div style="float:left;">
              <h5 style="color:#fff;">
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
          <div class="col-md-12 col-sm-12 col-xs-12" style="background:#001421 !important;min-height:80px; height:auto;padding-top: 20px;" >
            <div style="float:left; padding:5px 35px 5px 0;"> <img src="{{ url('public/img/meal.png') }}" style="height:32px;"> </div>
            <div style="float:left;">
              <h5 style="color:#fff;">
                <ul style="padding:0px">
                  @foreach($meals as $meal)
                  <li style="float:left;padding-right:35px;">{!! ucfirst(trim($meal)) !!}</li>
                  @endforeach
                </ul>
              </h5>
            </div>
          </div>
          @endif </div>
        @else
        <div class="bhoechie-tab-content" >
          <div class="col-md-12 col-sm-12 col-xs-12" style="background:#001421 !important;min-height:80px; height:auto;padding-top: 20px;" >
            <div style="float:left; padding:5px 35px 5px 0;"> <img src="{{ url('public/img/hotel.png') }}" style="height:32px;"> </div>
            <div style="float:left;">
              <h5 style="color:#fff;">{!! $sightseeing->travel !!}</h5>
            </div>
          </div>
          <div style="clear:both; padding-top:5px;"></div>
          <?php $sights = explode(" ### ",$sightseeing->sightseeing); ?>
          @if($sights[0])
          <div class="col-md-12 col-sm-12 col-xs-12" style="background:#001421 !important;min-height:80px; height:auto;padding-top: 20px;" >
            <div style="float:left; padding:5px 35px 5px 0;"> <img src="{{ url('public/img/sightseen.png') }}" style="height:32px;"> </div>
            <div style="float:left;">
              <h5 style="color:#fff;">
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
          <div class="col-md-12 col-sm-12 col-xs-12" style="background:#001421 !important;min-height:80px; height:auto;padding-top: 20px;" >
            <div style="float:left; padding:5px 35px 5px 0;"> <img src="{{ url('public/img/meal.png') }}" style="height:32px;"> </div>
            <div style="float:left;">
              <h5 style="color:#fff;">
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
 
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingThree">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
           <h5> Inclusions </h5>
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
      <div class="panel-body">
        
  @if($tour->inclusions != '' )
  <!--Inclusions starst-->
<div style="clear:both;margin:20px; 0"><hr /></div>
  <div class="col-md-12">   
         
          <p align="justify">{!! $tour->inclusions !!}</p>  
  </div>
  <!--Inclusions ends-->
  @endif
      </div>
    </div>
  </div>
  
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingFour">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
          <h5>Exclusions</h5>
        </a>
      </h4>
    </div>
    <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
      <div class="panel-body">
      @if($tour->exclusions != '' )
  <!--Exclusions starts-->
  <div style="clear:both;margin:20px; 0"><hr /></div>
  <div class="col-md-12">
          
          <p align="justify">{!! $tour->exclusions !!}</p>        
  </div>
  <!--Exclusions ends-->
  @endif
  <!--Hr starts-->
  <!--Hr ends-->
      
      </div>
    </div>
  </div>
  
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingFive">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
          <h5>Detailed Day Wise Itinerary</h5>
        </a>
      </h4>
    </div>
    <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
      <div class="panel-body">
        @if(isset($tour_days[0]))
  <!--Detailed itinery starts-->
  <div style="clear:both;margin:20px; 0"><hr /></div>
    <div class="col-md-12">
        <div style="padding-left:10px;">
          
          <?php $i=0; ?>
          @foreach($tour_days as $days)
          <div class="day"> <strong>Day {{ $i = $i+1 }} - {!! $days->itinerydata_title !!}</strong>
            <p align="justify">{!! $days->itinerydata_description !!}</p>
          </div>
          @endforeach </div>
    </div>
  <!--Detailed itinery ends-->  
  @endif
  
      </div>
    </div>
  </div>
  
  
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingSix">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="false" aria-controls="collapseThree">
          <h5>About Itinerary</h5>
        </a>
      </h4>
    </div>
    <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
      <div class="panel-body">
        
  @if(isset($tour_pvisits[0]))
  <!--About itinery starts-->  
  <div style="clear:both;margin:20px; 0"><hr /></div>
  <div class="col-md-12">
          
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
  
  
  
  
  
      </div>
    </div>
  </div>
  
</div>
</div>
  
  
  <!-- end jalpesh -->
  
  
  
  
 
  
  
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
          <div class="col-md-4"> <img src="{{ url('public/tours_images/1.jpg') }}" class="img-responsive" id="modelimage" /><br />
            <span id="tourname">Get the Best Holiday Planned by us!</span> </div>
        </form>
      </div>
      <div class="modal-footer" style="border-top:none;">
        <div class="col-md-4" style="padding-top:20px;border-top:none;">
          <button type="button" class="btn btn-primary">Send</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endsection
@section('page_js')
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

<script type="text/javascript">
 $('.panel-collapse').on('show.bs.collapse', function () {
    $(this).siblings('.panel-heading').addClass('active');
  });

  $('.panel-collapse').on('hide.bs.collapse', function () {
    $(this).siblings('.panel-heading').removeClass('active');
  });
</script>
@endsection