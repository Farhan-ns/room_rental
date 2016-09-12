<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Auth;

use App\Post;

use App\User;

use Illuminate\Support\Facades\Mail;


class GeneralController extends Controller
{
	// This method is used to send notifcation/inquiry to the owner of the posts via email and sms
	public function sendMsgToOwner(Request $request)
	{
		$this->validate($request,[
			'message' => 'required'
			]);

		$id = $request['id'];
		$message = $request['message'];

		$post = Post::find($id);

		$user = User::find($post->user->id);

		// info of the user
		$data['user'] = Auth::user()->firstname . ' ' . Auth::user()->lastname;
		$data['email'] = Auth::user()->email;
		$data['mobile'] = Auth::user()->mobile;

		//post info
		$data['post_title'] = $post->title;
		$data['post_type'] = $post->type;
		$data['post_price'] = $post->price;
		$data['post_address'] = $post->location;

		//inquiry message
		$data['msg'] = $request['message'];
		$data['id'] = $id;

		//post owner info
		$owner_email = $user->email;

		// Mail Part
		Mail::send('pages.client.mailformat', $data, function ($message) use ($owner_email) {
	        $message->from('inquiry@rental-domain.cf', 'Inquiry Service');
	        $message->to($owner_email)->subject('Inquiry To Your Post');

    	});

		// SMS Part
		$api_user = "APIVBWZGFYTDN"; // This is the api username of onewaysms.ph
		$api_pass = "APIVBWZGFYTDN914FO"; // This is the api password of onewaysms.ph
		$recipient = $user->mobile;
		$sms_msg = "This is a test from Joshua Paredes sms notifcation";  // customize your message here

		$this->sendSMS($api_user, $api_pass, "M&R Rentals", $recipient, $sms_msg);


		return redirect()->route('post', $id)->with('message', 'Inquiry Message Sent to Owner!');


	}

	// The method to send the sms
	public function sendSMS($user,$pass,$sms_from,$sms_to,$sms_msg)
    {
         
    	$query_string = "api.aspx?apiusername=".$user."&apipassword=".$pass;
        $query_string .= "&senderid=".rawurlencode($sms_from)."&mobileno=".rawurlencode($sms_to);
        $query_string .= "&message=".rawurlencode(stripslashes($sms_msg)) . "&languagetype=1";        
        $url = "http://gateway.onewaysms.com.au:10001/".$query_string;       
        $fd = @implode ('', file ($url));      
        if ($fd) {                       
		    if ($fd > 0) {
				Print("MT ID : " . $fd);
				$ok = "success";
		    }        
		    else {
				print("Please refer to API on Error : " . $fd);
				$ok = "fail";
		    }
        }           
        else      
        {                       
            // no contact with gateway                      
            $ok = "fail";       
        }           
        return $ok;  
	}
}
