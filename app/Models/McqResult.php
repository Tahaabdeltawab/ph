<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class McqResult extends Model
{

    protected $table = 'mcq_results';
    protected $fillable = ['user_id', 'chapter_id', 'topic_id', 'data', 'score'];

    public static function boot()
    {
        parent::boot();

        McqResult::observe(new \App\Observers\UserActionsObserver);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }
    
    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
}
