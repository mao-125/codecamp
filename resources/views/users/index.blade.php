@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <h1>{{ $title }}</h1>
  
 （アイコン）ユーザー名：{{ $users->name }}<br>
 
 @if(Auth::user() == $users)
 
 @elseif(Auth::user()->isFollowing($users))
         <form method="post" action="{{route('follows.destroy', $users) }}" class="follow">
           @csrf
           @method('delete')
           <input type="submit" value="フォロー解除">
         </form>
        @else
         <form method="post" action="{{ route('follows.store') }}" class="follow">
           @csrf
           <input type="hidden" name="follow_id" value="{{ $users->id }}">
           <input type="submit" value="フォロー">
         </form>
        @endif 
  
 [<a href="{{ route('follows.index', $users) }}">フォロー</a>]
 [<a href="{{ route('follows.follower', $users) }}">フォロワー</a>]
 <br>
　（プロフィール文）<br>
　<a href="{{ route('likes.index') }}">いいね一覧</a><br>
　
  <ul class="posts">
      @forelse($posts as $post)
          <li class="post">
              <div class="post_body">
                <div class="post_body_heading">
                  投稿者:{{ $post->user->name }}
                  ({{ $post->created_at }})
                </div>
                
                <div class="post_body_main">
                  <div class="post_body_main_img">
                    @if($post->image !== '')
                        <img src="{{ \Storage::url($post->image) }}">
                    @else
                        <img src="{{ asset('images/no_image.png') }}">
                    @endif
                　</div>
                　<div class="post_body_main_comment">
                    {!! nl2br(e($post->comment)) !!}
                  </div>  
                </div>
              </div>    
          </li>
      @empty
          <li>投稿はありません。</li>
      @endforelse
  </ul>        
@endsection        