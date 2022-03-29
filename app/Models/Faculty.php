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

    protected $fillable = ['title', 'university_id'];

    public static function boot()
    {
        parent::boot();

        Faculty::observe(new \App\Observers\UserActionsObserver);
    }

    protected static function booted()
    {
        static::addGlobalScope('latest', function ($builder) {
            $builder->latest();
        });
    }

    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function years()
    {
        return $this->hasMany(Year::class);
    }

     /**
     * Getters & Setters
     */

    public function setTitleAttribute($input)
    {
        $this->attributes['title'] = htmlentities($input);
    }
    public function getTitleAttribute($input)
    {
        return html_entity_decode($input);
    }
    
}
