<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Cashier\Billable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable {

    use Notifiable;
    use SoftDeletes;
    use Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    function getpropsals() {
        return $this->hasMany(Proposal::class, 'company_id', 'id');
    }

    function getJobs() {
        return $this->hasMany(Job::class, 'user_id', 'id');
    }

    function getGeneralContractor() {
        return $this->hasOne(GeneralContractor::class, 'user_id', 'id');
    }

    function getSubContractor() {
        return $this->hasOne(SubContractor::class, 'user_id', 'id');
    }

    function getOwner() {
        return $this->hasOne(Owner::class, 'user_id', 'id');
    }

    function getProfessional() {
        return $this->hasOne(Professional::class, 'user_id', 'id');
    }

    function getSupplier() {
        return $this->hasOne(Supplier::class, 'user_id', 'id');
    }

    function getRatings() {
        return $this->hasMany(Review::class, 'company_id', 'id');
    }

    function getSubscription() {
        return $this->hasOne(Subscription::class, 'user_id', 'id');
    }

    public function getProposals() {
        return $this->hasMany(Proposal::class, 'company_id', 'id');
    }

    public function getCompanyDetail() {
        return $this->hasOne(CompanyDetail::class, 'user_id', 'id');
    }
    
    public function getProducts(){
        return $this->hasMany(Product::class,'company_id','id');
    }
    public function getProjects(){
        return $this->hasMany(Project::class,'company_id','id');
    }
    public function getSaves(){
        return $this->hasMany(Save::class,'company_id','id');
    }
    
    function ratingAvg() {
        return $this->hasOne(Review::class , 'company_id', 'id')->selectRaw('company_id , CAST(AVG(rating) AS DECIMAL(8,2)) as total')->groupBy('company_id');
    }

function starrating() {
        return $this->hasMany(Review::class , 'company_id', 'id')->where('rating','>=',4.5);
    }

    public function getSpecialities(){
        return $this->hasMany(Specialities::class ,'company_id' ,'id');
    }
    
    public function getCompanyConatcted(){
        return $this->hasMany(Contact::class ,'company_id' ,'id')->where('homeowner_id',Auth::user()->id);
    }


}
