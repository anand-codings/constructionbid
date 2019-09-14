<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $dates = ['created_at', 'updated_at'];
    
     function getUser() {
//        return $this->belongsTo(User::class, 'user_id');
         return $this->hasOne(User::class,'id','user_id');
    }
    
//    function getUserName(){
//        return $this->hasOne(User::class,'id','user_id');
//    }
    
}
