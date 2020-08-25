<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Mailgun\Mailgun;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
		
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
			'status' => $data['status'],
        ]);
		
			  
	  $subject = "Welcome new User ".$data['name'];
	  
	  $newuser = '<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			</head>
			<body>
				<strong>New User Registration</strong><br />
				<hr />
				Name : '.$data['name'].'<br>
				Email : '.$data['email'].'<br>
				<hr />
			</body>
			</html>';
			
			$mg = new Mailgun("key-a886acc552c9ecb8cae8937ff13894ec");
			$domain = "bulkmail.influensell.net";
			$batchMsg = $mg->BatchMessage($domain);
			$batchMsg->setFromAddress("info@tripindia.com", array("first"=>"Trip", "last" => "India"));
			$batchMsg->setSubject($subject);
			$batchMsg->setHtmlBody($newuser);
			$batchMsg->addToRecipient('nikunj@anibyte.net', array("first" => "Nikunj", "last" => "Anibyte"));
			$batchMsg->addCcRecipient('ramesh@anibyte.net', array("first" => "Ramesh", "last" => "Anibyte"));
			//$batchMsg->addBccRecipient("prashanth@anibyte.net", array("first"=>"Prashanth", "last" => "Sirsi"));
			//$batchMsg->addBccRecipient("sudhakar@anibyte.net", array("first"=>"Sudhakar", "last" => ""));
			$batchMsg->addBccRecipient("nikjoshi96@gmail.com", array("first"=>"Nikunj", "last" => "Joshi"));
			$batchMsg->finalize();
	  
    }
}
