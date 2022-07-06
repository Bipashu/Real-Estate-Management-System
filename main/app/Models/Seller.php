<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;
    public function getRentProperties(){
        return $this->hasMany('App\Models\Rent_property_model');
    }
    public function getSellProperties(){
        return $this->hasMany('App\Models\Sell_property_model');
    }
}
