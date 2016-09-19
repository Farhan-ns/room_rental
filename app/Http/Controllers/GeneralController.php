<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Auth;

use App\Post;

use App\User;

use Illuminate\Support\Facades\Mail;

use App\MessageLog;

use App\Message;

use App\UserLog;


class GeneralController extends Controller
{

	// this method is use to delete sent items messages
	public function deleteSentMsg(Request $request)
	{
		$id = $request['msg_id'];

		$msg = MessageLog::find($id);

		$msg->delete();

		$msg_log = new UserLog();

		$msg_log->action = 'Delete Message in Sent Items';
		$msg_log->user_id = Auth::user()->id;

		$msg_log->save();

		return redirect()->route('sent_msg')->with('message', 'Successfully Deleted!');
	}

	// This method is use to view sent message
	public function viewSentMessage(Request $request)
	{
		$id = $request['msg_id'];

		$message = MessageLog::find($id);

		return view('pages.client.read_sent', ['message' => $message]);
	}

	// This method is use to view sent message of the user
	public function sentMessage()
	{
		$sent_msg = MessageLog::where('inquirer', '=', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(15);

		return view('pages.client.sent', ['messages' => $sent_msg]);
	}


	// This method is use to delete message
	public function msgDelete(Request $request)
	{
		$msg_id = $request['msg_id'];

		$msg = Message::find($msg_id);

		$msg->delete();


		$msg_log = new UserLog();

		$msg_log->action = 'Delete Message in Inbox';
		$msg_log->user_id = Auth::user()->id;

		$msg_log->save();

		return redirect()->route('inbox')->with('message', 'Message Deleted!');
	}


	// This method is use to read inbox messages
	public function readInboxMsg(Request $request)
	{
		$msg_id = $request['msg_id'];

		$msg = Message::find($msg_id);

		$msg->status = 'Read';

		$msg->save();

		return view('pages.client.read_msg', ['message' => $msg]);

	}


	// This method is used to go to user's inbox
	public function inbox()
	{
		$messages = Message::where('recipient', Auth::user()->id)->orderBy('created_at','desc')->paginate(15);

		return view('pages.client.inbox', ['messages' => $messages]);
	}


	// This method is used to send notifcation/inquiry to the owner of the posts via email and sms
	public function sendMsgToOwner(Request $request)
	{
		$this->validate($request,[
			'message' => 'required'
			]);

		$id = $request['id'];
		$post_id = $request['post_id'];
		$message = $request['message'];

		$post = Post::find($post_id);

		$user = User::find($id);

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
		$api_user = "APIJFV7PWCYXD"; // This is the api username of onewaysms.ph
		$api_pass = "APIJFV7PWCYXDJFV7P"; // This is the api password of onewaysms.ph
		$recipient = $user->mobile;
		$sms_msg = $message;  // customize your message here

		// $this->sendSMS($api_user, $api_pass, "M&R Rentals", $recipient, $sms_msg);

		// Save Message Log to database
		// new message log instance
		$msg_log = new MessageLog();

		$msg_log->post_id = $post->id;
		$msg_log->inquirer = Auth::user()->id;
		$msg_log->email = $user->email;
		$msg_log->mobile = $user->mobile;
		$msg_log->message = $message;

		$msg_log->save();


		// Message Part
		$user_message = new Message();

		$user_message->sender = Auth::user()->id;
		$user_message->post_id = $post->id;
		$user_message->recipient = $user->id;
		$user_message->message = $message;

		$user_message->save();


		// user log, sending inquiry message
		// new instance of user log
		$user_log = new UserLog();

		$user_log->action = 'Send inquiry message to post owner. (Email/SMS)';
		$user_log->user_id = Auth::user()->id;

		$user_log->save();

		return redirect()->route('post', $post->id)->with('message', 'Inquiry Message Sent to Owner!');


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
