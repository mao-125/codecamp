<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use App\Follow;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\UserImageRequest;
use App\Services\FileUploadService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function show(User $user)
    {
        $posts = $user->posts()->latest()->paginate(5);;
        
        return view('users.index', [
          'title' => 'プロフィール',
          'users' => $user,
          'posts' => $posts,
          ]);
    }
    public function edit()
    {
        $user = \Auth::user();
        return view('users.edit', [
          'title' => 'プロフィール編集',
          'users' => $user,
        ]);
    }
    public function update(ProfileRequest $request)
    {
       $user = \Auth::user();
        $user->update($request->only(['name','profile']));
        session()->flash('success', 'プロフィールを編集しました');
        return redirect()->route('users.show', $user);

    }
    public function editImage()
      {
        $user = \Auth::user();
        return view('users.edit_image', [
          'title' => '画像変更画面',
          'users' => $user,
        ]);
      }
      public function updateImage(UserImageRequest $request, FileUploadService $service)
      {  
        $user = \Auth::user();
        $path = $service->saveImage($request->file('image'));
        
        if($user->image !== ''){
          \Storage::disk('public')->delete(\Storage::url($user->image));
        }
        $user->update([
          'image' => $icon, 
        ]);
        session()->flash('success', '画像を変更しました');
        return redirect()->route('users.show', $user);
      }
}
