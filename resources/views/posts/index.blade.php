@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <h1>{{ $title }}</h1>
  
  <form action="{{ route('posts.index') }}" method="GET">
    <p><input type="serch" name="keyword" value="{{$keyword}}"></p>
    <p><input type="submit" value="検索"></p>
  </form>
  
  <ul>
    @forelse($posts as $post)
      <li>{{ $post->comment }}</li>
    @empty
      <li>検索結果なし</li>
    @endforelse
  </ul>

  <h2>おすすめユーザー</h2>
  <ul class="recommend_users">
    @forelse($recommend_users as $recommend_user)
      <li><a href="{{ route('users.show', $recommend_user) }}">{{ $recommend_user->name }}</a></li>
    @empty
      <li>他のユーザーが存在しません。</li>
    @endforelse
  </ul>
  
  <h2>タイムライン</h2>
  <ul class="posts">
      @forelse($user_posts as $post)
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
                        <li>コメントはありません。</li>
                      @endforelse
                    </ul>
                    <form method="post" action="{{ route('comments.store') }}">
                      @csrf
                      <input type="hidden" name="post_id" value="{{ $post->id }}">
                      <label>
                      コメントを追加:
                      <input type="text" name="body">
                      </label>
                      <input type="submit" value="送信">
                    </form>
                  </div>  
                </div>
                
                <div class="post_body_footer">
                  @if($post->user->id === Auth::user()->id)
                    [<a href="{{ route('posts.edit', $post) }}">編集</a>]
                    [<a href="{{ route('posts.edit_image', $post) }}">画像編集</a>]
                    <form class="delete" method="post" action="{{ route('posts.destroy', $post) }}">
                      @csrf
                      @method('DELETE')
                      <input type="submit" value="削除">
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
    /* global $ */
    $('.like_button').on('click', (event) => {
        $(event.currentTarget).next().submit();
    })
  </script>
@endsection
