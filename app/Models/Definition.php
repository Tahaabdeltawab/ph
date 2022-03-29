<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelFavorite\Traits\Favoriteable;

class Definition extends Model
{
    use Favoriteable, \Spatie\Tags\HasTags;
    
    protected $fillable = ['title', 'topic_id', 'chapter_id', 'flashable', 'reversible', 'mcquable', 'automcquable', 'custommcquable', 'completable', 'explanation'];

    public static function boot()
    {
        parent::boot();

        Definition::observe(new \App\Observers\UserActionsObserver);
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

    public function setExplanationAttribute($input)
    {
        $this->attributes['explanation'] = htmlentities($input);
    }
    public function getExplanationAttribute($input)
    {
        return html_entity_decode($input);
    }

    /**
     * Scopes
    */
    /**
     * don't make flashable def with multi terms => automcquable
     * the definition may be viewed as flashcard or mcq or complete
     * if (definition has one term) the definition will be viewed as complete
     * if (custommcquable == 1) => so the definition will be viewed as mcq only 
     * elseif (custommcquable == 0) => flashable() => the definition will be viewed as 👇
     *      if (automcquable == 0) => flashcard only 
     *      if (automcquable == 1) => flashcard and mcq
     */
    public function scopeFlashable($query)
    {
        // return $query->where('custommcquable', 0);
        return $query->where('flashable', 1);
    }
    public function scopeMcquable($query)
    {
        // return $query->automcquable()->orWhere->custommcquable();
        return $query->where('mcquable', 1);
    }
    public function scopeCompletable($query)
    {
        // return $query->onetermed(); //TODO add (or custommcquable) 
        return $query->where('completable', 1); 
    }
    public function scopeAutomcquable($query)
    {
        return $query->where('automcquable', 1);
    }
    public function scopeCustommcquable($query)
    {
        return $query->where('custommcquable', 1);
    }
    public function scopeOnetermed($query)
    {
        return $query->withCount('terms')->having('terms_count', '=', 1);
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
    // returns an array of the definition terms
    public function terms()
    {
        return $this->hasMany(Term::class);
    }

    /**
     * used to evaluate mcq option is correct or not in definitions with one term 
     * so not applied in definitions with more than one term because they are not automcquable
     * 
     */
    public function term()
    {
        return $this->hasOne(Term::class)->when($this->custommcquable == 1, fn($q) => $q->correct());
    }

    // terms options for auto mcq
    public function mcq_terms() 
    {
        return $this->custommcquable == 1
        ? $this->terms() 
        : $this->chapter->terms()->automcquable()
        ->where('terms.id', '!=', $this->term->id)
        ->inRandomOrder()
        ->limit(3);
        // where('terms.id', '!=', $this->term->id)  => // because it will be appended in DefinitionResource.
    }

    public function user_level(){
        return $this->hasOne(DefinitionLevel::class, 'definition_id')->where('user_id', auth()->id());
    }
}
