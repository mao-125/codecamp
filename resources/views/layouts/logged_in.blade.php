@extends('layouts.default')
 
@section('header')
<header>
    <ul class="header_nav container">
      <div class="header_left">
        <li>
          <a href="{{ route('posts.index') }}">
             nekoneko
          </a>  
        </li>
      </div>
      
      <div class="header_right">
        <li>
          <a href="{{ route('users.show',\Auth::user()) }}" class="btn">
            プロフィール
          </a>
        </li>
        <li>
          <a href="{{ route('posts.create') }}" class="btn">
            新規投稿
          </a>
        </li>
        <li>
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <input type="submit" value="ログアウト" class="btn">
          </form>
        </li>
      </div>  
    </ul>
</header>

@section('footer')
<footer class="footer">
  <small>&copy; 2021 nekoneko</small>
</footer>

@endsection