@extends('layouts.default')
 
@section('header')
<header>
    <ul class="header_nav">
      <div class="header_left">
        <li>
           <a href="{{ route('posts.index') }}">
            マイクロブログ
           </a>  
        </li>
      </div>
      
      <div class="header_right">
        <li>
          <form action="{{ route('posts.create') }}">
            @csrf
            <input type="submit" value="新規投稿">
          </form>
        </li>
        <li>
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <input type="submit" value="ログアウト">
          </form>
        </li>
      </div>  
    </ul>
</header>
@endsection