<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Post;

use DB;

use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /*
    |--------------------------------------------------------------------------------
    | This is index method used by client to view their posts and the status of their post
    |--------------------------------------------------------------------------------
    */
	public function index()
    {
    	$id = Auth::user()->id;
        $posts = DB::table('posts')->where('user_id', '=', $id)->orderby('updated_at','desc')->paginate(4);
        return view('pages.client.posts', ['posts' => $posts]);
    }


    /*
    |--------------------------------------------------------------------------------
    | This methods is use to view the specific post
    |--------------------------------------------------------------------------------
    */
    public function postView($id)
    {
    	$post = DB::table('posts')->where('id', $id)->first();

    	$data['title'] = $post->title;
    	$data['price'] = $post->price;
    	$data['description'] = $post->description;
    	$data['location'] = $post->location;
    	$data['user_id'] = $post->user_id;

    	$user = DB::table('users')->where('id', $post->user_id)->first();

    	$data['user_fname'] = $user->firstname;
    	$data['user_lname'] = $user->lastname;
    	$data['user_mobile'] = $user->mobile;
    	$data['user_email'] = $user->email;

        return view('pages.client.post', $data);
    }


    /*
    |--------------------------------------------------------------------------------
    | This methods is use to browse all the posts in the database to view by the client
    |--------------------------------------------------------------------------------
    */
	public function browsePosts()
    {
        $posts = DB::table('posts')->orderby('updated_at','desc')->paginate(4);
        return view('pages.client.browse', ['posts' => $posts]);
    }


    /*
    |--------------------------------------------------------------------------------
    | This methods is use to add post by authenticated client/user
    |--------------------------------------------------------------------------------
    */
    public function postAddPost(Request $request)
    {
    	$this->validate($request, [
    		'title' => 'required|min:6|max:150',
    		'price' => 'required',
    		'description' => 'required|min:25',
    		'location' => 'required'
    		// upload multiple images for the room/appartment
    		]);

    	$title = $request['title'];
    	$price = $request['price'];
    	$description = $request['description'];
    	$location = $request['location'];
    	$user_id = $request['user_id'];

    	$post = new Post();

    	$post->title = $title;
    	$post->price = $price;
    	$post->description = $description;
    	$post->location = $location;
    	$post->user_id = $user_id;

    	$post->save();

    	return redirect()->route('addpost')->with('message', 'Post Successfully Saved!');
    }
}
