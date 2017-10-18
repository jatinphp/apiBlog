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

        $this->middleware('auth:api')->except(['index']);
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
        $guzzle = new Client();
        $res = $guzzle->request('GET','http://localhost:8887/api/post/'.$id, ['query' =>['api_token' => auth()->guard('api')->user()->api_token]]);

        $post = json_decode($res->getBody()->getContents());

        $post = $post->post;

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

        $guzzle = new Client();

        if(auth()->guard('api')->check()){
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

            $postsData = [
                "title"=> $request->title,
                "body"=> $request->body,
                "image"=> $input['imagename'],
                "_token"=> $request->_token,
                "users_id"=> auth()->guard('api')->id()
            ];

            $response = $guzzle->post('http://localhost:8887/api/post', ['query' =>['api_token' => auth()->guard('api')->user()->api_token],'form_params'=>$postsData]);
            $resposed =  json_decode($response->getBody()->getContents());

            if($resposed->status == 'success'){
                return redirect('/');
            }
        }
        return back()->withErrors([
            'message' => 'Please Check your credentials and try again!'
        ]);
    }

    public function update(Request $request, $id)
    {
        Posts::where('id', $id)->update(["title"=>$request->title,"body"=>$request->body]);
        return redirect('/posts/'.$id);
    }
}
