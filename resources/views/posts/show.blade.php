@extends('layouts.master')
@section('title')
    <div class="blog-header">
        <div class="container">
            <h1 class="blog-title">Blog </h1>
        </div>
    </div>
@endsection
@section('content')
                <div class="blog-post">
                    <h2 class="blog-post-title">{{ $post->title }}

                    </h2>
                    <p class="blog-post-meta">By {{ $post->users->name }} on {{ Carbon\Carbon::parse($post->created_at)->format('d F,Y') }}
                        @if(auth()->id() == $post->users_id)
                               <a class="btn-sm " href="{{url('posts/'.$post->id.'/edit')}}">Edit</a>
                        @endif
                    </p>
                    @if($post->image)
                    <p><img src="{{url('/images/'.$post->image)}}" class="img-responsive"></p>
                    @endif
                    <p>{{ $post->body }}</p>

                </div>
                <hr>

                <div class="comments">
                    <h5> Comments </h5>
                    <ul class="list-group">
                        @foreach($post->commentsa as $comment)
                           <li class="list-group-item">
                               <strong>{{ $comment->users->name }}</strong> : &af;
                               {{$comment->body}}
                           <br>
                               <small>{{$comment->created_at->diffForHumans()}}  </small>
                           </li>

                        @endforeach
                    </ul>

                </div>
                <hr>
                @if(auth()->guard('api')->check())
                <div class="card">
                    <div class="card-body">
                         <form method="POST" action="{{url('/posts/'.$post->id.'/comments')}}">
                             {{ csrf_field() }}
                            <div class="form-group">
                                  <textarea name="body" placeholder="Your Comment Here." class="form-control"></textarea>

                            </div>
                             <div class="form-group">
                                 <button type="submit" class="btn btn-primary">Add Comment</button>
                             </div>
                             @include('layouts.errors')
                         </form>
                    </div>
                </div>
                @else
                    <div class="card">
                        <div class="card-body">
                            Please <a href="{{ url('/login') }}">Login</a> For Posts Comments.
                        </div>
                    </div>
                @endif
                <br>

@endsection