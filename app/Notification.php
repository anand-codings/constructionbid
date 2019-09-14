<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    public function getSender(){
        return $this->hasOne(User::class,'id','from_user');
    }
     public function getProposal(){
        return $this->hasOne(Proposal::class,'id','proposal_id');
    }
}
