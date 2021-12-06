<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Term extends Model
{

    protected $fillable = ['title', 'question_id', 'chapter_id', 'topic_id'];

    public static function boot()
    {
        parent::boot();

        Term::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setQuestionIdAttribute($input)
    {
        $this->attributes['question_id'] = $input ? $input : null;
    }
    public function setChapterIdAttribute($input)
    {
        $this->attributes['chapter_id'] = $input ? $input : null;
    }
    public function setTopicIdAttribute($input)
    {
        $this->attributes['topic_id'] = $input ? $input : null;
    }

    public function definition()
    {
        return $this->belongsTo(Definition::class);
    }
    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }
    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

}
