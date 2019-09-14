<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
      function getFile()
  {
     return  $this->hasOne(File::class,'service_id','id');
  }
}
