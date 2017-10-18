<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;


class SessionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
       $this->middleware('guest')->except(['destroy']);

    }
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
        return view('sessions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $guzzle = new Client();

        //$post_data = ['email'=>$request->email,'password'=>$request->password];
        $myBody['email'] = $request->email;
        $myBody['password'] = $request->password;
        $response = $guzzle->post('http://localhost:8887/api/login', ['query' =>['api_token' => 'A7jHvdqnbZtiFFrlOXvVeELX7CQoGfXTHlc9kEnlvKyfhfDdBTsHGxRsQy3r'],'form_params'=>$myBody]);
        $resposed =  json_decode($response->getBody()->getContents());

        if($resposed->status == 'success'){
            $userdata = [
                'email'=>$resposed->user->email,
                'password'=>$request->password,
                'name'=>$resposed->user->name,
                'api_token' => $resposed->user->api_token
            ];
            Auth::guard('api')->attempt($userdata);
            return redirect('/');
        }
        return back()->withErrors([
            'message' => 'Please Check your credentials and try again!'
        ]);

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
    public function destroy()
    {
        auth()->guard('api')->logout();
        return redirect('/');
    }
}
