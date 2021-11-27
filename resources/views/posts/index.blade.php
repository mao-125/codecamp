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
                    {!! nl2br(e($post->comment)) !!}
                </div>
                
              @if($post->user->id === Auth::user()->id)
                 <div class="post_body_footer">
                  [<a href="{{ route('posts.edit', $post) }}">編集</a>]
                  <form class="delete" method="post" action="{{ route('posts.destroy', $post) }}">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="削除">
                  </form>
                 </div>
               @else
               @endif
               </div>
          </li>
          
      @empty
          <li>投稿はありません。</li>
      @endforelse
  </ul>
@endsection