<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
   protected $table = 'owner';
        function getServices()
  {
     return  $this->hasMany(Service::class,'owner_id','id');
  }
        function getSpecialities()
  {
     return  $this->hasMany(Specialities::class,'owner_id','id');
  }
}
