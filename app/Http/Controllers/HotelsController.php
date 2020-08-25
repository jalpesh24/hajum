<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Hotels;
use DB;
use Auth;
use Session;

use Mailgun\Mailgun;

class HotelsController extends Controller
{
	// SEARCH HOTEL NAMES OR LOCATIONS FOR INDEX PAGE
	public function gethotels(Request $request)
	{
		
		$query = $request->get("query");
		
		$city_location = \DB::table('hotels')->select('city_location')->where('city_location', 'like', '%'.$query.'%')->where('hotel_status',1)->groupBy('city_location')->orderBy('city_location', 'asc')->get();
		$hotels = array(); $i = 1;
		echo "["; $str = '';
		foreach($city_location as $location)
		{
			$hotels['id']= $query;
			$hotels['label'] = ucwords(strtolower($location->city_location));
			$str .= json_encode($hotels).",";
			$i++;
		}
		$hotel_name = \DB::table('hotels')->select('hotel_name')->where('hotel_name', 'like', '%'.$query.'%')->where('hotel_status',1)->groupBy('hotel_name')->orderBy('hotel_name', 'asc')->get();
		foreach($hotel_name as $name)
		{
			$hotels['id']= $query;
			$hotels['label'] = ucwords(strtolower($name->hotel_name));
			$str .= json_encode($hotels).",";
			$i++;
		}
		$str = substr($str,0,strlen($str)-1);
		echo $str."]"; exit();
	}
	
	// SEARCH HOTELS PAGE
	public function searchhotels(Request $request) 
	{
		$chilage = '';
		if(isset($_POST['childage']) && !empty($_POST['childage'])) {
		$chilage = implode(",",$_POST['childage']);
		Session::put('chilage',$chilage);
		}
		elseif(Session::has('chilage'))
		{
			Session::put('chilage','');
		}
		
		$fromdate = date("Y-m-d", strtotime($request->checkin));
		$todate = date("Y-m-d", strtotime($request->checkout)); 
		$room = $request->totroom;
		
		
		if($request->hotel_name_location != '' && $request->checkin != '' && $request->checkout != '' && $request->totroom != '' && $request->totadult != '' && $request->totchild != ''  ) {
			$hotel_name =  $request->hotel_name_location;
			$fromdate = date("Y-m-d", strtotime($request->checkin));
			  $todate = date("Y-m-d", strtotime($request->checkout)); 
			  $room = $request->totroom;
			  $adults = $request->totadult;
			  $childs = $request->totchild;
			$to = \Carbon\Carbon::createFromFormat('Y-m-d', $fromdate);
			$from = \Carbon\Carbon::createFromFormat('Y-m-d', $todate);	
			$hotels_arr = \DB::select("SELECT
h.*,
min(hr.`hotel_max_adult`) as `min_adults`,
max(hr.`hotel_max_adult`) as `max_adults`,
max(hr.`hotel_max_child`) as `max_childs`,
min(hr.`hotel_max_child`) as `min_childs`,
COUNT(hr.`hotel_room_id`) AS `Total_Rooms`
FROM
`hotels` h
LEFT JOIN `hotels_roomdata` hr ON h.`hotel_id` = hr.`hotel_id`
WHERE `city_location` = '$hotel_name' AND (hr.room_fromdate >= '$fromdate' AND hr.room_todate <= '$todate' )
GROUP BY h.`hotel_id` HAVING `Total_Rooms` BETWEEN $room AND `Total_Rooms` AND `max_adults` BETWEEN $adults AND `max_adults` AND `max_childs` BETWEEN $childs AND `max_childs`");
			
		}
		else if($request->hotel_name_location != '' && $request->checkin != '' && $request->checkout != '' && $request->totroom != '' && $request->totadult != '' ) {
			$hotel_name =  $request->hotel_name_location;
			$fromdate = date("Y-m-d", strtotime($request->checkin));
			  $todate = date("Y-m-d", strtotime($request->checkout));
			  $room = $request->totroom;
			  $adults = $request->totadult;
			  $childs = $request->totchild;
			$to = \Carbon\Carbon::createFromFormat('Y-m-d', $fromdate);
			$from = \Carbon\Carbon::createFromFormat('Y-m-d', $todate);	
			

		$hotels_arr = \DB::select("SELECT
h.*,
min(hr.`hotel_max_adult`) as `min_adults`,
max(hr.`hotel_max_adult`) as `max_adults`,
max(hr.`hotel_max_child`) as `max_childs`,
min(hr.`hotel_max_child`) as `min_childs`,
COUNT(hr.`hotel_room_id`) AS `Total_Rooms`
FROM
`hotels` h
LEFT JOIN `hotels_roomdata` hr ON h.`hotel_id` = hr.`hotel_id`
WHERE `city_location` = '$hotel_name' AND (hr.room_fromdate >= '$fromdate' AND hr.room_todate <= '$todate' )
GROUP BY h.`hotel_id` HAVING `Total_Rooms` BETWEEN $room AND `Total_Rooms` AND `max_adults` BETWEEN $adults AND `max_adults`");
			
		}		
		else if($request->hotel_name_location != '') {
			  $hotel_name =  $request->hotel_name_location;			  
		
		$hotels_arr = \DB::table('hotels')		
		->Where('hotels.city_location','like', '%'.$hotel_name.'%')		
		->where('hotels.hotel_status',1)->orderBy('hotels.hotel_id', 'asc')->get()->toArray();			
		}
		else{
			$hotel_name =  $request->hotel_name_location_id;
		}
		
		$hotels = array();	
		
		if(count($hotels_arr) > 0)
		{
			$h=0;
			foreach($hotels_arr as $hotel_detail)
			{
				
				$hotels[$h]=$hotel_detail;
				$hotels_roomdata_arr = \DB::table('hotels_roomdata')->where('hotel_id',$hotel_detail->hotel_id)->orderBy('hotel_saleprice', 'asc')->offset(0)->limit(1)->get()->toArray();
				if(count($hotels_roomdata_arr) > 0)
				{
					foreach($hotels_roomdata_arr as $room_detail)
					{
						$hotels[$h]->hotels_roomdata=$room_detail;
					}
				}
				$h++;
			}
			//echo '<pre>'; print_r($hotels); exit();
		}
			$adults = $request->totadult;
			$childs = $request->totchild;
		$room = $request->totroom;
		$fromdate = date("Y-m-d", strtotime($request->checkin));
		$todate = date("Y-m-d", strtotime($request->checkout)); 
			  
		return view('hotels_search',array('chilage'=>$chilage,'room'=>$room,'fromdate'=>$fromdate,'todate'=>$todate,'adults'=>$adults,'childs'=>$childs,'hotels'=>$hotels,'name_location'=>$hotel_name));
	}
	
	// Hotel PACKAGE Booked
	public function hotelbooked()
	{
		if (Auth::check())
		{
			$hotelbooked = \DB::table('orders')
						->select('*','orders.status as orderstatus')
						->join('hotels', 'hotels.hotel_id', '=', 'orders.hotel_id')						
						->where('hotels.user_id',Auth::user()->id)
						->orderBy('orders.hotel_id', 'desc')->get();
				
			return view('hotels.hotels_booked',array('hotelbooked'=>$hotelbooked));
		}
		else {
			return redirect()->intended(route('mybooking'));
		}
	}
	
	// SEARCH HOTELS (AJAX)
	public function listsearchhotels(Request $request) 
	{
		$hotel_name = '';
		if($request->hotel_name != '') {
			$hotel_name =  $request->hotel_name;
		}
		
		$hotel_price_start = 0; $hotel_price_end = 0; $hotels_prices_arr = array();
		if($request->hotel_price  != '')
		{
			$prices_arr = explode(",",$request->hotel_price);
			$p = 1; $total=count($prices_arr);
			foreach($prices_arr as $prs)
			{
				$prices = explode("-",$prs);
				if($p==1 && $total == 1) 
				{
					$hotel_price_start = $prices[0];
					$hotel_price_end = $prices[1];
				}
				elseif($p==1 && $total > 1)  {
					$hotel_price_start = $prices[0];
				}
				elseif($p == $total) {
					$hotel_price_end = $prices[1];
				}
				$p++;
			}
			$hotels_prices_arr = \DB::table('hotels_roomdata')->where('hotel_id',$hotel_detail->hotel_id)->whereBetween('hotel_saleprice', [$hotel_price_start, $hotel_price_end])->orderBy('hotel_saleprice', 'asc')->offset(0)->limit(1)->get()->toArray();
		}
		
		$hotels = array();
		$hotels_arr = \DB::table('hotels')->where('hotel_name','like', '%'.$hotel_name.'%')->orWhere('city_location','like', '%'.$hotel_name.'%')->where('hotel_status',1)->orderBy('hotel_id', 'asc')->get()->toArray();
		if(count($hotels_arr) > 0)
		{
			if($hotel_price_start > 0 && $hotel_price_end > 0 && count($hotels_prices_arr) > 0)
			{
				$h=0;
				foreach($hotels_arr as $hotel_detail)
				{
					$hotels[$h]= $hotel_detail;
					if($hotel_price_start > 0 && $hotel_price_end > 0) {
						$hotels_roomdata_arr = \DB::table('hotels_roomdata')->where('hotel_id',$hotel_detail->hotel_id)->whereBetween('hotel_saleprice', [$hotel_price_start, $hotel_price_end])->orderBy('hotel_saleprice', 'asc')->offset(0)->limit(1)->get()->toArray();
					}
					
					if(count($hotels_roomdata_arr) > 0)
					{
						foreach($hotels_roomdata_arr as $room_detail)
						{
							$hotels[$h]->hotels_roomdata=$room_detail;
						}
					}
					$h++;
				}
			}
			else 
			{
				$h=0;
				foreach($hotels_arr as $hotel_detail)
				{
					$hotels[$h]= $hotel_detail;
					$hotels_roomdata_arr = \DB::table('hotels_roomdata')->where('hotel_id',$hotel_detail->hotel_id)->orderBy('hotel_saleprice', 'asc')->offset(0)->limit(1)->get()->toArray();
				
					if(count($hotels_roomdata_arr) > 0)
					{
						foreach($hotels_roomdata_arr as $room_detail)
						{
							$hotels[$h]->hotels_roomdata=$room_detail;
						}
					}
					$h++;
				}
			}	
		}
		
		$room =1;
		$adults =1;
		$childs = 0;
		$fromdate = date("Y-m-d");
		$todate = date('Y-m-d', strtotime("+1 days"));
		
		echo '<input type="hidden" name="total_hotels" id="total_hotels" value="'.count($hotels).'" />';
		foreach($hotels as $hotel)
		{
			$hotelroom = explode(',', $hotel->hotel_image); 
			$hotleimages = $hotelroom[0];
			
			echo '<div class="payment-box2">
				<div class="row"><div class="col-md-4 rest-img">';
				if($hotel->hotel_image != '') 
					echo '<img src="'.url('/hotel_images/'.$hotleimages).'" class="img-thumbnail"/>';
				else
					echo '<div class="col-md-4" style="padding-left:10px;"><img src="'.url('/hotel_images/2.jpg').'" class="img-thumbnail"/></div>';
				
				echo ' </div>
				<div class="col-md-5">
					<div><strong>'.$hotel->hotel_name.'</strong></div>
					<div>'.$hotel->hotel_address.', '.$hotel->city_location.'</div>
					<div>Star Rating</div>
					<div>'.$hotel->hotel_amenities.'</div>
				</div>
				<div class="col-md-3">
					<p><label>Per person<br />';
						if(isset($hotel->hotels_roomdata)) {
							echo '<strike>'.$hotel->hotels_roomdata->hotel_price.'</strike><strong>'.$hotel->hotels_roomdata->hotel_saleprice.'</strong>';
						}	
						echo '</label>
					</p>
					<div style="margin-top:20px;">';
					if($hotel->hotel_status == '1'){
						echo '<a href="'.url('/hoteldetail/'.$hotel->hotel_id.'?adults='.$adults.'&childs='.$childs.'&room='.$room.'&fromdate='.$fromdate.'&todate='.$todate).'" class="btn-danger btn btn-md">Choose Room</a>';
					}
					else{
						echo '<a href="#" class="btn-danger btn btn-md">Not Active</a>';
					}
					echo '</div>
				</div>
			</div></div>';			
		}
		exit();
	}
	
	// HOTEL DETAIL 
	public function hoteldetail(Request $request)
	{
		$chilage= array();
		if(Session::has('chilage'))
		{
			$chilage = explode(',',Session::get('chilage'));
		}
				
		if($request->hid != '' && $request->hid > 0)
		{
			$hotel_id = $request->hid;
			
			$hotels = new Hotels();
			$hotel_detail = $hotels->getHotelinfo($hotel_id);
			$hotel_rooms = $hotels->getHotelRooms($hotel_id);
			
			if($request->fromdate != '') {
				$fromdate = date("Y-m-d", strtotime($request->fromdate));
			}
			else { $fromdate = date("Y-m-d"); }
		
			if($request->todate != '') {
				$todate = date("Y-m-d", strtotime($request->todate));
			}
			else { $todate = date('Y-m-d', strtotime("+1 days")); }
			
			$rooms = array();
			if($fromdate != '' && $todate != '')
			{		
			
			
			foreach($hotel_rooms as $room)
			{
				$check_room = \DB::table('orders')->where('hotel_id',$hotel_id)->where('hotel_room_id',$room->hotel_room_id)->whereBetween('hotel_checkin_date', [$fromdate, $todate])->whereBetween('hotel_chekout_date', [$fromdate, $todate])->get()->count();
				
				if(empty($check_room)) {
					$rooms[] = $room;
				}
			}
			}
		
			return view('hotel_detail',array('chilage'=>$chilage,'fromdate'=>$fromdate,'todate'=>$todate,'hotel_detail'=>$hotel_detail,'hotel_rooms'=>$rooms));
		}
	}
	
	// SELECT HOTEL date filter BOOKING (CHEKOUT)
	public function hoteldatefilter(Request $request) 
	{
		$hotel_id = $request->hotel_id;
		if($request->checkin != '' && $request->checkout != '' && $request->rooms != '' && $request->adults != '' && $request->childs != ''  )
		{
			  $fromdate = date("Y-m-d", strtotime($request->checkin));
			  $todate = date("Y-m-d", strtotime($request->checkout)); 
			  $room = $request->rooms;
			  $adults = $request->adults;
			  $childs = $request->childs;
			  $to = \Carbon\Carbon::createFromFormat('Y-m-d', $fromdate);
			  $from = \Carbon\Carbon::createFromFormat('Y-m-d', $todate);
			
			 $hotelsdatefilter = \DB::select("select * from hotels_roomdata where hotel_id='$hotel_id' and DATE(room_fromdate) BETWEEN '$fromdate' AND '$todate' ORDER BY `hotel_saleprice` ASC LIMIT 1");
			
		}

		$hotels = array();	
		
		if(count($hotelsdatefilter) > 0)
		{
			$h=0;
			foreach($hotelsdatefilter as $hotel_detail)
			{
				
				$hotels[$h]=$hotel_detail;
				$hotels_roomdata_arr = \DB::table('hotels_roomdata')->where('hotel_room_id',$hotel_detail->hotel_room_id)->orderBy('hotel_saleprice', 'asc')->offset(0)->limit(1)->get()->toArray();
				if(count($hotels_roomdata_arr) > 0)
				{
					foreach($hotels_roomdata_arr as $room_detail)
					{
						$hotels[$h]->hotels_roomdata=$room_detail;
						
					}
				}
				$h++;
			}
			 $roomprice = $hotels_roomdata_arr[0]->hotel_price;
			 $sellprice = $hotels_roomdata_arr[0]->hotel_saleprice;
			 
			$date1=date_create($fromdate);
			$date2=date_create($todate);
			$diff=date_diff($date1,$date2);
			$days = $diff->format("%a");

			//echo '<pre>'; print_r($hotels); exit();
			//return response()->json(['success' => true, 'message' => "We have no availability here for the dates you are looking. Try changing dates or number of guests."]);
			return response()->json(array(
                    'success' => true,
                    'price'   => $roomprice,
					'sprice' => $sellprice,
					'days' => $days
					
                )); 
		}
		else{
		
		 return response()->json(['success' => false, 'message' => "We have no availability here for the dates you are looking. Try changing dates or number of guests."]);
		//return response()->json(['success' => true, 'price' => $hotels[0]->hotel_id]);
		
	}	
		
	}
	
	//  hoteladultchildfilter function
	public function hoteladultchildfilter(Request $request) 
	{
		$hotel_id = $request->hotel_id;
		if($request->checkin != '' && $request->checkout != '' && $request->rooms != '' && $request->adults != '' && $request->childs != ''  )
		{
			  $fromdate = date("Y-m-d", strtotime($request->checkin));
			  $todate = date("Y-m-d", strtotime($request->checkout)); 
			  $room = $request->rooms;
			  $adults = $request->adults;
			  $childs = $request->childs;
			  $to = \Carbon\Carbon::createFromFormat('Y-m-d', $fromdate);
			  $from = \Carbon\Carbon::createFromFormat('Y-m-d', $todate);	
			
			$hotelsdatefilter = \DB::select("SELECT
h.*,
min(hr.`hotel_max_adult`) as `min_adults`,
max(hr.`hotel_max_adult`) as `max_adults`,
max(hr.`hotel_max_child`) as `max_childs`,
min(hr.`hotel_max_child`) as `min_childs`,
COUNT(hr.`hotel_room_id`) AS `Total_Rooms`
FROM
`hotels` h
LEFT JOIN `hotels_roomdata` hr ON h.`hotel_id` = hr.`hotel_id`
WHERE (hr.room_fromdate >= '$fromdate' AND hr.room_todate <= '$todate' ) AND h.`hotel_id` = $hotel_id
GROUP BY h.`hotel_id` HAVING `Total_Rooms` BETWEEN $room AND `Total_Rooms` AND `max_adults` BETWEEN $adults AND `max_adults` AND `max_childs` BETWEEN $childs AND `max_childs`");
			
		}
		
//echo "<pre>";print_r($hotelsdatefilter);exit;
		$hotels = array();	
		$all_data = array();
		if(count($hotelsdatefilter) > 0)
		{
			$h=0;
			foreach($hotelsdatefilter as $hotel_detail)
			{
				
				$hotels[$h]=$hotel_detail;
				$hotels_roomdata_arr = \DB::table('hotels_roomdata')->where('hotel_id',$hotel_detail->hotel_id)->orderBy('hotel_saleprice', 'asc')->offset(0)->limit(1)->get()->toArray();
				if(count($hotels_roomdata_arr) > 0)
				{
					foreach($hotels_roomdata_arr as $room_detail)
					{
						$hotels[$h]->hotels_roomdata=$room_detail;
						
					}
				}
				$h++;
			}
			 $roomprice = $hotels_roomdata_arr[0]->hotel_price;
			 $sellprice = $hotels_roomdata_arr[0]->hotel_saleprice;
			 
			$date1=date_create($fromdate);
			$date2=date_create($todate);
			$diff=date_diff($date1,$date2);
			$days = $diff->format("%a");

			//echo '<pre>'; print_r($hotels); exit();
			//return response()->json(['success' => true, 'message' => "We have no availability here for the dates you are looking. Try changing dates or number of guests."]);
			return response()->json(array(
                    'success' => true,
                    'price'   => $roomprice,
					'sprice' => $sellprice,
					'days' => $days
					
                )); 
		}
		else{
		
		 return response()->json(['success' => false, 'message' => "We have no availability here for the dates you are looking. Try changing dates or number of guests."]);
		//return response()->json(['success' => true, 'price' => $hotels[0]->hotel_id]);
		
	}	
		
	
}
	// SELECT HOTEL BOOKING (CHEKOUT)
	public function hotelcheckoutselect(Request $request) 
	{
		
		$hotelid=$request->hid; 
		$roomid=$request->hrid;
		$chilage= array();
		if(Session::has('chilage'))
		{
			$chilage = explode(',',Session::get('chilage'));
		}
		
		if($request->fromdate != '') {
				$fromdate = date("Y-m-d", strtotime($request->fromdate));
			}
			else { $fromdate = ''; }
			
			if($request->todate != '') {
				$todate = date("Y-m-d", strtotime($request->todate));
			}
			else { $todate = ''; }

		/* if (Auth::check()) 
		{ */
			@session_start();
			
				$hotel = \DB::table('hotels')->where('hotel_id', $hotelid)->get();
				$hotel_room = \DB::table('hotels_roomdata')->where('hotel_room_id', $roomid)->get();
				
				return view('hotel-checkoutselect',array('chilage'=>$chilage,'fromdate'=>$fromdate,'todate'=>$todate,'hotel'=>$hotel,'hotel_room'=>$hotel_room));
			
		/*}
		else {
			return redirect('/login');
		}*/
	}
	
	// HOTEL BOOKING (CHEKOUT)
	public function hotelcheckout(Request $request) 
	{
		$chilage= array();
		if(Session::has('chilage'))
		{
			$chilage = explode(',',Session::get('chilage'));
		}
		
		if($request->fromdate != '') {
				$fromdate = date("Y-m-d", strtotime($request->fromdate));
			}
			else { $fromdate = ''; }
			
			if($request->todate != '') {
				$todate = date("Y-m-d", strtotime($request->todate));
			}
			else { $todate = ''; }

		/* if (Auth::check()) 
		{ */
			@session_start();
			if(Session::has('order_hotel_id') && Session::has('order_hotel_roomid')) 
			{
				$hotel = \DB::table('hotels')->where('hotel_id', Session::get('order_hotel_id'))->get();
				$hotel_room = \DB::table('hotels_roomdata')->where('hotel_room_id', Session::get('order_hotel_roomid'))->get();
				
				return view('hotel-checkout',array('chilage'=>$chilage,'fromdate'=>$fromdate,'todate'=>$todate,'hotel'=>$hotel,'hotel_room'=>$hotel_room));
			}
			else {
				return back();
			}
		/*}
		else {
			return redirect('/login');
		}*/
	}
	
	// NEW HOTEL BOOKING (CHEKOUT)
	public function newhotelcheckout(Request $request) 
	{
		$chilage= array();
		if(Session::has('chilage'))
		{
			$chilage = explode(',',Session::get('chilage'));
		}
		
		if($request->fromdate != '') {
				$fromdate = date("Y-m-d", strtotime($request->fromdate));
			}
			else { $fromdate = ''; }
			
			if($request->todate != '') {
				$todate = date("Y-m-d", strtotime($request->todate));
			}
			else { $todate = ''; }
		/*if (Auth::check()) 
		{*/
			@session_start();
			$currentuid = Auth::user()->id; 
			$user_check = DB::table('users')->where('id',$currentuid)->where('ticketit_agent',1)->get()->first();
			if(!empty($user_check))
				{
					// GET USER
					$curentid = $user_check->id;
					$agentid = $user_check->ticketit_agent;
					if($agentid == 1){
					$catid = $user_check->catid;
					$cat_check = DB::table('category')->where('cid',$catid)->get()->first();					
					$catdiscount = $cat_check->catdiscount;
					$_SESSION['catgorydicount'] = $catdiscount;					
					$_SESSION['curuid'] = $curentid;
					}
					$_SESSION['catid'] = $curentid;
					
				}
				else{					
					$_SESSION['curuid'] = 0;
				}
			
			if(Session::has('order_hotel_id') && Session::has('order_hotel_roomid')) 
			{
				$hotel = \DB::table('hotels')->where('hotel_id', Session::get('order_hotel_id'))->get();
				$hotel_room = \DB::table('hotels_roomdata')->where('hotel_room_id', Session::get('order_hotel_roomid'))->get();
				
				return view('newhotel-checkout',array('chilage'=>$chilage,'fromdate'=>$fromdate,'todate'=>$todate,'hotel'=>$hotel,'hotel_room'=>$hotel_room));
			}
			else {
				return back();
			}
		/*}
		else {
			return redirect('/login');
		}*/
	}
		
	// INSERT HOTEL CHECKOUT ORDER INTO DATABASE
	public function inserthotelorder(Request $request)
	{
		@session_start();
		
		$hotel_id = 0; $hotel_roomid = 0;
		if($request->has('hotel_id') && $request->get('hotel_id') > 0) {
			$hotel_id =  $request->get('hotel_id');
			$hotel_roomid =  $request->get('hotel_roomid');
		}
		elseif(Session::has('order_hotel_id') && Session::has('order_hotel_roomid'))  {
			$hotel_id =  Session::get('order_hotel_id');
			$hotel_roomid =  Session::get('order_hotel_roomid');
		}
		elseif(isset($_SESSION['order_hotel_id']) && $_SESSION['order_hotel_id']>0) 
		{
			$hotel_id =  $_SESSION['order_hotel_id'];
			$hotel_roomid =  $_SESSION['order_hotel_roomid'];
		}
		
		if($hotel_id > 0 && $hotel_roomid > 0)
		{
			$firstname =  $request->get('firstname');
			$lastname =  $request->get('lastname');
			$email =  $request->get('email');
			$phone =  $request->get('phone');
			$address =  $request->get('address');
			$pincode =  $request->get('pincode');
			$city =  $request->get('city');
			$state =  $request->get('state');
			$country =  $request->get('country');
			$productinfo = $request->get('productinfo');
			$price_per_person = $request->get('price_per_person');
			$room = $request->get('room');
			$extraroom = $request->get('no_of_extra_room');
			$extraadult = $request->get('no_of_extra_adults');
			$extrachildren = $request->get('no_of_extra_child');
			
			$childage = implode(",",$request->get('child_age'));
			
			if($request->has("no_of_adults")) {
				$no_of_persons = $request->get('no_of_adults');
			}
			elseif($request->has("no_of_persons")) {
				$no_of_persons = $request->get('no_of_persons');
			}
			if($request->has("no_of_childs")) {
				$no_of_child = $request->get('no_of_childs');
			}
			elseif($request->has("no_of_childs")) {
				$no_of_child = $request->get('no_of_childs');
			}	
			
			$amount = $request->get('amount');
			$coupon_code = '';
			if($request->has("txt_coupon_code")) {
				$coupon_code = $request->get('txt_coupon_code');
			}
			elseif($request->has("applied_coupon_code")) {
				$coupon_code = $request->get('applied_coupon_code');
			}
			
			$tour_date = date("Y-m-d",strtotime($request->get('txt_travel_date')));
			$checkin_date = date("Y-m-d",strtotime($request->get('txt_checkin')));
			$checkout_date = date("Y-m-d",strtotime($request->get('txt_checkout')));
			
			$coupon_amount = 0;
			if(trim($coupon_code) != "")
			{
				$coupon = \DB::table('coupons')->where('coupon_code', trim($coupon_code))->get()->toArray();
				if(!empty($coupon)) {
					$coupon_amount = $coupon[0]->coupon_amount;
				}
			}
			
			$_SESSION['orderfirstname'] = trim($firstname);
			$_SESSION['orderlastname'] = trim($lastname);
			$_SESSION['orderemail'] = trim($email);
			
			$user_id = 0;
			if($email != '')
			{
				$user_check = DB::table('users')->where('email',$email)->get()->first();
				
				if(!empty($user_check))
				{
					// GET USER
					$user_id = $user_check->id;
				}
				else
				{
					
					$password = substr(md5(microtime()),rand(0,26),6);
					// INSERT USER
					$user_id = \DB::table('users')->insertGetId([
					'name' => trim($firstname).' '.trim($lastname),
					'email' => trim($email),
					'password' => bcrypt($password),
					'status' => 'Active'
					]);
					
					$subject = "Welcome to Tripindia";
					$password_message = "Your New Useranme (email) ".$email."<br /> Password is ".$password;
					
					$mg = new Mailgun("key-a886acc552c9ecb8cae8937ff13894ec");
					$domain = "bulkmail.influensell.net";
					$batchMsg = $mg->BatchMessage($domain);
					$batchMsg->setFromAddress("info@tripindia.com", array("first"=>"Trip", "last" => "India"));
					$batchMsg->setSubject($subject);
					$batchMsg->setHtmlBody($password_message);
					$batchMsg->addToRecipient($email, array("first" => $firstname, "last" => $lastname));
					$batchMsg->addBccRecipient("jalpesh@anibyte.net", array("first"=>"Jalpesh", "last" => "Anibyte"));
					$batchMsg->finalize();
				}
			}
			
			 $order_id = \DB::table('orders')->insertGetId([
				'hotel_id' => $hotel_id, 
				'hotel_room_id' => $hotel_roomid, 
				'user_id' => $user_id, 
				'tour_name' => trim($productinfo),
				'firstname' => trim($firstname),
				'lastname' => trim($lastname),
				'email' => trim($email),
				'phone' => trim($phone),
				'city' => trim($city),
				'state' => trim($state),
				'address' => trim($address),
				'country' => trim($country),
				'no_of_persons' => $no_of_persons,
				'no_of_child' => $no_of_child,
				'no_of_room' => $room,
				'extra_room' => $extraroom,
				'extra_adult' => $extraadult,
				'extra_children' => $extrachildren,
				'child_age' => $childage,
				'tour_date' => $tour_date,
				'tour_date' => $tour_date,
				'tour_date' => $tour_date,
				'hotel_checkin_date' => $checkin_date,
				'hotel_chekout_date' => $checkout_date,
				'coupon_code' => trim($coupon_code),
				'coupon_amount' => trim($coupon_amount),
				'amount' => $request->amount,
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
			]); 
			//dd($order_id);
			
			Session::put('order_id', $order_id);
			$_SESSION['order_id'] = $order_id;

		}
	}
	
	// INSERT HOTEL CHECKOUT ORDER INTO DATABASE
	public function newinserthotelorder(Request $request)
	{
		@session_start();
		
		$hotel_id = 0; $hotel_roomid = 0;
		if($request->has('hotel_id') && $request->get('hotel_id') > 0) {
			$hotel_id =  $request->get('hotel_id');
			$hotel_roomid =  $request->get('hotel_roomid');
		}
		elseif(Session::has('order_hotel_id') && Session::has('order_hotel_roomid'))  {
			$hotel_id =  Session::get('order_hotel_id');
			$hotel_roomid =  Session::get('order_hotel_roomid');
		}
		elseif(isset($_SESSION['order_hotel_id']) && $_SESSION['order_hotel_id']>0) 
		{
			$hotel_id =  $_SESSION['order_hotel_id'];
			$hotel_roomid =  $_SESSION['order_hotel_roomid'];
		}
		
		if($hotel_id > 0 && $hotel_roomid > 0)
		{
			$firstname =  $request->get('firstname');
			$lastname =  $request->get('lastname');
			$email =  $request->get('email');
			$phone =  $request->get('phone');
			$address =  $request->get('address');
			$pincode =  $request->get('pincode');
			$city =  $request->get('city');
			$state =  $request->get('state');
			$country =  $request->get('country');
			$productinfo = $request->get('productinfo');
			$price_per_person = $request->get('price_per_person');
			$extraroom = $request->get('no_of_extra_room');
			$extraadult = $request->get('no_of_extra_adults');
			$extrachildren = $request->get('no_of_extra_child');
			$agent_id = $request->get('agent_id');
			$discount = $request->get('discount');
			$disamount =  $request->get('disamount');
			$agtamount =  $request->get('amount');
			$useramount = $request->get('useramount');
			$room = $request->get('room');
			$childage = implode(",",$request->get('child_age'));
			
			if($request->has("no_of_adults")) {
				$no_of_persons = $request->get('no_of_adults');
			}
			elseif($request->has("no_of_persons")) {
				$no_of_persons = $request->get('no_of_persons');
			}
			if($request->has("no_of_childs")) {
				$no_of_child = $request->get('no_of_childs');
			}
			elseif($request->has("no_of_childs")) {
				$no_of_child = $request->get('no_of_childs');
			}	
			
			$amount = $request->get('amount');
			$coupon_code = '';
			if($request->has("txt_coupon_code")) {
				$coupon_code = $request->get('txt_coupon_code');
			}
			elseif($request->has("applied_coupon_code")) {
				$coupon_code = $request->get('applied_coupon_code');
			}
			
			$tour_date = date("Y-m-d",strtotime($request->get('txt_travel_date')));
			$checkin_date = date("Y-m-d",strtotime($request->get('txt_checkin')));
			$checkout_date = date("Y-m-d",strtotime($request->get('txt_checkout')));
			
			$coupon_amount = 0;
			if(trim($coupon_code) != "")
			{
				$coupon = \DB::table('coupons')->where('coupon_code', trim($coupon_code))->get()->toArray();
				if(!empty($coupon)) {
					$coupon_amount = $coupon[0]->coupon_amount;
				}
			}
			
			$_SESSION['orderfirstname'] = trim($firstname);
			$_SESSION['orderlastname'] = trim($lastname);
			$_SESSION['orderemail'] = trim($email);
			
			$user_id = 0;
			if($email != '')
			{
				$user_check = DB::table('users')->where('email',$email)->get()->first();
				
				if(!empty($user_check))
				{
					// GET USER
					$user_id = $user_check->id;
				}
				else
				{
					
					$password = substr(md5(microtime()),rand(0,26),6);
					// INSERT USER
					$user_id = \DB::table('users')->insertGetId([
					'name' => trim($firstname).' '.trim($lastname),
					'email' => trim($email),
					'password' => bcrypt($password),
					'status' => 'Active'
					]);
					
					$subject = "Welcome to Tripindia";
					$password_message = "Your New Useranme (email) ".$email."<br /> Password is ".$password;
					
					$mg = new Mailgun("key-a886acc552c9ecb8cae8937ff13894ec");
					$domain = "bulkmail.influensell.net";
					$batchMsg = $mg->BatchMessage($domain);
					$batchMsg->setFromAddress("info@tripindia.com", array("first"=>"Trip", "last" => "India"));
					$batchMsg->setSubject($subject);
					$batchMsg->setHtmlBody($password_message);
					$batchMsg->addToRecipient($email, array("first" => $firstname, "last" => $lastname));
					$batchMsg->addBccRecipient("jalpesh@anibyte.net", array("first"=>"Jalpesh", "last" => "Anibyte"));
					$batchMsg->finalize();
				}
			}
			
				$order_id = \DB::table('orders')->insertGetId([
				'hotel_id' => $hotel_id, 
				'hotel_room_id' => $hotel_roomid, 
				'user_id' => $user_id, 
				'agent_id' => $agent_id, 
				'tour_name' => trim($productinfo),
				'firstname' => trim($firstname),
				'lastname' => trim($lastname),
				'email' => trim($email),
				'phone' => trim($phone),
				'city' => trim($city),
				'state' => trim($state),
				'address' => trim($address),
				'country' => trim($country),
				'no_of_persons' => $no_of_persons,
				'no_of_child' => $no_of_child,				
				'no_of_room' => $room,
				'extra_room' => $extraroom,
				'extra_adult' => $extraadult,
				'extra_children' => $extrachildren,
				'child_age' => $childage,
				'tour_date' => $tour_date,
				'tour_date' => $tour_date,
				'tour_date' => $tour_date,
				'hotel_checkin_date' => $checkin_date,
				'hotel_chekout_date' => $checkout_date,
				'coupon_code' => trim($coupon_code),
				'coupon_amount' => trim($coupon_amount),
				'agentdiscount' => $discount,
				'agent_desc_total' => trim($disamount),
				'agent_total_pay' => trim($agtamount),
				'user_amount' => trim($useramount),
				'amount' => $request->amount,
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
			]); 
			//dd($order_id);
			Session::put('order_id', $order_id);
			$_SESSION['order_id'] = $order_id;

		}
	}
	
	// HOTEL BOOKING (CHEKOUT SESSION GENERATE)
	public function checkouthotelorder(Request $request)
	{
		@session_start();
		if(Session::has('order_hotel_id') && Session::has('order_hotel_roomid')) {
			Session::put('order_hotel_id', '');
			Session::put('order_hotel_roomid', '');
		}
		
		$hotel_id = $request->hotel_id;
		$hotel_roomid = $request->hotel_roomid;
		
		Session::put('order_hotel_id', $hotel_id);
		$_SESSION['order_hotel_id'] = $hotel_id;
		
		Session::put('order_hotel_roomid', $hotel_roomid);
		$_SESSION['order_hotel_roomid'] = $hotel_roomid;
	}
	
	
	
	public function applycoupon(Request $request) 
	{
		$coupon_code = $request->coupon;
		$hotel_id = $request->hotel_id;
		
		$coupons = \DB::select("SELECT * FROM `coupons` WHERE `status` LIKE 'Active' AND `aht` = 2 AND `from_date` <= CURDATE() AND `to_date` >= CURDATE() AND `coupon_code` = '".$coupon_code."' ");
		
		if(!empty($coupons))
		{
			$data['success'] = $coupons[0]->coupon_amount;
		}
		else  {
			$data['error'] = 'Invalid Coupon Code';
		}
		echo json_encode($data); exit();
	}
	
	// HOTEL BOOKING SUCCESS PAGE
	public function hotelsuccess(Request $request) 
	{
		@session_start();
		$user_id = DB::table('hotels')->where('hotel_id',$_SESSION['order_hotel_id'])->pluck('user_id'); 
		$hotel_email = Hotels::where('hotel_id',$_SESSION['order_hotel_id'])->pluck('hotel_email');
		//$client_email = DB::table('orders')->select('firstname','lastname','email')->where('order_id',$_SESSION['order_id'])->pluck('email');
		$client_email = DB::table('orders')
		  ->select('orders.*','hotels.*','hotels_roomdata.*',DB::raw('orders.child_age as children_ages,orders.created_at as ordercreate'))
				->join('hotels', 'hotels.hotel_id', '=', 'orders.hotel_id')	
				->join('hotels_roomdata', 'hotels.hotel_id', '=', 'hotels_roomdata.hotel_id')	
				->where('orders.order_id',$_SESSION['order_id'])->get();
		$agentemail = DB::table('users')->select('name','email')->where('id',$client_email[0]->agent_id)->get();
		
		/*echo "<pre>";
		print_r($client_email);exit;*/
		
		if(isset($_SESSION['order_id']) && isset($_SESSION['order_hotel_id']) && isset($_SESSION['order_hotel_roomid']))
		{
			if($client_email[0]->agent_id > 0 ){
				  
				 
				$to = \Carbon\Carbon::createFromFormat('Y-m-d', $client_email[0]->hotel_checkin_date);
				$from = \Carbon\Carbon::createFromFormat('Y-m-d', $client_email[0]->hotel_chekout_date);

				$diff_in_days = $to->diffInDays($from);				
				$totalsvalue = ($diff_in_days * $client_email[0]->hotel_saleprice);
				
				$subject = "Trip Hotel Invoice ".$_SESSION['order_id'];
				$invoice = '<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			</head>
			<body>
				<strong>Payment Successfully</strong><br />
				<hr />
				<div class="col-md-12">
<div id="content">
<div id="printablediv">
    <table id="invoiceTable" style="max-width:600px;margin-top: 35px; margin-bottom: 35px;" width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
        <tbody><tr>
                        <td style="font-size: 0; padding: 12px; color: black; font-family: tahoma; text-transform: uppercase; letter-spacing: 4px;" valign="top" bgcolor="#38A870" align="center">
                <div style="font-size:16px;color:white;">
                    Your booking Status is <b class="wow flash animted animated animated" style="visibility: visible;">Paid</b>
                    <p style="color:white;letter-spacing: 2px; font-size: 10px; margin-top: 0px;" class="text-center">Booking details were sent '.$client_email[0]->email.'</p>
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
				 <p style="color:#123456;letter-spacing: 2px; font-size: 12px; margin-top: 0px;">Invoice Date : '.$client_email[0]->ordercreate.'</p>
				 <p style="color:#123456;letter-spacing: 2px; font-size: 12px; margin-top: 0px;">Invoice Number : '.$client_email[0]->order_id.'</p>
				 <p style="color:#123456;letter-spacing: 2px; font-size: 12px; margin-top: 0px;">Name : '.$client_email[0]->firstname.' '.$client_email[0]->lastname.'</p>
                 <p style="color:#123456;letter-spacing: 2px; font-size: 12px; margin-top: 0px;">Email: '.$client_email[0]->email.'</p> 
                 <p style="color:#123456;letter-spacing: 2px; font-size: 12px; margin-top: 0px;">Phone: '.$client_email[0]->phone.'</p>
				 </div>                             
							</td>
                        </tr>
                    </tbody></table>
                </div>
            </td>
        </tr>
           <tr style="height: 4px; width: 100%; float: left;background: #F8F8F8; background: -moz-linear-gradient(left, #f76570 0%, #f76570 8%, #f3a46b 8%, #f3a46b 16%, #f3a46b 16%, #ffd205 16%, #ffd205 24%, #ffd205 24%, #1bbc9b 24%, #1bbc9b 25%, #1bbc9b 32%, #14b9d5 32%, #14b9d5 40%, #c377e4 40%, #c377e4 48%, #f76570 48%, #f76570 56%, #f3a46b 56%, #f3a46b 64%, #ffd205 64%, #ffd205 72%, #1bbc9b 72%, #1bbc9b 80%, #14b9d5 80%, #14b9d5 80%, #14b9d5 89%, #c377e4 89%, #c377e4 100%); background: -webkit-gradient(linear, left top, right top, color-stop(0%,#f76570), color-stop(8%,#f76570), color-stop(8%,#f3a46b), color-stop(16%,#f3a46b), color-stop(16%,#f3a46b), color-stop(16%,#ffd205), color-stop(24%,#ffd205), color-stop(24%,#ffd205), color-stop(24%,#1bbc9b), color-stop(25%,#1bbc9b), color-stop(32%,#1bbc9b), color-stop(32%,#14b9d5), color-stop(40%,#14b9d5), color-stop(40%,#c377e4), color-stop(48%,#c377e4), color-stop(48%,#f76570), color-stop(56%,#f76570), color-stop(56%,#f3a46b), color-stop(64%,#f3a46b), color-stop(64%,#ffd205), color-stop(72%,#ffd205), color-stop(72%,#1bbc9b), color-stop(80%,#1bbc9b), color-stop(80%,#14b9d5), color-stop(80%,#14b9d5), color-stop(89%,#14b9d5), color-stop(89%,#c377e4), color-stop(100%,#c377e4)); /* background: -webkit-linear-gradient(left, #f76570 0%,#f76570 8%,#f3a46b 8%,#f3a46b 16%,#f3a46b 16%,#ffd205 16%,#ffd205 24%,#ffd205 24%,#1bbc9b 24%,#1bbc9b 25%,#1bbc9b 32%,#14b9d5 32%,#14b9d5 40%,#c377e4 40%,#c377e4 48%,#f76570 48%,#f76570 56%,#f3a46b 56%,#f3a46b 64%,#ffd205 64%,#ffd205 72%,#1bbc9b 72%,#1bbc9b 80%,#14b9d5 80%,#14b9d5 80%,#14b9d5 89%,#c377e4 89%,#c377e4 100%); */ background: -o-linear-gradient(left, #f76570 0%,#f76570 8%,#f3a46b 8%,#f3a46b 16%,#f3a46b 16%,#ffd205 16%,#ffd205 24%,#ffd205 24%,#1bbc9b 24%,#1bbc9b 25%,#1bbc9b 32%,#14b9d5 32%,#14b9d5 40%,#c377e4 40%,#c377e4 48%,#f76570 48%,#f76570 56%,#f3a46b 56%,#f3a46b 64%,#ffd205 64%,#ffd205 72%,#1bbc9b 72%,#1bbc9b 80%,#14b9d5 80%,#14b9d5 80%,#14b9d5 89%,#c377e4 89%,#c377e4 100%); background: -ms-linear-gradient(left, #f76570 0%,#f76570 8%,#f3a46b 8%,#f3a46b 16%,#f3a46b 16%,#ffd205 16%,#ffd205 24%,#ffd205 24%,#1bbc9b 24%,#1bbc9b 25%,#1bbc9b 32%,#14b9d5 32%,#14b9d5 40%,#c377e4 40%,#c377e4 48%,#f76570 48%,#f76570 56%,#f3a46b 56%,#f3a46b 64%,#ffd205 64%,#ffd205 72%,#1bbc9b 72%,#1bbc9b 80%,#14b9d5 80%,#14b9d5 80%,#14b9d5 89%,#c377e4 89%,#c377e4 100%); background: linear-gradient(to right, #f76570 0%,#f76570 8%,#f3a46b 8%,#f3a46b 16%,#f3a46b 16%,#ffd205 16%,#ffd205 24%,#ffd205 24%,#1bbc9b 24%,#1bbc9b 25%,#1bbc9b 32%,#14b9d5 32%,#14b9d5 40%,#c377e4 40%,#c377e4 48%,#f76570 48%,#f76570 56%,#f3a46b 56%,#f3a46b 64%,#ffd205 64%,#ffd205 72%,#1bbc9b 72%,#1bbc9b 80%,#14b9d5 80%,#14b9d5 80%,#14b9d5 89%,#c377e4 89%,#c377e4 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="#f76570", endColorstr="#c377e4",GradientType=1 );"></tr>
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
                                       '.$client_email[0]->tour_name .' <i class="star star icon-star-5"></i><i class="star star icon-star-5"></i><i class="star star icon-star-5"></i><i class="star star icon-star-5"></i><i class="star star icon-star-5"></i>                                    </td>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 800; line-height: 24px; padding: 5px;" width="25%" bgcolor="#eeeeee" align="left">
                                        <small>'.$client_email[0]->city_location.'</small>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="75%" align="left">
                                        <img src="url("/hotel_images/")'.$client_email[0]->hotel_image.' class="img-responsive" title="'.ucwords(strtolower($client_email[0]->tour_name)).'" alt="'.ucwords(strtolower($client_email[0]->tour_name)).'" id="tourimage_'.$client_email[0]->hotel_id.'" />
                                    </td>
                                </tr>
								<tr>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="75%" align="left">
                                      '.$diff_in_days. '  Nights Accomodation Price                                 </td>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="25%" align="left">
                                        Rs. '.$client_email[0]->hotel_saleprice.'                                </td>
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
                                       '.$client_email[0]->hotel_checkin_date.'                          </td>
                                </tr>
								<tr>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="75%" align="left">
                                        Check Out                                    </td>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="25%" align="left">
                                       '.$client_email[0]->hotel_chekout_date.'                          </td>
                                </tr>
								<tr>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="75%" align="left">
                                        Room                                  </td>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="25%" align="left">
                                         '.$client_email[0]->no_of_room .'                  </td>
                                </tr>
                                <tr>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="75%" align="left">
                                         Adults                               </td>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="25%" align="left">
                                         '.$client_email[0]->no_of_persons .'                    </td>
                                </tr>
								<tr>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="75%" align="left">
                                        Child                               </td>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="25%" align="left">
                                         '.$client_email[0]->no_of_child .'                     </td>
                                </tr>	
								<tr>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="75%" align="left">
                                        Child  Age                             </td>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="25%" align="left">
                                         '.$client_email[0]->children_ages .'                     </td>
                                </tr>									
								<tr>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="75%" align="left">
                                       Discount  ('.$client_email[0]->agentdiscount.')  -                            </td>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="25%" align="left">
                                         Rs '.$client_email[0]->agent_desc_total.'                     </td>
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
                                        Rs '.$client_email[0]->amount.'                     </td>
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
			</body>
			</html>';
			/*echo "<pre>";
			print_r($client_email);exit;*/
			$mg = new Mailgun("key-a886acc552c9ecb8cae8937ff13894ec");
			$domain = "bulkmail.influensell.net";
			$batchMsg = $mg->BatchMessage($domain);
			$batchMsg->setFromAddress("info@tripindia.com", array("first"=>"Trip", "last" => "India"));
			$batchMsg->setSubject($subject);
			$batchMsg->setHtmlBody($invoice);
			$batchMsg->addToRecipient($agentemail[0]->email, array("first" => "jalpesh", "last" => "Bhadarka"));
			//$batchMsg->addCcRecipient($client_email[0]->hotel_email, array("first" => "Jalpesh", "last" => "Bhadarka"));
			//$batchMsg->addBccRecipient("prashanth@anibyte.net", array("first"=>"Prashanth", "last" => "Sirsi"));
			//$batchMsg->addBccRecipient("sudhakar@anibyte.net", array("first"=>"Sudhakar", "last" => ""));
			//$batchMsg->addBccRecipient("nikjoshi96@gmail.com", array("first"=>"Nikunj", "last" => "Joshi"));
			$batchMsg->finalize();
			
			
			$subject = "Trip Hotel Invoice ".$_SESSION['order_id'];
			$invoice = '<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			</head>
			<body>
				<strong>Payment Successfully</strong><br />
				<hr />
				<div class="col-md-12">
<div id="content">
<div id="printablediv">
    <table id="invoiceTable" style="max-width:600px;margin-top: 35px; margin-bottom: 35px;" width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
        <tbody><tr>
                        <td style="font-size: 0; padding: 12px; color: black; font-family: tahoma; text-transform: uppercase; letter-spacing: 4px;" valign="top" bgcolor="#38A870" align="center">
                <div style="font-size:16px;color:white;">
                    Your booking Status is <b class="wow flash animted animated animated" style="visibility: visible;">Paid</b>
                    <p style="color:white;letter-spacing: 2px; font-size: 10px; margin-top: 0px;" class="text-center">Booking details were sent '.$client_email[0]->email.'</p>
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
				 <p style="color:#123456;letter-spacing: 2px; font-size: 12px; margin-top: 0px;">Invoice Date : '.$client_email[0]->ordercreate.'</p>
				 <p style="color:#123456;letter-spacing: 2px; font-size: 12px; margin-top: 0px;">Invoice Number : '.$client_email[0]->order_id.'</p>
				 <p style="color:#123456;letter-spacing: 2px; font-size: 12px; margin-top: 0px;">Name : '.$client_email[0]->firstname.' '.$client_email[0]->lastname.'</p>
                 <p style="color:#123456;letter-spacing: 2px; font-size: 12px; margin-top: 0px;">Email: '.$client_email[0]->email.'</p> 
                 <p style="color:#123456;letter-spacing: 2px; font-size: 12px; margin-top: 0px;">Phone: '.$client_email[0]->phone.'</p>
				 </div>                             
							</td>
                        </tr>
                    </tbody></table>
                </div>
            </td>
        </tr>
           <tr style="height: 4px; width: 100%; float: left;background: #F8F8F8; background: -moz-linear-gradient(left, #f76570 0%, #f76570 8%, #f3a46b 8%, #f3a46b 16%, #f3a46b 16%, #ffd205 16%, #ffd205 24%, #ffd205 24%, #1bbc9b 24%, #1bbc9b 25%, #1bbc9b 32%, #14b9d5 32%, #14b9d5 40%, #c377e4 40%, #c377e4 48%, #f76570 48%, #f76570 56%, #f3a46b 56%, #f3a46b 64%, #ffd205 64%, #ffd205 72%, #1bbc9b 72%, #1bbc9b 80%, #14b9d5 80%, #14b9d5 80%, #14b9d5 89%, #c377e4 89%, #c377e4 100%); background: -webkit-gradient(linear, left top, right top, color-stop(0%,#f76570), color-stop(8%,#f76570), color-stop(8%,#f3a46b), color-stop(16%,#f3a46b), color-stop(16%,#f3a46b), color-stop(16%,#ffd205), color-stop(24%,#ffd205), color-stop(24%,#ffd205), color-stop(24%,#1bbc9b), color-stop(25%,#1bbc9b), color-stop(32%,#1bbc9b), color-stop(32%,#14b9d5), color-stop(40%,#14b9d5), color-stop(40%,#c377e4), color-stop(48%,#c377e4), color-stop(48%,#f76570), color-stop(56%,#f76570), color-stop(56%,#f3a46b), color-stop(64%,#f3a46b), color-stop(64%,#ffd205), color-stop(72%,#ffd205), color-stop(72%,#1bbc9b), color-stop(80%,#1bbc9b), color-stop(80%,#14b9d5), color-stop(80%,#14b9d5), color-stop(89%,#14b9d5), color-stop(89%,#c377e4), color-stop(100%,#c377e4)); /* background: -webkit-linear-gradient(left, #f76570 0%,#f76570 8%,#f3a46b 8%,#f3a46b 16%,#f3a46b 16%,#ffd205 16%,#ffd205 24%,#ffd205 24%,#1bbc9b 24%,#1bbc9b 25%,#1bbc9b 32%,#14b9d5 32%,#14b9d5 40%,#c377e4 40%,#c377e4 48%,#f76570 48%,#f76570 56%,#f3a46b 56%,#f3a46b 64%,#ffd205 64%,#ffd205 72%,#1bbc9b 72%,#1bbc9b 80%,#14b9d5 80%,#14b9d5 80%,#14b9d5 89%,#c377e4 89%,#c377e4 100%); */ background: -o-linear-gradient(left, #f76570 0%,#f76570 8%,#f3a46b 8%,#f3a46b 16%,#f3a46b 16%,#ffd205 16%,#ffd205 24%,#ffd205 24%,#1bbc9b 24%,#1bbc9b 25%,#1bbc9b 32%,#14b9d5 32%,#14b9d5 40%,#c377e4 40%,#c377e4 48%,#f76570 48%,#f76570 56%,#f3a46b 56%,#f3a46b 64%,#ffd205 64%,#ffd205 72%,#1bbc9b 72%,#1bbc9b 80%,#14b9d5 80%,#14b9d5 80%,#14b9d5 89%,#c377e4 89%,#c377e4 100%); background: -ms-linear-gradient(left, #f76570 0%,#f76570 8%,#f3a46b 8%,#f3a46b 16%,#f3a46b 16%,#ffd205 16%,#ffd205 24%,#ffd205 24%,#1bbc9b 24%,#1bbc9b 25%,#1bbc9b 32%,#14b9d5 32%,#14b9d5 40%,#c377e4 40%,#c377e4 48%,#f76570 48%,#f76570 56%,#f3a46b 56%,#f3a46b 64%,#ffd205 64%,#ffd205 72%,#1bbc9b 72%,#1bbc9b 80%,#14b9d5 80%,#14b9d5 80%,#14b9d5 89%,#c377e4 89%,#c377e4 100%); background: linear-gradient(to right, #f76570 0%,#f76570 8%,#f3a46b 8%,#f3a46b 16%,#f3a46b 16%,#ffd205 16%,#ffd205 24%,#ffd205 24%,#1bbc9b 24%,#1bbc9b 25%,#1bbc9b 32%,#14b9d5 32%,#14b9d5 40%,#c377e4 40%,#c377e4 48%,#f76570 48%,#f76570 56%,#f3a46b 56%,#f3a46b 64%,#ffd205 64%,#ffd205 72%,#1bbc9b 72%,#1bbc9b 80%,#14b9d5 80%,#14b9d5 80%,#14b9d5 89%,#c377e4 89%,#c377e4 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="#f76570", endColorstr="#c377e4",GradientType=1 );"></tr>
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
                                       '.$client_email[0]->tour_name .' <i class="star star icon-star-5"></i><i class="star star icon-star-5"></i><i class="star star icon-star-5"></i><i class="star star icon-star-5"></i><i class="star star icon-star-5"></i>                                    </td>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 800; line-height: 24px; padding: 5px;" width="25%" bgcolor="#eeeeee" align="left">
                                        <small>'.$client_email[0]->city_location.'</small>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="75%" align="left">
                                        <img src="url("/hotel_images/")'.$client_email[0]->hotel_image.' class="img-responsive" title="'.ucwords(strtolower($client_email[0]->tour_name)).'" alt="'.ucwords(strtolower($client_email[0]->tour_name)).'" id="tourimage_'.$client_email[0]->hotel_id.'" />
                                    </td>
                                </tr>
								<tr>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="75%" align="left">
                                      '.$diff_in_days. '  Nights Accomodation Price                                 </td>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="25%" align="left">
                                        Rs. '.$client_email[0]->hotel_saleprice.'                                </td>
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
                                       '.$client_email[0]->hotel_checkin_date.'                          </td>
                                </tr>
								<tr>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="75%" align="left">
                                        Check Out                                    </td>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="25%" align="left">
                                       '.$client_email[0]->hotel_chekout_date.'                          </td>
                                </tr>
								<tr>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="75%" align="left">
                                        Room                                  </td>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="25%" align="left">
                                         '.$client_email[0]->no_of_room .'                  </td>
                                </tr>
                                <tr>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="75%" align="left">
                                         Adults                               </td>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="25%" align="left">
                                         '.$client_email[0]->no_of_persons .'                    </td>
                                </tr>
								<tr>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="75%" align="left">
                                        Child                               </td>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="25%" align="left">
                                         '.$client_email[0]->no_of_child .'                     </td>
                                </tr>	
								<tr>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="75%" align="left">
                                        Child  Age                             </td>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="25%" align="left">
                                         '.$client_email[0]->children_ages .'                     </td>
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
                                        Rs '.$client_email[0]->user_amount.'                     </td>
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
			</body>
			</html>';
			/*echo "<pre>";
			print_r($client_email);exit;*/
			$mg = new Mailgun("key-a886acc552c9ecb8cae8937ff13894ec");
			$domain = "bulkmail.influensell.net";
			$batchMsg = $mg->BatchMessage($domain);
			$batchMsg->setFromAddress("info@tripindia.com", array("first"=>"Trip", "last" => "India"));
			$batchMsg->setSubject($subject);
			$batchMsg->setHtmlBody($invoice);
			$batchMsg->addToRecipient($client_email[0]->email, array("first" => "jalpesh", "last" => "Bhadarka"));
			$batchMsg->addCcRecipient($client_email[0]->hotel_email, array("first" => "Jalpesh", "last" => "Bhadarka"));
			//$batchMsg->addBccRecipient("prashanth@anibyte.net", array("first"=>"Prashanth", "last" => "Sirsi"));
			//$batchMsg->addBccRecipient("sudhakar@anibyte.net", array("first"=>"Sudhakar", "last" => ""));
			//$batchMsg->addBccRecipient("nikjoshi96@gmail.com", array("first"=>"Nikunj", "last" => "Joshi"));
			$batchMsg->finalize();
			
			}else{
				$to = \Carbon\Carbon::createFromFormat('Y-m-d', $client_email[0]->hotel_checkin_date);
				$from = \Carbon\Carbon::createFromFormat('Y-m-d', $client_email[0]->hotel_chekout_date);

				$diff_in_days = $to->diffInDays($from);				
				
				$subject = "Trip Hotel Invoice ".$_SESSION['order_id'];
			$invoice = '<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			</head>
			<body>
				<strong>Payment Successfully</strong><br />
				<hr />
				<div class="col-md-12">
<div id="content">
<div id="printablediv">
    <table id="invoiceTable" style="max-width:600px;margin-top: 35px; margin-bottom: 35px;" width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
        <tbody><tr>
                        <td style="font-size: 0; padding: 12px; color: black; font-family: tahoma; text-transform: uppercase; letter-spacing: 4px;" valign="top" bgcolor="#38A870" align="center">
                <div style="font-size:16px;color:white;">
                    Your booking Status is <b class="wow flash animted animated animated" style="visibility: visible;">Paid</b>
                    <p style="color:white;letter-spacing: 2px; font-size: 10px; margin-top: 0px;" class="text-center">Booking details were sent '.$client_email[0]->email.'</p>
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
				 <p style="color:#123456;letter-spacing: 2px; font-size: 12px; margin-top: 0px;">Invoice Date : '.$client_email[0]->ordercreate.'</p>
				 <p style="color:#123456;letter-spacing: 2px; font-size: 12px; margin-top: 0px;">Invoice Number : '.$client_email[0]->order_id.'</p>
				 <p style="color:#123456;letter-spacing: 2px; font-size: 12px; margin-top: 0px;">Name : '.$client_email[0]->firstname.' '.$client_email[0]->lastname.'</p>
                 <p style="color:#123456;letter-spacing: 2px; font-size: 12px; margin-top: 0px;">Email: '.$client_email[0]->email.'</p> 
                 <p style="color:#123456;letter-spacing: 2px; font-size: 12px; margin-top: 0px;">Phone: '.$client_email[0]->phone.'</p>
				 </div>                             
							</td>
                        </tr>
                    </tbody></table>
                </div>
            </td>
        </tr>
           <tr style="height: 4px; width: 100%; float: left;background: #F8F8F8; background: -moz-linear-gradient(left, #f76570 0%, #f76570 8%, #f3a46b 8%, #f3a46b 16%, #f3a46b 16%, #ffd205 16%, #ffd205 24%, #ffd205 24%, #1bbc9b 24%, #1bbc9b 25%, #1bbc9b 32%, #14b9d5 32%, #14b9d5 40%, #c377e4 40%, #c377e4 48%, #f76570 48%, #f76570 56%, #f3a46b 56%, #f3a46b 64%, #ffd205 64%, #ffd205 72%, #1bbc9b 72%, #1bbc9b 80%, #14b9d5 80%, #14b9d5 80%, #14b9d5 89%, #c377e4 89%, #c377e4 100%); background: -webkit-gradient(linear, left top, right top, color-stop(0%,#f76570), color-stop(8%,#f76570), color-stop(8%,#f3a46b), color-stop(16%,#f3a46b), color-stop(16%,#f3a46b), color-stop(16%,#ffd205), color-stop(24%,#ffd205), color-stop(24%,#ffd205), color-stop(24%,#1bbc9b), color-stop(25%,#1bbc9b), color-stop(32%,#1bbc9b), color-stop(32%,#14b9d5), color-stop(40%,#14b9d5), color-stop(40%,#c377e4), color-stop(48%,#c377e4), color-stop(48%,#f76570), color-stop(56%,#f76570), color-stop(56%,#f3a46b), color-stop(64%,#f3a46b), color-stop(64%,#ffd205), color-stop(72%,#ffd205), color-stop(72%,#1bbc9b), color-stop(80%,#1bbc9b), color-stop(80%,#14b9d5), color-stop(80%,#14b9d5), color-stop(89%,#14b9d5), color-stop(89%,#c377e4), color-stop(100%,#c377e4)); /* background: -webkit-linear-gradient(left, #f76570 0%,#f76570 8%,#f3a46b 8%,#f3a46b 16%,#f3a46b 16%,#ffd205 16%,#ffd205 24%,#ffd205 24%,#1bbc9b 24%,#1bbc9b 25%,#1bbc9b 32%,#14b9d5 32%,#14b9d5 40%,#c377e4 40%,#c377e4 48%,#f76570 48%,#f76570 56%,#f3a46b 56%,#f3a46b 64%,#ffd205 64%,#ffd205 72%,#1bbc9b 72%,#1bbc9b 80%,#14b9d5 80%,#14b9d5 80%,#14b9d5 89%,#c377e4 89%,#c377e4 100%); */ background: -o-linear-gradient(left, #f76570 0%,#f76570 8%,#f3a46b 8%,#f3a46b 16%,#f3a46b 16%,#ffd205 16%,#ffd205 24%,#ffd205 24%,#1bbc9b 24%,#1bbc9b 25%,#1bbc9b 32%,#14b9d5 32%,#14b9d5 40%,#c377e4 40%,#c377e4 48%,#f76570 48%,#f76570 56%,#f3a46b 56%,#f3a46b 64%,#ffd205 64%,#ffd205 72%,#1bbc9b 72%,#1bbc9b 80%,#14b9d5 80%,#14b9d5 80%,#14b9d5 89%,#c377e4 89%,#c377e4 100%); background: -ms-linear-gradient(left, #f76570 0%,#f76570 8%,#f3a46b 8%,#f3a46b 16%,#f3a46b 16%,#ffd205 16%,#ffd205 24%,#ffd205 24%,#1bbc9b 24%,#1bbc9b 25%,#1bbc9b 32%,#14b9d5 32%,#14b9d5 40%,#c377e4 40%,#c377e4 48%,#f76570 48%,#f76570 56%,#f3a46b 56%,#f3a46b 64%,#ffd205 64%,#ffd205 72%,#1bbc9b 72%,#1bbc9b 80%,#14b9d5 80%,#14b9d5 80%,#14b9d5 89%,#c377e4 89%,#c377e4 100%); background: linear-gradient(to right, #f76570 0%,#f76570 8%,#f3a46b 8%,#f3a46b 16%,#f3a46b 16%,#ffd205 16%,#ffd205 24%,#ffd205 24%,#1bbc9b 24%,#1bbc9b 25%,#1bbc9b 32%,#14b9d5 32%,#14b9d5 40%,#c377e4 40%,#c377e4 48%,#f76570 48%,#f76570 56%,#f3a46b 56%,#f3a46b 64%,#ffd205 64%,#ffd205 72%,#1bbc9b 72%,#1bbc9b 80%,#14b9d5 80%,#14b9d5 80%,#14b9d5 89%,#c377e4 89%,#c377e4 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="#f76570", endColorstr="#c377e4",GradientType=1 );"></tr>
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
                                       '.$client_email[0]->tour_name .' <i class="star star icon-star-5"></i><i class="star star icon-star-5"></i><i class="star star icon-star-5"></i><i class="star star icon-star-5"></i><i class="star star icon-star-5"></i>                                    </td>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 800; line-height: 24px; padding: 5px;" width="25%" bgcolor="#eeeeee" align="left">
                                        <small>'.$client_email[0]->city_location.'</small>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="75%" align="left">
                                        <img src="url("/hotel_images/")'.$client_email[0]->hotel_image.' class="img-responsive" title="'.ucwords(strtolower($client_email[0]->tour_name)).'" alt="'.ucwords(strtolower($client_email[0]->tour_name)).'" id="tourimage_'.$client_email[0]->hotel_id.'" />
                                    </td>
                                </tr>
								<tr>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="75%" align="left">
                                      '.$diff_in_days. '  Nights Accomodation Price                                 </td>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="25%" align="left">
                                        Rs. '.$client_email[0]->hotel_saleprice.'                                </td>
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
                                       '.$client_email[0]->hotel_checkin_date.'                          </td>
                                </tr>
								<tr>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="75%" align="left">
                                        Check Out                                    </td>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="25%" align="left">
                                       '.$client_email[0]->hotel_chekout_date.'                          </td>
                                </tr>
								<tr>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="75%" align="left">
                                        Room                                  </td>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="25%" align="left">
                                         '.$client_email[0]->no_of_room .'                  </td>
                                </tr>
                                <tr>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="75%" align="left">
                                         Adults                               </td>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="25%" align="left">
                                         '.$client_email[0]->no_of_persons .'                    </td>
                                </tr>
								<tr>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="75%" align="left">
                                        Child                               </td>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="25%" align="left">
                                         '.$client_email[0]->no_of_child .'                     </td>
                                </tr>	
								<tr>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="75%" align="left">
                                        Child  Age                             </td>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="25%" align="left">
                                         '.$client_email[0]->children_ages.'                     </td>
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
                                        Rs '.$client_email[0]->amount.'                     </td>
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
			</body>
			</html>';
			/*echo "<pre>";
			print_r($client_email);exit;*/
			$mg = new Mailgun("key-a886acc552c9ecb8cae8937ff13894ec");
			$domain = "bulkmail.influensell.net";
			$batchMsg = $mg->BatchMessage($domain);
			$batchMsg->setFromAddress("info@tripindia.com", array("first"=>"Trip", "last" => "India"));
			$batchMsg->setSubject($subject);
			$batchMsg->setHtmlBody($invoice);
			$batchMsg->addToRecipient($client_email[0]->email, array("first" => "jalpesh", "last" => "Bhadarka"));
			$batchMsg->addCcRecipient($client_email[0]->hotel_email, array("first" => "Jalpesh", "last" => "Bhadarka"));
			//$batchMsg->addBccRecipient("prashanth@anibyte.net", array("first"=>"Prashanth", "last" => "Sirsi"));
			//$batchMsg->addBccRecipient("sudhakar@anibyte.net", array("first"=>"Sudhakar", "last" => ""));
			//$batchMsg->addBccRecipient("nikjoshi96@gmail.com", array("first"=>"Nikunj", "last" => "Joshi"));
			$batchMsg->finalize();
			}
			
			
			
			unset($_SESSION['order_hotel_roomid']);
			unset($_SESSION['order_hotel_id']);
			unset($_SESSION['order_id']);
			
			return view('payment_success');
		}else
		{
			echo "Error";
			exit();
		}
	}
	
	// HOTELS  LIST
	public function hotelslist(Request $request)
	{
		
		if(Session::has('hotel_id')) {
			$request->session()->forget('hotel_id');
		}
		// if((Auth::user()->ticketit_admin==1)){
		// 	echo "hello"; exit;
		// }
		$hotels = \DB::table('hotels')->where('user_id',Auth::user()->id)->orderBy('hotel_name', 'asc')->paginate(10);
		return view('hotels.hotel_list',array('hotels'=>$hotels));
	}
	
	// Room  LIST
	public function roomlist(Request $request)
	{
		
		$id = $request->route('hid');
		if(Session::has('hotel_id')) {
			$request->session()->forget('hotel_id');
		}
		Session::put('hotel_id',$id);	
		
		$hotelsroomscount = \DB::table('hotels')
				->join('hotels_roomdata', 'hotels.hotel_id', '=', 'hotels_roomdata.hotel_id')					
				->where('hotels.hotel_id',$id)->count();
			
		if($hotelsroomscount==0)
		{
			
			return redirect('/hotel-add-roomdata');
		}
		else {
		$hotelsrooms = \DB::table('hotels')
				->join('hotels_roomdata', 'hotels.hotel_id', '=', 'hotels_roomdata.hotel_id')					
				->where('hotels.hotel_id',$id)->paginate(10);			
		}
		return view('hotels.room_list',array('hotelsrooms'=>$hotelsrooms));
	}
	
	
	//Amenities  LIST
	public function amenitieslist(Request $request)
	{
		
		$amenitieslists = \DB::table('hotelaminities')->orderBy('aid', 'asc')->get();
				
		return view('hotels.amenities_list',array('amenitieslists'=>$amenitieslists));
	}
	
		
	// Active Hotel PACKAGE
	public function activehotel(Request $request)
	{
	
		$id = $request->route('hid');
		\DB::table('hotels')->where('hotel_id', $id)
				->update([
					'hotel_status' => 1					
				]);
		return redirect('/allhotels');
	}
	
	
	
	
	// FOR EDIT HOTEL
	public function edithotel(Request $request)
	{
		$hotel_id = $request->hid;
		if($hotel_id > 0)
		{
			$hotel = \DB::table('hotels')->where('hotel_id',$hotel_id)->get();
			return view('hotels.hotel_edit',array('hotel'=>$hotel));
		}
		else {
			return redirect('/allhotels');
		}
	}
	
	// FOR EDIT HOTEL SAVE (UPDATE)
	public function updatehotel(Request $request)
	{
		if (Auth::check())
		{
			$destinationPath = '/public/hotel_images';
			$docsdestinationPath = '/public/hotel_docs';

			$hotel_id = $request->hid;
		
			if($request->has("hotel_name") && trim($request->hotel_name) != '') 
			{
				
				$hotel_name = trim($request->hotel_name);
				
				if($request->has("fromdate") && trim($request->fromdate) != '') {
					$fromdate = trim($request->fromdate);
				}
				else {
					$fromdate = trim($request->fromdate);
				}
				
				if($request->has("todate") && trim($request->todate) != '') {
					$todate = trim($request->todate);
				}
				else {
					$todate = trim($request->todate);
				}
				
				$hotel_pincode = trim($request->hotel_pincode);
				$hotel_address = trim($request->hotel_address);
				$city_location = trim($request->hotel_location);
				$checkin_time = trim($request->hotel_checkin_time);
				$checkout_time = trim($request->hotel_checkout_time);
				$checkin_ampm = trim($request->hotel_checkin_ampm);
				$checkout_ampm = trim($request->hotel_checkout_ampm);
				$hotel_highlights = trim($request->hotel_highlights);
				$hotel_cancellationfees = trim($request->hotel_cancellationfees);
				$hotel_paymentpolicy = trim($request->hotel_paymentpolicy);
				$hotel_cancellationpolicy = trim($request->hotel_cancellationpolicy);
				$hotel_terms_conditions = trim($request->hotel_termsconditions);
				$hotel_nearestplace = trim($request->hotel_nearestplace);
				$hotel_bankdetail = trim($request->hotel_bankdetail);
				$hotel_contact = trim($request->hotel_contact);
				$hotel_contact_name = trim($request->hotel_contact_name);
				$hotel_mobile = trim($request->hotel_mobile);
				$hotel_email = trim($request->hotel_email);
				
				$hotel_amenities = '';
				if(!empty($request->amenities)) {
					$hotel_amenities = implode(",",$request->amenities);
				}
				
				\DB::table('hotels')->where('hotel_id', $hotel_id)
				->update([
					'hotel_name' => addslashes($hotel_name),
					'hotel_address' => addslashes($hotel_address),
					'hotel_pincode' => addslashes($hotel_pincode),
					'fromdate' => date("Y-m-d",strtotime($fromdate)),
					'todate' => date("Y-m-d",strtotime($todate)),
					'city_location' => addslashes($city_location),
					'checkin_time' => addslashes($checkin_time)." ".addslashes($checkin_ampm),
					'checkout_time' => addslashes($checkout_time)." ".addslashes($checkout_ampm),
					'hotel_amenities' =>addslashes($hotel_amenities),
					'hotel_highlights' => addslashes($hotel_highlights),
					'hotel_cancellationfees' => addslashes($hotel_cancellationfees),
					'hotel_paymentpolicy' => addslashes($hotel_paymentpolicy),
					'hotel_cancellationpolicy' => addslashes($hotel_cancellationpolicy),
					'hotel_nearestplace'=>addslashes($hotel_nearestplace),
					'hotel_terms_conditions' => addslashes($hotel_terms_conditions),
					'hotel_bankdetail' => addslashes($hotel_bankdetail),
					'hotel_contact' => addslashes($hotel_contact),
					'hotel_contact_name' => addslashes($hotel_contact_name),
					'hotel_mobile' => addslashes($hotel_mobile),
					'hotel_email' => addslashes($hotel_email)
				]);
				//echo $_FILES['hotel_image']['name'][0]; exit();
				//print_r($_FILES); exit();
			
				if(isset($_FILES['hotel_image']) && $_FILES['hotel_image']['name'][0]!=''){
					$files_count = count($request->file('hotel_image'));
				$i = 1; $filenames = '';$files='';

        foreach($request->file('hotel_image') as $imageName)
        {
            if(!empty($imageName))
            {
				
				if($i == $files_count) {
				
				$filename = $imageName->getClientOriginalName();
				$temp = explode(".", $filename);
				$newfilename = $temp[0]."_".round(microtime(true)) . '.' . end($temp);
				$imageName->move(base_path().$destinationPath, $newfilename);
				$files .= $newfilename;
				}
				else {
				$filename = $imageName->getClientOriginalName();
				$temp = explode(".", $filename);
				$newfilename = $temp[0]."_".round(microtime(true)) . '.' . end($temp);
				$imageName->move(base_path().$destinationPath, $newfilename);
				$files .= $newfilename.",";
				}
				
            }
			$i++;
        }
		\DB::table('hotels')->where('hotel_id', $hotel_id)->update(['hotel_image' => $files]);
	}
		
		if(isset($_FILES['hotel_docs']) && $_FILES['hotel_docs']['name'][0]!=''){
			$docfiles = count($request->file('hotel_docs'));
		$j = 1; $docfilenames = ''; $doc_files='';
        foreach($request->file('hotel_docs') as $docsName)
        {
            if(!empty($docsName))
            {
				if($j == $docfiles) {
					
				$docfilenames = $docsName->getClientOriginalName();
				$temp1 = explode(".", $docfilenames);
				$newdocfilename = $temp[0]."_".round(microtime(true)) . '.' . end($temp1);
				$docsName->move(base_path().$docsdestinationPath, $newdocfilename);
				$doc_files .= $newdocfilename;				
				}
				else {
					
				$docfilenames = $docsName->getClientOriginalName();
				$temp1 = explode(".", $docfilenames);
				$newdocfilename = $temp[0]."_".round(microtime(true)) . '.' . end($temp1);
				$docsName->move(base_path().$docsdestinationPath, $newdocfilename);
				$doc_files .= $newdocfilename.",";
				}
            }
			$j++;
        }
				
		\DB::table('hotels')->where('hotel_id', $hotel_id)->update(['hotel_docs' => $doc_files]);
		}		
			}
			return redirect('/hotel/'.$hotel_id)->with('status', 'Hotel updated successfully!');
		}
		else {
			return redirect('/login');
		}
	}
	
	// FOR EDIT HOTEL ROOMS DATA
	public function edithotelroomdata(Request $request)
	{
		$hotel_id = $request->hid; 	
		$room_id = $request->rid; 	
		if($room_id > 0)
		{
			$hotels_roomdata = \DB::table('hotels_roomdata')->where('hotel_room_id',$room_id)->get();
			$hotels_extra_roomdata = \DB::table('hotels_extra_roomdata')->where('hotel_id',$hotel_id)->get();
			//dd(count($hotels_roomdata));exit;
			$roomaminities = \DB::table('hotelaminities')->orderBy('aid', 'ASC')->get();			
			return view('hotels.hotel_edit_roomdata',array('hotels_roomdata'=>$hotels_roomdata,'hotels_extra_roomdata'=>$hotels_extra_roomdata,'roomaminities'=>$roomaminities));
		}
		else {
			return redirect('/hotels-list');
		}
			
	}
	
	// FOR EDIT HOTEL ROOM DATA SAVE (UPDATE)
	public function updatehotelroomdata(Request $request)
	{
		$room_id = $request->rid;
		
		if($request->roomfromdate != '') {
				$hotel_checkin = date("Y-m-d",strtotime($request->roomfromdate));
			}
			else {
				$hotel_checkin = date("Y-m-d");
			}
			
			if($request->roomtodate != '') {
				$hotel_checkout = date("Y-m-d",strtotime($request->roomtodate));
			}
			else {
				$hotel_checkout = date("Y-m-d");
			}
		if($room_id > 0)
		{		
			 $hotel_id = $request->hotel_id; 
		
				if(!empty($room_id))
				{
					$room_type_arr = $request->hotel_roomtype;
					$max_adult_arr = $request->max_adult;
					$max_child_arr = $request->max_child;					
					$extra_room = $request->extra_room;
					$extra_adult = $request->extra_adult;
					$extra_child = $request->extra_child;
					$child_age = $request->child_age;
					$free_child_age = $request->free_child_age;
					$roomfromdate = $request->roomfromdate;
					$roomtodate = $request->roomtodate;					
					$price_arr = $request->price;
					$saleprice_arr = $request->saleprice;
					$hotel_amenities = '';
					if(!empty($request->amenities)) {
						$hotel_amenities = implode(",",$request->amenities);
					}
					
						\DB::table('hotels_roomdata')->where('hotel_room_id', $room_id)						
						->update([
							'hotel_roomtype' => $room_type_arr,
							'hotel_max_adult' => $max_adult_arr,
							'hotel_max_child' => $max_child_arr,							
							'hotel_extra_child' => $extra_child,
							'hotel_extra_adult' => $extra_adult,
							'hotel_extra_room' => $extra_room,
							'room_fromdate' => $hotel_checkin,
							'room_todate' => $hotel_checkout,
							'child_age' => $child_age,
							'hotel_child_free_age' => $free_child_age,
							'hotel_price' => $price_arr,
							'hotel_saleprice' => $saleprice_arr,
							'hotel_amenities' =>addslashes($hotel_amenities),
						]);
						
				}
				
				$destinationPath = '/public/hotel_room_images';
				if(isset($_FILES['hotel_image']) && $_FILES['hotel_image']['name'][0]!=''){
				$files_count = count($request->file('hotel_image'));
				$j = 1; $filenames = '';$files='';
		 
        foreach($request->file('hotel_image') as $imageName)
        {
			if(!empty($imageName))
            {
				if($j == $files_count) {
				
				$filename = $imageName->getClientOriginalName();
				$temp = explode(".", $filename);
				$newfilename = $temp[0]."_".round(microtime(true)) . '.' . end($temp);
				$imageName->move(base_path().$destinationPath, $newfilename);
				$files .= $newfilename;
				}
				else {
				$filename = $imageName->getClientOriginalName();
				$temp = explode(".", $filename);
				$newfilename = $temp[0]."_".round(microtime(true)) . '.' . end($temp);
				$imageName->move(base_path().$destinationPath, $newfilename);
				$files .= $newfilename.",";
				}
				
            }
			$j++;
        }
		
				\DB::table('hotels_roomdata')->where('hotel_room_id', $room_id)->update(['hotel_image' => $files]);	
				}
				return redirect('/room-list/'.$hotel_id)->with('status', 'Hotel rooms updated successfully!');
			
			
		}
		else {
			return redirect('/hotels-list');
		}
	}
	
	// FOR DELETE HOTEL 
	public function deletehotel(Request $request)
	{
		if (Auth::check())
		{
			$hotel_id = $request->hid;
			\DB::table('hotels')->where('hotel_id', $hotel_id)->delete();
			
			return redirect('/hotels-list')->with('status', 'Hotel deleted successfully!');
		}
	}
		
	// ADD NEW HOTEL
	public function hotel_add()
	{
		if (Auth::check())
		{
			$hotelaminities = \DB::table('hotelaminities')->orderBy('aid', 'ASC')->get();
			$hoteltypes = \DB::table('hoteltype')->orderBy('tid', 'ASC')->get();
			$hotelchainttypes = \DB::table('hotelchainttype')->orderBy('cid', 'ASC')->get();
			return view('hotels.hotel_add',array('hotelaminities'=>$hotelaminities,'hoteltypes'=>$hoteltypes,'hotelchainttypes'=>$hotelchainttypes));
			
			return view('hotels.hotel_add');
		}
		else {
			return redirect('/login');
		}
	}
	
	// SAVE NEW HOTEL
	public function hotel_save(Request $request)
	{
		if (Auth::check())
		{
			$doc_files = '';

			//@session_start();
			$destinationPath = '/public/hotel_images';
			$docsdestinationPath = '/public/hotel_docs';
			
			$hotel_name = $request->hotel_name;
			
			if($request->hotel_checkin != '') {
				$hotel_checkin = date("Y-m-d",strtotime($request->hotel_checkin));
			}
			else {
				$hotel_checkin = date("Y-m-d");
			}
			
			if($request->hotel_checkout != '') {
				$hotel_checkout = date("Y-m-d",strtotime($request->hotel_checkout));
			}
			else {
				$hotel_checkout = date("Y-m-d");
			}
			$hotel_checkin_time = $request->hotel_checkin_time;
			$hotel_checkout_time = $request->hotel_checkout_time;
			$hotel_checkin_ampm = $request->hotel_checkin_ampm;
			$hotel_checkout_ampm = $request->hotel_checkout_ampm;	
			$hotel_totalroom = $request->totalroom;			
			$hotel_address = $request->hotel_address;
			$hotel_location = $request->hotel_location;
			$hotel_state_location = $request->hotel_state_location;
			$hotel_country_location = $request->hotel_country_location;
			$hotel_pincode = $request->hotel_pincode;
			$hotel_highlights = $request->hotel_highlights;
			$hotel_paymentpolicy = $request->hotel_paymentpolicy;
			$hotel_nearestplace = $request->hotel_nearestplace;
			$hotel_cancellationpolicy = $request->hotel_cancellationpolicy;
			$hotel_termsconditions = $request->hotel_termsconditions;
			$hotel_bankdetail = $request->hotel_bankdetail;			
			$hotel_bank_accountname = $request->hotel_bank_accountname;
			$hotel_bank_accountno = $request->hotel_bank_accountno;
			$hotel_bankname = $request->hotel_bankname;
			$hotel_bank_state = $request->hotel_bank_state;
			$hotel_bank_code = $request->hotel_bank_code;
			$hotel_contact_name = $request->hotel_contact_name;			
			$hotel_contact = $request->hotel_contact;
			$hotel_mobile = $request->hotel_mobile;
			$hotel_email = $request->hotel_email;
			$hotel_fax = $request->hotel_fax;
			$hotel_code=$request->hotel_code;
			$hotel_type=$request->hotel_type;
			$hotel_chain=$request->hotel_chain;
			$hotel_star=$request->hotel_star;
			$hotel_restaurant=$request->hotel_restaurant;
			$totalfloor = $request->totalfloor;
			$hotel_currency = 'Indian Rupee';
			$hotel_website = $request->hotel_website;
			$hotel_panno = $request->hotel_panno;
			$hotel_pancardname = $request->hotel_pancardname;
			$hotel_servicetaxno =  $request->hotel_servicetaxno;
			$hotel_gst_no = $request->hotel_gst_no;
			$hotel_gst_name = $request->hotel_gst_name;
			$hotel_gst_address = $request->hotel_gst_address;
			$hotel_gst_state = $request->hotel_gst_state;
			$hotel_gst_pincode = $request->hotel_gst_pincode;
			$hotel_gst_contact = $request->hotel_gst_contact;
			$hotel_gst_email = $request->hotel_gst_email;
			$hotel_gst_designation = $request->hotel_gst_designation;
			
		
			$hotel_amenities = '';
			if(count($request->amenities) > 0)
			{
				$amenities = $request->amenities;
				foreach($amenities as $amenity) {
					$hotel_amenities .= $amenity.",";
				}
				$hotel_amenities = substr($hotel_amenities,0,strlen($hotel_amenities)-1);
			}
		
			$id = \DB::table('hotels')->insertGetId(
			['hotel_name' => trim($hotel_name), 
			'hotel_room' => trim($hotel_totalroom),
			'hotel_address' => trim($hotel_address), 
			'fromdate' => $hotel_checkin,
			'todate' => $hotel_checkout,
			'city_location' => trim($hotel_location),
			'state_location' => trim($hotel_state_location),
			'country_location' => trim($hotel_country_location),
			'hotel_pincode' => trim($hotel_pincode),
			'hotel_amenities' => $hotel_amenities,
			'checkin_time' => trim($hotel_checkin_time).' '.trim($hotel_checkin_ampm),
			'checkout_time' => trim($hotel_checkout_time).' '.trim($hotel_checkout_ampm),
			'hotel_highlights' => trim($hotel_highlights),
			'hotel_paymentpolicy' => trim($hotel_paymentpolicy),
			'hotel_cancellationpolicy' => trim($hotel_cancellationpolicy),
			'hotel_terms_conditions' => trim($hotel_termsconditions),
			'hotel_nearestplace' =>trim($hotel_nearestplace),
			'hotel_bankdetail' =>trim($hotel_bankdetail),			
			'hotel_bank_accountname' =>trim($hotel_bank_accountname),
			'hotel_bank_accountno' =>trim($hotel_bank_accountno),
			'hotel_bank_branch' =>trim($hotel_bankname),
			'hotel_bank_state' =>trim($hotel_bank_state),
			'hotel_bank_code' =>trim($hotel_bank_code),
			'hotel_contact_name' => trim($hotel_contact_name),
			'hotel_contact' =>trim($hotel_contact),
			'hotel_mobile' => trim($hotel_mobile),
			'hotel_email' =>trim($hotel_email),
			'hotel_fax' =>trim($hotel_fax),
			'hotel_code'=>trim($hotel_code),
			'hotel_type' => trim($hotel_type),
			'hotel_chain' => trim($hotel_chain),
			'hotel_star' => trim($hotel_star),
			'hotel_restaurant' => trim($hotel_restaurant),
			'hotel_floor' => trim($totalfloor),
			'hotel_currency' => trim($hotel_currency),
			'hoel_website' => trim($hotel_website),
			'hotel_pan_no' => trim($hotel_panno),
			'hotel_pan_name' => trim($hotel_pancardname),
			'hotel_pan_serviceno' => trim($hotel_servicetaxno),
			'hotel_gst_no' => trim($hotel_gst_no),
			'hotel_gst_name' => trim($hotel_gst_name),
			'hotel_gst_address' => trim($hotel_gst_address),
			'hotel_gst_state' => trim($hotel_gst_state),
			'hotel_gst_pincode' => trim($hotel_gst_pincode),
			'hotel_gst_contact' => trim($hotel_gst_contact),
			'hotel_gst_email' => trim($hotel_gst_email),
			'hotel_gst_designation' => trim($hotel_gst_designation),
			'hotel_docs' => '',	
			'hotel_image' => '',	
			'hotel_status' => 0,
			'user_id' => Auth::user()->id
			]);
			
			
			/*
			$imageName = $id . '.' . $request->file('hotel_image')->getClientOriginalExtension();
			$request->file('hotel_image')->move(base_path() . $destinationPath, $imageName);
			
			$docsName = $id . '.' . $request->file('hotel_docs')->getClientOriginalExtension();
			$request->file('hotel_docs')->move(base_path() . $docsdestinationPath, $docsName);
			*/
		$files_count = count($request->file('hotel_image'));
		$i = 1; $filenames = '';$files='';
        foreach($request->file('hotel_image') as $imageName)
        {
            if(!empty($imageName))
            {
				if($i == $files_count) {

				$filename = $imageName->getClientOriginalName();
				$temp = explode(".", $filename);
				$newfilename = $temp[0]."_".round(microtime(true)) . '.' . end($temp);
				$imageName->move(base_path().$destinationPath, $newfilename);
				$files .= $newfilename;
				}
				else {
				$filename = $imageName->getClientOriginalName();
				$temp = explode(".", $filename);
				$newfilename = $temp[0]."_".round(microtime(true)) . '.' . end($temp);
				$imageName->move(base_path().$destinationPath, $newfilename);
				$files .= $newfilename.",";
				}
				
            }
			$i++;
        }
		if(!empty($request->file('hotel_docs'))){

			$docfiles = count($request->file('hotel_docs'));
			$j = 1; $docfilenames = ''; $doc_files='';
	        foreach($request->file('hotel_docs') as $docsName)
	        {
	            if(!empty($docsName))
	            {
					if($j == $docfiles) {
						
					$docfilenames = $docsName->getClientOriginalName();
					$temp1 = explode(".", $docfilenames);
					$newdocfilename = $temp[0]."_".round(microtime(true)) . '.' . end($temp1);
					$docsName->move(base_path().$docsdestinationPath, $newdocfilename);
					$doc_files .= $newdocfilename;				
					}
					else {
						
					$docfilenames = $docsName->getClientOriginalName();
					$temp1 = explode(".", $docfilenames);
					$newdocfilename = $temp[0]."_".round(microtime(true)) . '.' . end($temp1);
					$docsName->move(base_path().$docsdestinationPath, $newdocfilename);
					$doc_files .= $newdocfilename.',';
					}
	            }
				$j++;
	        }
	    }
			
			\DB::table('hotels')->where('hotel_id', $id)->update(['hotel_image' => $files,'hotel_docs' => $doc_files]);

			
			
			if(Session::has('hotel_id'))
			{
				$request->session()->forget('hotel_id');
				$request->session()->put('hotel_id',$id);
			}
			else {
				$request->session()->put('hotel_id',$id);
			}
			
			$hotel_detail = \DB::table('hotels')->where('hotel_id', $id)->get();
			//print_r($hotel_detail);exit;
		$hotel_id = $hotel_detail[0]->hotel_id;
		$name = $hotel_detail[0]->hotel_name;
		$city_location = $hotel_detail[0]->city_location;		
		$userid = $hotel_detail[0]->user_id;
		$hotelemail = $hotel_detail[0] -> hotel_email;
			
			// $subject = "Message from New Hotel Add on Hotel ID ".$hotel_id;
			// $mg = new Mailgun("key-a886acc552c9ecb8cae8937ff13894ec");
			// $domain = "bulkmail.influensell.net";
			// $batchMsg = $mg->BatchMessage($domain);
			// $batchMsg->setFromAddress("info@tripindia.com", array("first"=>"Trip", "last" => "India"));
			// $batchMsg->setSubject($subject);
			
			// $message = '<html xmlns="http://www.w3.org/1999/xhtml">
			// <head>
			// 	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			// </head>
			// <body>
			// 	<strong>NEW Hotel Add By Operator.</strong><br />
			// 	<hr />
			// 	Hotel ID : '.$hotel_id.'<br>
			// 	Hotel Name : '.$name.'<br>
			// 	city_location : '.$city_location.'<br>				
			// 	user ID : '.$userid.'<br>
			// 	Hotel Email : '.$hotelemail.'<br>
			// 	<hr />
			// </body>
			// </html>';
			// $batchMsg->setHtmlBody($message);
			// $batchMsg->addToRecipient($hotelemail, array("first" => "jalpesh", "last" => "bhadarka"));
			// //$batchMsg->addCcRecipient('ramesh@anibyte.net', array("first" => "Ramesh", "last" => "Anibyte"));
			// $batchMsg->addBccRecipient('jalpesh@anibyte.net', array("first"=>"Prashanth", "last" => "Sirsi"));
			// //$batchMsg->addBccRecipient("bhadarka.jalpesh@anibyte.net", array("first"=>"Sudhakar", "last" => ""));
			// //$batchMsg->addBccRecipient("nikjoshi96@gmail.com", array("first"=>"Nikunj", "last" => "Joshi"));
			// $batchMsg->finalize();
			
		    return redirect('/hotels-list');
		}
		else {
			return redirect('/login');
		}
	}
	
	
	// ADD NEW TOUR PRICE
	
	public function addhotel_price(Request $request)
	{
		if (Auth::check())
		{
			
			if(Session::has('hotel_id'))
			{
				return view('hotels.hotel_add_price');
			}
			else {
				return redirect('/hotel-add');
			}
		}
		else {
			return redirect('/login');
		}
		
	}

	// SAVE NEW TOUR PACKAGE
	public function savehotel_price(Request $request) 
	{
		if(Session::has('hotel_id'))
		{
			$id = $request->session()->get('hotel_id');
			//print_r($_REQUEST);EXIT;
			$hotel_detail = \DB::table('hotels')->where('hotel_id', $id)->get();
							\DB::table('hotel_price')->insertGetId([
							'hotel_id' => $id,
							'adno'=> trim($request->get('adno')),
							'adprice'=> trim($request->get('adprice')),
							'addiscount'=> trim($request->get('addiscount')),
							'adflatdiscount'=> trim($request->get('adflatdiscount')),
							'adtotal'=> trim($request->get('adtotal')),
							'cdno'=> trim($request->get('cdno')),
							'cdprice'=> trim($request->get('cdprice')),
							'cddiscount'=> trim($request->get('cddiscount')),
							'cdflatdiscount'=> trim($request->get('cdflatdiscount')),
							'cdtotal'=> trim($request->get('cdtotal'))							
							]);
						
						
				return redirect('/hotel-add-roomdata');
			
		}
		else {
			return redirect('/hotel-add');
		}
	}
	
	// ADD HOTEL ROOM DATA
	public function hotel_add_roomdata()
	{
		if (Auth::check())
		{
			$hotelaminities = \DB::table('hotelaminities')->orderBy('aid', 'ASC')->get();
			$bedtypes = \DB::table('bedtype')->orderBy('bid', 'ASC')->get();
			$extrabedtypes = \DB::table('extrabedtype')->orderBy('ebid', 'ASC')->get();
			$roomviews = \DB::table('roomview')->orderBy('rvid', 'ASC')->get();
			
			return view('hotels.hotel_add_roomdata',array('hotelaminities'=>$hotelaminities,'bedtypes'=>$bedtypes,'extrabedtypes'=>$extrabedtypes,'roomviews'=>$roomviews));			
			
			
			if(Session::has('hotel_id'))
			{
				return view('hotels.hotel_add_roomdata');
			}
			else {
				return redirect('/hotel-add');
			}
		}
		else {
			return redirect('/login');
		}
	}
	
	// SAVE HOTEL ROOM DATA
	public function hotel_save_roomdata(Request $request)
	{
		$destinationPath = '/public/hotel_room_images';
		$destinationPath_room = '/public/hotel_extraroom_images';
		
		if (Auth::check())
		{
           if(Session::has('hotel_id'))
			{
				
					//(!empty($request->room_type))
					$room_type_arr = $request->new_room_type;
					$max_adult_arr = $request->max_adult;
					$max_child_arr = $request->max_child;
					$extra_room = $request->extra_room;
					$extra_adult = $request->extra_adult;
					$extra_child = $request->extra_child;
					$roomfromdate = date("Y-m-d",strtotime($request->roomfromdate[0]));
					$roomtodate = date("Y-m-d",strtotime($request->roomtodate[0]));
					$child_age = $request->child_age;
					$free_child_age = $request->free_child_age;
					$price_arr = $request->price;
					$saleprice_arr = $request->saleprice;
					$hotel_room_view = $request->new_room_view;
					$hotel_room_desc = $request->new_room_desc;
					$hotel_bed_type = $request->new_bed_type;
					$hotel_extrabed_type = $request->new_extrabed_type;
					$hotel_room_size = $request->new_room_size;
					$hotel_amenities = '';
					if(count($request->amenities) > 0)
					{
						$amenities = $request->amenities;
						foreach($amenities as $amenity) {
							$hotel_amenities .= $amenity.",";
						}
						$hotel_amenities = substr($hotel_amenities,0,strlen($hotel_amenities)-1);
					}
					$i=0;			
						$id = \DB::table('hotels_roomdata')->insertGetId(
						['hotel_roomtype' => trim($room_type_arr), 
						'hotel_max_adult' => trim($max_adult_arr[$i]), 
						'hotel_max_child' => trim($max_child_arr[$i]),
						'hotel_extra_room' => trim($extra_room[$i]),
						'hotel_extra_adult' => trim($extra_adult[$i]),	
						'hotel_extra_child' => trim($extra_child[$i]),	
						'room_fromdate' => trim($roomfromdate),
						'room_todate' => trim($roomtodate),	
						'child_age' => trim($child_age[$i]),
						'hotel_child_free_age' => trim($free_child_age),
						'hotel_price' => trim($price_arr[$i]),
						'hotel_saleprice' => trim($saleprice_arr[$i]),
						'hotel_room_view' => trim($hotel_room_view),	
						'hotel_room_desc' => trim($hotel_room_desc),	
						'hotel_bed_type' => trim($hotel_bed_type),	
						'hotel_extrabed_type' => trim($hotel_extrabed_type),	
						'hotel_room_size' => trim($hotel_room_size),						
						'hotel_amenities' => $hotel_amenities,
						'hotel_id' => Session::get('hotel_id'),
						'user_id' => Auth::user()->id
						]);
						$i++;
						
						$files_count = count($request->file('hotel_image'));
						$j = 1; $filenames = '';$files='';
		 
        foreach($request->file('hotel_image') as $imageName)
        {
			if(!empty($imageName))
            {
				if($i == $files_count) {
				
				$filename = $imageName->getClientOriginalName();
				$temp = explode(".", $filename);
				$newfilename = $temp[0]."_".round(microtime(true)) . '.' . end($temp);
				$imageName->move(base_path().$destinationPath, $newfilename);
				$files .= $newfilename;
				}
				else {
				$filename = $imageName->getClientOriginalName();
				$temp = explode(".", $filename);
				$newfilename = $temp[0]."_".round(microtime(true)) . '.' . end($temp);
				$imageName->move(base_path().$destinationPath, $newfilename);
				$files .= $newfilename.",";
				}
				
            }
			$i++;
        }
		
				\DB::table('hotels_roomdata')->where('hotel_room_id', $id)->update(['hotel_image' => $files]);		
						/*
						$imageName = $id . '.' . $request->file('hotel_image')->getClientOriginalExtension();
						$request->file('hotel_image')->move(base_path() . $destinationPath, $imageName);
						*/
						

					if($request->btn_add_new_hotel) {
						return redirect('/hotel-add-roomdata');
					}
					else {
						return redirect('/hotel-add');
					}
				

			}
			else {
				return redirect('/hotel-add');
			}
		}
		else {
			return redirect('/login');
		}
	}
	
	public function export_myhotels($type)
	{
		$data1[0]= ['Hotel Id', 'User Id' , 'hotel_name ', 'Hotel address','City Location', 'Hotel Pincode','Hotel Amenities','From Date','To Date',
		'Checkin time','Checkout time','Hotel highlights','Hotel cancellation fees','Hotel payment policy','Hotel cancellation policy','hotel_terms_conditions','hotel_status','Created'];    	
		
		$data2 =  Hotels::get(['hotel_id','user_id','hotel_name','hotel_address','city_location','hotel_pincode','hotel_amenities','fromdate','todate',
		'checkin_time','checkout_time','hotel_highlights','hotel_cancellationfees','hotel_paymentpolicy','hotel_cancellationpolicy','hotel_terms_conditions','hotel_status','created_at'])->toArray();
		
		$data = array_merge($data1,$data2);
		return Excel::create('Activity data', function($excel) use ($data) {		
		$excel->sheet('Activity', function($sheet) use ($data) { $sheet->fromArray($data, null, 'A1', false, false);});
  	    })->download($type);
		return redirect()->back();
	}
	
	public function hotelaminities(){
		
		if (Auth::check())
		{
			return view('hotels.hotelaminities');
		}
		else {
			return redirect('/login');
		}
		
	}
	
	public function hotelaminitiessave(Request $request)
	{
		        		
			$aminity =  $request->get('aminity_name');
			
			$this->validate($request, ['aminity_name' => 'required']);
		
			\DB::table('hotelaminities')->insert(['aminity_name' => $aminity, 
			'created_at' =>date("Y-m-d H:i:s"),
			'updated_at' =>date("Y-m-d H:i:s")]);
			
		return back()->with('success', 'Add Hotel Aminitiessave successfully.');
		
	}
	public function hoteltype(){
		
		if (Auth::check())
		{
			return view('hotels.hoteltype');
		}
		else {
			return redirect('/login');
		}
		
	}
	
	public function hoteltypesave(Request $request)
	{
		        		
			$hoteltype =  $request->get('hoteltype');
			
			$this->validate($request, ['hoteltype' => 'required']);
		
			\DB::table('hoteltype')->insert(['hoteltypename' => $hoteltype, 
			'created_at' =>date("Y-m-d H:i:s"),
			'updated_at' =>date("Y-m-d H:i:s")]);
			
		return back()->with('success', 'Add Hotel Type successfully.');
		
	}
	
	public function getahotelcall(Request $request)
	{
		
		$hotel_id = (int) trim($request->hid); 		
		$name = trim($request->name);
		$email = trim($request->email);
		$mobile = trim($request->mobile);		
		$inqmesg = trim($request->message);
		
		
		if($hotel_id > 0)
		{
			$subject = "Message from ".$name." on Hotel ID ".$hotel_id;
			$mg = new Mailgun("key-a886acc552c9ecb8cae8937ff13894ec");
			$domain = "bulkmail.influensell.net";
			$batchMsg = $mg->BatchMessage($domain);
			$batchMsg->setFromAddress("info@tripindia.com", array("first"=>"Trip", "last" => "India"));
			$batchMsg->setSubject($subject);
			
			$message = '<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			</head>
			<body>
				<strong>Get a call from Hotel search</strong><br />
				<hr />
				Hotel ID : '.$hotel_id.'<br>				
				Name : '.$name.'<br>
				Email From : '.$email.'<br>
				Mobile : '.$mobile.'<br>
				Message : '.$inqmesg.'<br>
				<hr />
			</body>
			</html>';
			$batchMsg->setHtmlBody($message);
			$batchMsg->addToRecipient('jalpesh@anibyte.net', array("first" => "Jalpesh", "last" => "Bhadarka"));
			//$batchMsg->addCcRecipient('jalpesh@anibyte.net', array("first" => "Jalpesh", "last" => "Bhadarka"));
			//$batchMsg->addBccRecipient("prashanth@anibyte.net", array("first"=>"Prashanth", "last" => "Sirsi"));
			//$batchMsg->addBccRecipient("sudhakar@anibyte.net", array("first"=>"Sudhakar", "last" => ""));
			$batchMsg->addBccRecipient("nikjoshi96@gmail.com", array("first"=>"Nikunj", "last" => "Joshi"));
			$batchMsg->finalize();
			echo "success"; exit();
		}
		
		echo "Fail"; exit();
	}

}
