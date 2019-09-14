<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Proposal extends Model
{
     protected $table = 'proposals';
      function getUser()
    {
        return $this->belongsTo(User::class,'company_id');
    }
      function getJob()
    {
        return $this->belongsTo(Job::class,'job_id');
    }
    function getFiles()
    {
        return $this->hasOne(File::class,'proposal_id','id');
    }
 
    public function getSubscription(){
        return $this->hasOne(Subscription::class,'user_id', Auth::id());
    }
}
