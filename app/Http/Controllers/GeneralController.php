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
	//
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

		return redirect()->route('post', $id)->with('message', 'Inquiry Message Sent to Owner!');


	}
}
