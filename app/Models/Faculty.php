<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Faculty
 *
 * @package App
 * @property string $title
*/
class Faculty extends Model
{

    protected $fillable = ['code', 'title', 'university_id'];

    public static function boot()
    {
        parent::boot();

        Faculty::observe(new \App\Observers\UserActionsObserver);
    }

    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function years()
    {
        return $this->hasMany(Year::class);
    }
}
