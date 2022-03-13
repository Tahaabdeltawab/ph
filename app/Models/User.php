<?php
namespace App\Models;

use App\Traits\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Hash;
use Mail;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Overtrue\LaravelFavorite\Traits\Favoriter;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable implements JWTSubject /*, MustVerifyEmail*/{
    use LaratrustUserTrait;
    use Notifiable, HasFactory, Favoriter;

    protected $fillable = ['username', 'phone', 'email', 'password', 'remember_token', 'status', 'university_id', 'faculty_id', 'year_id'];

    public static function boot()
    {
        parent::boot();

        User::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Hash password
     * @param $input
     */
    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
        }
    }

    public function scopeActive($q){
        return $q->where('status', true);
    }

    public function scopeInactive($q){
        return $q->where('status', false);
    }

    
    public function university(){
        return $this->belongsTo(University::class);
    }
    public function faculty(){
        return $this->belongsTo(Faculty::class);
    }
    public function year(){
        return $this->belongsTo(Year::class);
    }

    public function mcq_results(){
        return $this->hasMany(McqResult::class, 'user_id');
    }

    public function feedbacks(){
        return $this->hasMany(Feedback::class);
    }

    public function chapters(){
        return $this->belongsToMany(Chapter::class)->withPivot('permission')->using(ChapterUser::class);
    }

    /**
     **DB
     *  ✅3️⃣ many to many relationship: when sharing, add row in chapter_user table (user_id, chapter_id, permissions(show,updateWithAdd,delete,create more defs)) 
     *      permission: show,show-update,show-update-create,show-update-create-delete
     *      users column in the chapters table with users ids
     **WHERE TO USE
     *  practice private
     *      get topics 
     *          created by user (visibility=0, topic_creator=auth())
                contains chapters shared with user 
                ✅3️⃣ $user_allowed_chapters = ChapterUser::where('user_id', auth()->id)->where('permission', 'show')->pluck('chapter_id')->toArray();
                      Topic::whereHas('chapters', fn($q) => $q->whereIn('id', $user_allowed_chapters))
                      
     *      
     *  practice public
     *      get topics created by app admins (available for all)
     * 
     * 
     */


    
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    // protected $appends = [
    //     'avatar',
    // ];

    /**
     * Get the profile photo URL attribute.
     *
     * @return string
     */
    public function getAvatarAttribute()
    {
        $nameArray = explode(' ', $this->username);
        $username = count($nameArray) == 1 ? substr($nameArray[0], 0, 2) : substr($nameArray[0], 0, 1).substr($nameArray[1], 0, 1);
        return vsprintf('https://www.gravatar.com/avatar/%s.jpg?s=200&d=%s', [md5(strtolower($this->email)), urlencode("https://ui-avatars.com/api/$username")]);
    }

    /**
     * Get the oauth providers.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function oauthProviders()
    {
        return $this->hasMany(OAuthProvider::class);
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }

    /**
     * @return int
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }


}
