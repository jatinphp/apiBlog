@extends('layouts.master')
@section('title')
    <div class="blog-header">
        <div class="container">
            <h1 class="blog-title"> Blog </h1>
        </div>
    </div>
@endsection
@section('content')
                @foreach($posts as $post)

                <div class="blog-post">
                    <h3 class="blog-post-title">{{ $post->title }}</h3>
                    <p class="blog-post-meta">By on {{ Carbon\Carbon::parse($post->created_at)->format('d F,Y') }} </p>

                    <p>{{ str_limit($post->body, 100) }}</p>
                    <p><a href="{{url('/posts/'.$post->id)}}">read more..</a></p>

                </div>
                @endforeach

@endsection