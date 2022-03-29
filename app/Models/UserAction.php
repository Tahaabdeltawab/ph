<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserAction
 *
 * @package App
 * @property string $user
 * @property string $action
 * @property string $action_model
 * @property integer $action_id
*/
class UserAction extends Model
{

    protected $fillable = ['action', 'action_model', 'action_id', 'user_id'];


    /**
     * Set to null if empty
     * @param $input
     */
    public function setUserIdAttribute($input)
    {
        $this->attributes['user_id'] = $input ? $input : null;
    }

    protected static function booted()
    {
        static::addGlobalScope('latest', function ($builder) {
            $builder->latest();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
