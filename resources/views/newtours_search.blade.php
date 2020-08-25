@include('includes.newheader')
<div id="about">
  <div class="container">
    <div class="breadcrumbs1">
<ol class="breadcrumb">
              <li class="breadcrumb-item"><i class="fa fa-home" aria-hidden="true"></i> <a href="{{ url('/newhome') }}">Home</a></li>
              <li class="breadcrumb-item active">Tour Search</li>
</ol>
</div>
  <div class="col-md-12" style="margin-bottom:50px">
   <div class="package"> <small>Explore the world</small> <h2 style="text-align:center;">{{ strtoupper($search_tour) }} </h2></div>
  </div>
  <div class="col-md-3">
    <div class="left-bar">
      <h2 class="title">Refine Your Search</h2>
      <div class="box-section">
        <p>Month Of Travel</p>
        <select class="form-control" name="tours_month" id="tours_month" data-token="{{ csrf_token() }}">
          <option value="">Month of Travel (Any)</option>
          <?php  $month_num = date("Y-m"); $month_name = date("M-Y");
                                    if($month_num == $tours_month) {
                                    echo '<option value="'.$month_num.'" selected="selected" >'.$month_name.'</option>';
                                    }
                                    else {
                                    echo '<option value="'.$month_num.'">'.$month_name.'</option>';
                                    }
                                    
                                    $month = time();
                                    for ($i = 1; $i <= 12; $i++) 
                                    {
                                          $month = strtotime('next month', $month);
                                          $month_num = date("Y-m", $month);
                                          $month_name = date("M-Y", $month);
                                          if($month_num == $tours_month) {
                                          echo '<option value="'.$month_num.'" selected="selected" >'.$month_name.'</option>';
                                          }
                                          else {
                                          echo '<option value="'.$month_num.'">'.$month_name.'</option>';
                                          }
                                    }
                                    ?>
        </select>
      </div>
      <div class="box-section">
        <p>Duration (Days)</p>
        <?php for ($i = 0; $i <= 25; $i=$i+5)  {
         if($i == 0) { ?>
        <input type="checkbox" class="duration" id="duration<?php echo ($i+1) ?>" name="duration[]" value="<?php echo ($i+1).'-'.($i+5); ?>" />
        <label for="duration<?php echo ($i+1) ?>">
        <?php  echo 'From '.($i+1).' - '.($i+5).' Days'; ?>
        </label>
        <div style="clear:both"></div>
        <?php } else { ?>
        <input type="checkbox" id="duration<?php echo ($i) ?>" class="duration" name="duration[]" value="<?php echo ($i).'-'.($i+5); ?>" />
        <label for="duration<?php echo ($i) ?>">
        <?php  echo 'From '.($i).' - '.($i+5).' Days'; ?>
        </label>
        <div style="clear:both"></div>
        <?php } }?>
      </div>
      <div class="box-section">
        <p>Part Of India</p>
        <p class="last">
          <input type="checkbox" id="east" name="partofIndia[]" value="east" />
          <label for="east">East</label>
        </p>
        <p class="last">
          <input type="checkbox" id="west" name="partofIndia[]" value="west" />
          <label for="west">West</label>
        </p>
        <p class="last">
          <input type="checkbox" id="north" name="partofIndia[]" value="north" />
          <label for="north">North</label>
        </p>
        <p class="last">
          <input type="checkbox" id="south" name="partofIndia[]" value="south" />
          <label for="south">South</label>
        </p>
      </div>
      <div class="box-section icons-tag">
        <p>Themes</p>
        <p class="last">
          <input type="checkbox" id="family" />
          <label for="family"><img src="{{ url('public/img/family-icon.png') }}"> Family</label>
        </p>
        <p class="last">
          <input type="checkbox" id="beach" />
          <label for="beach"><img src="{{ url('public/img/beach-icon.png') }}"> Beach</label>
        </p>
        <p class="last">
          <input type="checkbox" id="romentic" />
          <label for="romentic"><img src="{{ url('public/img/romentic-icon.png') }}"> Romantic</label>
        </p>
      </div>
    </div>
  </div>
  <div class="col-md-9" id="listtours">
  	@if(isset($tours))
    @foreach ($tours as $tour)
    <div class="right-bar grid-view">
      <div class="col-md-9">   
        <div class="top">
          <h2 id="tourname_{!! $tour->tour_id !!}">{!! ucwords(strtolower($tour->tour_name)) !!}</h2>
        </div>
        <div class="grid-img"> <img src="{{ url('/tours_images/') }}{!! '/'.$tour->tour_image !!}" class="img-responsive" title="{!! ucwords(strtolower($tour->tour_name)) !!}" alt="{!! ucwords(strtolower($tour->tour_name)) !!}" id="tourimage_{!! $tour->tour_id !!}" />
          <div class="details">
            <div class="company-name"><a href="{{ url('/newtourdetail') }}/{!! $tour->tour_id !!}">{!! ucwords(strtolower($tour->tour_name)) !!}</a></div>
            <div class="location"><i class="fa fa-map-marker" aria-hidden="true"></i> {!! ucwords(strtolower($tour->city_location)) !!}</div>
            <div class="rating"> @for($r = 1; $r <= $tour->rating; $r++) <i class="fa fa-star" aria-hidden="true"></i> @endfor </div>
          </div>
        </div>
        <!-- <h4 class="inclusions">Inclusions</h4> -->
        <!-- {!! $inclusion_str = $tour->inclusion_select; !!} -->
        
        @if($tour->inclusion_select != "")
			<div class="col-md-12">
          <ul class="option">
            @foreach(explode(',', $tour->inclusion_select) as $info) 
              @if($info == "accomodation")
               <li style="width: 20%;float: left;list-style: none;"><img src="{{ url('public/img/stars-icon.png') }}" class="sign" style="width:25px;">
                  <p>Accommodation</p>
                </li>
              @endif  
              @if($info == "transfer") 
                 <li style="width: 20%;float: left;list-style: none;"><img src="{{ url('public/img/transfer-icon.png') }}" class="sign" style="width:25px;">
                 <p>Transfer</p>
                </li> 
              @endif
               @if($info == "meals") 
               <li style="width: 20%;float: left;list-style: none;"><img src="{{ url('public/img/meals-icon.png') }}" class="sign" style="width:25px;">
                 <p>Meals</p>
                </li> 
              @endif
               @if($info == "sightseen") 
                <li style="width: 20%;float: left;list-style: none;"><img src="{{ url('public/img/sight-icon.png') }}" class="sign" style="width:25px;">
                 <p>Sightseen</p>
                </li> 
              @endif
              
            @endforeach
             <li><p>{!! $tour->partofindia !!}</p></li>
        </ul>
		</div>
        @endif
        
        <div class="bootom-tag" style="border-bottom:2px solid;"><span><img src="{{ url('public/img/tag.png') }}"/>Use May2017 to book online & get upto 6500 off.</span></div>
      </div>
      <div class="col-md-3">   
      <div class="grid-right" style="width:auto;"> 
       
       <span class="salePrice" style="text-align:center">Rs. <strike>{!! $tour->price_per_person; !!}</strike></span> 
		<span class="itemPrice" style="text-align:center">Rs. {!! $tour->sale_price; !!}</span> 
			 
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
            <a href="{{ url('/newtourdetail') }}/{!! $tour->tour_id !!}">
            <button class="btn-default btn1">View Details</button>
            </a>
		 	<a href="#" class="getacall" tid="{!! $tour->tour_id !!}">
	        <button class="btn-default btn1">Get A Callback</button>
    	    </a> 
       </center>
     </div>      
    </div> 
    </div>
    <div class="col-md-1" style="float:left; width:100%;">
      <div>&nbsp;</div>
    </div>
    @endforeach
    <div class="pagination" style="float:left;"> {{ $tours->appends(request()->input())->links() }} </div>
     @endif
     </div>     
</div>
<!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel" style="color:#000000;">Get the Best Holiday Planned by us!</h4>
      </div>
      <div class="modal-body" style="color:#000000;">
        <form action="{{ url('/getacall') }}" method="post" name="frm_get_call">
          {{ csrf_field() }}
          <input type="hidden" name="tid" id="tid" value="" />
          <div class="col-md-8">
            <div class="alert alert-success sucsgetacall" style="display:none;"></div>
            <div class="alert alert-danger errgetacall" style="display:none;"></div>
            <div class="col-md-12">
              <input type="text" name="txt_name" class="form-control" id="txt_name" required="required" value="" placeholder="Full Name" />
            </div>
            <div class="col-md-12">&nbsp;
              <input type="email" name="txt_email" class="form-control" id="txt_email" required="required" value="" placeholder="Email ID" />
            </div>
            <div class="col-md-12">&nbsp;
              <input type="number" name="txt_mobile" class="form-control" id="txt_mobile" required="required" value="" placeholder="Phone Number" />
            </div>
          </div>
          <div class="col-md-4"> <img src="{{ url('/tours_images/1.jpg') }}" class="img-responsive"  id="modelimage"/><br />
            <span id="tourname">Get the Best Holiday Planned by us!</span> </div>
        </form>
      </div>
      <div class="modal-footer" style="border-top:none;">
        <div class="col-md-4" style="padding-top:20px;border-top:none;">
          <button type="button" class="btn btn-primary getacallsend">Send</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

</div>


  @include('includes.newfooter')

  

<script src="{{ url('newhtml/js/bootstrap.js') }}"></script>
<script src="{{ url('newhtml/js/bootstrap.min.js') }}"></script>
<script src="{{ url('newhtml/js/jqBootstrapValidation.js') }}"></script>
<script src="{{ url('newhtml/js/clean-blog.min.js') }}"></script>
<script src="{{ url('newhtml/js/jquery.bootcomplete.js') }}"></script>


<script type="text/javascript">
$(document).ready(function() 
{
	$(".sucsgetacall").html('');
	$(".sucsgetacall").hide();
	$(".errgetacall").html('');
	$(".errgetacall").hide();
	
	$(".getacall").click(function()
	{
		var id = $(this).attr("tid");
		var tourname = $("#tourname_"+id).html();
		var tourimage = $("#tourimage_"+id).attr("src");
		$("#tid").val(id);
		$("#myModalLabel").html(tourname);
		$("#modelimage").attr("src",tourimage);
		$("#tourname").html(tourname);
		$('#myModal').modal('show');
		return false;
	});
	
	$(".getacallsend").click(function() 
	{
		$(".sucsgetacall").hide();
		var tid = $("#tid").val();
		var name = $("#txt_name").val();
		var email = $("#txt_email").val();
		var mobile = $("#txt_mobile").val();
		
		var err = 0;
		var msg = '';
		if(name == '') 
		{
			msg = 'Please enter name.';
			err = 1;
		}
		if(email == '') 
		{
			msg = msg +' Please enter email address.';
			err = 1;
		}
		if(mobile == '') 
		{
			msg = msg +' Please enter mobile number.';
			err = 1;
		}
		if(msg != '') 
		{
			$(".errgetacall").html(msg);
			$(".errgetacall").show();
		}
		else 
		{
			$(".errgetacall").html('');
			$(".errgetacall").hide();
		}
		
		if(err == 0)
		{
			var token = $("input[name='_token']").val();
		
			$.ajax(
			{
				url:"{{ url('/getacall') }}",
				method : 'POST',
				data: { "_token":token,'tour_id':tid,"name":name,'email':email,'mobile':mobile},
				success: function(data) 
				{
					$(".sucsgetacall").html('Email sent successfully.');
					$(".sucsgetacall").show();
				}
			});
		}
		return false;
	});
	
	$("input[name='duration[]']").click(function()
	{
		var partofIndia_chked = '';
		$('input[name="partofIndia[]"]:checked').each(function() {
			partofIndia_chked = partofIndia_chked + "'"+this.value+"',";
		});
		var partofIndia = partofIndia_chked.substring(0,partofIndia_chked.length - 1);
		
		var duration_chked = '';
		$('input[name="duration[]"]:checked').each(function() {
			duration_chked = duration_chked + ""+this.value+",";
		});
		var duration = duration_chked.substring(0,duration_chked.length - 1);
		
		var tours_month = $("#tours_month").val();
		var token = $("#tours_month").attr("data-token");
		
		$.ajax(
		{
			url:"{{ url('/listsearchtours') }}",
			method : 'POST',
			data: { "_token":token,"tours_month":tours_month,'partofindia':partofIndia,'duration':duration},
			success: function(data) {
				$("#listtours").html(data);
			}
		});
	});
	
	$("input[name='partofIndia[]']").click(function()
	{
		var partofIndia_chked = '';
		$('input[name="partofIndia[]"]:checked').each(function() {
			partofIndia_chked = partofIndia_chked + "'"+this.value+"',";
		});
		var partofIndia = partofIndia_chked.substring(0,partofIndia_chked.length - 1);
		
		var duration_chked = '';
		$('input[name="duration[]"]:checked').each(function() {
			duration_chked = duration_chked + ""+this.value+",";
		});
		var duration = duration_chked.substring(0,duration_chked.length - 1);
		
		var tours_month = $("#tours_month").val();
		var token = $("#tours_month").attr("data-token");
		
		$.ajax(
		{
			url:"{{ url('/listsearchtours') }}",
			method : 'POST',
			data: { "_token":token,"tours_month":tours_month,'partofindia':partofIndia,'duration':duration},
			success: function(data) {
				$("#listtours").html(data);
			}
		});
	});
	
	$("#tours_month").change(function() 
	{
		var tours_month = $(this).val();
		var token = $(this).attr("data-token");
		var partofIndia_chked = '';
		$('input[name="partofIndia[]"]:checked').each(function() {
			partofIndia_chked = partofIndia_chked + "'"+this.value+"',";
		});
		var partofIndia = partofIndia_chked.substring(0,partofIndia_chked.length - 1);
		
		var duration_chked = '';
		$('input[name="duration[]"]:checked').each(function() {
			duration_chked = duration_chked + ""+this.value+",";
		});
		var duration = duration_chked.substring(0,duration_chked.length - 1);
		
		$.ajax(
		{
			url:"{{ url('/listsearchtours') }}",
			method : 'POST',
			data: { "_token":token,"tours_month":tours_month,'partofindia':partofIndia,'duration':duration},
			success: function(data) {
				$("#listtours").html(data);
			}
		});
		
	});
	
	$(".claa").click(function()
	{
		var tid = $(this).attr("tid");
		$("#tid").val(tid);
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