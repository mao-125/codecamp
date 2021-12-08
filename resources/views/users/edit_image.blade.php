@extends('layouts.logged_in')
 
@section('content')
    <h1>{{ $title }}</h1>
    <h2>現在の画像</h2>
    @if($users->image !== '')
        <img src="{{ \Storage::url($users->image) }}">
    @else
        <img src="{{ asset('images/no_image.png') }}">
    @endif
    <form
        method="POST"
        action="{{ route('users.update_image', $users) }}"
        enctype="multipart/form-data"
    >
    
        @csrf
        @method('patch')
        <div>
            <label>
                画像を選択:
                <input type="file" name="image">
            </label>
        </div>
        <input type="submit" value="更新">
    </form>
@endsection