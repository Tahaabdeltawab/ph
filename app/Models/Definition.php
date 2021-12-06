<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelFavorite\Traits\Favoriteable;

class Definition extends Model
{
    use Favoriteable;
    
    protected $fillable = ['title', 'topic_id', 'chapter_id'];

    public static function boot()
    {
        parent::boot();

        Definition::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setTopicIdAttribute($input)
    {
        $this->attributes['topic_id'] = $input ? $input : null;
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    public function term()
    {
        return $this->hasOne(Term::class);
    }

    // terms options for mcq
    public function terms() 
    {
        return $this->chapter->terms()->where('id', '!=', $this->term->id)->inRandomOrder()->limit(3);
    }

    public function user_level(){
        return $this->hasOne(DefinitionLevel::class, 'definition_id')->where('user_id', auth()->id());
    }
}
