<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use App\Follow;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(User $user)
    {
        $posts = $user->posts()->latest()->paginate(5);;
        
        return view('users.index', [
          'title' => 'プロフィール',
          'users' => $user,
          'posts' => $posts,
          ]);
    }
}
