<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Topic
 *
 * @package App
 * @property string $title
*/
class Topic extends Model
{

    protected $fillable = ['title', 'year_id', 'user_id', 'visibility'];

    public static function boot()
    {
        parent::boot();

        Topic::observe(new \App\Observers\UserActionsObserver);
    }

    protected static function booted()
    {
        static::addGlobalScope('latest', function ($builder) {
            $builder->latest();
        });
    }

    public function year()
    {
        return $this->belongsTo(Year::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function definitions()
    {
        return $this->hasMany(Definition::class);
    }
    public function terms()
    {
        return $this->hasManyThrough(Term::class, Definition::class);
    }
    
    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }

    public function scopePublic($q){
        return $q->where('visibility', 1);
    }

    public function scopePrivate($q){
        return $q->where('visibility', 0);
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
