@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
<div class="main container">
  <h1>{{ $title }}</h1>
  
  <ul class="users">
      @forelse($follow_users as $follow_user)
          <li class="user">
            @if($follow_user->image !== '')
              <img src="{{ \Storage::url($follow_user->image) }}">
            @else
              <img src="{{ asset('images/no_image.png') }}">
            @endif
            <a href="{{ route('users.show', $follow_user) }}" class="link">{{ $follow_user->name }}</a>
            <br>
            {{ $follow_user->profile }}
            
            @if($user === \Auth::user())
             <form method="post" action="{{route('follows.destroy', $follow_user)}}" class="follow">
                @csrf
                @method('delete')
                <input type="submit" value="フォロー解除" class="btn">
             </form>
            @else
            @endif
          </li>
      @empty
          <li>フォローしているユーザーはいません。</li>
      @endforelse
  </ul>
</div>  
@endsection