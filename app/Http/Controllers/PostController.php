<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Follow;
use App\Like;
use App\Http\Requests\PostRequest;
use App\Http\Requests\PostImageRequest;
use App\Services\FileUploadService;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    } 
    
    public function index(Request $request)
    {
        $user = \Auth::user();
        $follow_user_ids = $user->follow_users->pluck('id');
        $user_posts = $user->posts()->orWhereIn('user_id', $follow_user_ids)->latest()->get();
        $keyword = $request->input('keyword');
        
        return view('posts.index', [
          'title' => '投稿一覧',
          'user_posts' => $user_posts,
          'keyword' => $keyword,
        ]);
    }

    public function create()
    {
        return view('posts.create', [
          'title' => '新規投稿',
        ]);
    }

    public function store(PostRequest $request, FileUploadService $service)
    {
        $path = $service->saveImage($request->file('image'));
        
         Post::create([
          'user_id' => \Auth::user()->id,
          'comment' => $request->comment,
          'image' => $path,
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
    
    public function editImage($id)
    {
        $post = Post::find($id);
        return view('posts.edit_image', [
          'title' => '画像変更画面',
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
    
    public function updateImage($id, PostImageRequest $request, FileUploadService $service)
      {
        $post = Post::find($id);
        $path = $service->saveImage($request->file('image'));
        
        if($post->image !== ''){
         \Storage::disk('public')->delete('photos/' . $post->image);
        }
        $post->update([
          'image' => $path, 
        ]);
        \Session::flash('success', '投稿を編集しました');
        return redirect()->route('posts.index');
      }

    public function destroy($id)
    {
        $post = Post::find($id);
        
        if($post->image !== ''){
          \Storage::disk('public')->delete($post->image);
        }
        $post->delete();
        \Session::flash('success', '投稿を削除しました');
        return redirect()->route('posts.index');
    }
    
    public function toggleLike($id)
    {
        $user = \Auth::user();
        $post = Post::find($id);
 
        if($post->isLikedBy($user)){
          $post->likes->where('user_id', $user->id)->first()->delete();
          \Session::flash('success', 'いいねを取り消しました');
        } else {
          Like::create([
            'user_id' => $user->id,
            'post_id' => $post->id,
          ]);
          \Session::flash('success', 'いいねしました');
          }
        return redirect()->route('posts.index');
    }
    
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $query = Post::query();
        if (!empty($keyword)) {
            $query->where('comment', 'LIKE', "%{$keyword}%");
        }
        $search_posts = $query->get();
        
          return view('posts.search',[
            'title' => '検索結果',
            'search_posts' => $search_posts,
            ]);
    }
}
