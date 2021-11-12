<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class QuestionsOption
 *
 * @package App
 * @property string $question
 * @property string $option
 * @property tinyInteger $correct
*/
class QuestionsOption extends Model
{

    protected $fillable = ['option', 'correct', 'question_id'];

    public static function boot()
    {
        parent::boot();

        QuestionsOption::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setQuestionIdAttribute($input)
    {
        $this->attributes['question_id'] = $input ? $input : null;
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }

}
