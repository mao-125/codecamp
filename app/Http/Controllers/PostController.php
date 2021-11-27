<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    } 
    
    public function index()
    {
        $user = \Auth::user();
        $posts = $user->posts()->latest()->get();
        return view('posts.index', [
          'title' => '投稿一覧',
          'posts' => $posts,
          ]);
    }

    public function create()
    {
        return view('posts.create', [
          'title' => '新規投稿',
        ]);
    }

    public function store(PostRequest $request)
    {
         Post::create([
          'user_id' => \Auth::user()->id,
          'comment' => $request->comment,
        ]);
        \Session::flash('success', '投稿しました');
        return redirect('/posts');
    }

    public function edit(Post $post)
    {
        return view('posts.edit', [
          'title' => '投稿編集',
          'post' => $post,
          
        ]);
    }

    public function update(PostRequest $request, $id)
    {
        $post = Post::find($id);
        $post->update($request->only(['comment']));
        \Session::flash('success', '投稿を編集しました');
        return redirect()->route('posts.index');
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        \Session::flash('success', '投稿を削除しました');
        return redirect()->route('posts.index');
    }
}
