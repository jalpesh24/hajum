<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Tours;
use App\Models\Hotels;
use App\Models\Activities;

use DB;

class SearchController extends Controller
{
	public function generalsearch(Request $request)
	{
		$search = '';
		if($request->has("txt_search_india")) { 
			$search = addslashes(trim($request->txt_search_india));
		}
		elseif($request->has("search")) {
			$search = addslashes(trim($request->search));
		}
		
		$tours = \DB::select("SELECT * FROM `tours` WHERE `status` = 1 AND (`tour_name` LIKE '%".$search."%' OR `city_location` LIKE '%".$search."%') ");
		
		$activities = \DB::select("SELECT * FROM `activities` WHERE `activities_status` = 'Active' AND (`activities_name` LIKE '%".$search."%' OR `activities_address` LIKE '%".$search."%' OR `activities_location` LIKE '%".$search."%')");
		
		$hotels = \DB::select("SELECT hr.*,h.* FROM `hotels_roomdata` hr JOIN `hotels` h ON hr.`hotel_id` = h.`hotel_id` WHERE h.`hotel_status` = 1 AND 
		(h.`hotel_name` LIKE '%".$search."%' OR h.`hotel_address` LIKE '%".$search."%' OR h.`city_location` LIKE '%".$search."%') ORDER BY hr.`hotel_saleprice` ASC LIMIT 1");
		
		return view('search',array('tours'=>$tours,'activities'=>$activities,'hotels'=>$hotels));
	}
}
