<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Post;

use DB;

use Illuminate\Support\Facades\Auth;

use Image;

use App\PostImage;

use App\UserLog;

use App\User;


class PostController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Method use to show link in search result on guest
    |--------------------------------------------------------------------------
    */
    public function showGuestResult($id)
    {
        $post = DB::table('posts')->where('id', $id)
                                ->where('status', 'Active')
                                ->first();

        $data['title'] = $post->title;
        $data['price'] = $post->price;
        $data['description'] = $post->description;
        $data['location'] = $post->location;
        $data['type'] = $post->type;
        $data['user_id'] = $post->user_id;
        $data['image_id'] = $post->image_id;

        return view('pages.post', $data);
    }

    /*
    |--------------------------------------------------------------------------
    | Method use to show active posts in admin
    |--------------------------------------------------------------------------
    */
    public function showActivePosts()
    {
        $posts = DB::table('posts')->where('status', 'Active')->orderby('updated_at','desc')->paginate(4);

        return view('pages.admin.active_posts', ['posts' => $posts]);
    }

    /*
    |--------------------------------------------------------------------------
    | This method is delete pending posts by admin
    |--------------------------------------------------------------------------
    */
    public function deletePendingPost($id)
    {
        $delete = DB::table('posts')->delete($id);

        if($delete) {

            $user_log = new UserLog();

            $user_log->action = 'Delete Pending Post.';
            $user_log->user_id = Auth::user()->id;

            $user_log->save();

            return redirect()->route('pending-posts')->with('message', 'Post Successfully Deleted!');
        }

        return redirect()->route('pending-posts')->with('error_msg', 'Can\'t Delete Post!');
    }

    /*
    |--------------------------------------------------------------------------
    | This method is use to aprove pending posts by admin
    |--------------------------------------------------------------------------
    */
    public function aprovePendingPost($id)
    {
        $post = \App\Post::find($id);

        $post->status = 'Active';

        if($post->save()) {

            $user_log = new UserLog();

            $user_log->action = 'Approve a post.';
            $user_log->user_id = Auth::user()->id;

            $user_log->save();
            
            return redirect()->route('pending-posts')->with('message','Post is Active Now!');
        }
        else {
            return redirect()->route('pending-posts')->with('error_msg','Error!');
        }
    }

    /*
    |--------------------------------------------------------------------------
    | This method methods is by admin to show pending posts
    |--------------------------------------------------------------------------
    */
    public function showPendingPosts()
    {
        $result = DB::table('posts')->where('status','Inactive')
                                    ->paginate(4);

        return view('pages.admin.pending_posts',['posts' => $result]);
    }

    /*
    |--------------------------------------------------------------------------
    | This method methods is used by guest users to search for rooms
    |--------------------------------------------------------------------------
    */
    public function guestSearch(Request $request)
    {
        $this->validate($request,[
            'keyword' => 'required| min:2'
            ]);

        

        $keyword = $request['keyword'];

        $posts = DB::table('posts')->where('status', '=', "Active")
                                    ->where('location', 'like', "%$keyword%")
                                    ->orwhere('type', 'like', "%$keyword%")
                                    ->orwhere('title', 'like', "%$keyword%")
                                    ->orwhere('price', 'like', "%$keyword%")
                                    ->orwhere('description', 'like', "%$keyword")
                                    ->orderby('updated_at', 'desc')
                                    ->paginate(2);

        return view('pages.results', ['posts' => $posts]);
    }

    /*
    |--------------------------------------------------------------------------
    | This method to search by loggedin users
    |--------------------------------------------------------------------------
    */
    public function searchResult(Request $request)
    {
        $this->validate($request, [
            'type' => 'required',
            'max_price' => 'required',
            'location' => 'required'
            ]);

        $type = $request['type'];
        $max_price = $request['max_price'];
        $location = $request['location'];

        $results = DB::table('posts')->where('type', $type)
                                    ->where('status', 'Active')
                                    ->where('price', '<=',  $max_price)
                                    ->where('location', 'like', "%$location%")
                                    ->orderby('updated_at','desc')
                                    ->paginate(2);

        return view('pages.client.result', ['posts' => $results]);

    }

    /*
    |--------------------------------------------------------------------------
    | This method is use to delete multiple selected posts ids
    |--------------------------------------------------------------------------
    */
    public function postDeleteMultiplePost(Request $request)
    {
        $ids = $request->input('postid');

        if(DB::table('posts')->whereIn('id',$ids)->delete()) {

            $user_log = new UserLog();

            $user_log->action = 'Delete posts.';
            $user_log->user_id = Auth::user()->id;

            $user_log->save();

            return redirect()->route('showposttodelete')->with('message', 'Posts Successfully Delete!');
        }

        return redirect()->route('showposttodelete')->with('error_msg', 'Error Occured. Please Try again later.');
    }

    /*
    |--------------------------------------------------------------------------
    | This method is use to show multiple post to delete
    |--------------------------------------------------------------------------
    */
    public function showPostToDelete()
    {
        $posts = DB::table('posts')->select()->get();

        return view('pages.client.showdelete',['posts' => $posts]);
    }

    /*
    |--------------------------------------------------------------------------
    | This method is use to update the editted content of a post
    |--------------------------------------------------------------------------
    */
    public function postUpdatePost(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:6|max:150',
            'price' => 'required',
            'description' => 'required|min:25',
            'location' => 'required'
            // upload multiple images for the room/appartment
            ]); 
            
        $id = $request['post_id'];
        $title = $request['title'];
        $price = $request['price'];
        $description = $request['description'];
        $location = $request['location'];

        $post = \App\Post::find($id);

        $post->title = $title;
        $post->price = $price;
        $post->description = $description;
        $post->location = $location;

        if($post->save()) {

            $user_log = new UserLog();

            $user_log->action = 'Updated post.';
            $user_log->user_id = Auth::user()->id;

            $user_log->save();

            return redirect()->route('myposts')->with('message', 'Successfully Updated!');

        }

        return redirect()->route('myposts')->with('error_msg', 'Error Occured. Please try again later.');
    }


    /*
    |--------------------------------------------------------------------------
    | This method is use to edit post of the client/user
    |--------------------------------------------------------------------------
    */
    public function editPost($id)
    {
        $post = DB::table('posts')->where('id', $id)->first();

        if(!empty($post)) {
            $post_data['id'] = $post->id;
            $post_data['title'] = $post->title;
            $post_data['price'] = $post->price;
            $post_data['description'] = $post->description;
            $post_data['location'] = $post->location;

            return view('pages.client.postformedit', $post_data);
        }
        return redirect()->route('mypost')->with('error_msg', 'Error Occured. Please Try again later.');
    }

    /*
    |--------------------------------------------------------------------------------
    | This method is used by the user to delete single post
    | This is on the route('myposts') by the client
    |--------------------------------------------------------------------------------
    */
    public function deletePost($id)
    {
        $delete = DB::table('posts')->delete($id);

        if($delete) {

            $user_log = new UserLog();

            $user_log->action = 'Deleted a post';
            $user_log->user_id = Auth::user()->id;

            $user_log->save();

            return redirect()->route('myposts')->with('message', 'Post Successfully Deleted!');
        }

        return redirect()->route('myposts')->with('error_msg', 'Can\'t Delete Post!');
    }


    /*
    |--------------------------------------------------------------------------------
    | This is index method used by client to view their posts and the status of their post
    |--------------------------------------------------------------------------------
    */
	public function index()
    {
    	$id = Auth::user()->id;
        $posts = Post::where('user_id', $id)->paginate(4);
        return view('pages.client.posts', ['posts' => $posts]);
    }


    /*
    |--------------------------------------------------------------------------------
    | This methods is use to view the specific post
    |--------------------------------------------------------------------------------
    */
    public function postView($id)
    {
    	$post = Post::find($id);

        $user = User::find($post->user_id);

        return view('pages.client.post', ['post' => $post, 'user' => $user]);

    }


    /*
    |--------------------------------------------------------------------------------
    | This methods is use to browse all the posts in the database to view by the client
    |--------------------------------------------------------------------------------
    */
	public function browsePosts()
    {
        $posts = Post::where('status','Active')
                ->where('user_id', '!=', Auth::user()->id)
                ->orderby('updated_at','desc')
                ->paginate(4);
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
            'type' => 'required',
    		'title' => 'required|min:6|max:150',
    		'price' => 'required',
    		'description' => 'required|min:25',
    		'location' => 'required'
    		// upload multiple images for the room/appartment
    		]);

        $type = $request['type'];
    	$title = $request['title'];
    	$price = $request['price'];
    	$description = $request['description'];
    	$location = $request['location'];
    	$user_id = $request['user_id'];


        $images = $request->file('images');
        // $img = [];

        $post = new Post();

        $post->title = $title;
        $post->price = $price;
        $post->description = $description;
        $post->location = $location;
        $post->user_id = $user_id;
        $post->type = $type;

        $post->save();


        // $i = new PostImage();

        $post_img_insert = array();

        foreach ($images as $image) {
            $img = time() . "__n." . $image->getClientOriginalExtension();
            Image::make($image)->resize(500, 800)->save(public_path('/uploads/posts/' . $img));

            // $i->name = $img;
            // $i->post_id = $post->id;

            // $i->save();

            $post_img_insert[] =  array('name' => $img, 'post_id' => $post->id );

        }

        DB::table('post_images')->insert($post_img_insert);

        $user_log = new UserLog();

        $user_log->action = 'New Post';
        $user_log->user_id = Auth::user()->id;

        $user_log->save();

    	return redirect()->route('addpost')->with('message', 'Post Successfully Saved!');
    }


    public function pendingPosts()
    {
        $posts = Post::where('status', 'Inactive')->orderby('updated_at','desc')->paginate(4);
        return view('pages.admin.pending_posts', ['posts' => $posts]);
    }
}
