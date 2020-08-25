<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Tours;
use App\Models\Hotels;
use DB;
use Auth;
use Session;
use Mailgun\Mailgun;



class ToursController extends Controller
{
	// SEARCH TOUR NAMES OR LOCATIONS FOR INDEX PAGE
	public function tourlocations(Request $request)
	{
		$query = $request->get("query");		
		$city_location = \DB::table('tours')->select('city_location')->where('city_location', 'like', '%'.$query.'%')->groupBy('city_location')->orderBy('city_location', 'asc')->get();
		$tours = array(); $i = 1;
		echo "["; $str = '';
		foreach($city_location as $location)
		{
			$tours['id']= $query;
			$tours['label'] = ucwords(strtolower($location->city_location));
			$str .= json_encode($tours).",";
			$i++;
		}
		
		$tour_name = \DB::table('tours')->select('tour_name')->where('tour_name', 'like', '%'.$query.'%')->groupBy('tour_name')->orderBy('tour_name', 'asc')->get();
		foreach($tour_name as $name)
		{
			$tours['id']= $query;
			$tours['label'] = ucwords(strtolower($name->tour_name));
			$str .= json_encode($tours).",";
			$i++;
		}
		$str = substr($str,0,strlen($str)-1);
		echo $str."]"; exit();
	}
	
	// TOUR PACKAGE LIST
	public function tourslist(Request $request)
	{
		if(Session::has('tour_id')) {
			$request->session()->forget('tour_id');
		}
		
		$tours = \DB::table('tours_view')->where('user_id',Auth::user()->id)->orderBy('tour_id', 'desc')->get();
		return view('tours.tours_list',array('tours'=>$tours));
	}
	// TOUR PACKAGE Booked
	public function tourbooked()
	{
		if (Auth::check())
		{
			$tourbooked = \DB::table('orders')
						->select('*','orders.status as orderstatus')
						->join('tours', 'tours.tour_id', '=', 'orders.tour_id')						
						->where('tours.user_id',Auth::user()->id)
						->orderBy('orders.tour_id', 'desc')->get();
				
			return view('tours.tours_booked',array('tourbooked'=>$tourbooked));
		}
		else {
			return redirect()->intended(route('mybooking'));
		}
	}
	
	// TOUR PACKAGE DETAIL 
	public function tourdetail(Request $request)
	{
		$tour_id = $request->route('tid');
		$tours = \DB::table('tours')->where('tour_id',$tour_id)->orderBy('tour_id', 'desc')->get();
		$tour_days = \DB::table('tour_daywise')->where('tour_id',$tour_id)->orderBy('itinerydata_id', 'asc')->get();
		$tour_pvisits = \DB::table('tour_placevisit')->where('tour_id',$tour_id)->orderBy('pvisit_id', 'asc')->get();
		$tour_sightseeing = \DB::table('tour_sightseeing')->where('tour_id',$tour_id)->orderBy('sightseeing_id', 'asc')->get();
		$coupons = \DB::select("SELECT * FROM `coupons` WHERE `status` LIKE 'Active' AND `aht` = 3 AND `from_date` <= CURDATE() AND `to_date` >= CURDATE() LIMIT 1");
		
		return view('tours_detail',array('tours'=>$tours,'tour_days'=>$tour_days,'tour_pvisits'=>$tour_pvisits,'tour_sightseeing'=>$tour_sightseeing,'coupons'=>$coupons));
	}
	
	// New TOUR PACKAGE DETAIL 
	public function newtourdetail(Request $request)
	{ 
		$tour_id = $request->route('tid');
		$tours = \DB::table('tours')->where('tour_id',$tour_id)->orderBy('tour_id', 'desc')->get();
		$tour_days = \DB::table('tour_daywise')->where('tour_id',$tour_id)->orderBy('itinerydata_id', 'asc')->get();
		$tour_pvisits = \DB::table('tour_placevisit')->where('tour_id',$tour_id)->orderBy('pvisit_id', 'asc')->get();
		$tour_sightseeing = \DB::table('tour_sightseeing')->where('tour_id',$tour_id)->orderBy('sightseeing_id', 'asc')->get();
		$coupons = \DB::select("SELECT * FROM `coupons` WHERE `status` LIKE 'Active' AND `aht` = 3 AND `from_date` <= CURDATE() AND `to_date` >= CURDATE() LIMIT 1");
		$tour_package_type = \DB::select("SELECT tour_package_type,MAX(person) AS persons FROM tours_price where tour_id = ".$tour_id." GROUP BY tour_package_type");                 
		
		$tour_prices = array();
		foreach($tour_package_type as $type)
		{
			$data = \DB::table('tours_price')->where('tour_id',$tour_id)->where('tour_package_type',$type->tour_package_type)->where('person',$type->persons)->get()->toArray();
			$tour_prices[] = $data[0];
		}
		
		return view('newtours_detail',array('tours'=>$tours,'tour_days'=>$tour_days,'tour_pvisits'=>$tour_pvisits,'tour_sightseeing'=>$tour_sightseeing,'coupons'=>$coupons,'tour_prices' => $tour_prices));
	}
	
	
	// ADD NEW TOUR PACKAGE
	public function index(Request $request) 
	{
		if (Auth::check())
		{
			if(Session::has('tour_id')) {
				$request->session()->forget('tour_id');
			}
			return view('tours.tour_add');
		}
		else {
			return redirect('/login');
		}
	}
	
	// SAVE NEW TOUR PACKAGE
	public function savetour(Request $request) 
	{
			
		$themes = '';
		if($request->get('chk_themes') && !empty($request->get('chk_themes')))
		{
			foreach($request->get('chk_themes') as $theme) {
				$themes .= trim($theme).",";
			}
			$themes = substr($themes,0,strlen($themes)-1);
		}
		$inclusion_select = '';
		if($request->get('chk_inclusion') && !empty($request->get('chk_inclusion')))
		{
		    $i=0;
		  	foreach($request->get('chk_inclusion') as $inclusiondata) {
				if($i==0){
                   $inclusion_select .= trim($inclusiondata).",";
				}else
				{
				  $inclusion_select .= trim($inclusiondata).",";
				}
				$i++;
			}
			$inclusion_select = substr($inclusion_select,0,strlen($inclusion_select)-1);
		}
		
		$tours = new Tours();
		$id = \DB::table('tours')->insertGetId(
			['tour_name' => trim($request->get('txt_tour_name')), 
			'city_location' => trim($request->get('txt_tour_location')), 
			'fromdate' => date("Y-m-d",strtotime(trim($request->get('txt_tour_checkin')))),
			'todate' => date("Y-m-d",strtotime(trim($request->get('txt_tour_checkout')))),
			'price_per_person' => trim($request->get('txt_tour_price')),
			'sale_price' => trim($request->get('txt_tour_saleprice')),
			'guest_per_booking' => trim($request->get('txt_tour_guest')),
			'room_per_booking' => trim($request->get('txt_tour_room')),
			'child_age' => trim($request->get('txt_child_age')),
			'partofindia' => trim($request->get('partofindia')),
			'days' => trim($request->get('txt_tour_days')),
			'nights' => trim($request->get('txt_tour_nights')),
			'no_places' => trim($request->get('txt_tour_places')),
			'themes' => trim($themes),
			'rating' => trim($request->get('txt_tour_rating')),	
			'gst' => trim($request->get('gst')),	
			'overview' => trim($request->get('txt_tour_overview')),
			'inclusions' => trim($request->get('txt_tour_inclusions')),
			'inclusion_select' => trim($inclusion_select),	
			'exclusions' => trim($request->get('txt_tour_exclusions')),
			'paymentpolicy' => trim($request->get('txt_tour_paymentpolicy')),	
			'cancellationpolicy' => trim($request->get('txt_tour_cancellationpolicy')),
			'terms_conditions' => trim($request->get('txt_tour_termsconditions')),								
			'user_id' => Auth::user()->id
			]
		);
		$destinationPath = '/public/tours_images';
		   
		$files_count = count($request->file('mainimg'));
		$i = 1; $filenames = '';$files='';
        foreach($request->file('mainimg') as $imageName)
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
		\DB::table('tours')->where('tour_id', $id)->update(['tour_image' => $files]);
       
		
		
		/*
		$imageName = $id . '.' . $request->file('mainimg')->getClientOriginalExtension();
		
		$request->file('mainimg')->move(base_path() . $destinationPath, $imageName);
		
		\DB::table('tours')->where('tour_id', $id)->update(['tour_image' => $imageName]);
		*/
		if(Session::has('tour_id'))
		{
			$request->session()->forget('tour_id');
			$request->session()->put('tour_id',$id);
		}
		else {
			$request->session()->put('tour_id',$id);
		}
		
		
		
		 $tour_detail = \DB::table('tours')->where('tour_id', $id)->get();
		
		//jalpesh@anibyte
		//print_r($tour_detail);exit;
		$tour_id = $id;
		 $name = $tour_detail[0]->tour_name;
		$city_location = $tour_detail[0]->city_location;
		$price_per_person = $tour_detail[0]->price_per_person;
		$userid = $tour_detail[0]->user_id;
		
			$subject = "Message from New Tour Add on Tour ID ".$tour_id;
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
				<strong>NEW Tour Add By Tour Operator.</strong><br />
				<hr />
				Toru ID : '.$tour_id.'<br>
				Tour Name : '.$name.'<br>
				city_location : '.$city_location.'<br>
				price_per_person : '.$price_per_person.'<br>
				user ID : '.$userid.'<br>
				<hr />
			</body>
			</html>';
			$batchMsg->setHtmlBody($message);
			$batchMsg->addToRecipient('jalpesh@anibyte.net', array("first" => "jalpesh", "last" => "bhadarka"));
			//$batchMsg->addCcRecipient('ramesh@anibyte.net', array("first" => "Ramesh", "last" => "Anibyte"));
			$batchMsg->addBccRecipient("prashanth@anibyte.net", array("first"=>"Prashanth", "last" => "Sirsi"));
			$batchMsg->addBccRecipient("sudhakar@anibyte.net", array("first"=>"Sudhakar", "last" => ""));
			//$batchMsg->addBccRecipient("nikjoshi96@gmail.com", array("first"=>"Nikunj", "last" => "Joshi"));
			$batchMsg->finalize();
		
		return redirect('/addtourprice')->with('status', 'Tour package added successfully!');
		
		//return back()->with('status', 'Tour package added successfully!');
	}
	
	
	// ADD NEW TOUR PRICE
	
	public function addtour_price(Request $request)
	{
		if(Session::has('tour_id'))
		{
			$id = $request->session()->get('tour_id');
			$tourvehicle = \DB::table('vehicle')->orderBy('vid', 'ASC')->get();
			$tour_detail = \DB::table('tours')->where('tour_id', $id)->get();
			return view('tours.tour_addtourprice',array('tour_id'=>$id,'tour_detail'=>$tour_detail,'tourvehicle' => $tourvehicle));
		}
		else {
			return redirect('/addtour');
		}
		
	}

	// SAVE NEW TOUR PACKAGE
	public function savetour_price(Request $request) 
	{
		

		if(Session::has('tour_id'))
		{
			$id = $request->session()->get('tour_id');
			//print_r($_REQUEST);EXIT; 
			//echo '<pre>'; print_r($_POST); exit();
			for ($i = 0; $i < count($_POST['tour_package_type']); $i++)
			{
			$tour_detail = \DB::table('tours')->where('tour_id', $id)->get();
							\DB::table('tours_price')->insertGetId([
							'tour_id' => $id,
							'tour_package_type' => $_POST['tour_package_type'][$i],
							'person'=> $_POST['tour_package_person'][$i],
							'package_per_person'=> $_POST['tour_person_price'][$i],
							'vehicle'=> $_POST['tour_package_vehicle'][$i],
							'hotel_name'=> $_POST['tour_package_hotel'][$i],
							'hotel_star'=> $_POST['tour_package_hotel_rate'][$i],
							'commition_type' => $_POST['commition_type'][$i],
							'commision'=> $_POST['commision'][$i],							
							'extra_adult_price'=> $_POST['tour_package_adult_price'][$i],
							'extra_child_price'=> $_POST['tour_package_child_price'][$i],
							'free_child_age'=> $_POST['tour_package_free_child'][$i]							
							]); 
						
						
			}
				
				return redirect('/addtour-daywise');
			
		}
		else {
			return redirect('/addtour');
		}
	}
	
	
	
	// ADD NEW TOUR DAYWISE
	public function addtour_daywise(Request $request)
	{
		if(Session::has('tour_id'))
		{
			$id = $request->session()->get('tour_id');
			$tour_detail = \DB::table('tours')->where('tour_id', $id)->get();
			return view('tours.tour_add_daywise',array('tour_id'=>$id,'tour_detail'=>$tour_detail));
		}
		else {
			return redirect('/addtour');
		}
	}
	
		
	// SAVE NEW TOUR PACKAGE
	public function savetour_daywise(Request $request) 
	{
		if(Session::has('tour_id'))
		{
			$id = $request->session()->get('tour_id');
			$tour_detail = \DB::table('tours')->where('tour_id', $id)->get();
			$days = $tour_detail[0]->days;
			
			if($days > 0)
			{
				for($i = 1; $i <= $days; $i++) 
				{
					if($request->get('txt_day'.$i) && $request->get('txt_day'.$i) != '')
					{
						if($request->get('desc_'.$i) && $request->get('desc_'.$i) != '')
						{
							\DB::table('tour_daywise')->insertGetId([
							'tour_id' => $id,
							'itinerydata_title'=> trim($request->get('txt_day'.$i)),
							'itinerydata_description'=> trim($request->get('desc_'.$i))
							]);
						}
					}
				}
				return redirect('/addtour-sightseeing');
			}
		}
		else {
			return redirect('/addtour');
		}
	}
	
	// ADD NEW TOUR SIGHTSEEING
	public function addtour_sightseeing(Request $request)
	{
		if(Session::has('tour_id'))
		{
			$id = $request->session()->get('tour_id');
			$tour_detail = \DB::table('tours')->where('tour_id', $id)->get();
			return view('tours.tour_add_sightseeing',array('tour_id'=>$id,'tour_detail'=>$tour_detail));
		}
		else {
			return redirect('/addtour');
		}
		
	}
	
	// SAVE NEW TOUR SIGHTSEEING
	public function savetour_sightseeing(Request $request) 
	{
		if(Session::has('tour_id'))
		{
			$id = $request->session()->get('tour_id');
			$tour_detail = \DB::table('tours')->where('tour_id', $id)->get();
			$days = $tour_detail[0]->days;
			if($days > 0)
			{
				for($i=1; $i<=$days; $i++)
				{
					$travel = $request->get('txt_travel'.$i);
					
					$sightseeings = '';
					for($s=1; $s <=10; $s++)
					{
						if(trim($request->get('txt_sightseeing'.$i.'_'.$s)) != '') {
							$sightseeings .= trim($request->get('txt_sightseeing'.$i.'_'.$s)).' ### ';
						}
					}
					$sightseeings = substr($sightseeings,0,strlen($sightseeings)-5);
					
					$meal = '';
					if(!empty($request->get('chk_meal_'.$i))) {
						$meal = implode(',',$request->get('chk_meal_'.$i));
					}
					
					\DB::table('tour_sightseeing')->insertGetId([
					'tour_id' => $id,
					'travel'=> trim($travel),
					'sightseeing'=> trim($sightseeings),
					'meal'=> trim($meal)
					]);
					
				}
				return redirect('/addtour-placevisit');
			}
		}
		else {
			return redirect('/addtour');
		}
	}
	
	// ADD NEW TOUR PLACE VISIT
	public function addtour_placevisit(Request $request)
	{
		if(Session::has('tour_id'))
		{
			$id = $request->session()->get('tour_id');
			$tour_detail = \DB::table('tours')->where('tour_id', $id)->get();
			return view('tours.tour_add_placevisit',array('tour_id'=>$id,'tour_detail'=>$tour_detail));
		}
		else {
			return redirect('/addtour');
		}
	}
	
	// SAVE NEW TOUR PLACE VISIT
	public function savetour_placevisit(Request $request) 
	{
		if(Session::has('tour_id'))
		{
			$id = $request->session()->get('tour_id');
			$tour_detail = \DB::table('tours')->where('tour_id', $id)->get();
			$places = $tour_detail[0]->no_places;
			if($places > 0)
			{
				for($i=1; $i<=$places; $i++)
				{
					$pvisit_name =  $request->get('txt_place'.$i);
					$pvisit_description =  $request->get('desc_'.$i);
					
					\DB::table('tour_placevisit')->insertGetId([
					'tour_id' => $id,
					'pvisit_name'=> trim($pvisit_name),
					'pvisit_description'=> trim($pvisit_description)
					]);
				}
				\DB::table('tours')->where('tour_id', $id)->update(['status' => '0' ]);
				
				return redirect('/tours-list')->with('status', 'Tour package added successfully!');
			}
		}
		else {
			return redirect('/addtour');
		}
	}
	
	// EDIT TOUR PACKAGE
	public function edittour(Request $request)
	{
		$tour_id = $request->route('tid');
		$tour = \DB::table('tours')->where('tour_id',$tour_id)
		->orderBy('tour_id', 'desc')->get();
		
		return view('tours.tours_edit',array('tour'=>$tour));
	}
	
	// UPDATE TOUR PACKAGE
	public function updatetour(Request $request)
	{
		$tour_id = $request->route('tid');
		$tour_name = trim($request->get('txt_tour_name'));
		$tour_location = trim($request->get('txt_tour_location'));
		
		if($request->has("txt_tour_checkin") && trim($request->txt_tour_checkin) != '') {
			$fromdate = date("Y-m-d",strtotime($request->txt_tour_checkin));
		}
		else {
			$fromdate = date("Y-m-d",strtotime($request->fromdate));
		}
		
		if($request->has("txt_tour_checkout") && trim($request->txt_tour_checkout) != '') {
			$todate = date("Y-m-d",strtotime($request->txt_tour_checkout));
		}
		else {
			$todate = date("Y-m-d",strtotime($request->todate));
		}
		
		//$fromdate = date("Y-m-d",strtotime(trim($request->get('txt_tour_checkin'))));
		//$todate = date("Y-m-d",strtotime(trim($request->get('txt_tour_checkout'))));
		
		$tour_price = trim($request->get('txt_tour_price'));
		$sale_price = trim($request->get('txt_tour_saleprice'));
		$partofindia = trim($request->get('partofindia'));
		$guest_per_booking = trim($request->get('txt_tour_guest'));
		$room_per_booking = trim($request->get('txt_tour_room'));
		$child_age = trim($request->get('txt_child_age'));		
		$days = trim($request->get('txt_tour_days'));
		$nights = trim($request->get('txt_tour_nights'));
		$rating = trim($request->get('txt_tour_rating'));
		$places = trim($request->get('txt_tour_places'));
		$overview = trim($request->get('txt_tour_overview'));
		$inclusions = trim($request->get('txt_tour_inclusions'));
		$exclusions = trim($request->get('txt_tour_exclusions'));
		$paymentpolicy = trim($request->get('txt_tour_paymentpolicy'));	
		$cancellationpolicy = trim($request->get('txt_tour_cancellationpolicy'));	
		$termsconditions = trim($request->get('txt_tour_termsconditions'));
		

		$inclusion_select = '';
		if($request->get('chk_inclusion') && !empty($request->get('chk_inclusion')))
		{
		    $i=0;
		  	foreach($request->get('chk_inclusion') as $inclusiondata) {
				if($i==0){
                   $inclusion_select .= trim($inclusiondata).",";
				}else
				{
				  $inclusion_select .= trim($inclusiondata).",";
				}
				$i++;
			}
			$inclusion_select = substr($inclusion_select,0,strlen($inclusion_select)-1);
		}
		
		\DB::table('tours')->where('tour_id', $tour_id)->update([
		'tour_name' => $tour_name,
		'city_location' => $tour_location,
		'fromdate' => $fromdate,
		'todate' => $todate,		
		'price_per_person' => $tour_price,
		'sale_price' => $sale_price,
		'partofindia' => $partofindia,
		'guest_per_booking' => $guest_per_booking,
		'room_per_booking' => $room_per_booking,
		'child_age' => $child_age,
		'days' => $days,
		'nights' => $nights,
		'rating' => $rating,
		'no_places' => $places,
		'overview' => $overview,
		'inclusion_select' => $inclusion_select,
		'inclusions' => $inclusions,
		'exclusions' => $exclusions,
		'paymentpolicy' => $paymentpolicy,				
		'cancellationpolicy' => $cancellationpolicy,
		'terms_conditions' => $termsconditions]);	
		
		$destinationPath = '/public/tours_images';
		
		if(isset($_FILES['mainimage']) && $_FILES['mainimage']['name'][0]!=''){
		$files_count = count($request->file('mainimage'));
		$i = 1; $filenames = '';$files='';
        foreach($request->file('mainimage') as $imageName)
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
		\DB::table('tours')->where('tour_id', $tour_id)->update(['tour_image' => $files]);
		}
		
		return redirect("/tour-price/".$tour_id)->with('status', 'Tour package updated successfully!');
	}
	
	
	// EDIT TOUR PRICE
	public function edittour_price(Request $request)
	{
		$tours = \DB::table('tours_price')->where('tour_id', $request->route('tid'))->get()->count();		
		 if($tours <= 0){
		$id = $request->route('tid');
		$tour_detail = \DB::table('tours')->where('tour_id', $id)->get();
			 				\DB::table('tours_price')->insertGetId([
							'tour_id' => $id,
							'tour_package_type' => 'standard',
							'person'=> 1,
							'package_per_person'=> 5000,
							'vehicle'=> 'Maruthi',
							'hotel_name'=> 'hotel',
							'hotel_star'=> 0,
							'commition_type' => 'flat',
							'commision'=> 0,							
							'extra_adult_price'=> 0,
							'extra_child_price'=> 0,
							'free_child_age'=> 1	
							]);
							
							return redirect("/tour-price/".$id);
						
				
			}
			
			else{
		$tour_id = $request->route('tid');
		$tour_detail = \DB::table('tours')->where('tour_id',$tour_id)->orderBy('tour_id', 'desc')->get();
		$tour_price = \DB::table('tours_price')->where('tour_id',$tour_id)->orderBy('tour_id', 'desc')->get();
				
		return view('tours.tours_edit_price',array('tour_detail'=>$tour_detail,'tour_price'=>$tour_price));
	}	
		
		
	}
	
	// UPDATE TOUR PRICE
	public function updatetour_price(Request $request)
	{
		$tour_id = $request->route('tid');
		
		//print_r($_REQUEST);EXIT; 
			//echo '<pre>'; print_r($_POST); exit();
			for ($i = 0; $i < count($_POST['tour_package_type']); $i++)
			{
				$tour_price_id = $_POST['tour_price_id'][$i]; 
				$tour_package_type = $_POST['tour_package_type'][$i]; 
				$tour_package_person = $_POST['tour_package_person'][$i];
				$tour_person_price = $_POST['tour_person_price'][$i];
				$tour_package_vehicle = $_POST['tour_package_vehicle'][$i];
				$tour_package_hotel = $_POST['tour_package_hotel'][$i];
				$tour_package_hotel_rate = $_POST['tour_package_hotel_rate'][$i];
				$commition_type = $_POST['commition_type'][$i];
				$commision = $_POST['commision'][$i];
				$tour_package_adult_price = $_POST['tour_package_adult_price'][$i];
				$tour_package_child_price = $_POST['tour_package_child_price'][$i];
				$tour_package_free_child = $_POST['tour_package_free_child'][$i];
			
			if($tour_price_id != '' && $tour_price_id > 0) 
			{
			$tour_detail = 	\DB::table('tours_price')->where('tour_price_id',$tour_price_id)
							->where('tour_id',$tour_id)->update([							
							'tour_package_type' => $tour_package_type,
							'person' => $tour_package_person,
							'package_per_person' => $tour_person_price,
							'vehicle'=> $tour_package_vehicle,
							'hotel_name'=> $tour_package_hotel,
							'hotel_star'=> $tour_package_hotel_rate,
							'commition_type' => $commition_type,
							'commision'=> $commision,							
							'extra_adult_price'=> $tour_package_adult_price,
							'extra_child_price'=> $tour_package_child_price,
							'free_child_age'=> $tour_package_free_child							
							]); 
						
			}	
			elseif($tour_price_id == '')
			{
				\DB::table('tours_price')->insertGetId([
				'tour_id' => $tour_id,
				'tour_package_type' => $tour_package_type,
							'person' => $tour_package_person,
							'package_per_person' => $tour_person_price,
							'vehicle'=> $tour_package_vehicle,
							'hotel_name'=> $tour_package_hotel,
							'hotel_star'=> $tour_package_hotel_rate,
							'commition_type' => $commition_type,
							'commision'=> $commision,							
							'extra_adult_price'=> $tour_package_adult_price,
							'extra_child_price'=> $tour_package_child_price,
							'free_child_age'=> $tour_package_free_child							
							]); 
			}
			}
		return redirect("/tour-daywise/".$tour_id)->with('status', 'Tour package updated successfully!');
	}
	
	// EDIT TOUR DAYWISE
	public function edittour_daywise(Request $request)
	{
		
		$tours = \DB::table('tour_daywise')->where('tour_id', $request->route('tid'))->get()->count(); 
		if($tours <= 0){
		$id = $request->route('tid');
		$tour_detail = \DB::table('tours')->where('tour_id', $id)->get();
			$days = $tour_detail[0]->days; 
			if($days > 0)
			{
				for($i = 1; $i <= $days; $i++) 
				{
							\DB::table('tour_daywise')->insertGetId([
							'tour_id' => $id,
							'itinerydata_title'=> 'test1',
							'itinerydata_description'=>'data1'
							]);
						
				}
			}
			return redirect("/tour-daywise/".$id);
			}
			else{
				
		$tour_id = $request->route('tid');
		$tour_detail = \DB::table('tours')->where('tour_id',$tour_id)->orderBy('tour_id', 'desc')->get();
		$tour_daywise = \DB::table('tour_daywise')->where('tour_id',$tour_id)->orderBy('tour_id', 'desc')->get();
		$days = $tour_detail[0]->days; 		
		
		
		return view('tours.tours_edit_daywise',array('tour_detail'=>$tour_detail,'tour_daywise'=>$tour_daywise,'days'=>$days));
	}	
		
		
	}
	
	// UPDATE TOUR DAYWISE
	public function updatetour_daywise(Request $request)
	{
		
		$tour_id = $request->route('tid');
		
		if(!empty($request->get('hid_daywise')))
		{
			foreach($request->get('hid_daywise') as $key=>$id)
			{
				$itinerydata_id = $id;
				$title = $request->get('txt_day'.$key);
				$description = $request->get('desc_'.$key);
				
				\DB::table('tour_daywise')->where('itinerydata_id', $itinerydata_id)
				->where('tour_id',$tour_id)->update([
					'itinerydata_title' => $title,
					'itinerydata_description' => $description
				]);
			}
		}
		
		
		return redirect("/tour-sightseeing/".$tour_id)->with('status', 'Tour package updated successfully!');
	}
	
	// EDIT TOUR SIGHTSEEING
	public function edittour_sightseeing(Request $request)
	{
		
		$tours = \DB::table('tour_sightseeing')->where('tour_id', $request->route('tid'))->get()->count();
		
		 if($tours <= 0){
		 
			$id = $request->route('tid');
			$tour_detail = \DB::table('tours')->where('tour_id', $id)->get();
			$days = $tour_detail[0]->days;
			if($days > 0)
			{
				for($i=1; $i<=$days; $i++)
				{
					
					
					\DB::table('tour_sightseeing')->insertGetId([
					'tour_id' => $id,
					'travel'=> 'visit place',
					'sightseeing'=> 'visit place',
					'meal'=> ''
					]);
					
				}
				
			}
			return redirect("/tour-sightseeing/".$id);
		
		}else{
		
		$tour_id = $request->route('tid'); 
		$tour_detail = \DB::table('tours')->where('tour_id',$tour_id)->orderBy('tour_id', 'desc')->get();
		$tour_sightseeing = \DB::table('tour_sightseeing')->where('tour_id',$tour_id)->orderBy('tour_id', 'desc')->get();
		 $days1 = $tour_detail[0]->days; 
			/*if($days1 > 0)
			{
				for($i=1; $i<=$days1; $i++)
				{
					\DB::table('tour_sightseeing')->insertGetId([
					'tour_id' => $tour_id,
					'travel'=> 'visit place',
					'sightseeing'=> 'visit place',
					'meal'=> ''
					]);
					
				}
				
			}*/
		return view('tours.tours_edit_sightseeing',array('tour_detail'=>$tour_detail,'tour_sightseeing'=>$tour_sightseeing));
		}
	}
	
	// UPDATE TOUR SIGHTSEEING
	public function updatetour_sightseeing(Request $request)
	{
		$tour_id = $request->route('tid');
		if(!empty($request->get('hid_sightseeing')))
		{
			foreach($request->get('hid_sightseeing') as $key=>$id)
			{
				$sightseeing_id = $id;
				$travel = $request->get('txt_travel'.$key);
				$sightseeing = '';
				for($i = 1; $i <=10; $i++)
				{
					if(trim($request->get('txt_sightseeing'.$key.'_'.$i)) != '') {
						$sightseeing .= trim($request->get('txt_sightseeing'.$key.'_'.$i)).' ### ';
					}
				}
				$sightseeings = substr($sightseeing,0,strlen($sightseeing)-5);
				
				
				$meal = '';
				if(!empty($request->get('chk_meal_'.$key))) {
					$meal = implode(',',$request->get('chk_meal_'.$key));
				}
				
				\DB::table('tour_sightseeing')->where('sightseeing_id', $sightseeing_id)
				->where('tour_id',$tour_id)->update([
					'travel' => addslashes(trim($travel)),
					'sightseeing' => addslashes(trim($sightseeings)),
					'meal' => $meal
				]);
			}
		}
		return redirect("/tour-placevisit/".$tour_id)->with('status', 'Tour package updated successfully!');
	}
	
	// EDIT TOUR PLACE VISIT
	public function edittour_placevisit(Request $request)
	{
		$tour_id = $request->route('tid');
		$tour_detail = \DB::table('tours')->where('tour_id',$tour_id)->orderBy('tour_id', 'desc')->get();
		$tour_placevisit = \DB::table('tour_placevisit')->where('tour_id',$tour_id)->orderBy('tour_id', 'desc')->get();
		
		return view('tours.tours_edit_placevisit',array('tour_detail'=>$tour_detail,'tour_placevisit'=>$tour_placevisit));
	}
	
	// UPDATE TOUR PLACE VISIT
	public function updatetour_placevisit(Request $request)
	{
		$tour_id = $request->route('tid');
		if(!empty($request->get('hid_placevisit')))
		{
			foreach($request->get('hid_placevisit') as $key=>$id)
			{
				if($id != "")
				{
					$pvisit_id = $id;
					$pvisit_name = trim($request->get('txt_place'.$key));
					$pvisit_description = trim($request->get('desc_'.$key));
				
					if($pvisit_name != "")
					{
						\DB::table('tour_placevisit')->where('pvisit_id', $pvisit_id)
						->where('tour_id',$tour_id)->update([
							'pvisit_name' => addslashes($pvisit_name),
							'pvisit_description' => addslashes($pvisit_description)
						]);
					}
				}
				else
				{
					$pvisit_name = trim($request->get('txt_place'.$key));
					$pvisit_description = trim($request->get('desc_'.$key));
				
				
					\DB::table('tour_placevisit')->insertGetId([
					'tour_id' => $tour_id,
					'pvisit_name'=> trim($pvisit_name),
					'pvisit_description'=> trim($pvisit_description)
					]);
				}
			}
			return redirect("/tours-list")->with('status', 'Tour package updated successfully!');
		}
	}
	
	
	// Active TOUR PACKAGE
	public function activetour(Request $request)
	{
	
		$id = $request->route('tid');
		\DB::table('tours')->where('tour_id', $id)
				->update([
					'status' => 1					
				]);
		return redirect('/alltours');
	}

	// Active TOUR PACKAGE
	public function inActivetour(Request $request)
	{
	
		$id = $request->route('tid');
		\DB::table('tours')->where('tour_id', $id)
				->update([
					'status' => 0					
				]);
		return redirect('/alltours');
	}
	
	
	
	// DELETE TOUR PACKAGE
	public function deletetour(Request $request)
	{
		$tour_id = $request->route('tid');
		\DB::table('tours')->where('tour_id', $tour_id)->delete();
		return back()->with('status', 'Tour package deleted successfully!');
	}
	// DELETE TOUR PACKAGE
	public function deletetourprice(Request $request)
	{
		$tour_price_id = $request->route('tpid');		
		\DB::table('tours_price')->where('tour_price_id', $tour_price_id)->delete();
		return back()->with('status', 'Tour Price package deleted successfully!');
	}
	
	// DELETE Order PACKAGE
	public function deleteorder(Request $request)
	{
		$order_id = $request->route('oid');
		\DB::table('orders')->where('order_id', $order_id)->delete();
		return back()->with('status', 'Order package deleted successfully!');
	}
	
	// SEARCH TOUR PACKAGE
	public function searchtours(Request $request)
	{
		$tour_name_location =  $request->get("name_location");
		$tours_month =  $request->get("tours_month");
		
		if($tour_name_location != "") 
		{
			if($tours_month != "") 
			{
				$tours = DB::table('tours')
				->select('*')->where('status',1)->whereRaw("DATE_FORMAT(`todate`,'%Y-%m') >= ".$tours_month)
				->Where(function ($query) use($tour_name_location) {
					$query->where('tour_name','LIKE','%'.$tour_name_location.'%')
					->orwhere('city_location','LIKE','%'.$tour_name_location.'%');
				})
				->Where(function ($query) use($tours_month) {
					$query->whereRaw("DATE_FORMAT(`fromdate`,'%Y-%m') >= '".$tours_month."'")
					->orwhereRaw("DATE_FORMAT(`todate`,'%Y-%m') <= '".$tours_month."'");
				})
				->orderBy('days', 'asc')->orderBy('tour_name', 'asc')->paginate(5);
			}
			else
			{
				$tours = DB::table('tours')
				->select('*')->where('status',1)->where('todate','>=',date('Y-m-d'))
				->Where(function ($query) use($tour_name_location) {
					$query->where('tour_name','LIKE','%'.$tour_name_location.'%')
					->orwhere('city_location','LIKE','%'.$tour_name_location.'%');
				})
				->orderBy('days', 'asc')->orderBy('tour_name', 'asc')->paginate(5);
			}
		}
		else 
		{
			$tours = DB::table('tours')
        		->select('*')->where('status',1)->where('todate','>=',date('Y-m-d'))
        		->orderBy('days', 'asc')->orderBy('tour_name', 'asc')->paginate(5);
		}
		
		/*$month_sql = "";
		if($tours_month != "") {
			$month_sql = "AND '".$tours_month."' BETWEEN  DATE_FORMAT(`fromdate`,'%Y-%m') AND DATE_FORMAT(`todate`,'%Y-%m') ";
			//$month_sql = "AND (DATE_FORMAT(fromdate,'%Y-%m') >= '".$tours_month."' OR DATE_FORMAT(todate,'%Y-%m') <= '".$tours_month."')";
		}
		$name_location_sql = "";
		if($tour_name_location != "") {
			$name_location_sql = "AND (`tour_name` LIKE '%".$tour_name_location."%' OR `city_location` LIKE '%".$tour_name_location."%')";
		}
		
		$tours = DB::select("SELECT * FROM `tours_view` WHERE `status` = 1  AND `todate` >= CURDATE()
		".$month_sql." ".$name_location_sql);
		*/
		return view('tours_search',array('tours'=>$tours,'tours_month'=>$tours_month,'search_tour'=>$tour_name_location));
		
	}
	
	
	
	// Newsearchtours TOUR PACKAGE
	public function newsearchtours(Request $request)
	{
		
		$tour_name_location =  $request->get("name_location");
		$tours_month =  $request->get("tours_month");
							
		if($tour_name_location != "") 
		{
			
			if($tours_month != "") 
			{
				$tours = DB::table('tours')				
				->select('*')->where('status',1)->whereRaw("DATE_FORMAT(`todate`,'%Y-%m') >= ".$tours_month)
				->Where(function ($query) use($tour_name_location) {
					$query->where('tour_name','LIKE','%'.$tour_name_location.'%')
					->orwhere('city_location','LIKE','%'.$tour_name_location.'%');
				})
				->Where(function ($query) use($tours_month) {
					$query->whereRaw("DATE_FORMAT(`fromdate`,'%Y-%m') >= '".$tours_month."'")
					->orwhereRaw("DATE_FORMAT(`todate`,'%Y-%m') <= '".$tours_month."'");
				})
				->orderBy('days', 'asc')->orderBy('tour_name', 'asc')->paginate(5);
				
			}
			else
			{
				$tours = DB::table('tours')				
				->select('*')->where('status',1)->where('todate','>=',date('Y-m-d'))
				->Where(function ($query) use($tour_name_location) {
					$query->where('tour_name','LIKE','%'.$tour_name_location.'%')
					->orwhere('city_location','LIKE','%'.$tour_name_location.'%');
				})
				->orderBy('days', 'asc')->orderBy('tour_name', 'asc')->paginate(5);
			}
		}
		else 
		{
			$tours = DB::table('tours')				
        		->select('*')->where('status',1)->where('todate','>=',date('Y-m-d'))
        		->orderBy('days', 'asc')->orderBy('tour_name', 'asc')->paginate(5);
				
		}
		
		/*$month_sql = "";
		if($tours_month != "") {
			$month_sql = "AND '".$tours_month."' BETWEEN  DATE_FORMAT(`fromdate`,'%Y-%m') AND DATE_FORMAT(`todate`,'%Y-%m') ";
			//$month_sql = "AND (DATE_FORMAT(fromdate,'%Y-%m') >= '".$tours_month."' OR DATE_FORMAT(todate,'%Y-%m') <= '".$tours_month."')";
		}
		$name_location_sql = "";
		if($tour_name_location != "") {
			$name_location_sql = "AND (`tour_name` LIKE '%".$tour_name_location."%' OR `city_location` LIKE '%".$tour_name_location."%')";
		}
		
		$tours = DB::select("SELECT * FROM `tours_view` WHERE `status` = 1  AND `todate` >= CURDATE()
		".$month_sql." ".$name_location_sql);
		*/
		return view('newtours_search',array('tours'=>$tours,'tours_month'=>$tours_month,'search_tour'=>$tour_name_location));
		
	}
	
	
	
	// SEARCH TOUR PACKAGE (AJAX)
	public function listsearchtours(Request $request)
	{
		$token =  $request->get("_token");
		$tours_month =  $request->get("tours_month");
		$month_sql = "";
		if($tours_month != "") {
			$month_sql = "AND '".$tours_month."' BETWEEN  DATE_FORMAT(`fromdate`,'%Y-%m') AND DATE_FORMAT(`todate`,'%Y-%m') ";
		}
		else {
			$tours_month = date("Y-m-d");
		}
		
		$durations_sql = '';
		if($request->get("duration") && $request->get("duration") != '')
		{
			$durations_sql .= "AND `days` between ";
			$durations_arr = explode(",",$request->get("duration"));
			$d = 1; $total=count($durations_arr);
			foreach($durations_arr as $dur)
			{
				$duration_days = explode("-",$dur);
				if($d==1 && $total == 1) {
					$durations_sql .= " ".$duration_days[0]." and ".$duration_days[1];
				}
				elseif($d==1 && $total > 1) {
					$durations_sql .= " ".$duration_days[0]." and ";
				}
				elseif($d == $total) {
					$durations_sql .= " ".$duration_days[1];
				}
				$d++;
			}
		}
		
		/*$partofindia_sql = '';
		if($request->get("partofindia") && $request->get("partofindia") != '')
		{
			$partofindia_sql =  "AND `partofindia` IN (".$request->get("partofindia").")";
		}*/
		
		//$tours = DB::select("SELECT * FROM `tours_view` WHERE `status` = 1  AND `todate` >= CURDATE() ".$month_sql.' '.$durations_sql.' '.$partofindia_sql);
		if($request->get("partofindia") && $request->get("partofindia") != '')
		{
			$tours = DB::table('tours')->select('*')->where('status',1)->where('todate','>=',date('Y-m-d'))
			->whereRaw("DATE_FORMAT(`todate`,'%Y-%m') >= ".$tours_month)
			->whereIn('partofindia', [$request->partofindia])
			->orderBy('days', 'asc')->orderBy('tour_name', 'asc')->paginate(5);
		}
		else 
		{
			$tours = DB::table('tours')
			->select('*')->where('status',1)->where('todate','>=',date('Y-m-d'))
			->whereRaw("DATE_FORMAT(`todate`,'%Y-%m') >= ".$tours_month)
			->orderBy('days', 'asc')->orderBy('tour_name', 'asc')->paginate(5);
		}
		
		foreach($tours as $tour)
		{
			echo '<div class="right-bar grid-view">
				<div class="grid-left">
					<div class="top">
						<h2>'.$tour->tour_name.'</h2>
					</div>
					<div class="grid-img">
						<img src="'.url('public/tours_images/'.$tour->tour_image).'" class="img-responsive" alt="" />
						<div class="details">
							<div class="company-name"><a href="#">'.$tour->tour_name.'</a></div>
							<div class="location"><i class="fa fa-map-marker" aria-hidden="true"></i> '.$tour->city_location.'</div>
							<div class="rating">';
								for($r = 1; $r <= $tour->rating; $r++) {
									echo '<i class="fa fa-star" aria-hidden="true"></i>';
								}
						echo '</div>
						</div>
					</div>					
					<h4 class="inclusions">Inclusions</h4>
					<div class="col-md-12">
						<ul class="option">					
							<li style="width: 12%;float: left;list-style: none;"><a href="#"><img src="'.url('public/img/camp-icon.png').'" class="sign" style="width:25px;"><p>Camp  Stay</p></a></li>
							<li style="width: 12%;float: left;list-style: none;"><a href="#"><img src="'.url('public/img/transfer-icon.png').'" class="sign" style="width:25px;"><p>Transfer</p></a></li>
							<li style="width: 12%;float: left;list-style: none;"><a href="#"><img src="'.url('public/img/meals-icon.png').'" class="sign" style="width:25px;"><p>Meals</p></a></li>
							<li style="width: 12%;float: left;list-style: none;"><a href="#"><img src="'.url('public/img/stars-icon.png').'" class="sign" style="width:25px;"><p>$ Stars</p></a></li>
							<li style="width: 12%;float: left;list-style: none;"><a href="#"><img src="'.url('public/img/sight-icon.png').'" class="sign" style="width:25px;"><p>Sightseeing</p></a></li>
							<li style="width: 12%;float: left;list-style: none;"><a href="#"><img src="'.url('public/img/house-icon.png').'" class="house" style="width:25px;"><p>Houseboat</p></a></li>
							<li style="width: 12%;float: left;list-style: none;"><a href="#">'.$tour->partofindia.'</a></li>
						</ul>
					</div>
				</div>
				<div class="bootom-tag">
					<span><img src="'.url('public/img/tag.png').'" />Use May2017 to book online & get upto 6500 off.</span>
				</div>
				<div class="grid-right">
					<h5><span class="itemPrice">Rs. '.$tour->price_per_person.'</span>
						<p>Starting Price(Per Adult)</p>
					</h5>
					<span style="margin-right:10px">'.$tour->days.' days & '.$tour->nights.' Nights</span><br/><br/>
					<a href="'.url('/newtour-checkout').'" class="checkout" tid="'.$tour->tour_id.'" data-token="'.$token.'">
						<button class="btn-default btn1">Add to Cart</button>
					</a>
					<a href="'.url('/newtourdetail/'.$tour->tour_id).'">
						<button class="btn-default btn1">View Details</button>
					</a>
					<button class="btn-default btn1" data-toggle="modal" data-target="#myModal" tid="'.$tour->tour_id.'">Get A Callback</button>
					<div class="col-md-4">
						<div class="stars">
							<div id="stars" class="starrr"></div>
						</div>
					</div>
				</div>
				
			</div>
			<div class="col-md-1" style="float:left; width:100%;">
				<div>&nbsp;</div>
			</div>';
		}
		echo '<div class="pagination">'.$tours->appends(request()->input())->links().'</div>';
		exit();
	}
	
	public function checkoutorder(Request $request)
	{
		@session_start();
		if(Session::has('order_tour_id')) {
			Session::put('order_tour_id', '');
		}
		
		$tour_id = $request->get("tour_id");
		Session::put('order_tour_id', $tour_id);
		$_SESSION['order_tour_id'] = $tour_id;
	}
	
	// INSERT ORDER TO DATABASE
	public function insertorder(Request $request)
	{
		@session_start();
					
        
		$tour_id = 0;
		if($request->has('tour_id') && $request->get('tour_id') > 0) {
			$tour_id =  $request->get('tour_id');
		}
		elseif(Session::has('order_tour_id'))  {
			$tour_id =  Session::get('order_tour_id');
		}
		elseif(isset($_SESSION['order_tour_id']) && $_SESSION['order_tour_id']>0) {
			$tour_id =  $_SESSION['order_tour_id'];
		}
		
		if($tour_id > 0)
		{
			
			$firstname =  $request->get('firstname');
			$lastname =  $request->get('lastname');
			$email =  $request->get('email');
			$phone =  $request->get('phone');
			$address =  $request->get('address');
			$pincode ='';
			// $pincode =  $request->get('pincode');
			 $city =  $request->get('city');
			 //$state = '';
			$state =  $request->get('state');
			$country =  $request->get('country');
			$productinfo = $request->get('productinfo');
			$price_per_person = $request->get('price_per_person');
			$agent_id = $request->get('agent_id');
			$discount = $request->get('discount');
			$disamount =  $request->get('disamount');
			$agtamount =  $request->get('newamount');
			
			
			if($request->has("no_of_persons")) {
				$no_of_persons = $request->get('no_of_persons');
			}
			elseif($request->has("no_of_adults")) {
				$no_of_persons = $request->get('no_of_adults');
			}
			if($request->has("no_of_child")) {
				$no_of_child = $request->get('no_of_child');
			}
			elseif($request->has("no_of_child")) {
				$no_of_child = $request->get('no_of_child');
			}			
			
			$amount = $request->get('newamount');
			$coupon_code = '';
			if($request->has("txt_coupon_code")) {
				$coupon_code = $request->get('txt_coupon_code');
			}
			elseif($request->has("applied_coupon_code")) {
				$coupon_code = $request->get('applied_coupon_code');
			}
			
			$tour_date = date("Y-m-d",strtotime($request->get('txt_tour_date')));
			
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
		
			//echo $user_id; exit;
			$order_id = \DB::table('orders')->insertGetId([
				'tour_id' => $tour_id, 
				'user_id' => $user_id, 
				'agent_id' => $agent_id, 
				'tour_name' => trim($productinfo),
				'firstname' => trim($firstname),
				'lastname' => trim($lastname),
				'email' => trim($email),
				'phone' => trim($phone),
				'city' => trim($city),
				'state' => trim($state),
				'country' => trim($country),
				'address' => $address,
				'no_of_persons' => $no_of_persons,
				'no_of_child' => $no_of_child,
				'tour_date' => $tour_date,
				'coupon_code' => trim($coupon_code),
				'coupon_amount' => trim($coupon_amount),
				'agentdiscount' => $discount,
				'agent_desc_total' => trim($disamount),
				'agent_total_pay' => trim($agtamount),
				'amount' => trim($amount),
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
			]); 
			
			Session::put('order_id', $order_id);
			echo $_SESSION['order_id'] = $order_id;
		}
	}
	
	// INSERT New ORDER TO DATABASE
	public function newinsertorder(Request $request)
	{
		@session_start();		
        
		$tour_id = 0;
		if($request->has('tour_id') && $request->get('tour_id') > 0) {
			$tour_id =  $request->get('tour_id');
		}
		elseif(Session::has('order_tour_id'))  {
			$tour_id =  Session::get('order_tour_id');
		}
		elseif(isset($_SESSION['order_tour_id']) && $_SESSION['order_tour_id']>0) {
			$tour_id =  $_SESSION['order_tour_id'];
		}
		
		if($tour_id > 0)
		{
			$firstname =  $request->get('firstname');
			$lastname =  $request->get('lastname');
			$email =  $request->get('email');
			$phone =  $request->get('phone');
			$address =  $request->get('address');
			$pincode ='';
			// $pincode =  $request->get('pincode');
			 $city =  $request->get('city');
			 //$state = '';
			$state =  $request->get('state');
			$country =  $request->get('country');
			$productinfo = $request->get('productinfo');
			$price_per_person = $request->get('price_per_person');
			
			if($request->has("no_of_persons")) {
				$no_of_persons = $request->get('no_of_persons');
			}
			elseif($request->has("no_of_adults")) {
				$no_of_persons = $request->get('no_of_adults');
			}
			if($request->has("no_of_child")) {
				$no_of_child = $request->get('no_of_child');
			}
			elseif($request->has("no_of_child")) {
				$no_of_child = $request->get('no_of_child');
			}			
			
			$amount = $request->get('amount');
			$coupon_code = '';
			if($request->has("txt_coupon_code")) {
				$coupon_code = $request->get('txt_coupon_code');
			}
			elseif($request->has("applied_coupon_code")) {
				$coupon_code = $request->get('applied_coupon_code');
			}
			
			$tour_date = date("Y-m-d",strtotime($request->get('txt_tour_date')));
			
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
					//$batchMsg->addBccRecipient("jalpesh@anibyte.net", array("first"=>"Jalpesh", "last" => "Anibyte"));
					$batchMsg->finalize();
				}
			}
		
			
			$order_id = \DB::table('orders')->insertGetId([
				'tour_id' => $tour_id, 
				'user_id' => $user_id, 
				'tour_name' => trim($productinfo),
				'firstname' => trim($firstname),
				'lastname' => trim($lastname),
				'email' => trim($email),
				'phone' => trim($phone),
				'city' => trim($city),
				'state' => trim($state),
				'country' => trim($country),
				'address' => $address,
				'no_of_persons' => $no_of_persons,
				'no_of_child' => $no_of_child,
				'tour_date' => $tour_date,
				'coupon_code' => trim($coupon_code),
				'coupon_amount' => trim($coupon_amount),
				'amount' => trim($amount),
				'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
			]); 
			
			Session::put('order_id', $order_id);
			$_SESSION['order_id'] = $order_id;
		}
	}
	
	
	
	
	
	public function checkout(Request $request) 
	{
		/*if (Auth::check()) 
		{*/
			@session_start();
			if(Session::has('order_tour_id')) 
			{
								
				$tour = \DB::table('tours')
				->join('tourpricecalc', 'tours.tour_id', '=', 'tourpricecalc.tour_id')	
				->join('tours_price', 'tours.tour_id', '=', 'tours_price.tour_id')	
				->where('tours.tour_id', Session::get('order_tour_id'))->get();				
				return view('tour-checkout',array('tour'=>$tour));
			}
			else {
				return back();
			}
		/*}
		else {
			return redirect('/login');
		}*/
	}
	
	public function newcheckout(Request $request) 
	{
		
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
			
			if(Session::has('order_tour_id')) 
			{
								
				$tour = \DB::table('tours')
				->join('tourpricecalc', 'tours.tour_id', '=', 'tourpricecalc.tour_id')
				->join('tours_price', 'tours.tour_id', '=', 'tours_price.tour_id')				
				->where('tours.tour_id', Session::get('order_tour_id'))->get();
				
				return view('newtour-checkout',array('tour'=>$tour));
				
			}
			else {
				return back();
			}
		/*}
		else {
			return redirect('/login');
		}*/
	}
	
	
	
	
	public function applycoupon(Request $request) 
	{
		$coupon_code = $request->coupon;
		$tour_id = $request->tour_id;
		
		//$coupons = \DB::table('coupons')->where('aht', 3)->where('aht_ids', $tour_id)->get()->toArray();
		$coupons = \DB::select("SELECT * FROM `coupons` WHERE `status` LIKE 'Active' AND `aht` = 3 AND `from_date` <= CURDATE() AND `to_date` >= CURDATE() AND `coupon_code` = '".$coupon_code."' ");
		
		if(!empty($coupons))
		{
			//$data['coupon_id'] = $coupons[0]->coupon_id;
			//$data['coupon_code'] = $coupons[0]->coupon_code;
			$data['success'] = $coupons[0]->coupon_amount;
			//$data['aht'] = $coupons[0]->aht;
			//$data['aht_ids'] = $coupons[0]->aht_ids;
			//$data['from_date'] = $coupons[0]->from_date;
			//$data['to_date'] = $coupons[0]->to_date;
			//$data['status'] = $coupons[0]->status;
			//$data['created'] = $coupons[0]->created;
			//$data['updated'] = $coupons[0]->updated;
		}
		else  {
			$data['error'] = 'Invalid Coupon Code';
		}
		echo json_encode($data); exit();
	}
	
	// PAYMENT SUCCESS PAGE.
	public function success(Request $request) 
	{
		//$tour_email = DB::table('users')->select('name','email')->where('id',$user_id)->get();
		
		@session_start();
		$user_id = DB::table('tours')->where('tour_id',$_SESSION['order_tour_id'])->pluck('user_id'); 
		$tour_email = DB::table('users')->select('name','email')->where('id',$user_id)->get();
		$client_email = DB::table('orders')		
				->join('tours', 'tours.tour_id', '=', 'orders.tour_id')	
				->join('tourpricecalc', 'tours.tour_id', '=', 'tourpricecalc.tour_id')	
				->where('orders.order_id',$_SESSION['order_id'])->get();
		//->get();
		//dd($client_email->email);
				
		
		if(isset($_SESSION['order_id']) && isset($_SESSION['order_tour_id']))
		{
			$subject = "Trip Invoice ".$_SESSION['order_id'];
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
				 <p style="color:#123456;letter-spacing: 2px; font-size: 12px; margin-top: 0px;">Invoice Date : '.date("d-M-y",$client_email[0]->created_at).'</p>
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
                                        <img src="url("/tours_images/")'.$client_email[0]->tour_image.' class="img-responsive" title="'.ucwords(strtolower($client_email[0]->tour_name)).'" alt="'.ucwords(strtolower($client_email[0]->tour_name)).'" id="tourimage_'.$client_email[0]->tour_id.'" />
                                    </td>
                                </tr>
								<tr>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="75%" align="left">
                                        '.$client_email[0]->days.' Nights Accomodation                                    </td>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="25%" align="left">
                                        Rs'.$client_email[0]->sale_price.'                                </td>
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
                                       '.$client_email[0]->fromdate.'                          </td>
                                </tr>
                                <tr>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="75%" align="left">
                                        Adults  '.$client_email[0]->no_of_persons.' RS '.$client_email[0]->adprice.'                                </td>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="25%" align="left">
                                         Rs'.($client_email[0]->adprice * $client_email[0]->no_of_persons).'                    </td>
                                </tr>
								<tr>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="75%" align="left">
                                        Child  '.$client_email[0]->no_of_child.'RS '.$client_email[0]->cdprice.'                              </td>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="25%" align="left">
                                         Rs'.($client_email[0]->cdprice * $client_email[0]->no_of_child).'                      </td>
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
			
			
			
			$mg = new Mailgun("key-a886acc552c9ecb8cae8937ff13894ec");
			$domain = "bulkmail.influensell.net";
			$batchMsg = $mg->BatchMessage($domain);
			$batchMsg->setFromAddress("info@tripindia.com", array("first"=>"Trip", "last" => "India"));
			$batchMsg->setSubject($subject);
			$batchMsg->setHtmlBody($invoice);
			$batchMsg->addToRecipient($client_email[0]->email, array("first" => $client_email[0]->firstname, "last" => $client_email[0]->lastname));
			//$batchMsg->addCcRecipient("bhadarka.jalpesh@gmail.com", array("first" => $tour_email[0]->name, "last" => "Anibyte"));
			//$batchMsg->addBccRecipient($tour_email[0]->email, array("first"=>$tour_email[0]->name, "last" => "Anibyte"));
			//$batchMsg->addBccRecipient("sudhakar@anibyte.net", array("first"=>"Sudhakar", "last" => ""));
			
			//$batchMsg->addBccRecipient("prashanth@anibyte.net", array("first"=>"Prashanth", "last" => "Sirsi"));
			//$batchMsg->addBccRecipient("sudhakar@anibyte.net", array("first"=>"Sudhakar", "last" => ""));
			//$batchMsg->addBccRecipient("info@anibyte.net", array("first"=>"Trip", "last" => "India"));
			$batchMsg->finalize();
			
			
			$subject = "Trip Invoice ".$_SESSION['order_id'];
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
                    Your Tour Booked By <b class="wow flash animted animated animated" style="visibility: visible;">Agent</b>
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
				 <p style="color:#123456;letter-spacing: 2px; font-size: 12px; margin-top: 0px;">Invoice Date : '.date("d-M-y",$client_email[0]->created_at).'</p>
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
                                        <img src="url("/tours_images/")'.$client_email[0]->tour_image.' class="img-responsive" title="'.ucwords(strtolower($client_email[0]->tour_name)).'" alt="'.ucwords(strtolower($client_email[0]->tour_name)).'" id="tourimage_'.$client_email[0]->tour_id.'" />
                                    </td>
                                </tr>
								<tr>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="75%" align="left">
                                        '.$client_email[0]->days.' Nights Accomodation                                    </td>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="25%" align="left">
                                        Rs'.$client_email[0]->sale_price.'                                </td>
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
                                       '.$client_email[0]->fromdate.'                          </td>
                                </tr>
                                <tr>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="75%" align="left">
                                        Adults  '.$client_email[0]->no_of_persons.' RS '.$client_email[0]->adprice.'                                </td>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="25%" align="left">
                                         Rs'.($client_email[0]->adprice * $client_email[0]->no_of_persons).'                    </td>
                                </tr>
								<tr>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="75%" align="left">
                                        Child  '.$client_email[0]->no_of_child.' RS '.$client_email[0]->cdprice.'                              </td>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="25%" align="left">
                                         Rs'.($client_email[0]->cdprice * $client_email[0]->no_of_child).'                      </td>
                                </tr>
								<tr>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="75%" align="left">
                                        Total Amount                                </td>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="25%" align="left">
                                         Rs'.$client_email[0]->user_amount.'                      </td>
                                </tr>
								<tr>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="75%" align="left">
                                        Discount                                </td>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="25%" align="left">
                                         Rs'.$client_email[0]->agentdiscount.'                      </td>
                                </tr>
								<tr>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="75%" align="left">
                                       Agent Payment                                </td>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="25%" align="left">
                                         Rs'.$client_email[0]->agent_total_pay.'                      </td>
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
			
			
			
			$mg = new Mailgun("key-a886acc552c9ecb8cae8937ff13894ec");
			$domain = "bulkmail.influensell.net";
			$batchMsg = $mg->BatchMessage($domain);
			$batchMsg->setFromAddress("info@tripindia.com", array("first"=>"Trip", "last" => "India"));
			$batchMsg->setSubject($subject);
			$batchMsg->setHtmlBody($invoice);
			$batchMsg->addToRecipient($tour_email[0]->email, array("first"=>$tour_email[0]->name, "last" => "Anibyte"));
			//$batchMsg->addCcRecipient("bhadarka.jalpesh@gmail.com", array("first" => $tour_email[0]->name, "last" => "Anibyte"));
			//$batchMsg->addBccRecipient($tour_email[0]->email, array("first"=>$tour_email[0]->name, "last" => "Anibyte"));
			//$batchMsg->addBccRecipient("sudhakar@anibyte.net", array("first"=>"Sudhakar", "last" => ""));
			
			//$batchMsg->addBccRecipient("prashanth@anibyte.net", array("first"=>"Prashanth", "last" => "Sirsi"));
			//$batchMsg->addBccRecipient("sudhakar@anibyte.net", array("first"=>"Sudhakar", "last" => ""));
			$batchMsg->addBccRecipient("info@anibyte.net", array("first"=>"Trip", "last" => "India"));
			$batchMsg->finalize();
			
			
			
			
			unset($_SESSION['order_tour_id']);
			unset($_SESSION['order_id']);
			
			return view('payment_success');
		}
	}
	
	// PAYMENT NewSUCCESS PAGE.
	public function newsuccess(Request $request) 
	{
		@session_start();
		$user_id = DB::table('tours')->where('tour_id',$_SESSION['order_tour_id'])->pluck('user_id'); 
		$tour_email = DB::table('users')->select('name','email')->where('id',$user_id)->get();;
		$client_email = DB::table('orders')		
				->join('tours', 'tours.tour_id', '=', 'orders.tour_id')	
				->join('tourpricecalc', 'tours.tour_id', '=', 'tourpricecalc.tour_id')	
				->where('orders.order_id',$_SESSION['order_id'])->get();
		//->get();
		//dd($client_email->email);
			
		
		if(isset($_SESSION['order_id']) && isset($_SESSION['order_tour_id']))
		{
			$subject = "Trip Invoice ".$_SESSION['order_id'];
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
				 <p style="color:#123456;letter-spacing: 2px; font-size: 12px; margin-top: 0px;">Invoice Date : '.date("d-M-y",$client_email[0]->created_at).'</p>
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
                                        <img src="url("/tours_images/")'.$client_email[0]->tour_image.' class="img-responsive" title="'.ucwords(strtolower($client_email[0]->tour_name)).'" alt="'.ucwords(strtolower($client_email[0]->tour_name)).'" id="tourimage_'.$client_email[0]->tour_id.'" />
                                    </td>
                                </tr>
								<tr>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="75%" align="left">
                                        '.$client_email[0]->days.' Nights Accomodation                                    </td>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="25%" align="left">
                                        Rs'.$client_email[0]->sale_price.'                                </td>
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
                                       '.$client_email[0]->fromdate.'                          </td>
                                </tr>
                                <tr>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="75%" align="left">
                                        Adults  '.$client_email[0]->no_of_persons.' RS '.$client_email[0]->adprice.'                                </td>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="25%" align="left">
                                         Rs'.($client_email[0]->adprice * $client_email[0]->no_of_persons).'                    </td>
                                </tr>
								<tr>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="75%" align="left">
                                        Child  '.$client_email[0]->no_of_child.'RS '.$client_email[0]->cdprice.'                              </td>
                                    <td style="font-family: Tahoma; font-size: 16px; font-weight: 400; line-height: 14px; padding: 5px;" width="25%" align="left">
                                         Rs'.($client_email[0]->cdprice * $client_email[0]->no_of_child).'                      </td>
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
			$mg = new Mailgun("key-a886acc552c9ecb8cae8937ff13894ec");
			$domain = "bulkmail.influensell.net";
			$batchMsg = $mg->BatchMessage($domain);
			$batchMsg->setFromAddress("info@tripindia.com", array("first"=>"Trip", "last" => "India"));
			$batchMsg->setSubject($subject);
			$batchMsg->setHtmlBody($invoice);
			$batchMsg->addToRecipient($client_email[0]->email, array("first" => $client_email[0]->firstname, "last" => $client_email[0]->lastname));
			$batchMsg->addToRecipient($tour_email[0]->email, array("first" => $tour_email[0]->name, "last" => "Anibyte"));
			$batchMsg->addBccRecipient("jalpesh@anibyte.net", array("first"=>"Jalpesh", "last" => "Bhadrka"));
			//$batchMsg->addBccRecipient("sudhakar@anibyte.net", array("first"=>"Sudhakar", "last" => ""));
			$batchMsg->addBccRecipient("info@anibyte.net", array("first"=>"Trip", "last" => "India"));
			$batchMsg->finalize();
			
			unset($_SESSION['order_tour_id']);
			unset($_SESSION['order_id']);
			
			return view('newpayment_success');
		}
	}
	
	// OFFERS PAGE
	public function offers()
	{
		//$tours = \DB::select("SELECT * FROM `tours` WHERE `status` = 1  AND `todate` >= CURDATE() AND `sale_price` > 0 ");
		
		$tours = Tours::where('sale_price', '>', 0)->where('status', '1')->where('todate', '>', date('Y-m-d'))->paginate(10);
		
		return view('pages.offers',array('tours'=>$tours));
	}
	
	// GET A CALL OPTION SUBMITED
	public function getacall(Request $request)
	{
		$tour_id = (int) trim($request->tour_id);
		$name = trim($request->name);
		$email = trim($request->email);
		$mobile = trim($request->mobile);
		
		if($tour_id > 0)
		{
			$subject = "Message from ".$name." on Tour ID ".$tour_id;
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
				<strong>Get a call from tour search</strong><br />
				<hr />
				Toru ID : '.$tour_id.'<br>
				Name : '.$name.'<br>
				Email : '.$email.'<br>
				Mobile : '.$mobile.'<br>
				<hr />
			</body>
			</html>';
			$batchMsg->setHtmlBody($message);
			$batchMsg->addToRecipient('nikunj@anibyte.net', array("first" => "Nikunj", "last" => "Anibyte"));
			$batchMsg->addCcRecipient('ramesh@anibyte.net', array("first" => "Ramesh", "last" => "Anibyte"));
			//$batchMsg->addBccRecipient("prashanth@anibyte.net", array("first"=>"Prashanth", "last" => "Sirsi"));
			//$batchMsg->addBccRecipient("sudhakar@anibyte.net", array("first"=>"Sudhakar", "last" => ""));
			$batchMsg->addBccRecipient("nikjoshi96@gmail.com", array("first"=>"Nikunj", "last" => "Joshi"));
			$batchMsg->finalize();
			echo "success"; exit();
		}
		
		echo "Fail"; exit();
	}
	
	
	
	
}