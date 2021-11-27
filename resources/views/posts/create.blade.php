@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <h1>{{ $title }}</h1>
  <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
      @csrf
      <div>
          <label>
              コメント：<br>
              <textarea type="text" name="comment" rows="5" cols="50"></textarea>
          </label>
      </div>
      
      <input type="submit" value="投稿">
  </form>
@endsection