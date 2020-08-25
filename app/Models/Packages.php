<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Packages extends Model
{
	protected $table = 'packages';
	protected $fillable = ['package_name', 'city_location', 'transfer', 'fromdate', 'todate', 'price_per_person', 'package_image','days', 'nights', 'rating', 'overview', 'gst', 'package_transport_type','package_agent','paymentpolicy', 'cancellationpolicy', 'terms_conditions', 'user_id', 'status'];
}
