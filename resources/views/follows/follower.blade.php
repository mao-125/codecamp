@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
<div class="main container">
  <h1>{{ $title }}</h1>
  
  <ul class="users">
      @forelse($followers as $follower)
          <li class="user">
            @if($follower->image !== '')
              <img src="{{ \Storage::url($follower->image) }}">
            @else
              <img src="{{ asset('images/no_image.png') }}">
            @endif
            <a href="{{ route('users.show', $follower) }}" class="link">{{ $follower->name }}</a>
            <br>
            {{ $follower->profile }}
            
            @if(Auth::user()->isFollowing($follower))
              <form method="post" action="{{route('follows.destroy', $follower)}}" class="follow">
                @csrf
                @method('delete')
                <input type="submit" value="フォロー解除" class="btn">
              </form>
            @else
              <form method="post" action="{{route('follows.store')}}" class="follow">
                @csrf
                <input type="hidden" name="follow_id" value="{{ $follower->id }}">
                <input type="submit" value="フォロー" class="btn">
              </form>
            @endif
          </li>
      @empty
          <li>フォローされているユーザーはいません。</li>
      @endforelse
  </ul>
</div>  
@endsection