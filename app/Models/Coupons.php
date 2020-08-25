<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use DB;
class Coupons extends Model
{
	public function getCoupons()
	{
		$coupons = \DB::table('coupons')->orderBy('coupon_id', 'desc')->get()->toArray();
		return $coupons;
	}
	
	public function deleteCoupon($coupon_id=0)
	{
		if($coupon_id > 0)
		{
			\DB::table('coupons')->where('coupon_id', $coupon_id)->delete();
			return 1;
		}
		return $coupon_id;
	}
	
	public function saveNewCoupon($fields=array())
	{
		$id = \DB::table('coupons')->insertGetId($fields);
		return $id;
	}
}
