<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class Hotels extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'hotel_name', 'hotel_address','city_location','hotel_pincode','hotel_amenities','fromdate','todate','hotel_image','checkin-time','checkout-time','hotel_highlights','hotel_paymentpolicy','hotel_cancellationpolicy','hotel_terms_conditions','hotel_status'
    ];
    
	public function getHotelinfo($hotel_id)
    	{
    		if($hotel_id > 0)
		{
			$hotel =\DB::table('hotels')->where('hotel_id',$hotel_id)->orderBy('hotel_id', 'desc')->get()->toArray();
			return $hotel;
		}
		else {
			return array();
		}
    	}
    
    	public function getHotelRooms($hotel_id)
    	{
		if($hotel_id > 0)
		{
			$hotel_rooms =\DB::table('hotels_roomdata')->where('hotel_id',$hotel_id)->orderBy('hotel_room_id', 'asc')->get()->toArray();
			return $hotel_rooms;
    		}
		else {
			return array();
		}
	}
}
