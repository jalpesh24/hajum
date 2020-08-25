<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

use DB;
class CMS extends Model
{
    use Notifiable;

    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'cms';
    protected $primaryKey = 'cms_id';
    public $incrementing = false;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['cms_id', 'title', 'description', 'cms_slug', 'content_display_location', 'status'];
    

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    public static function getCmsMenuList(){
        $allCmsData = CMS::SELECT('cms.title', 'cms.cms_slug')
            ->WHERE('cms.status', '1')
            ->WHERENULL('cms.deleted_at')
            ->get();
        return $allCmsData;
    }

    // public static function getCmsDataList(){
    //     $allCmsData = CMS::SELECT(
    //         'cms.cms_id',
    //         'cms.title',   
    //         'cms.description',
    //         'cms.content_display_location',
    //         'cms.cms_slug'
    //     )
    //         ->WHERE('cms.status', '1')
    //         ->WHERE('cms.content_display_location', 'home_Page')
    //         ->WHERENULL('cms.deleted_at')
    //         ->get();
    //     return $allCmsData;
    // }


}
