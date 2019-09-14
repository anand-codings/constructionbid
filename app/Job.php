<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
class Job extends Model
{
  protected $table = 'jobs';
  
  function getSpeciality()
  {
     return  $this->hasMany(Specialities::class,'job_id','id');
  }
    function getUser()
  {
     return  $this->belongsTo(User::class,'user_id');
  }
   function getProposal()
  {
     return  $this->hasMany(Proposal::class,'job_id','id');
  }
      function getFiles()
    {
        return $this->hasMany(File::class,'job_id','id');
    }
    function appliedProposal()
  {
     return  $this->hasOne(Proposal::class,'job_id','id')->where('company_id',Auth::user()->id);
  }
  
  public function getJobUser(){
      return $this->hasOne(User::class, 'id','user_id');
  }
    public function getJobProposal(){
        return $this->hasMany(Proposal::class ,'job_id','id');
    }
}
