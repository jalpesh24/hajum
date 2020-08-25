@include('includes.newheader')
<div class="container">
<div class="breadcrumbs1">
<ol class="breadcrumb">
              <li class="breadcrumb-item"><i class="fa fa-home" aria-hidden="true"></i> <a href="{{ url('/newhome') }}">Home</a></li>
              <li class="breadcrumb-item active">Details View</li>
</ol>
</div>

  <div class="row">
    <div class="col-sm-12"> @if (session('status'))
      <div class="alert alert-success">{{ session('status') }}</div>
      @endif
       <div class="panel panel-default" id="panelbg">
         <div class="panel-heading" id="headerbg">
         @if (Auth::guest())              
         @else
	     @include('includes.minimenu')              
         @endif
        </div>
        <div class="panel-body">
			
			<div class="col-md-12">
			  @if(!empty($tour_detail))
             @foreach($tour_detail as $detailview)
			<div id="content">
<div id="printablediv">

    <table id="invoiceTable" style="max-width:600px;margin-top: 35px; margin-bottom: 35px;" width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
        <tbody><tr>
                        <td style="font-size: 0; padding: 12px; color: black; font-family: tahoma; text-transform: uppercase; letter-spacing: 4px;" valign="top" bgcolor="#38A870" align="center">
                <div style="font-size:16px;color:white;">
                    Your booking Status is <b class="wow flash animted animated animated" style="visibility: visible;">Paid</b>
                    <p style="color:white;letter-spacing: 2px; font-size: 10px; margin-top: 0px;" class="text-center">Booking details were sent {!! $detailview->email !!}</p>
                </div>
            </td>
                    </tr>
        <tr>
            <td style="font-size:0; padding: 2px;" valign="top" bgcolor="#E0F0FF" align="left">
                <div style="display:inline-block; max-width:100%; min-width:100px; vertical-align:top; width:100%;">
                    <table style="max-width:300px;" width="100%" cellspacing="0" cellpadding="0" border="0" align="left">
                        <tbody><tr>
				<td style="font-size: 0; padding: 5px; color: black; font-family: tahoma; text-transform: uppercase; letter-spacing: 4px;" valign="top" bgcolor="#E0F0FF" align="left">
                 <div style="font-size:16px;color:#;">
				 <p style="color:#123456;letter-spacing: 2px; font-size: 12px; margin-top: 0px;">Invoice Date : {!! $detailview->created_at !!}</p>
				 <p style="color:#123456;letter-spacing: 2px; font-size: 12px; margin-top: 0px;">Invoice Number : {!! $detailview->order_id !!}</p>
				 <p style="color:#123456;letter-spacing: 2px; font-size: 12px; margin-top: 0px;">Name : {!! $detailview->firstname !!} {!! $detailview->lastname !!}</p>
                 <p style="color:#123456;letter-spacing: 2px; font-size: 12px; margin-top: 0px;">Email: {!! $detailview->email !!}</p> 
                 <p style="color:#123456;letter-spacing: 2px; font-size: 12px; margin-top: 0px;">Phone: {!! $detailview->phone !!}</p>
				 </div>                             

							</td>
                        </tr>
                    </tbody></table>
                </div>
               
            </td>
        </tr>
           <tr style="height: 4px; width: 100%; float: left;background: #F8F8F8; background: -moz-linear-gradient(left, #f76570 0%, #f76570 8%, #f3a46b 8%, #f3a46b 16%, #f3a46b 16%, #ffd205 16%, #ffd205 24%, #ffd205 24%, #1bbc9b 24%, #1bbc9b 25%, #1bbc9b 32%, #14b9d5 32%, #14b9d5 40%, #c377e4 40%, #c377e4 48%, #f76570 48%, #f76570 56%, #f3a46b 56%, #f3a46b 64%, #ffd205 64%, #ffd205 72%, #1bbc9b 72%, #1bbc9b 80%, #14b9d5 80%, #14b9d5 80%, #14b9d5 89%, #c377e4 89%, #c377e4 100%); background: -webkit-gradient(linear, left top, right top, color-stop(0%,#f76570), color-stop(8%,#f76570), color-stop(8%,#f3a46b), color-stop(16%,#f3a46b), color-stop(16%,#f3a46b), color-stop(16%,#ffd205), color-stop(24%,#ffd205), color-stop(24%,#ffd205), color-stop(24%,#1bbc9b), color-stop(25%,#1bbc9b), color-stop(32%,#1bbc9b), color-stop(32%,#14b9d5), color-stop(40%,#14b9d5), color-stop(40%,#c377e4), color-stop(48%,#c377e4), color-stop(48%,#f76570), color-stop(56%,#f76570), color-stop(56%,#f3a46b), color-stop(64%,#f3a46b), color-stop(64%,#ffd205), color-stop(72%,#ffd205), color-stop(72%,#1bbc9b), color-stop(80%,#1bbc9b), color-stop(80%,#14b9d5), color-stop(80%,#14b9d5), color-stop(89%,#14b9d5), color-stop(89%,#c377e4), color-stop(100%,#c377e4)); /* background: -webkit-linear-gradient(left, #f76570 0%,#f76570 8%,#f3a46b 8%,#f3a46b 16%,#f3a46b 16%,#ffd205 16%,#ffd205 24%,#ffd205 24%,#1bbc9b 24%,#1bbc9b 25%,#1bbc9b 32%,#14b9d5 32%,#14b9d5 40%,#c377e4 40%,#c377e4 48%,#f76570 48%,#f76570 56%,#f3a46b 56%,#f3a46b 64%,#ffd205 64%,#ffd205 72%,#1bbc9b 72%,#1bbc9b 80%,#14b9d5 80%,#14b9d5 80%,#14b9d5 89%,#c377e4 89%,#c377e4 100%); */ background: -o-linear-gradient(left, #f76570 0%,#f76570 8%,#f3a46b 8%,#f3a46b 16%,#f3a46b 16%,#ffd205 16%,#ffd205 24%,#ffd205 24%,#1bbc9b 24%,#1bbc9b 25%,#1bbc9b 32%,#14b9d5 32%,#14b9d5 40%,#c377e4 40%,#c377e4 48%,#f76570 48%,#f76570 56%,#f3a46b 56%,#f3a46b 64%,#ffd205 64%,#ffd205 72%,#1bbc9b 72%,#1bbc9b 80%,#14b9d5 80%,#14b9d5 80%,#14b9d5 89%,#c377e4 89%,#c377e4 100%); background: -ms-linear-gradient(left, #f76570 0%,#f76570 8%,#f3a46b 8%,#f3a46b 16%,#f3a46b 16%,#ffd205 16%,#ffd205 24%,#ffd205 24%,#1bbc9b 24%,#1bbc9b 25%,#1bbc9b 32%,#14b9d5 32%,#14b9d5 40%,#c377e4 40%,#c377e4 48%,#f76570 48%,#f76570 56%,#f3a46b 56%,#f3a46b 64%,#ffd205 64%,#ffd205 72%,#1bbc9b 72%,#1bbc9b 80%,#14b9d5 80%,#14b9d5 80%,#14b9d5 89%,#c377e4 89%,#c377e4 100%); background: linear-gradient(to right, #f76570 0%,#f76570 8%,#f3a46b 8%,#f3a46b 16%,#f3a46b 16%,#ffd205 16%,#ffd205 24%,#ffd205 24%,#1bbc9b 24%,#1bbc9b 25%,#1bbc9b 32%,#14b9d5 32%,#14b9d5 40%,#c377e4 40%,#c377e4 48%,#f76570 48%,#f76570 56%,#f3a46b 56%,#f3a46b 64%,#ffd205 64%,#ffd205 72%,#1bbc9b 72%,#1bbc9b 80%,#14b9d5 80%,#14b9d5 80%,#14b9d5 89%,#c377e4 89%,#c377e4 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f76570', endColorstr='#c377e4',GradientType=1 );"></tr>
        <tr>
            <td style="padding: 35px 35px 20px 35px; background-color: #F8F8F8;" bgcolor="#ffffff" align="center">
                <table style="max-width:600px;" width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                    <!--<tr>
                        <td align="center" style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 24px;">
                         <table cellspacing="0" cellpadding="0" border="0" align="right">
                            <tr>
                                <td style="font-family: Tahoma; font-size: 18px; font-weight: 400;">
                                    <p style="font-size: 14px; font-weight: 400; margin: 0; color: #002141;"><a href="https://www.phptravels.net/" target="_blank" style="color: #002141; letter-spacing: 5px; font-size: 22px; text-align: right; text-decoration: none;">PHPTRAVELS &nbsp;</a></p>
                                </td>
                            </tr>
                         </table>
                        </td>
                    </tr>-->
                    <tbody><tr>
                        <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 5px;" align="left">
                           <!-- <p style="font-size: 16px; font-weight: 400; line-height: 24px; color: #777777;"></p>-->
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top: 20px;" align="left">
                            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                <tbody><tr>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 800; line-height: 24px; padding: 5px;" width="75%" bgcolor="#eeeeee" align="left">
                                        {!! $detailview->tour_name !!} <i class="star star icon-star-5"></i><i class="star star icon-star-5"></i><i class="star star icon-star-5"></i><i class="star star icon-star-5"></i><i class="star star icon-star-5"></i>                                    </td>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 800; line-height: 24px; padding: 5px;" width="25%" bgcolor="#eeeeee" align="left">
                                        <small>{!! $detailview->city_location !!}</small>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="75%" align="left">
                                        <img src="{{ url('/tours_images/') }}{!! '/'.$detailview->tour_image !!}" class="img-responsive" title="{!! ucwords(strtolower($detailview->tour_name)) !!}" alt="{!! ucwords(strtolower($detailview->tour_name)) !!}" id="tourimage_{!! $detailview->tour_id !!}" />
                                    </td>
                                </tr>


                                

                                                                                                <tr>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="75%" align="left">
                                        {!! $detailview->days !!} Nights Accomodation                                    </td>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="25%" align="left">
                                        {!! $detailview->price_per_person !!}                                    </td>
                                </tr>
                                
                                <!--<tr>
                                    <td width="75%" align="left" style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;">
                                                                            </td>
                                    <td width="25%" align="left" style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;">
                                                                            </td>
                                </tr>-->

                                <!-- Start Tours Section -->
                                
                                <tr>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="75%" align="left">
                                        Check in                                    </td>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="25%" align="left">
                                        {!! $detailview->fromdate !!}                              </td>
                                </tr>
                                <tr>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="75%" align="left">
                                        Adults  {!! $detailview->no_of_persons !!} RS {!! $detailview->adprice !!}                                    </td>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="25%" align="left">
                                         Rs{!! ($detailview->adprice * $detailview->no_of_persons) !!}                          </td>
                                </tr>
								<tr>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="75%" align="left">
                                        Child  {!! $detailview->no_of_child !!} RS {!! $detailview->cdprice !!}                                    </td>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="25%" align="left">
                                         Rs{!! ($detailview->cdprice * $detailview->no_of_child) !!}                          </td>
                                </tr>
                                


                                <!-- Guest Info Table -->
                                                                                                <!-- End Guest Info Table -->
                                                                <!-- End Tours Section -->





                                <!-- Start Cars Section -->
                                                                <!-- End Cars Section -->

                                </tbody></table><table class="table table-bordered" style="width:100%;background: #F5F5F5; padding: 10px;margin-top:25px;margin-bottom:25px">
                                    <thead style="text-transform:uppercase;background: #e1dddd;">
                                        <tr style="width:100%">
                                    
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="33.3%" align="center">
                                         <strong>Tax &amp; VAT</strong>
                                    </td>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="33.3%" align="center">
                                         <strong>Total Amount</strong>
                                    </td>
                               </tr>
                                  </thead>
                                    <tbody>
                                 <tr style="width:100%">
                                  
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="33.3%" align="center">
                                        Rs.0                                 </td>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="33.3%" align="center">
                                        Rs {!! $detailview->amount !!}                               </td>
                                </tr>
                                </tbody>
                                </table>
                                
                                
                            </td></tr></tbody></table>
                        </td>
                    </tr>
                    <tr>
                    </tr><tr>
                        <td style="padding: 10px 37px;; background-color: #F8F8F8;" bgcolor="#ffffff" align="center">
                            <table style="max-width:600px;" width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                                <tbody><tr>
                                   
                                    <td style="color:#002141;width:550px" align="left">
                                        <p style="font-size: 14px;font-family: tahoma; font-weight: 800; line-height: 0px; color: #002141;    margin-top: 5px;"><div class="copy">© 2018 All rights reserved. Trip India</div></p>
                                       
                                    </td>
                                </tr>
                            </tbody></table>
                        </td>
                    </tr>
                    
                </tbody></table>
            
        
    

</div>
</div>
           @endforeach
              @endif
            
            
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
@include('includes.newfooter')
<script src="{{ url('newhtml/js/jquery.js') }}"></script>
<script src="{{ url('newhtml/js/jquery-ui.js') }}"></script>
<script src="{{ url('newhtml/js/jquery-migrate-1.js') }}"></script>
<script src="{{ url('newhtml/js/superfish.js') }}"></script>
<script src="{{ url('newhtml/js/select2.js') }}"></script>
<script src="{{ url('newhtml/js/jquery_002.js') }}"></script>
<script src="{{ url('newhtml/js/jquery_006.js') }}"></script>
<script src="{{ url('newhtml/js/jquery_003.js') }}"></script>
<script src="{{ url('newhtml/js/jquery_007.js') }}"></script>
<script src="{{ url('newhtml/js/scripts.js') }}"></script>
<script src="{{ url('newhtml/js/owl.carousel.min.js') }}"></script>
<script src="{{ url('newhtml/js/bootstrap.min.js') }}"></script>

<a href="#" id="toTop" style="display: inline;"><span id="toTopHover"></span></a><div id="ui-datepicker-div" class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all"></div></body></html>