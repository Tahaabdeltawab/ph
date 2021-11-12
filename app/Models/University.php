<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class University
 *
 * @package App
 * @property string $title
*/
class University extends Model
{

    protected $fillable = ['code', 'title'];

    public static function boot()
    {
        parent::boot();

        University::observe(new \App\Observers\UserActionsObserver);
    }

    public function faculties()
    {
        return $this->hasMany(Faculty::class);
    }
}
