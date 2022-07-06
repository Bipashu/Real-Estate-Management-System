<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rent_property_model extends Model
{
    use HasFactory;
    public function setCommentAttribute($value){
        $this->attributes['description']=ucfirst($value);
    }

    public function getProperty(){
        return $this->hasOne('App\Models\Property_model');
    }
    public function getComments(){
        return $this->hasMany('App\Models\Rent_comment');
    }
    public function getBids(){
        return $this->hasMany('App\Models\Rent_bid');
    }
    public function getLocation(){
        return $this->hasOne('App\Models\Rent_location');
    }
}
