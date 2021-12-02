<?php

namespace App\Http\Controllers;

use App\User;
use App\Follow;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    // フォロー一覧
    public function index(User $user)
    {
        $follow_users = $user->follow_users;
        return view('follows.index', [
          'title' => 'フォロー一覧',
          'follow_users' => $follow_users,
          'user' => $user,
        ]);
    }
    // フォロワー一覧
    public function followerIndex(User $user)
    {
        $followers = $user->followers;
        return view('follows.follower', [
          'title' => 'フォロワー一覧',
          'followers' => $followers,
          'user' => $user,
        ]);
    }

    public function store(Request $request)
    {
        $user = \Auth::user();
        Follow::create([
           'user_id' => $user->id,
           'follow_id' => $request->follow_id,
        ]);
        \Session::flash('success', 'フォローしました');
        return redirect()->route('posts.index');
    }
 
    public function destroy($id)
    {
        $follow = \Auth::user()->follows->where('follow_id', $id)->first();
        $follow->delete();
        \Session::flash('success', 'フォロー解除しました');
        return redirect()->route('posts.index');
    }
}
