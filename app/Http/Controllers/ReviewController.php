<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Review;
use App\User;

use Auth;
use DB;
use Mailgun\Mailgun;

class ReviewController extends Controller
{
	// FOR MY REVIEWS
	public function myreviews()
	{
		$review = new Review();
		$user_id = Auth::user()->id;
		$reviews = $review->myreviews($user_id);
		return view('review.myreviews',array('reviews'=>$reviews));
	}
	
	// FOR LIST OF REVIEWS
	public function review_list()
	{
		$review = new Review();
		//$reviews = $review->review_list();
		$reviews = \DB::table('review')->where('is_approve',1)->orderBy('id','desc')->take(9)->get();
		return view('pages.review',array('reviews'=>$reviews));
	}
	// FOR LIST OF All Reviews
	public function review_alllist()
	{
		$review = new Review();
		//$reviews = $review->review_list();
		$reviews = \DB::table('review')->where('is_approve',1)->orderBy('id','desc')->get();
		return view('pages.reviewall',array('reviews'=>$reviews));
	}
	
	// FOR ADD NEW TESTIMONIAL
	public function review_add()
	{
		if (Auth::check())
		{
			return view('review.review_add');
		}
		else {
			return redirect('/login');
		}
	}
	
	// FOR SAVE NEW TESTIMONIAL
	public function review_save(Request $request)
	{
		if (Auth::check())
		{
			$destinationPath = '/public/reviews';
			
			$review = new Review();
			
			//$tour_id = trim($request->get('tour_id'));
			//$tour_id = 1;
			$user_id = Auth::user()->id;
			
			$user = new User();
			$user_info = $user->getUserinfo($user_id);
			
			$id = \DB::table('review')->insertGetId(
				[ 
				'client_name' => trim($user_info[0]->name),
				'client_post' => trim($request->get('txt_post')),
				'client_rating' => trim($request->get('txt_rating')),
				'comments' => trim($request->get('txt_comment')),
				'client_id' => Auth::user()->id
				]
			);
			// if($request->file('mainimg'))
			// {
			// 	$imageName = $id . '.' . $request->file('mainimg')->getClientOriginalExtension();
			
			// 	$request->file('mainimg')->move(base_path() . $destinationPath, $imageName);
		
			// 	\DB::table('review')->where('id', $id)->update(['client_image' => $imageName]);
			// }
			
			$subject = "Thank you for your review ";
	  
	  $review_html = '<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			</head>
			<body>
				<strong>Thank you for your review</strong><br />
				<hr />
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
			return redirect('/review-add')->with('status', 'Review comment added successfully!');
		}
		else {
		
		}
	}
}
