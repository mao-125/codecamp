@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
<div class="main container">
  <h1>{{ $title }}</h1>     
  
    <div class="user_main">
        <h2>{{ $users->name }}</h2>
        
        @if($users->image !== '')
            <img src="{{ \Storage::url($users->image) }}">
        @else
            <img src="{{ asset('images/no_image.png') }}">
        @endif
  
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
    </div>        
  
    <div class="profile">
　      {!! nl2br(e($users->profile)) !!}<br>
　      @if(Auth::user() == $users)
　         <a href="{{ route('users.edit',$users) }}" class="link">[プロフィール編集]</a>
　         <a href="{{ route('users.edit_image', $users) }}" class="link">[画像変更]</a>
　      @else
　      @endif
　  </div>
    
    <ul class="user_menu flex">　
        <li><a href="{{ route('follows.index', $users) }}" class="btn_underline">フォロー</a></li>
        <li><a href="{{ route('follows.follower', $users) }}" class="btn_underline">フォロワー</a></li>
        <li><a href="{{ route('users.recommend', $users) }}" class="btn_underline">おすすめユーザー</a></li>
        <li><a href="{{ route('likes.index') }}" class="btn_underline">いいね一覧</a></li>
    </ul>
    

    <ul class="posts">
      @forelse($posts as $post)
        <li class="post">
            <div class="post_body">
                <div class="post_heading">
                  投稿者:{{ $post->user->name }}
                  ({{ $post->created_at }})
                </div>
                
            <div class="post_main">
                <div class="post_main_image">
                    @if($post->image !== '')
                        <img src="{{ \Storage::url($post->image) }}">
                    @else
                        <img src="{{ asset('images/no_image.png') }}">
                    @endif
                </div>  
                <div class="post_main_comment">
                    {!! nl2br(e($post->comment)) !!}
                </div>
            </div>    
        </li>
      @empty
        <li>投稿はありません。</li>
      @endforelse
    </ul> 
</div>    
@endsection        