@include('includes.newheader')
<div id="about">
  <div class="container">
  <div class="breadcrumbs1">
<ol class="breadcrumb">
              <li class="breadcrumb-item"><i class="fa fa-home" aria-hidden="true"></i> <a href="{{ url('/newhome') }}">Home</a></li>
              <li class="breadcrumb-item active">Quality</li>
</ol>
</div>

    <div class="title1">Quality</div>
<div class="col-md-12">
     <p align="justify"> <img src="{{ url('newhtml/images/quality-policy.png') }}" align="left" style="padding-right:10px">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe nostrum ullam eveniet pariatur voluptates odit, fuga atque ea nobis sit soluta odio, adipisci quas excepturi maxime quae totam ducimus consectetur?
        
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius praesentium recusandae illo eaque architecto error, repellendus iusto reprehenderit, doloribus, minus sunt. Numquam at quae voluptatum in officia voluptas voluptatibus, minus!
        
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum molestiae debitis nobis, quod sapiente qui voluptatum, placeat magni repudiandae accusantium fugit quas labore non rerum possimus, corrupti enim modi! Et. </p>
      <p align="justify">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. </p>
      <p align="justify"> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe nostrum ullam eveniet pariatur voluptates odit, fuga atque ea nobis sit soluta odio, adipisci quas excepturi maxime quae totam ducimus consectetur?
        
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius praesentium recusandae illo eaque architecto error, repellendus iusto reprehenderit, doloribus, minus sunt. Numquam at quae voluptatum in officia voluptas voluptatibus, minus!
        
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum molestiae debitis nobis, quod sapiente qui voluptatum, placeat magni repudiandae accusantium fugit quas labore non rerum possimus, corrupti enim modi! Et. </p>
      <p align="justify">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. </p>
   

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