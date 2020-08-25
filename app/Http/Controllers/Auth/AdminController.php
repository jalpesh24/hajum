<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use App\Orders;
use App\Activities;
use App\Hotels;
use App\Tours;
use App\Packages;
use DB;
use App\User;
use Excel;

class AdminController extends Controller 
{

	public function __construct()
	{
		$this->middleware('auth');
	}

	public function admins()
	{
		if (Auth::check()) 
		{
		//$admins = \DB::table('users')->where('ticketit_admin',1)->where('ticketit_agent',0)->where('trip_agent',0)->orderBy('id', 'desc')->get();

		$admins = DB::table('users')->where('ticketit_admin',1)->orderBy('id', 'desc')->paginate(15);		
		return view('admin.admins',array('admins'=>$admins));
		}else {
			return redirect('/login');
		}
	}
	
	public function users()
	{
		if (Auth::check()) 
		{
		//$users = \DB::table('users')->where('ticketit_admin',0)->where('ticketit_agent',0)->where('trip_agent',0)->orderBy('id', 'desc')->get();
		$users = DB::table('users')->where('ticketit_admin',0)->where('ticketit_agent',0)->where('trip_agent',0)->orderBy('id', 'desc')->paginate(15);	
		return view('admin.users',array('users'=>$users));
		}else {
			return redirect('/login');
		}
	}
	
	public function agents()
	{
		// $agents = \DB::table('users')
		// 		->select('users.*')
		// 		->where('ticketit_admin',0)->where('ticketit_agent',0)->where('trip_agent',1)->orderBy('id', 'desc')->get();
		$agents = DB::table('users')->where('trip_agent',1)->orderBy('id', 'desc')->paginate(15);	
		return view('admin.agents',array('agents'=>$agents));
	}

	public function agency()
	{		
		$agences = DB::table('users')->where('trip_agency',1)->orderBy('id', 'desc')->paginate(15);	
		return view('admin.agency',array('agences'=>$agences));
	}
	
	
	public function travelar()
	{
		$travelars = \DB::table('users')
		->leftJoin('category', 'users.catid', '=', 'category.cid')
		->select('users.*', 'category.cid', 'category.catname','category.catdiscount')
		->where('ticketit_admin',0)->where('ticketit_agent',1)->where('trip_agent',0)->orderBy('id', 'desc')->get();
		return view('admin.travelar',array('travelars'=>$travelars));
	}
	
	public function hotelagents()
	{
		$hotelagents = \DB::table('users')->where('ticketit_admin',0)->where('hotel_agent',1)->where('trip_agent',0)->orderBy('id', 'desc')->get();
		return view('admin.hotelagent',array('hotelagents'=>$hotelagents));
	}
	
	public function bookings()
	{
		$bookings = \DB::table('orders')->orderBy('order_id', 'desc')->get();
		return view('admin.bookings',array('bookings'=>$bookings));
	}
	
	public function allcategory()
	{
		$categories = \DB::table('category')->orderBy('cid', 'ASC')->get();
		//print_r($categories); exit;
		return view('admin.allcategory',array('categories'=>$categories));
	}
	
	public function alltours()
	{
		// $tours = \DB::table('tours')			
		// 	->select('tour_id','tour_name','city_location','fromdate','todate','price_per_person','status')
		// 	->orderBy('tour_id', 'desc')
		// 	->paginate(20);
		$tours = DB::table('tours')->where('status',1)->paginate(15);
		return view('admin.alltours',array('tours'=>$tours));
	}

	public function allpackages()
	{	
		$packages = DB::table('packages')->where('status',1)->paginate(15);
		return view('admin.allpackages',array('packages'=>$packages));
	}


	public function allhotels()
	{
		// $hotels = \DB::table('hotels')
		// 		->select('hotels.*')
		// 		->orderBy('hotel_id', 'desc')->get();
		$hotels = DB::table('hotels')->where('hotel_status',1)->paginate(15);		
		return view('admin.allhotels',array('hotels'=>$hotels));
	}
	
	public function allactivities()
	{
		//$activities = \DB::table('activities')->orderBy('activities_id', 'desc')->get();
		$activities = DB::table('activities')->orderBy('activities_id', 'desc')->paginate(15);	
		return view('admin.allactivities',array('activities'=>$activities));
	}
	public function export_users($type)
	{
		$data1[0]= ['Id', 'Name' , 'Email', 'Address','Contact No', 'Status'];    	
		$data2 = User::where('ticketit_admin', 0)->where('ticketit_agent',0)->where('trip_agent',0)->orderBy('id', 'desc')->get(['id','name','email','address','contact_number','status'])->toArray();		
		$data = array_merge($data1,$data2);
		return Excel::create('Users data', function($excel) use ($data) {		
		$excel->sheet('Users', function($sheet) use ($data) { $sheet->fromArray($data, null, 'A1', false, false);});
  	    })->download($type);
		return redirect()->back();
	}
	
	public function export_agents($type)
	{
		$data1[0]= ['Id', 'Name' , 'Email', 'Address','Contact No', 'Status'];    	
		$data2 = User::where('ticketit_admin', 0)->where('ticketit_agent',0)->where('trip_agent',1)->orderBy('id', 'desc')->get(['id','name','email','address','contact_number','status'])->toArray();		
		$data = array_merge($data1,$data2);
		return Excel::create('Agent data', function($excel) use ($data) {		
		$excel->sheet('Agents', function($sheet) use ($data) { $sheet->fromArray($data, null, 'A1', false, false);});
  	    })->download($type);
		return redirect()->back();
	}
	
	
	public function export_admins($type)
	{
		$data1[0]= ['Id', 'Name' , 'Email', 'Address','Contact No', 'Status'];    	
		$data2 = User::where('ticketit_admin', 1)->where('ticketit_agent',0)->where('trip_agent',0)->orderBy('id', 'desc')->get(['id','name','email','address','contact_number','status'])->toArray();		
		$data = array_merge($data1,$data2);
		return Excel::create('Admin data', function($excel) use ($data) {		
		$excel->sheet('Admins', function($sheet) use ($data) { $sheet->fromArray($data, null, 'A1', false, false);});
  	    })->download($type);
		return redirect()->back();
	}
	
	public function export_bookings($type)
	{
		$data1[0]= ['Payu Id', 'Package Name' , 'Email', 'Amount','Contact No', 'Date of Travel'];    	
		$data2 =  Orders::get(['payu_id','tour_name','email','amount','phone','tour_date'])->toArray();
		$data = array_merge($data1,$data2);
		return Excel::create('Admin data', function($excel) use ($data) {		
		$excel->sheet('Admins', function($sheet) use ($data) { $sheet->fromArray($data, null, 'A1', false, false);});
  	    })->download($type);
		return redirect()->back();
	}
	
	public function export_allactivities($type)
	{
		$data1[0]= ['Activity Id', 'Activity Name' , 'Category ', 'Activities address','Activities Location', 'Activities Pincode','activities_price','Activities Description','Activities Additional_info',
		'Activities highlights','Activities Duration','Activities meeting point','Activities meeting time','Activities rating','Activities_status','Created'];    	
		$data2 =  Activities::get(['activities_id','activities_name','activities_category','activities_address','activities_location','activities_pincode','activities_price','activities_description','activities_additional_info',
		'activities_highlights','activities_duration','activities_meeting_point','activities_meeting_time','activities_meeting_time','activities_rating','activities_status','created_at'])->toArray();
		$data = array_merge($data1,$data2);
		return Excel::create('Activity data', function($excel) use ($data) {		
		$excel->sheet('Activity', function($sheet) use ($data) { $sheet->fromArray($data, null, 'A1', false, false);});
  	    })->download($type);
		return redirect()->back();
	}
	
	public function export_allhotels($type)
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

	public function export_alltours($type)
	{
		$data1[0]= ['Tour Id' ,'Tour name ', 'City Location', 'Features','From Date','To Date','Price per person','Sale price','Image name',
		'Part of india','Days','Nights','No places','Themes','Rating','Overview','Inclusions','Exclusions','Payment policy','Cancellation policy','Terms conditions','Status'];    	
		
		$data2 =  Tours::get(['tour_id','tour_name','city_location','features','fromdate','todate','price_per_person','sale_price','tour_image',
		'partofindia','days','nights','no_places','themes','rating','overview','inclusions','exclusions','paymentpolicy','cancellationpolicy','terms_conditions','status'])->toArray();
		
		$data = array_merge($data1,$data2);
		return Excel::create('Tours data', function($excel) use ($data) {		
		$excel->sheet('Tours', function($sheet) use ($data) { $sheet->fromArray($data, null, 'A1', false, false);});
  	    })->download($type);
		return redirect()->back();
	}
	public function addcategory(){
		
		return view('category');
	}
	
	public function addcategorysave(Request $request)
	{
		        		
			$catname =  $request->get('catname');
			$catdiscount =  $request->get('catdiscount');
			

			$this->validate($request, ['catname' => 'required','catdiscount'=> 'required']);
		
			\DB::table('category')->insert(['catname' => $catname, 
			'catdiscount' => $catdiscount,			
			'created_at' =>date("Y-m-d H:i:s"),
			'updated_at' =>date("Y-m-d H:i:s")]);
			
		return back()->with('success', 'Add Category successfully.');
		
	}
}
