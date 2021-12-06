<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function index()
    {
        $like_posts = \Auth::user()->likePosts;
        return view('likes.index', [
          'title' => 'いいね一覧',
          'like_posts' => $like_posts,
        ]);
    }
}
