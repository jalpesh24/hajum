<?php
 
namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use DB;
use Auth;
use Session;
//use Mailgun\Mailgun;
use User;
use Agency;

class AgencyController extends Controller
{
    use AuthenticatesUsers;
    
    protected $redirectTo = '/dashboard';
   
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
		
	public function register(){
		 $countries =  \DB::table('countries')->select('name','id')->get();
		 return view('agency_register',array('countries'=>$countries));
	}
	
	public function save(Request $request)
	{
			$postData = $request->all();    
			        		
			$name =  $request->get('name');
			$email =  $request->get('email');
			$password =  bcrypt($request->get('password'));
			$password_confirmation =  bcrypt($request->get('password_confirmation'));
			$address   = $request->get('address');
			$phone   = $request->get('phone');
			$country =  $request->get('country');
			$state =  $request->get('state');
			$city =  $request->get('city');
			$about =  $request->get('about');
			$comp_url =  $request->get('comp_url');
			$gsm = $request->get('gsm');
			$cont_name = $request->get('cont_name');
			$trip_agency =  1;
			$status =  $request->get('status');

			$this->validate($request, ['email' => 'required|string|email|max:255|unique:agency','password'=> 'min:6|required_with:password_confirmation|same:password_confirmation','password_confirmation' => 'min:6','phone'=>'required|numeric','country'=>'required','state'=>'required','city'=>'required']);

			$id = DB::table('agency')->insertGetId(array(
				'aname' => $name, 
				'email' => $email,
				'password' => $password,
				'address' => $address,
				'contact_number' => $phone,			
				'country' => $country,
				'state' => $state,
				'city' => $city,
				'aboutus' => $about,
				'comp_url' => $comp_url,
				'gsm' => $gsm,
				'contact_name' => $cont_name,
				'trip_agency' => $trip_agency,
				'status' => $status,			
				'created_at' =>date("Y-m-d H:i:s"),
				'updated_at' =>date("Y-m-d H:i:s")
				));

				\DB::table('users')->insert(['name' => $name, 
				'email' => $email,
				'password' => $password,
				'address' => $address,
				'contact_number' => $phone,
				'trip_agency' => $trip_agency,
				'status' => $status,
				'created_at' =>date("Y-m-d H:i:s"),
				'updated_at' =>date("Y-m-d H:i:s")]);

				

		if(Auth::attempt(['email'=>$request->email,'password'=>$request->password,'status' => 'Active'],false)) {
			return redirect('/dashboard')->with('status', 'Thank You For Registration!');
		
		}
		else{
				return back()->with('false', 'Registration faild.');
		}
		
	}
	
	public function getStateList(Request $request)
    {
        $states = \DB::table('states')
        ->where('country_id',$request->country_id)
        ->select('name','id')->get()->toarray();        
        return response()->json($states);
    }
    public function getCityList(Request $request)
    {
       $cities = \DB::table('cities')
                ->where('state_id',$request->state_id)
                ->select('name','id')->get();
            return response()->json($cities);
    }
	
	
	
}