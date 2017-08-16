<?php

namespace App;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function mobiles(){
        return $this->hasMany('App\Mobileaccount','userid');

    }
    public function banks(){
        return $this->hasMany('App\Bankaccount','userid');

    }
    public function transactions(){
        return $this->hasMany('App\Transaction','userid');

    }
}
