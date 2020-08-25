@include('includes.newheader')

<div id="about">
  <div class="container">
  <div class="breadcrumbs1">
<ol class="breadcrumb">
              <li class="breadcrumb-item"><i class="fa fa-home" aria-hidden="true"></i> <a href="{{ url('/newhome') }}">Home</a></li>
              <li class="breadcrumb-item active">Review</li>
</ol>
</div>
    <div class="title1">Review</div>
<div class="col-md-12">
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
      </section>
</div>

<br/>


  </div>
</div>









<div class="bot1">
  
  @include('includes.newfooter')

    </div>
  </div>
</div>

<div class="bot2">
  <div class="container">
    <ul class="menu_bot clearfix">
      <li><a href="#">Privacy Policy</a></li>
      <li><a href="#">About Us</a></li>
      <li><a href="#">Support</a></li>
      <li><a href="#">FAQ</a></li>
      <li><a href="#">Blog</a></li>
      <li><a href="#">Forum</a></li>
    </ul>
    <div class="copy">© 2017 All rights reserved. Travel Company</div>
  </div>
</div>


</div>

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
<a href="#" id="toTop" style="display: inline;"><span id="toTopHover"></span></a><div id="ui-datepicker-div" class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all"></div></body></html>