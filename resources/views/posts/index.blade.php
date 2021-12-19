@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <div class="main container">
    <h1>{{ $title }}</h1>
  
    <div class="search">
      <form action="{{ route('posts.search') }}" method="GET">
        <input type="search" name="keyword" value="{{$keyword}}" placeholder="キーワード" class="form">
        <input type="submit" value="検索" class="form_btn">
      </form>
    </div>  
  
    <ul class="posts">
      @forelse($user_posts as $post)
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
                　
                <div class="post_comment">
                  <ul>
                    @forelse($post->comments as $comment)
                        <li>{{ $comment->user->name }}: {{ $comment->body }}
                          <form class="delete" method="post" action="{{ route('comments.destroy', $comment) }}">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="削除">
                          </form>
                        </li>
                    @empty
                    @endforelse
                  </ul>
                    
                  <form method="post" action="{{ route('comments.store') }}">
                      @csrf
                      <input type="hidden" name="post_id" value="{{ $post->id }}">
                      <input type="text" name="body"  placeholder="コメント"class="form">
                      <input type="submit" value="送信" class="form_btn">
                  </form>
                </div>  
                
                <div class="post_footer">
                  @if($post->user->id === Auth::user()->id)
                    <a href="{{ route('posts.edit', $post) }}" class="link">[編集]</a>
                    <a href="{{ route('posts.edit_image', $post) }}" class="link">[画像変更]</a>
                    <form class="delete" method="post" action="{{ route('posts.destroy', $post) }}">
                      @csrf
                      @method('DELETE')
                      <input type="submit" value="削除" class="btn">
                    </form>
                  @else
                  @endif
                 
                 　<a class="like_button">{{ $post->isLikedBy(Auth::user()) ? '★' : '☆' }}</a>
                    <form method="post" class="like" action="{{ route('posts.toggle_like', $post) }}">
                      @csrf
                      @method('patch')
                    </form>
                </div>
          </li>
      @empty
          <li>投稿はありません。</li>
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
