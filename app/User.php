<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Laravel\Passport\HasApiTokens;
// use QCod\Gamify\HasReputations;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar', 'xp'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function viagems()
    {
        return $this->hasMany(Viagem::class);
    }

    public function review()
    {
        return $this->hasMany(Review::class);
    }

    public function produtos()
    {
        return $this->hasMany(Produto::class);
    }

    public function userBadge()
    {
        return $this->hasMany(UserBadge::class);
    }
}
