<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use DB;

class Testimonial extends Model
{
	public function testimonial_list()
	{
		$testimonials = \DB::table('testimonial')->get();
		return $testimonials;
	}
	
	public function mytestimonials($user_id)
	{
		$testimonials = \DB::table('testimonial')->where('client_id',$user_id)->get();
		return $testimonials;
	}
}
