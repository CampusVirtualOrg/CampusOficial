<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $post = Post::all();
        $user = Auth::user();
        return Inertia::render('AvisoAluno' , ['post' => $post, 'user' => $user]);
    }
	public function showOne(String $id)
    {

		$comments = Comment::where('post_id',$id)->get();
		$user_id = $comments[0]["user_id"];
		$user = User::where("id",$user_id);
        $post = Post::where('id',$id)->get();
        return Inertia::render('AvisoAlunoOne' , ['post' => $post , 'comments' => $comments , 'user' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
		return Inertia::render('CreatePost');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $credentials = $request->only('titulo','subtitulo','descr','url');
		$post = new Post([
			'titulo' => $credentials['titulo'],
			'subtitulo' => $credentials['subtitulo'],
			'descr' => $credentials['descr'],
			'url' => $credentials['url'],
		]);
		$post->save();

		//RETORNA A RESPOSTA
		return redirect('/aviso');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
		$post = Post::where('id',$id)->get();
		$user = Auth::user();
        return Inertia::render('CreatePostEdit' , ['post' => $post , 'ident' => $id, 'user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

		try {
			$credentials = $request->only('titulo','subtitulo','descr','url');
			if (Post::where('id', $id)->exists()) {
				$Post = [
					'titulo' => $credentials['titulo'],
					'subtitulo' => $credentials['subtitulo'],
					'descr' => $credentials['descr'],
					'url' => $credentials['url'],
				];

				Post::where('id', $id)->update($Post);
				return redirect('/aviso');
			} else {
				return response()->json([
					"success" => false
				], 404);
			}
		} catch (\Throwable $e) {
			return response()->json([
				"success" => false,
				"error" => $e->getMessage()
			], 400);
		}
    }

    /**
     * Remove the specified resource from storage.
     */
	public function remove(string $id)
    {
        //VERIFICA SE ID EXISTE
        $post = Post::all()->where('id', $id)->first();
        if (!$post) {
            return response([
                'msg' => 'Post não removido',
                'data' => $post
            ]);
        }
        //REMOVE User
        $post->delete();
        return redirect('/aviso');
    }
}
