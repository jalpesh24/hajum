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

class AgentController extends Controller
{
    use AuthenticatesUsers;
    
    protected $redirectTo = '/dashboard';
   
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
	
	
	public function userregister(){
		$countries =  \DB::table('countries')->select('name','id')->get();
		 return view('user-register',array('countries'=>$countries));

		// $countries =  \DB::table('countries')->select('name','id')->get();
		// return view('user-register',array('countries'=>$countries));
	}
	
	public function usersave(Request $request)
	{
		        		
			$name =  $request->get('name');
			$email =  $request->get('email');
			$password =  bcrypt($request->get('password'));	
			$address   = $request->get('address');
			$phone   = $request->get('phone');
			$country =  $request->get('country');
			$status =  $request->get('status');

			$this->validate($request, ['email' => 'required|email','password'=> 'required','phone'=>'required|numeric']);
		
			\DB::table('users')->insert(['name' => $name, 
			'email' => $email,
			'password' => $password,
			'address' => $address,
			'contact_number' => $phone,
			'country' => $country,
			'status' => $status,
			'created_at' =>date("Y-m-d H:i:s"),
			'updated_at' =>date("Y-m-d H:i:s")]);
			
			// $subject = "Welcome new User ".$name;
	  
			// $newuser = '<html xmlns="http://www.w3.org/1999/xhtml">
			// <head>
			// 	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			// </head>
			// <body>
			// 	<strong>Thank You For Registration</strong><br />
			// 	<b> Your Account Will be Activated Soon.</b><br/>
			// 	<hr />
			// 	Name : '.$name.'<br>
			// 	Email : '.$email.'<br>
			// 	Password : '.$password.'<br>
			// 	<hr />
			// </body>
			// </html>';
			
			// $mg = new Mailgun("key-a886acc552c9ecb8cae8937ff13894ec");
			// $domain = "bulkmail.influensell.net";
			// $batchMsg = $mg->BatchMessage($domain);
			// $batchMsg->setFromAddress("info@tripindia.com", array("first"=>"Trip", "last" => "India"));
			// $batchMsg->setSubject($subject);
			// $batchMsg->setHtmlBody($newuser);
			// $batchMsg->addToRecipient($email, array("first" => "Jalpesh", "last" => "Bhadarka"));
			//$batchMsg->addCcRecipient('ramesh@anibyte.net', array("first" => "Ramesh", "last" => "Anibyte"));
			//$batchMsg->addBccRecipient("prashanth@anibyte.net", array("first"=>"Prashanth", "last" => "Sirsi"));
			//$batchMsg->addBccRecipient("sudhakar@anibyte.net", array("first"=>"Sudhakar", "last" => ""));
			//$batchMsg->addBccRecipient("nikjoshi96@gmail.com", array("first"=>"Nikunj", "last" => "Joshi"));
			//$batchMsg->finalize();		
		if(Auth::attempt(['email'=>$request->email,'password'=>$request->password,'status' => 'Active'],false)) {
			return redirect('/dashboard')->with('status', 'Thank You For Registration!');
		
		}
		else{
				return back()->with('success', 'User Registration successfully.');
		}
		
	}
	
	
	
	
	public function register(){
		return view('agent_register');
	}
	
	public function save(Request $request)
	{
			        		
			$name =  $request->get('name');
			$email =  $request->get('email');
			$password =  bcrypt($request->get('password'));
			$address   = $request->get('address');
			$phone   = $request->get('phone');
			$trip_agent =  $request->get('trip_agent');
			$status =  $request->get('status');
			$bname = $request->get('bankname');
			$baccno = $request->get('baccno');
			$bcode = $request->get('bankcode');
			
		$this->validate($request, ['email' => 'required|email','password'=> 'required','phone'=>'required|numeric']);
		
		\DB::table('users')->insert(['name' => $name, 
			'email' => $email,
			'password' => $password,
			'address' => $address,
			'contact_number' => $phone,			
			'trip_agent' => $trip_agent,
			'status' => $status,
			'bname' => $bname,
			'baccno' => $baccno,
			'bcode' => $bcode,
			'created_at' =>date("Y-m-d H:i:s"),
			'updated_at' =>date("Y-m-d H:i:s")]);
		
		$subject = "Welcome new Agent ".$name;
	  
		$newuser = '<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			</head>
			<body>
				<strong>Thank You For Registration</strong><br />
				<b> Your Account Will be Activated Soon.</b><br/>
				<hr />
				Name : '.$name.'<br>
				Email : '.$email.'<br>
				Phone : '.$phone.'<br>
				Bank Name : '.$bname.'<br>
				Bank Account : '.$baccno.'<br>
				Bank Code : '.$bcode.'<br>
				<hr />
			</body>
			</html>';
			
			$mg = new Mailgun("key-a886acc552c9ecb8cae8937ff13894ec");
			$domain = "bulkmail.influensell.net";
			$batchMsg = $mg->BatchMessage($domain);
			$batchMsg->setFromAddress("info@tripindia.com", array("first"=>"Trip", "last" => "India"));
			$batchMsg->setSubject($subject);
			$batchMsg->setHtmlBody($newuser);
			$batchMsg->addToRecipient($email, array("first" => "Jalpesh", "last" => "Bhadarka"));
			//$batchMsg->addCcRecipient('ramesh@anibyte.net', array("first" => "Ramesh", "last" => "Anibyte"));
			//$batchMsg->addBccRecipient("prashanth@anibyte.net", array("first"=>"Prashanth", "last" => "Sirsi"));
			//$batchMsg->addBccRecipient("sudhakar@anibyte.net", array("first"=>"Sudhakar", "last" => ""));
			//$batchMsg->addBccRecipient("nikjoshi96@gmail.com", array("first"=>"Nikunj", "last" => "Joshi"));
			$batchMsg->finalize();
			
			
		if(Auth::attempt(['email'=>$request->email,'password'=>$request->password,'status' => 'Active'],false)) {
			return redirect('/dashboard')->with('status', 'Thank You For Registration!');
		
		}
		else{
				return back()->with('success', 'Operator User Registration successfully.');
		}
		
	}
	
	public function travelregister(){
		return view('travelagent-register');
	}
	
	public function traveagentlsave(Request $request)
	{
	        	
				
			$name =  $request->get('name');
			$email =  $request->get('email');
			$password =  bcrypt($request->get('password'));
			$address   = $request->get('address');
			$phone   = $request->get('phone');
			$ticketit_agent =  $request->get('ticketit_agent');
			$status =  $request->get('status');
			$bname = $request->get('bankname');
			$baccno = $request->get('baccno');
			$bcode = $request->get('bankcode');	
			
			
		$this->validate($request, ['email' => 'required|email','password'=> 'required','phone'=>'required|numeric']);
		$id = \DB::table('users')->insertGetId(
			['name' => $name, 
			'email' => $email,
			'password' => $password,
			'address' => $address,
			'contact_number' => $phone,	
			'ticketit_agent' => $ticketit_agent,
			'status' => $status,
			'bname' => $bname,
			'baccno' => $baccno,
			'bcode' => $bcode,
			'created_at' =>date("Y-m-d H:i:s"),
			'updated_at' =>date("Y-m-d H:i:s")]);
			
			//echo $id; exit;
		$destinationPath = '/public/agent_document';
		if($request->file('filename'))
		{
		$files = count($request->file('filename'));
		$i = 1; $filenames = '';
        foreach($request->file('filename') as $media)
        {
           
				if($i == $files) {
				
				$filename = $media->getClientOriginalName();
				$media->move(base_path().$destinationPath, $filename);
				$files .= $filename;
				}
				else {
				$filename = $media->getClientOriginalName();
				$media->move(base_path().$destinationPath, $filename);
				$files .= $filename.",";
				}
            
			$i++;
        }
		\DB::table('users')->where('id', $id)->update(['document' => $files]);
        }
		
		$subject = "Welcome new Travel Agent ".$name;
	  
		$newuser = '<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			</head>
			<body>
				<strong>Thank You For Registration</strong><br />
				<b> Your Account Will be Activated Soon.</b><br/>
				<hr />
				Name : '.$name.'<br>
				Email : '.$email.'<br>
				Phone : '.$phone.'<br>
				Bank Name : '.$bname.'<br>
				Bank Account : '.$baccno.'<br>
				Bank Code : '.$bcode.'<br>
				<hr />
			</body>
			</html>';
			
			$mg = new Mailgun("key-a886acc552c9ecb8cae8937ff13894ec");
			$domain = "bulkmail.influensell.net";
			$batchMsg = $mg->BatchMessage($domain);
			$batchMsg->setFromAddress("info@tripindia.com", array("first"=>"Trip", "last" => "India"));
			$batchMsg->setSubject($subject);
			$batchMsg->setHtmlBody($newuser);
			$batchMsg->addToRecipient($email, array("first" => "Jalpesh", "last" => "Bhadarka"));
			//$batchMsg->addCcRecipient('ramesh@anibyte.net', array("first" => "Ramesh", "last" => "Anibyte"));
			//$batchMsg->addBccRecipient("prashanth@anibyte.net", array("first"=>"Prashanth", "last" => "Sirsi"));
			//$batchMsg->addBccRecipient("sudhakar@anibyte.net", array("first"=>"Sudhakar", "last" => ""));
			//$batchMsg->addBccRecipient("nikjoshi96@gmail.com", array("first"=>"Nikunj", "last" => "Joshi"));
			$batchMsg->finalize();
		
		if(Auth::attempt(['email'=>$request->email,'password'=>$request->password,'status' => 'Active'],false)) {
			return redirect('/dashboard')->with('status', 'Thank You For Registration!');
		
		}else{
				return back()->with('success', 'Travel User Registration successfully.');
		}
		
	}
	
	
	public function hotelregister(){
		return view('hotelagent-register');
	}
	
	public function hotelagentlsave(Request $request)
	{
	        	
				
			$name =  $request->get('name');
			$email =  $request->get('email');
			$password =  bcrypt($request->get('password'));
			$address   = $request->get('address');
			$phone   = $request->get('phone');
			$hotel_agent =  $request->get('hotel_agent');
			$status =  $request->get('status');
			$bname = $request->get('bankname');
			$baccno = $request->get('baccno');
			$bcode = $request->get('bankcode');	
			
			
		$this->validate($request, ['email' => 'required|email','password'=> 'required','phone'=>'required|numeric']);
		
		\DB::table('users')->insert(['name' => $name, 
			'email' => $email,
			'password' => $password,
			'address' => $address,
			'contact_number' => $phone,	
			'hotel_agent' => $hotel_agent,
			'status' => $status,
			'bname' => $bname,
			'baccno' => $baccno,
			'bcode' => $bcode,
			'created_at' =>date("Y-m-d H:i:s"),
			'updated_at' =>date("Y-m-d H:i:s")]);
		
		$subject = "Welcome new Hotel Agent ".$name;
	  
		$newuser = '<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			</head>
			<body>
				<strong>Thank You For Registration</strong><br />
				<b> Your Account Will be Activated Soon.</b><br/>
				<hr />
				Name : '.$name.'<br>
				Email : '.$email.'<br>
				Phone : '.$phone.'<br>
				Bank Name : '.$bname.'<br>
				Bank Account : '.$baccno.'<br>
				Bank Code : '.$bcode.'<br>
				<hr />
			</body>
			</html>';
			
			$mg = new Mailgun("key-a886acc552c9ecb8cae8937ff13894ec");
			$domain = "bulkmail.influensell.net";
			$batchMsg = $mg->BatchMessage($domain);
			$batchMsg->setFromAddress("info@tripindia.com", array("first"=>"Trip", "last" => "India"));
			$batchMsg->setSubject($subject);
			$batchMsg->setHtmlBody($newuser);
			$batchMsg->addToRecipient($email, array("first" => "Jalpesh", "last" => "Bhadarka"));
			//$batchMsg->addCcRecipient('ramesh@anibyte.net', array("first" => "Ramesh", "last" => "Anibyte"));
			//$batchMsg->addBccRecipient("prashanth@anibyte.net", array("first"=>"Prashanth", "last" => "Sirsi"));
			//$batchMsg->addBccRecipient("sudhakar@anibyte.net", array("first"=>"Sudhakar", "last" => ""));
			//$batchMsg->addBccRecipient("nikjoshi96@gmail.com", array("first"=>"Nikunj", "last" => "Joshi"));
			$batchMsg->finalize();
		
		if(Auth::attempt(['email'=>$request->email,'password'=>$request->password,'status' => 'Active'],false)) {
			return redirect('/dashboard')->with('status', 'Thank You For Registration!');
		
		}else{
				return back()->with('success', 'Hotel User Registration successfully.');
		}
		
	}
	
	
	
	
}