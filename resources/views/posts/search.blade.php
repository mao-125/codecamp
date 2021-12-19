@extends('layouts.logged_in')
 
@section('content')
<div class="main container">
  <h1>{{ $title }}</h1>
 
  <ul class="posts">
    @forelse($search_posts as $post)
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
                
          <a class="like_button">{{ $post->isLikedBy(Auth::user()) ? '★' : '☆' }}</a>
            <form method="post" class="like" action="{{ route('posts.toggle_like', $post) }}">
              @csrf
              @method('patch')
            </form>
       </div>
      </li>
    @empty
      <li>検索結果はありません。</li>
    @endforelse
  </ul>
</div>  
  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    /* global $ */
    $('.like_button').on('click', (event) => {
        $(event.currentTarget).next().submit();
    })
</script>
@endsection