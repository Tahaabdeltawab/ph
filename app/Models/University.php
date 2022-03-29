<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class University
 *
 * @package App
 * @property string $title
*/
class University extends Model
{

    protected $fillable = ['title'];

    public static function boot()
    {
        parent::boot();

        University::observe(new \App\Observers\UserActionsObserver);
    }

    protected static function booted()
    {
        static::addGlobalScope('latest', function ($builder) {
            $builder->latest();
        });
    }

    public function faculties()
    {
        return $this->hasMany(Faculty::class);
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
