@include('includes.newheader')

 <div class="container">
<div class="breadcrumbs1">
<ol class="breadcrumb">
              <li class="breadcrumb-item"><i class="fa fa-home" aria-hidden="true"></i> <a href="{{ url('/newhome') }}">Home</a></li>
              <li class="breadcrumb-item active">Contact Us</li>
</ol>
</div>
    <div class="title1">Contact Us</div>
<section id="contact" style="">
        <div class="about_our_company" style="margin-bottom: 20px;">
          <h4 style="color:#fff;">Write Your Message</h4>
          <div class="titleline-icon"></div>
        </div>
        <div class="row">
          <div class="col-md-8">
            <form name="sentMessage" id="contactForm" action="" method="post">
              {{ csrf_field() }}
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <input type="text" class="form-control" placeholder="Your Name *" id="txt_contact_name" name="txt_contact_name" required="" data-validation-required-message="Please enter your name.">
                    <p class="help-block text-danger"></p>
                  </div>
                  <div class="form-group">
                    <input type="email" class="form-control" placeholder="Your Email *" id="txt_contact_email" name="txt_contact_email" required="" data-validation-required-message="Please enter your email address.">
                    <p class="help-block text-danger"></p>
                  </div>
                  <div class="form-group">
                    <input type="tel" class="form-control" placeholder="Your Phone *" id="txt_contact_phone" name="txt_contact_phone" required="" data-validation-required-message="Please enter your phone number.">
                    <p class="help-block text-danger"></p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <textarea class="form-control" rows="5" placeholder="Your Message *" id="txt_contact_message" name="txt_contact_message" required="" data-validation-required-message="Please enter a message."></textarea>
                    <p class="help-block text-danger"></p>
                  </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-lg-3">
                  <div id="success"></div>
                  <button type="submit" id="btn_contactus_send" name="btn_contactus_send" class="btn btn-primary">Send Message</button>
                </div>
              </div>
            </form>
          </div>
          <div class="col-md-4"> <strong><i class="fa fa-map-marker"></i> Address</strong><br>
            <p>B-29 , Ansal Chambers II,<br />
              Bhikaji Cama Place,<br />
              New Delhi - 110066.</p>
            <ul>
              <li>+011-26162705/26162706</li>
              <li>+ 91 9910329129/9650119494</li>            
            </ul>
            <p> <strong>Regional Marketting &amp; Sales Office:(East)</strong><br />
              42 F, Babubagan, DHAKURIA, KOLKATA-700031<br />
              Mobile : +91-8860049752 / 9311007374<br />
              Phone : +91-33-242 36891<br />
              Email : sales@tripindiahotels.com<br />
            </p>
            <p> <strong>JASH TOUR &quot;N&quot; TRAVELS</strong><br />
              GROUND FLOOR, PARADISE TOWER, NEAR MCDONALD,<br />
              OPP ALOK HOTEL,THANE (W), 400601<br />
              Mobile : +91 9702363344<br />
              Phone : 022 - 25419840<br />
              Email : <a href="mailto:jashtour@yahoo.com" target="_blank">jashtour@yahoo.com</a><br />
            </p>
            <p> <strong>SS Holidays Bangalore</strong><br />
              190/5 Banswadi main road,<br />
              Subbana Paliya, M S Nagar Post<br />
              Mobile : 08041687777, 9036669995</p>
            <p style="color:#fff;"><strong><i class="fa fa-phone"></i> Phone Number</strong><br>
              (+8801)7123456</p>
            <p style="color:#fff;"> <strong><i class="fa fa-envelope"></i> Email Address</strong><br>
              Email@info.com</p>
            <p></p>
          </div>
        </div>
      </section>

<br/>


  </div>

  
  @include('includes.newfooter')

   
<script src="{{ url('newhtml/js/bootstrap.js') }}"></script>
<script src="{{ url('newhtml/js/bootstrap.min.js') }}"></script>
<script src="{{ url('newhtml/js/jqBootstrapValidation.js') }}"></script>
<script src="{{ url('newhtml/js/clean-blog.min.js') }}"></script>
<script src="{{ url('newhtml/js/jquery.bootcomplete.js') }}"></script>
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
		var url = "{{ url('/newcontact') }}";
		
		$.ajax(
		{
			url: url,
			type: 'post',
			async: false,
			data: { "_token":token,"name":name,"email":email,"phone":phone,"message":message },
			success: function (data) 
			{
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
<a href="#" id="toTop" style="display: inline;"><span id="toTopHover"></span></a><div id="ui-datepicker-div" class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all"></div></body></html>