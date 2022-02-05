<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelFavorite\Traits\Favoriteable;

class Definition extends Model
{
    use Favoriteable, \Spatie\Tags\HasTags;
    
    protected $fillable = ['title', 'topic_id', 'chapter_id', 'reversible', 'automcquable', 'explanation'];

    public static function boot()
    {
        parent::boot();

        Definition::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Getters & Setters
     */

    public function setExplanationAttribute($input)
    {
        $this->attributes['explanation'] = htmlentities($input);
    }

    public function getExplanationAttribute($input)
    {
        return html_entity_decode($input);
    }

    
    /**
     * Relations
     */
    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    public function terms()
    {
        return $this->hasMany(Term::class);
    }

    // used to evaluate mcq option is correct or not
    public function term()
    {
        return $this->hasOne(Term::class);
    }

    // terms options for auto mcq
    public function mcq_terms() 
    {
        return $this->chapter->terms()
        ->where(
            function($q)
            {
                $q->whereHas('definition', function($qu)
                    {
                        return $qu->where('automcquable', true);
                    }
                );
            }
        )
        ->where('terms.id', '!=', $this->term->id)
        ->inRandomOrder()
        ->limit(3);
    }

    public function user_level(){
        return $this->hasOne(DefinitionLevel::class, 'definition_id')->where('user_id', auth()->id());
    }
}
