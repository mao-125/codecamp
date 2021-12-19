@extends('layouts.default')

@section('header')
<header>
    <ul class="header_nav">
        <li>
          <a href="{{ route('register') }}" class="btn">
            サインアップ
          </a>
        </li>
        <li>
          <a href="{{ route('login') }}" class="btn">
            ログイン
          </a>
        </li>
    </ul>
</header>
@endsection