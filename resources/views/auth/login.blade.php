@extends('layouts.not_logged_in')
 
@section('content')
<div class="main container">
  <h1>ログイン</h1>
 
  <form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="form-item">
      <label for="email"></label>
      <input type="email" name="email" placeholder="メールアドレス"></input>
    </div>
    <div class="form-item">
      <label for="password"></label>
      <input type="password" name="password" placeholder="パスワード"></input>
    </div>
    <div class="button-panel">
      <input type="submit" class="button" title="login" value="ログイン"></input>
    </div>
  <form>
  
</div>  
@endsection