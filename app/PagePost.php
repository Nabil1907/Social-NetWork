<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PagePost extends Model
{
    protected $fillable = [
      'post_id',
      'page_id',
    ];

    public static function boot() {
        parent::boot();

        static::deleting(function($page_post) {
             $page_post->post()->delete();
        });
    }

    public function page(){
      return $this->belongsTo('App\Page');
    }

    public function post(){
      return $this->belongsTo('App\Post');
    }
}
