<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function getFile(){
        return $this->hasOne(File::class,'product_id','id');
    } 
}
