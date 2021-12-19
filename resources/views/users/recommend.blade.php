@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
<div class="main container">
  <h1>{{ $title }}</h1>
  
  <ul class="users">
      @forelse($recommend_users as $users)
        <li class="user">
          @if($users->image !== '')
            <img src="{{ \Storage::url($users->image) }}">
          @else
            <img src="{{ asset('images/no_image.png') }}">
          @endif
          <a href="{{ route('users.show', $users) }}" class="link">{{ $users->name }}</a>
          <br>
          {{ $users->profile }}
        </li>
      @empty
        <li>他のユーザーが存在しません。</li>
      @endforelse
  </ul>
</div>
@endsection  