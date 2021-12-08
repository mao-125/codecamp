@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <h1>{{ $title }}</h1>
  
  <form method="POST" action="{{ route('users.update', $users) }}">
      @csrf
      @method('patch')
      <div>
          <label>
            名前:
            <input type="text" name="name" value="{{ $users->name }}">
          </label>
      </div>
      <div>
          <label>
            プロフィール:<br>
            <textarea type="text" name="profile" rows="5" cols="80">{{ $users->profile }}</textarea>
          </label>
      </div>
 
      <input type="submit" value="更新">
  </form>
@endsection