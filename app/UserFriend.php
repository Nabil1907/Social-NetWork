<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserFriend extends Model
{
    protected $fillable = [
      'sender_id', 'receiver_id', 'is_accepted'
    ];

    public function getUserAttribute(){
      return ($this->sender_id == 1);
    }

}
