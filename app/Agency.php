<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;
class Agency extends Model
{
    use Notifiable;
	protected $table = 'agency';
    protected $primaryKey = 'aid';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'aname', 'email', 'password','status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    
}
