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

    protected $fillable = ['title', 'year_id'];

    public static function boot()
    {
        parent::boot();

        Topic::observe(new \App\Observers\UserActionsObserver);
    }

    public function year()
    {
        return $this->belongsTo(Year::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }

    public function tests()
    {
        return $this->hasMany(Test::class);
    }
}
