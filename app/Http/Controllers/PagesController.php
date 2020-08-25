<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Tours;

use DB;
use Auth;
use Session;

class PagesController extends Controller
{
	// FOR HOME (INDEX) PAGE
	public function index()
	{
		// $regions = \DB::table('tours')->select('city_location')->where('city_location','!=', '')->groupBy('city_location')->get()->toArray();
		// return view('index',array('index'=>1,'regions'=>$regions));
		 $countries =  \DB::table('countries')->select('name','id')->get();
		 return view('index',array('index'=>1,'countries'=>$countries));
	}
	
	// FOR ABOUT US PAGE
	public function aboutus()
	{
		return view('pages.aboutus');
	}
	
	
	// FOR CONTACT US PAGE
	public function contact()
	{
		return view('pages.contact');
	}
	
	// FOR New Layout PAGE
	public function newhome()
	{
		$tours = \DB::table('tours')->orderBy('tour_id', 'desc')->take(8)->get();
		return view('newhome',array('tours'=>$tours));
	}
	// FOR ABOUT US PAGE
	public function newabout()
	{
		return view('newabout');
	}
	
	public function newoffers()
	{
		//$tours = \DB::select("SELECT * FROM `tours` WHERE `status` = 1  AND `todate` >= CURDATE() AND `sale_price` > 0 ");
		
		$tours = Tours::where('sale_price', '>', 0)->where('status', '1')->where('todate', '>', date('Y-m-d'))->paginate(10);
		
		return view('newoffers',array('tours'=>$tours));
	}
	
	public function newtestimonial()
	{
		$testimonials = \DB::table('testimonial')->orderBy('id', 'ASC')->get();
		return view('newtestimonial',array('testimonials'=>$testimonials));
	}
	
	// FOR ABOUT US PAGE
	public function newquality()
	{
		return view('newquality');
	}
	
	// FOR ABOUT US PAGE
	public function newreview()
	{
		$reviews = \DB::table('review')->where('is_approve',1)->orderBy('id','desc')->take(9)->get();
		return view('newreview',array('reviews'=>$reviews));
	}
	
	// FOR CONTACT US PAGE
	public function newcontact()
	{
		return view('newcontact');
	}
	
	
	
}
