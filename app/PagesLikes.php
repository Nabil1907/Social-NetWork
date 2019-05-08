<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PagesLikes extends Model
{
  
    public function page()
    {
    return $this->belongsTo('App\Page');
    }
    public function user()
    {
    return $this->belongsTo('App\User');
    }
}
