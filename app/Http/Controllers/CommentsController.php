<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Comments;
use App\Posts;
use GuzzleHttp\Client;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($post)
    {
        $this->validate(request(),[
            'body' => 'required|min:10'
        ]);
        $guzzle = new Client();
        $postsData = [
            "body"=> request('body'),
            "_token"=> request('_token'),
            "users_id"=> auth()->guard('api')->id(),
            "post" => $post
        ];

        $response = $guzzle->post('http://localhost:8887/api/post/comment', ['query' =>['api_token' => auth()->guard('api')->user()->api_token],'form_params'=>$postsData]);
        $resposed =  json_decode($response->getBody()->getContents());

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
