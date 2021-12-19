@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
<div class="main container">
  <h1>{{ $title }}</h1>
  
  <form method="POST" action="{{ route('posts.update', $post) }}">
      @csrf
      @method('patch')
      <div>
          <label>
            コメント<br>
            <textarea type="text" name="comment" rows="5" cols="50">{{ $post->comment }}</textarea>
          </label>
      </div>
 
      <input type="submit" value="投稿" class="btn">
  </form>
</div>  
@endsection