<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Config;
use Auth;
use Carbon;
use DB;

class Hotels extends Model
{
   use Notifiable;
	protected $table = 'hotels';
	protected $primaryKey = 'hotel_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
   /* Customization start - ashwin for the revision class */
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    /* Customization end - ashwin for the revision class */


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

}
