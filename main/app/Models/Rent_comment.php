<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rent_comment extends Model
{
    use HasFactory;
    public function setCommentAttribute($value){
        $this->attributes['comment']=ucfirst($value);
    }
}
