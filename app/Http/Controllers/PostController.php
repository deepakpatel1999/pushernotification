<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Events\PostCreated;
use Illuminate\Http\Request;

class PostController extends Controller
{

  public function index()
  {

    return view('post.create');
  }

  public function createPost(Request $request)
  {

    $post = new Post;
    $post->title = $request->title;
    $post->user_id = $request->user_id; 
    $post->save();

    event(new PostCreated($post));

    // return redirect()->back();
    return json_encode(array(
      "statusCode" => 200
    ));
    // return response()->json([
    //   'message' => 'New post created'
    // ]);
  }
}
