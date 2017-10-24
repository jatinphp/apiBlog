<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.sidebar',function($view){
            $guzzle = new Client();
            $res = $guzzle->request('GET','http://localhost:8887/api/archives', ['query' =>['api_token' => 'A7jHvdqnbZtiFFrlOXvVeELX7CQoGfXTHlc9kEnlvKyfhfDdBTsHGxRsQy3r']]);

            $archives = json_decode($res->getBody()->getContents());

            $res = $guzzle->request('GET','http://localhost:8887/api/tags', ['query' =>['api_token' => 'A7jHvdqnbZtiFFrlOXvVeELX7CQoGfXTHlc9kEnlvKyfhfDdBTsHGxRsQy3r']]);

            $tags = json_decode($res->getBody()->getContents());

            $view->with(compact('archives','tags'));
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
