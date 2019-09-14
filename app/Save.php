<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Save extends Model
{
    //
     function getJobs()
  {
     return  $this->hasMany(Job::class,'id','job_id');
  }
}
