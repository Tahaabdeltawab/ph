<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Feedback
 *
 * @package App
 * @property string $title
*/
class Feedback extends Model
{

    protected $table = 'feedbacks';
    protected $fillable = ['content', 'user_id'];

    public static function boot()
    {
        parent::boot();

        Feedback::observe(new \App\Observers\UserActionsObserver);
    }

    protected static function booted()
    {
        static::addGlobalScope('latest', function ($builder) {
            $builder->latest();
        });
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

     /**
     * Getters & Setters
     */

    public function setContentAttribute($input)
    {
        $this->attributes['content'] = htmlentities($input);
    }
    public function getContentAttribute($input)
    {
        return html_entity_decode($input);
    }
    
}
