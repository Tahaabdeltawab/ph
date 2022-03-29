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

    protected $fillable = ['title', 'faculty_id'];

    public static function boot()
    {
        parent::boot();

        Year::observe(new \App\Observers\UserActionsObserver);
    }

    protected static function booted()
    {
        static::addGlobalScope('latest', function ($builder) {
            $builder->latest();
        });
    }

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }
    
    public function topics()
    {
        return $this->hasMany(Topic::class);
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
