<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
      'body',
      'user_id',
      'for_page',
    ];
    protected $guarded =[];
    public function user()
    {
    return $this->belongsTo('App\User');
    }
    public function like()
    {
    return $this->hasMany('App\Like');
    }
    public function comments()
    {
    return $this->hasMany('App\Comment');
    }
   /*  public function page_post(){
      return $this->hasMany('App\PagePost');
    } */
}
