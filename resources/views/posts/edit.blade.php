@extends('layouts.master')
@section('title')
    <div class="blog-header">
        <div class="container">
            <h1 class="blog-title">Blog</h1>
        </div>
    </div>
@endsection
@section('content')
    <div class="blog-post">
        <h2 class="blog-post-title">Edit Post</h2>
        <hr>
        <form method="POST" action="{{ url('/posts/edit/'.$post->id) }}">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control"  id="title" value="{{ $post->title }}" name="title" placeholder="Title">
            </div>

            <div class="form-group">
                <label for="body">Body</label>
                <textarea id="body"  class="form-control" rows="7" name="body">{{ $post->body }}</textarea>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
            @include('layouts.errors')
        </form>

    </div>
   <!--  <nav class="blog-pagination">
        <a class="btn btn-outline-primary" href="#">Older</a>
        <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
    </nav>-->
@endsection