<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
  protected $table = 'supplier';
       function getServices()
  {
     return  $this->hasMany(Service::class,'supplier_id','id');
  }
        function getSpecialities()
  {
     return  $this->hasMany(Specialities::class,'supplier_id','id');
  }
}
