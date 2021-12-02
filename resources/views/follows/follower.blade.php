@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <h1>{{ $title }}</h1>
  
  <ul class="followers">
      @forelse($followers as $follower)
          <li class="follower">
            <a href="{{ route('users.show',$follower) }}">{{ $follower->name }}</a>
            @if($user === \Auth::user())
             @if(Auth::user()->isFollowing($follower))
              <form method="post" action="{{route('follows.destroy', $follower)}}" class="follow">
                @csrf
                @method('delete')
                <input type="submit" value="フォロー解除">
              </form>
             @else
              <form method="post" action="{{route('follows.store')}}" class="follow">
                @csrf
                <input type="hidden" name="follow_id" value="{{ $follower->id }}">
                <input type="submit" value="フォロー">
              </form>
             @endif
            @else
            @endif
          </li>
      @empty
          <li>フォローされているユーザーはいません。</li>
      @endforelse
  </ul>
@endsection