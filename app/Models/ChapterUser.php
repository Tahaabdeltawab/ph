<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Relations\Pivot;
 
class ChapterUser extends Pivot
{
    public $timestamps = false;

    public function scopeNotAdmin($q){
        return $q->where('permission', '!=', 'admin-show-update-create-delete');
    }
}