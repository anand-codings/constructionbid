<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
       public function getFile(){
        return $this->hasMany(File::class,'project_id','id');
    } 

       public function getComapny(){
        return $this->hasOne(User::class,'id','company_id');
    } 
}
