<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Testimonial;
use App\User;

use Auth;
use DB;
use Mailgun\Mailgun;

class TestimonialController extends Controller
{
	// FOR MY TESTIMONIALS
	public function mytestimonials()
	{
		$testimonial = new Testimonial();
		$user_id = Auth::user()->id;
		$testimonials = $testimonial->mytestimonials($user_id);
		return view('testimonial.mytestimonials',array('testimonials'=>$testimonials));
	}
	
	// FOR LIST OF TESTIMONIALS
	public function testimonial_list()
	{
		$testimonial = new Testimonial();
		$testimonials = $testimonial->testimonial_list();
		return view('pages.testimonial',array('testimonials'=>$testimonials));
	}
	
	// FOR ADD NEW TESTIMONIAL
	public function testimonial_add()
	{
		if (Auth::check())
		{
			return view('testimonial.testimonial_add');
		}
		else {
			return redirect('/login');
		}
	}
	
	// FOR SAVE NEW TESTIMONIAL
	public function testimonial_save(Request $request)
	{
		if (Auth::check())
		{
			$destinationPath = '/public/testimonials';
			
			$testimonial = new Testimonial();
			
			//$tour_id = trim($request->get('tour_id'));
			$tour_id = 1;
			$user_id = Auth::user()->id;
			
			$user = new User();
			$user_info = $user->getUserinfo($user_id);
			
			$id = \DB::table('testimonial')->insertGetId(
				['tour_id' => $tour_id, 
				'client_name' => trim($user_info[0]->name),
				'client_post' => trim($request->get('txt_post')),
				'client_rating' => trim($request->get('txt_rating')),
				'comments' => trim($request->get('txt_comment')),
				'client_id' => Auth::user()->id
				]
			);
			if($request->file('mainimg'))
			{
				$imageName = $id . '.' . $request->file('mainimg')->getClientOriginalExtension();
			
				$request->file('mainimg')->move(base_path() . $destinationPath, $imageName);
		
				\DB::table('testimonial')->where('id', $id)->update(['client_image' => $imageName]);
			}
			
			$subject = "Thank you for your review ";
	  
	  $review_html = '<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			</head>
			<body>
				<strong>Thank you for your review</strong><br />
				<hr />
				Tour ID : '.$tour_id.'<br>
				Client ID : '.Auth::user()->id.'<br>
				Name : '.trim($user_info[0]->name).'<br>
				Post : '.trim($request->get('txt_post')).'<br>
				Rating : '.trim($request->get('txt_rating')).'<br>
				Comment : '.trim($request->get('txt_comment')).'<br>
				<hr />
			</body>
			</html>';
			
			$mg = new Mailgun("key-a886acc552c9ecb8cae8937ff13894ec");
			$domain = "bulkmail.influensell.net";
			$batchMsg = $mg->BatchMessage($domain);
			$batchMsg->setFromAddress("info@tripindia.com", array("first"=>"Trip", "last" => "India"));
			$batchMsg->setSubject($subject);
			$batchMsg->setHtmlBody($review_html);
			$batchMsg->addToRecipient('nikunj@anibyte.net', array("first" => "Nikunj", "last" => "Anibyte"));
			$batchMsg->addCcRecipient('ramesh@anibyte.net', array("first" => "Ramesh", "last" => "Anibyte"));
			//$batchMsg->addBccRecipient("prashanth@anibyte.net", array("first"=>"Prashanth", "last" => "Sirsi"));
			//$batchMsg->addBccRecipient("sudhakar@anibyte.net", array("first"=>"Sudhakar", "last" => ""));
			$batchMsg->addBccRecipient("nikjoshi96@gmail.com", array("first"=>"Nikunj", "last" => "Joshi"));
			$batchMsg->finalize();
			return redirect('/testimonial-add')->with('status', 'Testimonial comment added successfully!');
		}
		else {
		
		}
	}
}
