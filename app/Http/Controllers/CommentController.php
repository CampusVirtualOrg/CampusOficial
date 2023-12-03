<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

	public function store(Request $request)
	{
		try {
			$credentials = $request->only('post','comment');
			$user = Auth::user();
			$user = $user['id'];
			$post = $credentials['post'];
			$msg = $credentials['comment'];
			dump($post,$user,$msg);


			$comment = new Comment([
				'comment' => $msg,
				'user_id' => $user,
				'post_id' => $post,
			]);
			$comment->save();

			return redirect('/aviso');


		} catch (\Throwable $th) {
			echo throw $th;
		}
	}

	public function destroy(comment $comment)
	{
		//
	}
}
