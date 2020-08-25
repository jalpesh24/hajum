<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\FeedbackMail;

use App\User;

use Session;
use Auth;
use DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard');
    }

    // FOR USER PROFILE PAGE
    public function userprofile()
    {
        if (Auth::check()) 
        {
            $user_id = Auth::user()->id;
            $user = new User();
            $user_info = $user->getUserinfo($user_id);
            return view('auth.user_profile',array('user_info'=>$user_info));    
        }
        else {
            return redirect('/login');
        }
    }
    
    // FOR USER PROFILE SAVE
    public function userprofilesave(Request $request)
    {
        if (Auth::check()) 
        {
            $user_id = Auth::user()->id;
            $user = new User();
            
            $name = trim($request->user_name);
            $email = trim($request->user_email);
            $contact = addslashes(trim($request->user_contact));
            $address = addslashes(trim($request->user_address));
            
            \DB::table('users')->where('id', $user_id)
            ->update(['name' => $name,'email' => $email,'address' => $address,'contact_number' => $contact]);
            
            return redirect('/user-profile')->with('status', 'Profile updated successfully!');
        }
        else {
            return redirect('/login');
        }
    }
    
    // FOR AGENT USER PROFILE PAGE
    public function agentuserprofile()
    {
        if (Auth::check()) 
        {
            $user_id = Auth::user()->id;
            $user = new User();
            $user_info = $user->getUserinfo($user_id);
            return view('auth.agentuser_profile',array('user_info'=>$user_info));   
        }
        else {
            return redirect('/login');
        }
    }
    
    // FOR AGENT USER PROFILE SAVE
    public function agentuserprofilesave(Request $request)
    {
        if (Auth::check()) 
        {
            $user_id = Auth::user()->id;
            $user = new User();
            
            $name = trim($request->user_name);
            $email = trim($request->user_email);
            $contact = addslashes(trim($request->user_contact));
            $address = addslashes(trim($request->user_address));
            
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
        \DB::table('users')->where('id', $user_id)->update(['document' => $files]);
        }
            
            \DB::table('users')->where('id', $user_id)
            ->update(['name' => $name,'email' => $email,'address' => $address,'contact_number' => $contact]);
            
            return redirect('/agentuser_profile')->with('status', 'Profile updated successfully!');
        }
        else {
            return redirect('/login');
        }
    }
      
    
    public function activeuser(Request $request)
    {
    
        $id = $request->route('uid');
        $userStatus = User::find($id);
            if(isset($userStatus) && !empty($userStatus)) {
                $userNewStatus = ($userStatus->status==='Active') ? 'InActive' : 'Active';
                $userStatus->status =  $userNewStatus;
                    $userStatus->save();
                    DB::commit();
                    return redirect('/users')->with('status', 'users status change successfully!');
                 
           }else {
                    return redirect('/users')->with('error', 'users status not change successfully!');
                }
    }

    public function activeagency(Request $request)
    {
    
        $id = $request->route('uid');
        \DB::table('users')->where('id', $id)
                ->update([
                    'status' => 'Active'                    
                ]);
        return redirect('/agency');
    }
    
    
    
    
    public function activeagent(Request $request)
    {
    
        $id = $request->route('uid');
        \DB::table('users')->where('id', $id)
                ->update([
                    'status' => 'Active'                    
                ]);
        return redirect('/agents');
    }
    
    public function editagent(Request $request)
    {
        
        $id = $request->route('uid');
        $agentsdetail = \DB::table('users')->where('id',$id)->orderBy('id', 'desc')->get()->toArray();
        $agnetscats = \DB::table('category')->orderBy('cid', 'ASC')->get();
            //print_r($agentsdetail);exit;
        return view('admin.editagents',array('agentsdetail'=>$agentsdetail,'agnetscats'=>$agnetscats));
        
    }
    
    public function editagentsave (Request $request)
    {
        
        $id = $request->route('uid');
        $catid = $request->get('catid');
        \DB::table('users')->where('id', $id)
                ->update([
                    'catid' =>$catid                
                ]);
        return redirect('/agents');
    }
    
    public function edittravel(Request $request)
    {
        
        $id = $request->route('uid');
        $traveldetail = \DB::table('users')->where('id',$id)->orderBy('id', 'desc')->get()->toArray();
        $travelcats = \DB::table('category')->orderBy('cid', 'ASC')->get();
            //print_r($agentsdetail);exit;
        return view('admin.edittravelar',array('traveldetail'=>$traveldetail,'travelcats'=>$travelcats));
        
    }
    
    public function edittravelsave (Request $request)
    {       
        $id = $request->route('uid');
        $catid = $request->get('catid');
        \DB::table('users')->where('id', $id)
                ->update([
                    'catid' =>$catid                
                ]);
        return redirect('/travelar');
    }
    
    
    
    
    public function activetravelagent(Request $request)
    {
    
        $id = $request->route('uid');
        \DB::table('users')->where('id', $id)
                ->update([
                    'status' => 'Active'                    
                ]);
        return redirect('/travelar');
    }
    
    public function activehotelagent(Request $request)
    {
    
        $id = $request->route('uid');
        \DB::table('users')->where('id', $id)
                ->update([
                    'status' => 'Active'                    
                ]);
        return redirect('/hotelagent');
    }
    
    
    public function inactiveagent(Request $request)
    {
    
        $id = $request->route('uid');
        \DB::table('users')->where('id', $id)
                ->update([
                    'status' => 'InActive'                  
                ]);
        return redirect('/agents');
    }
    
    public function inactivetravel(Request $request)
    {
    
        $id = $request->route('uid');
        \DB::table('users')->where('id', $id)
                ->update([
                    'status' => 'InActive'                  
                ]);
        return redirect('/travelar');
    }
    
        
    // edit user
    public function editusers(Request $request)
    {
    
        $id = $request->route('uid');
        $userdetail = \DB::table('users')->where('id',$id)->orderBy('id', 'desc')->get()->toArray();
        $userdata = \DB::table('users')->where('id',$id)->orderBy('id', 'desc')->get();
                
        return view('admin.editusers',array('user_detail'=>$userdetail,'user-data'=>$userdata));
    }

    public function sendFeedback()
    {
       $comment = 'Hi, This test feedback.';
       $toEmail = "bhadarka.jalpesh@gmail.com";
       Mail::to($toEmail)->send(new FeedbackMail($comment));
       
       return 'Email has been sent to '. $toEmail;
    }
    
    
}

