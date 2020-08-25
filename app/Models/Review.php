<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use DB;

class Review extends Model
{
	public function review_list()
	{
		$reviews = \DB::table('review')->get();
		return $reviews;
	}
	
	public function myreviews($user_id)
	{
		$reviews = \DB::table('review')->where('client_id',$user_id)->get();
		return $reviews;
	}
}
