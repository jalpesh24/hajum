<?php
namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use DB;
use Auth;
use Session;
use Mailgun\Mailgun;
use User;

class APIController extends Controller
{
    public function index()
    {
    $countries = DB::table("countries")->lists("name","id");
    return view('agency_register',array('countries'=>$countries));
                        
    }
    public function getStateList(Request $request)
    {
        $states = \DB::table('states')
        ->where('country_id',$request->country_id)
        ->select('name','id');
        return response()->json($states);
    }
    public function getCityList(Request $request)
    {
       $cities = \DB::table('cities')
                ->where('state_id',$request->state_id)
                ->select('name','id');
            return response()->json($cities);
    }
    
}