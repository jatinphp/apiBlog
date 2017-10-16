<div class="blog-masthead">
    <div class="container">
        <nav class="nav">
            <a class="nav-link active" href="{{url('/')}}">Home</a>


            @if(Auth::check())
                <a class="nav-link" href="{{url('posts/create')}}">Publish Blog</a>
            <a class="nav-link ml-auto" href="#">{{ Auth::user()->name }}</a>
                <a class="nav-link " href="{{url('/logout')}}">Logout</a>
            @else
                <a class="nav-link ml-auto" href="{{url('/register')}}">Register</a>
                <a class="nav-link " href="{{url('/login')}}">Login</a>
            @endif
        </nav>
    </div>
</div>
