<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Faculty
 *
 * @package App
 * @property string $title
*/
class DefinitionLevel extends Model
{
    protected $table = 'definition_level';
    protected $fillable = ['level', 'user_id', 'definition_id'];

    public static function boot()
    {
        parent::boot();

        Faculty::observe(new \App\Observers\UserActionsObserver);
    }

}
