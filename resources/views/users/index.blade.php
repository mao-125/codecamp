@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <h1>{{ $title }}</h1>
  
  ユーザー名：{{ $users->name }}
  
  @if(Auth::user()->isFollowing($users))
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
        
  <ul class="posts">
      @forelse($posts as $post)
          <li class="post">
              <div class="post_body">
                <div class="post_body_heading">
                  投稿者:{{ $post->user->name }}
                  ({{ $post->created_at }})
                </div>
                
                <div class="post_body_main">
                    {!! nl2br(e($post->comment)) !!}
                </div>
          </li>
          
      @empty
          <li>投稿はありません。</li>
      @endforelse
  </ul>        
        
@endsection        