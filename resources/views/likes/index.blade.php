@extends('layouts.logged_in')
 
@section('content')
  <h1>{{ $title }}</h1>
 
  <ul class="posts">
      @forelse($like_posts as $post)
          <li class="post like_post">
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
          <li>いいねした投稿はありません。</li>
      @endforelse
  </ul>
@endsection