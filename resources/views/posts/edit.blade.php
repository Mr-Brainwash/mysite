@extends('layouts.layout', ['title' => 'Редактировать статью'])
@section('content')
    <form action="{{route('post.update', ['id' => $post->post_id])}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <h2>Редактировать статью</h2>
        @include('posts.parts.form')
        <input type="submit" class="btn btn-outline-success" value="Редактировать">
    </form>
@endsection
