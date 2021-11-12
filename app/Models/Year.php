<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Year
 * 
 * @package App
 * @property string $title
*/
class Year extends Model
{

    protected $fillable = ['code', 'title', 'faculty_id'];

    public static function boot()
    {
        parent::boot();

        Year::observe(new \App\Observers\UserActionsObserver);
    }

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }
    
    public function topics()
    {
        return $this->hasMany(Topic::class);
    }
}
