<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tours extends Model
{
	protected $table = 'tours';
	protected $fillable = ['tour_name', 'city_location', 'features', 'fromdate', 'todate', 'price_per_person', 'sale_price','guest_per_booking','room_per_booking','child_age','tour_image', 'partofindia', 'days', 'nights', 'no_places', 'themes', 'rating', 'overview', 'inclusions', 'exclusions', 'paymentpolicy', 'cancellationpolicy', 'terms_conditions', 'user_id', 'status'];
}
