<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Coupons;
use Excel;
use DB;
use Auth;
use Session;

class CouponsController extends Controller
{
	public function __construct() {
		$this->middleware('auth');
	}
	
	// COUPONS LIST FOR ADMIN
	public function index()
	{
		if (Auth::check()) 
		{
			$coupons = new Coupons();
			$coupons_arr = $coupons->getCoupons();
			return view('coupons.index',array('coupons'=>$coupons_arr));
		}
		else {
			return redirect('/login');
		}
	}
	
	// ADD NEW COUPON
	public function coupon_add()
	{
		if (Auth::check()) 
		{
			return view('coupons.coupon_add');
		}
		else {
			return redirect('/login');
		}
	}
	
	// SAVE NEW COUPON
	public function coupons_save(Request $request)
	{
		if (Auth::check()) 
		{
			$this->validate($request, [
				'coupon_code' => 'required|unique:coupons|max:15',
				'coupon_amount' => 'required|max:5',
				'fromdate' => 'required',
				'todate' => 'required'
			]);
			
			$coupons = new Coupons();
			$fields = array(
				'coupon_code' => addslashes(trim($request->coupon_code)),
				'coupon_amount' => (int) addslashes(trim($request->coupon_amount)),
				'from_date' => date("Y-m-d",strtotime(trim($request->fromdate))),
				'to_date' => date("Y-m-d",strtotime(trim($request->todate))),
				'aht' => addslashes(trim($request->aht)),
				'aht_ids' => trim('1'),
				'status' => 'Active',
				'created' => date("Y-m-d H:i:s"),
				'updated' => date("Y-m-d H:i:s"),
			);
			$id = $coupons->saveNewCoupon($fields);
			return redirect('/coupons')->with('status', 'Coupon added successfully!');
		}
		else {
			return redirect('/login');
		}
	}
	
	//GENERATE NEW COUPON CODE (AJAX)
	public function generatecoupon(Request $request)
	{
		if (Auth::check())  
		{
			$chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
			$res = "";
			for ($i = 0; $i < 6; $i++) {
				$res .= $chars[mt_rand(0, strlen($chars)-1)];
			}
			echo $res; exit();
		}
		else {
			return redirect('/login');
		}
	}
	
	// EDIT COUPON
	public function coupon_edit(Request $request)
	{
		if (Auth::check()) 
		{
			return view('coupons.coupon_edit');
		}
		else {
			return redirect('/login');
		}
	}
	
	// DELETE COUPON
	public function coupons_delete(Request $request)
	{
		if (Auth::check()) 
		{
			$coupon_id = $request->route('cid');
			$coupons = new Coupons();
			$coupons_id = $coupons->deleteCoupon($coupon_id);
			if($coupons_id > 0) {
				return redirect('/coupons')->with('status', 'Coupon deleted successfully!');
			}
			else {
				return redirect('/coupons')->with('error', 'Error in coupon code delete!');
			}
		}
		else {
			return redirect('/login');
		}
	}
	
	public function export_coupons($type)
	{
		$data1[0]= ['Coupon Id', 'coupon code' , 'coupon amount', 'Activities/Hotel/Tours','aht_ids', 'from_date','to_date','status','created'];    	
		$data2 =  Coupons::get(['coupon_id','coupon_code','coupon_amount','aht','aht_ids','from_date','to_date','status','created'])->toArray();
		$data = array_merge($data1,$data2);
		return Excel::create('Coupon data', function($excel) use ($data) {		
		$excel->sheet('Coupon', function($sheet) use ($data) { $sheet->fromArray($data, null, 'A1', false, false);});
  	    })->download($type);
		return redirect()->back();
	}
	
}

