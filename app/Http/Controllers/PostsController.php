<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Posts;
use Carbon\Carbon;
use phpDocumentor\Reflection\Types\Null_;
use GuzzleHttp\Client;


class PostsController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth')->except(['index','show']);
    }

    public function index()
    {
        $guzzle = new Client();
        $res = $guzzle->request('GET','http://localhost:8887/api/post', ['query' =>['api_token' => 'A7jHvdqnbZtiFFrlOXvVeELX7CQoGfXTHlc9kEnlvKyfhfDdBTsHGxRsQy3r']]);

       $posts = json_decode($res->getBody()->getContents());

       return view('posts.index', compact('posts'));
    }

    public function show($id)
    {
        $post = Posts::find($id);
        return view('posts.show', compact('post'));
    }

    public function create()
    {

        return view('posts.create');
    }

    public function edit(Posts $post)
    {

        if(auth()->id() !== $post->users_id) {

            return redirect('/');

        }

        return view('posts.edit', compact('post'));
    }

    public function store(Request $request){


        $this->validate($request,[
            'title'=> 'required|unique:posts|max:255',
            'body' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $input['imagename'] = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $input['imagename']);
        }

        Posts::create([
            "title"=> $request->title,
            "body"=> $request->body,
            "image"=> $input['imagename'],
            "users_id"=> auth()->id()
        ]);
        return redirect('/');
    }
    public function update(Request $request, $id)
    {
        Posts::where('id', $id)->update(["title"=>$request->title,"body"=>$request->body]);
        return redirect('/posts/'.$id);
    }
}
