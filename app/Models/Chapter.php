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
    use \Spatie\Tags\HasTags;
    
    protected $fillable = ['title', 'topic_id'];

    public static $common = ['chapters.id','chapters.title', 'chapters.topic_id'];

    public static function boot()
    {
        parent::boot();

        Chapter::observe(new \App\Observers\UserActionsObserver);
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('permission')->using(ChapterUser::class);
    }

    public function definitions()
    {
        return $this->hasMany(Definition::class);
    }
    public function terms()
    {
        return $this->hasManyThrough(Term::class, Definition::class);
    }
}
