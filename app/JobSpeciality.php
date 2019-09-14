<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobSpeciality extends Model
{
   protected $table = 'job_speciality';
   
     function getJob()
  {
      return $this->belongsToMany(Job::class,'jobs_speciality_junction','job_id','job_speciality_id');
  }
}
