<?php

namespace App\Models;

use App\Notifications\ResetPassword;
use App\Notifications\VerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject //, MustVerifyEmail
{
    use Notifiable,
        HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'phone',
        'status',
        'password',
        'city_id',
        'area_id',
        'role',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
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

    public function checkRole($role){
        return $this->role == $role;
    }
    public function isAdmin(){
        return $this->role == 1;
    }
    public function isUser(){
        return $this->role == 2;
    }
    public function isSupervisor(){
        return $this->role == 3;
    }
    public function scopeAdmin($q){
        return $q->where('role', 1);
    }
    public function scopeUser($q){
        return $q->where('role', 2);
    }
    public function scopeSupervisor($q){
        return $q->where('role', 3);
    }

    public function places(){
        return $this->hasMany(Place::class, 'supervisor_id');
    }

}
