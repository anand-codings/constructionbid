<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GeneralContractor extends Model
{
   protected $table = 'general_contractor';
   
     function getServices()
  {
     return  $this->hasMany(Service::class,'gc_id','id');
  }
      function getSpecialities()
  {
     return  $this->hasMany(Specialities::class,'gc_id','id');
  }
}
