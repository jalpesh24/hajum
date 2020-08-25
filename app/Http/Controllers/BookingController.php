<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;
use Session;

class BookingController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}
	
	public function mybooking()
	{
		if (Auth::check())
		{
			$bookings = \DB::table('orders')->where('user_id',Auth::user()->id)->orderBy('tour_id', 'desc')->get();
			return view('booking_list',array('bookings'=>$bookings));
		}
		else {
			return redirect()->intended(route('mybooking'));
		}
	}
	
	public function detailview(Request $request)
	{
		$order_id = $request->route('tid');
		
		$tour_detail = ''; $hotel_detail = ''; $activity_detail = ''; $hotel_room_detail = '';
		$order_detail = \DB::table('orders')->where('order_id',$order_id)->orderBy('order_id', 'desc')->get()->toArray();
		if(!empty($order_detail))
		{
			if($order_detail[0]->tour_id > 0) {
				$tour_detail = \DB::table('tours')
				->join('tourpricecalc', 'tours.tour_id', '=', 'tourpricecalc.tour_id')
				->join('orders', 'tours.tour_id', '=', 'orders.tour_id')
				->where('orders.order_id',$order_id)->orderBy('order_id', 'desc')->get()->toArray();
			}
			if($order_detail[0]->activity_id > 0) {
				$activity_detail = \DB::table('activities')->where('activities_id',$order_detail[0]->activity_id)->orderBy('activities_id', 'desc')->get()->toArray();
			}
			if($order_detail[0]->hotel_id > 0 && $order_detail[0]->hotel_room_id > 0) 
			{
				$hotel_detail = \DB::table('hotels')->where('hotel_id',$order_detail[0]->hotel_id)->orderBy('hotel_id', 'desc')->get()->toArray();
				$hotel_room_detail = \DB::table('hotels_roomdata')->where('hotel_room_id',$order_detail[0]->hotel_room_id)->orderBy('hotel_room_id', 'desc')->get()->toArray();
			}
		}
		
		return view('detailview',array('tour_detail'=>$tour_detail,'activity_detail'=>$activity_detail,'hotel_detail'=>$hotel_detail,'hotel_room_detail'=>$hotel_room_detail));
	}
	
	
}