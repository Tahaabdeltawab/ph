<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Term extends Model
{

    protected $fillable = ['title', 'question_id'];

    public static function boot()
    {
        parent::boot();

        Term::observe(new \App\Observers\UserActionsObserver);
    }

    public function definition()
    {
        return $this->belongsTo(Definition::class);
    }

    public function scopeAutomcquable($query)
    {
        return $query->whereHas('definition', function($q){return $q->automcquable;});
    }

}
