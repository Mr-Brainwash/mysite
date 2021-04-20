@extends('layouts.layout', ['title' => 'Создать статью'])
@section('content')
    <form action="{{route('post.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <h2>Создать статью</h2>
        @include('posts.parts.form')
        <input type="submit" class="btn btn-outline-success" value="Создать статью">
    </form>
@endsection
