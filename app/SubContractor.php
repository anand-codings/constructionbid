<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubContractor extends Model
{
protected $table = 'sub_contractor';
     function getServices()
  {
     return  $this->hasMany(Service::class,'sc_id','id');
  }
        function getSpecialities()
  {
     return  $this->hasMany(Specialities::class,'sc_id','id');
  }
}
