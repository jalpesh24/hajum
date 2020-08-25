<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Mailgun\Mailgun;

class ContactsController extends Controller
{
	public function index(Request $request)
	{
		if($request->get("name")) {
			$name = trim($request->get("name"));
		}
		else {
			$name = trim($request->get("txt_contact_name"));
		}
		if($request->get("email")) {
			$email = trim($request->get("email"));
		}
		else {
			$email = trim($request->get("txt_contact_email"));
		}
		if($request->get("phone")) {
			$phone = trim($request->get("phone"));
		}
		else {
			$phone = trim($request->get("txt_contact_email"));
		}
		
		if($request->get("message")) {
			$message = addslashes(trim($request->get("message")));
		}
		else {
			$message = addslashes(trim($request->get("txt_contact_message")));
		}
		
		if($name != '' && $email != '' && $phone != '' && $message != '')
		{
			\DB::table('contacts')->insert(['contact_name' => $name, 'contact_email'=> $email, 'contact_phone'=> $phone, 'contact_message'=> $message, 'created_at' => date("Y-m-d H:i:s")]);
			
			$path = '/home/forge/Hajum/public/mailtemplate/contactus.html';
			$file = file_get_contents($path, true);
			$file = str_replace("{!! date('d M Y') !!}",date("d M Y"),$file);
			$file = str_replace('$name',$name,$file);
			$file = str_replace('$email',$email,$file);
			$file = str_replace('$phone',$phone,$file);
			$file = str_replace('$message',$message,$file);
			
		
			/*$htmlBody = '<table><tr><th colspan="2" align="center">Trip India Contact</th></tr>
			<tr><td align="right">Name:</td><td> '.$name.'</td></tr>
			<tr><td align="right">Email:</td><td> '.$email.'</td></tr>
			<tr><td align="right">Phone:</td><td> '.$phone.'</td></tr>
			<tr><td align="right">Message:</td><td> '.$message.'</td></tr>
			</table>';*/
		
		
			$mg = new Mailgun("key-a886acc552c9ecb8cae8937ff13894ec");
			$domain = "bulkmail.influensell.net";
			$batchMsg = $mg->BatchMessage($domain);
			$batchMsg->setFromAddress("prashanthsirsi@gmail.com", array("first"=>"Trip", "last" => "India"));
			$batchMsg->setSubject("Thank you for contacting us on Trip India");
			$batchMsg->setHtmlBody($file);
			$batchMsg->addToRecipient('jalpesh@anibyte.net', array("first" => "Jalpesh", "last" => "Anibyte"));
			//$batchMsg->addToRecipient('prashanth@anibyte.net', array("first" => "Prashanth", "last" => "Sirsi"));
			//$batchMsg->addToRecipient('sudhakar@anibyte.net', array("first" => "Sudhakar", "last" => ""));
			//$batchMsg->addCcRecipient('nikunj@anibyte.net', array("first" => "Nikunj", "last" => "Anibyte"));
			$batchMsg->addBccRecipient('bhadarka.jalpesh@gmail.com', array("first" => "jalpesh", "last" => "bhadarka"));
		
			$batchMsg->finalize();
			echo "Message sent successfully"; exit();
		}
		else {
			echo "Please enter required fields"; exit();
		}
	}
}
