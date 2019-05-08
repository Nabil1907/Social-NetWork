<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{

    protected $fillable =
    [
      'page_name',
      'description',
      'user_id',
    ];

    public static function boot() {
        parent::boot();

        static::deleting(function($page) {
             $page->page_post()->delete();
        });
    }

    public function user(){
      return $this->belongsTo(User::class);
    }
    public function getName()
    {
        return $this->page_name ;
    }

    public function page_post(){
      return $this->hasMany('App\PagePost');
    }
    public function pageslikes(){
      return $this->hasMany('App\PagesLikes');
    }

}
