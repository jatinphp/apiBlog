<?php

namespace App;
use Carbon\Carbon;

class Posts extends Model
{
    public function commentsa(){
        return $this->hasMany(Comments::class);
    }
    public function users(){
        return $this->belongsTo(User::class);
    }
    public function addComments($body){
        $users_id = auth()->id();
        $this->commentsa()->create(compact('body','users_id'));
        /*Comments::create([
            'posts_id' => $this->id,
            'user_id' => '1',
            'body'=> $body
        ]);*/

    }
    public function scopeFilter($query, $filters){

        if($month = $filters['month']){
            $query->whereMonth('created_at',carbon::parse($month)->month);
        }
        if($year = $filters['year']){
            $query->whereYear('created_at',$year);
        }
    }

    public static function archives(){

        return static::selectRaw('year(created_at) year, monthname(created_at) month, count(*) published ')
            ->groupBy('year','month')
            ->orderByRaw('min(created_at) desc')
            ->get();
    }
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
}
