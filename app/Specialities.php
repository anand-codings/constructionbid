<?php

namespace App;
use App\JobSpeciality;
use Illuminate\Database\Eloquent\Model;

class Specialities extends Model
{
  protected $table = 'specialities';
  
  function getspecialImage()
  {
     return  $this->hasOne(JobSpeciality::class,'id','speciality_id');
  }
  
  public function getJobSpecialty(){
      return $this->hasOne(JobSpeciality::class,'id','speciality_id');
  }
}
