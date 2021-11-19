<?php
namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Hash;
use Mail;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable implements JWTSubject /*, MustVerifyEmail*/{
    use Notifiable, HasFactory;

    protected $fillable = ['username', 'phone', 'email', 'password', 'remember_token', 'role', 'status'];

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

    public function scopeAdmin($q){
        return $q->where('role', 'admin');
    }

    public function scopeUser($q){
        return $q->where('role', 'user');
    }

    public function isAdmin(){
        return $this->role == 'admin';
    }

    public function isUser(){
        return $this->role == 'user';
    }


    public static $roles = [
        'admin',
        'user',
    ];
 
    







    
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    // protected $appends = [
    //     'photo_url',
    // ];

    /**
     * Get the profile photo URL attribute.
     *
     * @return string
     */
    /* public function getPhotoUrlAttribute()
    {
        return vsprintf('https://www.gravatar.com/avatar/%s.jpg?s=200&d=%s', [
            md5(strtolower($this->email)),
            $this->name ? urlencode("https://ui-avatars.com/api/$this->name") : 'mp',
        ]);
    } */

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

    public static function rules(){
        return [
            'username' => 'required|unique:users',
            'phone_user' => 'unique:users,phone|numeric|min:7|regex:/(0)[0-9]{9}/',
            'email' => 'unique:users|regex:/(.+)@(.+)\.(.+)/i',
            'password' => 'required|confirmed|min:6'
        ];
    }
    
    public function notifications()
    {
        return $this->belongsToMany(Notification::class, 'user_notifications');
    }


}
