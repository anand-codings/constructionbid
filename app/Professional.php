<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Professional extends Model
{
  protected $table = 'professional';
       function getServices()
  {
     return  $this->hasMany(Service::class,'professional_id','id');
  }
        function getSpecialities()
  {
     return  $this->hasMany(Specialities::class,'professional_id','id');
  }
}
