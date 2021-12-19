@extends('layouts.not_logged_in')
 
@section('content')
<div class="main container">
  <h1>サインアップ</h1>
 
  <form method="POST" action="{{ route('register') }}">
    @csrf
    <div class="form-item">
      <label for="name"></label>
      <input type="name" name="name" placeholder="名前"></input>
    </div>
   <div class="form-item">
      <label for="email"></label>
      <input type="email" name="email" placeholder="メールアドレス"></input>
    </div>
    <div class="form-item">
      <label for="password"></label>
      <input type="password" name="password" placeholder="パスワード"></input>
    </div>
    <div class="form-item">
      <label for="password"></label>
      <input type="password" name="password confirm" placeholder="パスワード(確認用)"></input>
    </div>
    <div class="button-panel">
      <input type="submit" class="button" title="sign up" value="サインアップ"></input>
    </div>
  </form>
  </form>
</div>  
@endsection