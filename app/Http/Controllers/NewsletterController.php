<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Mailgun\Mailgun;

class NewsletterController extends Controller
{
	public function index(Request $request)
	{
		$email = trim($request->get("txt_newsletter"));
		\DB::table('newsletter')->insert(['newsletter_email' => $email, 'created_at' => date("Y-m-d H:i:s")]);
		
		$path = '/home/forge/default/public/mailtemplate/newsletter.html';
		$file = file_get_contents($path, true);
		$file = str_replace("{!! date('d M Y') !!}",date("d M Y"),$file);
		
		$mg = new Mailgun("key-a886acc552c9ecb8cae8937ff13894ec");
		$domain = "bulkmail.influensell.net";
		$batchMsg = $mg->BatchMessage($domain);
		$batchMsg->setFromAddress("prashanthsirsi@gmail.com", array("first"=>"Trip", "last" => "India"));
		$batchMsg->setSubject("Thank you for subscribe on Trip India");
		$batchMsg->setHtmlBody($file);
		$batchMsg->addToRecipient($email, array("first" => "", "last" => ""));
		$batchMsg->addCcRecipient('nikunj@anibyte.net', array("first" => "Nikunj", "last" => "Anibyte"));
		$batchMsg->finalize();
		
		return redirect()->back()->with('newsletter', 'Thank you for our newsletter subscription');
	}
}
