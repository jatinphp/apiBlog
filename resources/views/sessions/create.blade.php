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
        <h2 class="blog-post-title">Login </h2>
        <hr>
        <form method="POST" action="{{ url('/login') }}">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email"  class="form-control" placeholder="Email" name="email">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password"  class="form-control" placeholder="Password" name="password">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
            @include('layouts.errors')
        </form>

    </div>

@endsection