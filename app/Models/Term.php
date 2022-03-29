<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Term extends Model
{

    protected $fillable = ['title', 'definition_id', 'correct'];
    // if (correct == null) => the terms are terms, else => the terms are mcq options which are all false except the one having (correct == 1)  

    public static function boot()
    {
        parent::boot();

        Term::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Relations
     */
    public function definition()
    {
        return $this->belongsTo(Definition::class);
    }

    /**
     * Scopes
     */

    public function scopeCorrect($query)
    {
        return $query->where('correct', 1);
    }
    public function scopeIncorrect($query)
    {
        return $query->where('correct', 0);
    }
    
    public function scopeAutomcquable($query)
    {
        return $query->whereHas('definition', fn($q) => $q->where('automcquable', 1));
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
