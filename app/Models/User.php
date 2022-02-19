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
