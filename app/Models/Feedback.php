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

    public function user(){
        return $this->belongsTo(User::class);
    }

}
