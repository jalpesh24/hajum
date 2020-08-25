<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Packages;
use App\Models\Tours;
//use App\Models\Hotels;
use DB;
use Auth;
use Session;
//use Mailgun\Mailgun;



class PackageController extends Controller
{
	
	// ADD NEW PACKAGE
	public function index(Request $request) 
	{
		$countries =  \DB::table('countries')->select('name','id')->get();

		if (Auth::check())
		{
			if(Session::has('package_id')) {
				$request->session()->forget('package_id');
			}
			return view('packages.package_add',array('countries'=>$countries));
		}
		else {
			return redirect('/login');
		}
	}

	// Package  LIST
	public function packageslist(Request $request)
	{
		
		if(Session::has('package_id')) {
			$request->session()->forget('package_id');
		}
		
		$packages = \DB::table('packages')->where('user_id',Auth::user()->id)->orderBy('package_name', 'asc')->paginate(10);
		return view('packages.packages_list',array('packages'=>$packages));
	}

	// FOR DELETE Package 
	public function deletepackage(Request $request)
	{
		if (Auth::check())
		{
			$package_id = $request->pid;
			\DB::table('packages')->where('package_id', $package_id)->delete();
			
			return redirect('/packages_list')->with('status', 'Package deleted successfully!');
		}
	}
	
	// SAVE NEW  PACKAGE
	public function savepackage(Request $request) 
	{		
		$package = new Packages();
		$id = \DB::table('packages')->insertGetId(
			['package_name' => trim($request->get('package_name')), 
			'country' => trim($request->get('country')), 
			'city_location' => trim($request->get('city_location')), 
			'transfer' => trim($request->get('transfer')), 
			'fromdate' => date("Y-m-d",strtotime(trim($request->get('fromdate')))),
			'todate' => date("Y-m-d",strtotime(trim($request->get('todate')))),
			'price_per_person' => trim($request->get('price_per_person')),			
			'package_image' => trim($request->get('package_image')),			
			'days' => trim($request->get('days')),
			'nights' => trim($request->get('nights')),
			'package_transport_type' => trim($request->get('package_transport_type')),
			'overview' => trim($request->get('txt_tour_overview')),
			'inclusions' => trim($request->get('txt_tour_inclusions')),
			'exclusions' => trim($request->get('txt_tour_exclusions')),
			'paymentpolicy' => trim($request->get('txt_tour_paymentpolicy')),	
			'cancellationpolicy' => trim($request->get('txt_tour_cancellationpolicy')),
			'terms_conditions' => trim($request->get('txt_tour_termsconditions')),					
			'user_id' => Auth::user()->id
		]
	);
		$destinationPath = '/public/packages_images';

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
		\DB::table('packages')->where('package_id', $id)->update(['package_image' => $files]);

		if(Session::has('package_id'))
		{
			$request->session()->forget('package_id');
			$request->session()->put('package_id',$id);
		}
		else {
			$request->session()->put('package_id',$id);
		}
		
		
		
		$package_detail = \DB::table('packages')->where('package_id', $id)->get();
		
		//jalpesh@anibyte
		//print_r($tour_detail);exit;
		$package_id = $id;
		$name = $package_detail[0]->package_name;
		$city_location = $package_detail[0]->city_location;
		$price_per_person = $package_detail[0]->price_per_person;
		$userid = $package_detail[0]->user_id;
		
			// $subject = "Message from New Tour Add on Tour ID ".$tour_id;
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
			// 	<strong>NEW Tour Add By Tour Operator.</strong><br />
			// 	<hr />
			// 	Toru ID : '.$tour_id.'<br>
			// 	Tour Name : '.$name.'<br>
			// 	city_location : '.$city_location.'<br>
			// 	price_per_person : '.$price_per_person.'<br>
			// 	user ID : '.$userid.'<br>
			// 	<hr />
			// </body>
			// </html>';
			// $batchMsg->setHtmlBody($message);
			// $batchMsg->addToRecipient('jalpesh@anibyte.net', array("first" => "jalpesh", "last" => "bhadarka"));
			// //$batchMsg->addCcRecipient('ramesh@anibyte.net', array("first" => "Ramesh", "last" => "Anibyte"));
			// $batchMsg->addBccRecipient("prashanth@anibyte.net", array("first"=>"Prashanth", "last" => "Sirsi"));
			// $batchMsg->addBccRecipient("sudhakar@anibyte.net", array("first"=>"Sudhakar", "last" => ""));
			// //$batchMsg->addBccRecipient("nikjoshi96@gmail.com", array("first"=>"Nikunj", "last" => "Joshi"));
			// $batchMsg->finalize();
		
		return redirect('/addpackagehotel')->with('status', 'Package added successfully!');
		
		//return back()->with('status', 'Tour package added successfully!');
	}
	
	
	
	// ADD NEW Package hotel
	public function addpackage_hotel(Request $request)
	{
		if(Session::has('package_id'))
		{
			$id = $request->session()->get('package_id');
			return view('packages.package_add_hotle');
		}
		else {
			return redirect('/addpackage');
		}
	}
	

	// SAVE NEW PACKAGE hotel
	public function savepackage_hotel(Request $request) 
	{	
		// echo $count = count($request->get('hotel_name'));
		// echo "<pre>";
		// print_r($_REQUEST);EXIT;
		if(Session::has('package_id'))
		{
			$id = $request->session()->get('package_id');
			//print_r($_REQUEST);EXIT;
			foreach($request->get('hid') as $hid) 
			{
				$package_details = \DB::table('packages')->where('package_id', $id)->get();
				\DB::table('packages_hotel')->insertGetId([
					'package_id' => $id,							
					'ph_name'=> trim($request->get('hotel_name_'.$hid)),
					'ph_stars'=> trim($request->get('rating_'.$hid)),
					'ph_distance'=> trim($request->get('distance_'.$hid))
				]);
			}			
			return redirect('/addpackageprice')->with('status', 'Package hotel add successfully!');
			
		}
		else {
			return redirect('/addpackage');
		}
	}

	// ADD NEW TOUR PRICE
	
	public function addpackage_price(Request $request)
	{
		if(Session::has('package_id'))
		{
			$id = $request->session()->get('package_id');
			return view('packages.package_add_price');
		}
		else {
			return redirect('/addpackage');
		}
		
	}

	// SAVE NEW TOUR PACKAGE
	public function savepackage_price(Request $request) 
	{	

		if(Session::has('package_id'))
		{
			$id = $request->session()->get('package_id');
			//print_r($_REQUEST);EXIT;
			foreach($request->get('pid') as $pid) 
			{
				$package_details = \DB::table('packages')->where('package_id', $id)->get();
				\DB::table('packages_price')->insertGetId([
					'package_id' => $id,							
					'pp_type'=> trim($request->get('typeName_'.$pid)),
					'pp_price'=> trim($request->get('price_'.$pid)),

				]);
			}

			return redirect('/addpackage')->with('status', 'Package Price add successfully!');
			
		}
		else {
			return redirect('/addpackage');
		}
	}

	// Newsearchtours TOUR PACKAGE
	public function searchpackage(Request $request)
	{

		$countries =  \DB::table('countries')->select('name','id')->get();

		$days =  $request->get("days"); 
		$starrate =  $request->get("starrate");
		$country =  $request->get("country");
		$city =  $request->get("city");
		$amount1 =  $request->get("amount1");
		$amount2 =  $request->get("amount2");
							
		// if($days != "" || $starrate != "" || $country != "" || $city != "" || $amount1 != "" || $amount2 != "") 
		// {			
			if($days != "") 
			{
				
				$packageObj = Packages::select('*');
	            $packageObj->where('status', '1');
	            if($days == 7){
					$packageObj->whereBetween('days',[0,$days]);
				}else if($days == 15){
					$packageObj->whereBetween('days',[8,$days]);
				}else if($days == 21){
					$packageObj->whereBetween('days',[16,$days]);
				}else if($days == 28){
					$packageObj->whereBetween('days',[22,$days]);
				}else if($days == 35){
					$packageObj->whereBetween('days',[29,$days]);
				}else if($days == 36){
					$packageObj->where('days','>=',$days);
				}				
	            $packageObj->orderBy('packages.package_name', 'DESC');
	            $packageList = $packageObj->get()->toArray();
	           
	            foreach ($packageList as $key => $value) {
	                $packageList[$key]['photels'] = DB::table('packages_hotel')				
							->select('*')
							->where('package_id',$value['package_id'])				
							->orderBy('ph_id', 'asc')->get();
	            }				
			}
			else
			{

				$packageObj = Packages::select('*');				
				$packageObj->where('status',1);
				$packageObj->where('todate','>=',date('Y-m-d'));			
				$packageObj->orderBy('package_name', 'asc');
				$packageList = $packageObj->get()->toArray();
				foreach ($packageList as $key => $value) {
	                $packageList[$key]['photels'] = DB::table('packages_hotel')				
							->select('*')
							->where('package_id',$value['package_id'])				
							->orderBy('ph_id', 'asc')->get();
	            }	
			}	
			return view('packages_search',array('packageList'=>$packageList,'countries'=>$countries));
		
	}
	
	
}