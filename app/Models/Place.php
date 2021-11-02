<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    public $table = "places";

    public function supervisor(){
        return $this->belongsTo(User::class, 'supervisor_id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function aboutuses(){
        return $this->hasMany(Place_aboutUs::class, 'place_id');
    }
    public function offers(){
        return $this->hasMany(Place_offer::class, 'place_id');
    }
    public function services(){
        return $this->hasMany(Place_service::class, 'place_id');
    }
    public function products(){
        return $this->hasMany(Place_product::class, 'place_id');
    }

}
