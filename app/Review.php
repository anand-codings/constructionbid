<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    function getHomeowner() {
        return $this->belongsTo(User::class, 'homeowner_id');
    }
    
    function getCompany(){
        return $this->belongsTo('App\User', 'company_id');
    }
    
    public function getfile(){
        return $this->hasMany(File::class,'review_id','id');
    }
    
}
