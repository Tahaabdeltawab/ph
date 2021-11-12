<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Topic
 *
 * @package App
 * @property string $title
*/
class Chapter extends Model
{

    protected $fillable = ['title', 'topic_id'];

    public static function boot()
    {
        parent::boot();

        Chapter::observe(new \App\Observers\UserActionsObserver);
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function tests()
    {
        return $this->hasMany(Test::class);
    }
}
