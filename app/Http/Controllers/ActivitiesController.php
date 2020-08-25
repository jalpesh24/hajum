<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Activities;
use App\User;

use Session;
use Auth;
use DB;
use Mailgun\Mailgun;

class ActivitiesController extends Controller
{
	// SEARCH ACTIVITY PACKAGE
	public function searchactivities(Request $request)
	{
		$input = trim($request->get("txt_activity_name_location_id"));
		$name_location = trim($request->get("txt_activity_name_location"));
		
		//$activities = \DB::table('activities')->where('activities_name', 'like', '%'.$name_location.'%')->orderBy('activities_name', 'asc')->get();
		$activities = \DB::table('activities')->where('activities_name', 'like', '%'.$name_location.'%')
            ->orWhere('activities_location',  'like', '%'.$name_location.'%')
            ->get();
		return view('activities_search',array('activities'=>$activities,"name_location"=>$name_location));
	}
	
	// SEARCH ACTIVITY PACKAGE (AJAX)
	public function listsearchactivities(Request $request)
	{
		$token =  $request->get("_token");
		
		$name_location = trim($request->get("name_location"));
		$activity_sql = "";
		if($name_location != "") {
			$activity_sql = "AND (`activities_name` LIKE '%".$name_location."%' OR `activities_location` LIKE '%".$name_location."%') ";
		}
		
		$activity_category =  $request->get("activity_category");
		$category_sql = "";
		if($activity_category != "") {
			$category_sql = "AND `activities_category` IN (".$activity_category.")";
		}
		
		$price_sql = '';
		if($request->get("activity_price") && $request->get("activity_price") != '')
		{
			$activity_price_arr =  explode(",",$request->get("activity_price"));
			
			if(count($activity_price_arr) == 1)
			{
				$activity_price_arr1 = explode("-",$activity_price_arr[0]);
				$price_sql = "AND `activities_price` BETWEEN ".$activity_price_arr1[0]." AND ".$activity_price_arr1[1]." ";
			}
			elseif(count($activity_price_arr) > 1)
			{
				$total = count($activity_price_arr);
				$price_sql = "AND `activities_price` BETWEEN ";
				for($i=0; $i <$total; $i++)
				{
					$activity_price_arr1 = explode("-",$activity_price_arr[$i]);
					if($i == 0) {
						$price_sql .= $activity_price_arr1[0]. " AND ";
					}
					elseif($i == ($total-1)) {
						$price_sql .= $activity_price_arr1[1];
					}
				}
			}
		}
		
		$activities = DB::select("SELECT * FROM `activities` WHERE `activities_status` = 'Active' ".$activity_sql." ".$category_sql." ".$price_sql);
		echo '<div class="right-bar grid-view">';
		//echo "SELECT * FROM `activities` WHERE `activities_status` = 'Active' ".$activity_sql." ".$category_sql." ".$price_sql;
		foreach($activities as $activity)
		{
			echo '<div class="col-md-4">
				<div style="margin-top:20px;">';
				if($activity->activities_image != '') {
					echo '<div><img src="'.url('/activities/'.$activity->activities_image).'" class="img-responsive" ></div>';
				}
				else {
					echo'<div><img src="'.url('/activities/akshardham.jpg').'" class="img-responsive"></div>';
				}
				echo '<div style="padding-top:10px;"><strong>'.$activity->activities_name.'</strong></div>
					<div style="padding-top:25px;">Price: Rs '.$activity->activities_price.'</div>
					<span>Location: '.$activity->activities_location.'</span>
					<div style="padding:10px 0 25px 0;"> <a href="'.url('/activitydetail/'.$activity->activities_id).'" class="btn btn-warning">Book now</a></div>
				</div>
			</div>';
		}
		echo '</div>';
		exit();
	}
	
	// SEARCH ACTIVITY PACKAGE
	public function getactivities(Request $request)
	{
		$query = $request->get("query");
		
		$activities_location = \DB::table('activities')->select('activities_location')->where('activities_location', 'like', '%'.$query.'%')->groupBy('activities_location')->orderBy('activities_location', 'asc')->get();
		$activities = array(); $i = 1;
		echo "["; $str = '';
		foreach($activities_location as $location)
		{
			$activities['id']= $query;
			$activities['label'] = ucwords(strtolower($location->activities_location));
			$str .= json_encode($activities).",";
			$i++;
		}
		$activities_name = \DB::table('activities')->select('activities_name')->where('activities_name', 'like', '%'.$query.'%')->groupBy('activities_name')->orderBy('activities_name', 'asc')->get();
		foreach($activities_name as $name)
		{
			$activities['id']= $query;
			$activities['label'] = ucwords(strtolower($name->activities_name));
			$str .= json_encode($activities).",";
			$i++;
		}
		$str = substr($str,0,strlen($str)-1);
		echo $str."]"; exit();
	}
	
	// ACTIVITY DETAIL
	public function activitydetail(Request $request) 
	{
		$activities_id = $request->route('aid');
		$activities = \DB::table('activities')->where('activities_id',$activities_id)->orderBy('activities_id', 'asc')->get();
		return view('activity_detail_view',array('activities'=>$activities));
	}
	
	// ADD NEW ACTIVITY
	public function activity_add()
	{
		if (Auth::check()) {
			return view('activities.activity_add');
		}
		else {
			return redirect('/login');
		}
	}
	
	// SAVE NEW ACTIVITY
	public function activity_save(Request $request) 
	{
		if (Auth::check())
		{
			$destinationPath = '/public/activities';
			$user_id = Auth::user()->id;
			
			$activities = new Activities();
			
			$id = \DB::table('activities')->insertGetId(
				['activities_name' => trim($request->get('activities_name')),
				'activities_category' => trim($request->get('activities_category')), 
				'activities_location' => trim($request->get('activities_location')),
				'activities_price' => trim($request->get('activities_price')),
				'activities_description' => trim($request->get('activities_description')),
				'activities_additional_info' => trim($request->get('activities_additional_info')),
				'activities_highlights' => trim($request->get('activities_highlights')),
				'activities_duration' => trim($request->get('activity_duration')),
				'activities_meeting_point' => trim($request->get('activities_meeting_point')),
				'activities_meeting_time' => trim($request->get('activities_meeting_time')),
				'activities_rating' => trim($request->get('activities_rating')),
				'activities_status' => trim($request->get('activities_status')),
				'activities_terms_condition' => trim($request->get('activities_terms_condition')),
				'user_id' => Auth::user()->id
				]
			);
			
			if($request->file('mainimg'))
			{
				$imageName = $id . '.' . $request->file('mainimg')->getClientOriginalExtension();
			
				$request->file('mainimg')->move(base_path() . $destinationPath, $imageName);
		
				\DB::table('activities')->where('activities_id', $id)->update(['activities_image' => $imageName]);
			}
			return redirect('/activity-add')->with('status', 'Activity added successfully!');
		}
		else {
			return redirect('/login');
		}
	}
	
	// ACTIVITY LIST
	public function activity_list()
	{
		$user_id = Auth::user()->id;
		$activities = \DB::table('activities')->where('user_id',$user_id)->orderBy('activities_id', 'asc')->get();
		return view('activities.activity_list',array('activities'=>$activities));
	}
	
	public function insertactivityorder(Request $request)
	{
		@session_start(); 
		$activities_id = 0;
		if($request->has('activities_id') && $request->get('activities_id') > 0) {
			$activities_id =  $request->get('activities_id');
		}
		elseif(Session::has('order_activity_id'))  {
			$activities_id =  Session::get('order_activity_id');
		}
		elseif(isset($_SESSION['order_activity_id']) && $_SESSION['order_activity_id']>0) {
			$activities_id =  $_SESSION['order_activity_id'];
		}
		
		if($activities_id > 0)
		{
			$firstname =  $request->get('firstname');
			$lastname =  $request->get('lastname');
			$email =  $request->get('email');
			$phone =  $request->get('phone');
			
			$address = $request->get('address');
			$pincode = "5653236";
			$city = $request->get('city');
			$state = $request->get('state');
			$country = $request->get('country');
			//$address =  $request->get('address');
			//$pincode =  $request->get('pincode');
			//$city =  $request->get('city');
			//$state =  $request->get('state');
			
			$productinfo = $request->get('productinfo');
			$price_per_person = $request->get('price_per_person');
			
			if($request->has("no_of_adults")) {
				$no_of_persons = $request->get('no_of_adults');
			}
			elseif($request->has("no_of_persons")) {
				$no_of_persons = $request->get('no_of_persons');
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
			
			$coupon_amount = 0;
			if(trim($coupon_code) != "")
			{
				$coupon = \DB::table('coupons')->where('coupon_code', trim($coupon_code))->get()->toArray();
				if(!empty($coupon)) {
					$coupon_amount = $coupon[0]->coupon_amount;
				}
			}
			
			$order_id = \DB::table('orders')->insertGetId([
				'activity_id' => $activities_id, 
				'user_id' => Auth::id(), 
				'tour_name' => trim($productinfo),
				'firstname' => trim($firstname),
				'lastname' => trim($lastname),
				'email' => trim($email),
				'phone' => trim($phone),
				'city' => trim($city),
				'state' => trim($state),
				'country' => trim($country),
				'address' => trim($address),
				'no_of_persons' => $no_of_persons,
				'tour_date' => $tour_date,
				'coupon_code' => trim($coupon_code),
				'coupon_amount' => trim($coupon_amount),
				'amount' => $request->get('amount'),
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
			]); 
			Session::put('order_id', $order_id);
			$_SESSION['order_id'] = $order_id;
		}
	}
	
	public function activitycheckout(Request $request) 
	{
		if (Auth::check()) 
		{
			@session_start();
			if(Session::has('order_activity_id')) 
			{
				$activity = \DB::table('activities')->where('activities_id', Session::get('order_activity_id'))->get();
				return view('activity-checkout',array('activity'=>$activity));
			}
			else {
				return back();
			}
		}
		else {
			return redirect('/login');
		}
	}
	
	public function checkoutactivityorder(Request $request)
	{
		@session_start();
		if(Session::has('order_activity_id')) {
			Session::put('order_activity_id', '');
		}
		
		$activities_id = $request->get("activity_id");
		Session::put('order_activity_id', $activities_id);
		$_SESSION['order_activity_id'] = $activities_id;
	}
	
	public function applycoupon(Request $request) 
	{
		$coupon_code = $request->coupon;
		$hotel_id = $request->hotel_id;
		
		$coupons = \DB::select("SELECT * FROM `coupons` WHERE `status` LIKE 'Active' AND `aht` = 1 AND `from_date` <= CURDATE() AND `to_date` >= CURDATE() AND `coupon_code` = '".$coupon_code."' ");
		
		if(!empty($coupons))
		{
			$data['success'] = $coupons[0]->coupon_amount;
		}
		else  {
			$data['error'] = 'Invalid Coupon Code';
		}
		echo json_encode($data); exit();
	}
	
	public function activitysuccess(Request $request) 
	{
		@session_start();
		$user_id = DB::table('activities')->where('activities_id',$_SESSION['order_activity_id'])->pluck('user_id');
        $activity_email = DB::table('users')->select('name','email')->where('id',$user_id)->get();
        $client_email = DB::table('orders')->select('firstname','lastname','email')->where('order_id',$_SESSION['order_id'])->get();
        
		if(isset($_SESSION['order_id']) && isset($_SESSION['order_activity_id']))
		{
			$subject = "Trip Activity Invoice ".$_SESSION['order_id'];
			$invoice = '<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			</head>
			<body>
				<strong>Payment Successfully</strong><br />
				<hr />
				Activity ID : '.$_SESSION['order_activity_id'].'<br>
				Order ID : '.$_SESSION['order_id'].'<br>
				<hr />
			</body>
			</html>';
			$mg = new Mailgun("key-a886acc552c9ecb8cae8937ff13894ec");
			$domain = "bulkmail.influensell.net";
			$batchMsg = $mg->BatchMessage($domain);
			$batchMsg->setFromAddress("info@tripindia.com", array("first"=>"Trip", "last" => "India"));
			$batchMsg->setSubject($subject);
			$batchMsg->setHtmlBody($invoice);
			$batchMsg->addToRecipient($client_email[0]->email, array("first" => $client_email[0]->firstname, "last" => $client_email[0]->lastname));
			$batchMsg->addCcRecipient($activity_email[0]->email, array("first" => $activity_email[0]->name, "last" => "Anibyte"));

			//$batchMsg->addBccRecipient("prashanth@anibyte.net", array("first"=>"Prashanth", "last" => "Sirsi"));
			//$batchMsg->addBccRecipient("sudhakar@anibyte.net", array("first"=>"Sudhakar", "last" => ""));
			$batchMsg->addBccRecipient("info@tripindia.com", array("first"=>"Trip", "last" => "India"));
			$batchMsg->finalize();
			
			unset($_SESSION['order_activity_id']);
			unset($_SESSION['order_id']);
			
			return view('payment_success');
		}
	}
	
	// FOR EDIT ACTIVITY
	public function editactivity(Request $request)
	{
		$activity_id = $request->aid;
		if($activity_id > 0)
		{
			$activity = \DB::table('activities')->where('activities_id',$activity_id)->get();
			return view('activities.activity_edit',array('activity'=>$activity));
		}
		else {
			return redirect('/allactivities');
		}
	}
	
	// FOR EDIT ACTIVITY SAVE (UPDATE)
	public function updateactivity(Request $request)
	{
		if (Auth::check())
		{
			$destinationPath = '/public/activities';
			$activities_id = $request->aid;
		
			if($request->has("activities_name") && trim($request->activities_name) != '') 
			{
				$activities_name = trim($request->activities_name);
				$activities_category = trim($request->activities_category);
				$activities_location = trim($request->activities_location);
				$activities_price = trim($request->activities_price);
				$activities_description = trim($request->activities_description);
				$activities_additional_info = trim($request->activities_additional_info);
				$activities_highlights = trim($request->activities_highlights);
				$activities_duration = trim($request->activity_duration);
				$activities_meeting_point = trim($request->activities_meeting_point);
				$activities_meeting_time = trim($request->activities_meeting_time);
				
				$activities_rating = trim($request->activities_rating);
				$activities_status = trim($request->activities_status);
				$activities_terms_condition = trim($request->activities_terms_condition);
				
				
				\DB::table('activities')->where('activities_id', $activities_id)
				->update([
					'activities_name' => addslashes($activities_name),
					'activities_category' => addslashes($activities_category),
					'activities_location' => addslashes($activities_location),
					'activities_price' => addslashes($activities_price),
					'activities_description' => addslashes($activities_description),
					'activities_additional_info' => addslashes($activities_additional_info),
					'activities_highlights' => addslashes($activities_highlights),
					'activities_duration' => addslashes($activities_duration),
					'activities_meeting_point' => addslashes($activities_meeting_point),
					'activities_meeting_time' => addslashes($activities_meeting_time),
					'activities_rating' => addslashes($activities_rating),
					'activities_status' => addslashes($activities_status),
					'activities_terms_condition' => addslashes($activities_terms_condition)
				]);
				
				if($request->has("old_activity_image") && trim($request->old_activity_image) != '') 
				{
					if(file_exists($destinationPath.trim($request->old_activity_image))) {
						unlink($destinationPath.trim($request->old_activity_image));
					}
				}
				
				if($request->file("mainimage")) 
				{
					$imageName = $activities_id . '.' . $request->file('mainimage')->getClientOriginalExtension();
					
					$request->file('mainimage')->move(base_path() . $destinationPath, $imageName);
					\DB::table('activities')->where('activities_id', $activities_id)->update(['activities_image' => $imageName]);
				}
			}
		}
		
		return redirect('/allactivities');
	}
	
	// FOR DELETE ACTIVITY 
	public function deleteactivity(Request $request)
	{
		if (Auth::check())
		{
			$activities_id = $request->aid;
			\DB::table('activities')->where('activities_id', $activities_id)->delete();
			
			return redirect('/allactivities')->with('status', 'Activity deleted successfully!');
		}
	}
}