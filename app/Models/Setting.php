<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public $table = "setting";
    protected $fillable = [
         'language',
         'notification',
         'user_id',
    ];
}
