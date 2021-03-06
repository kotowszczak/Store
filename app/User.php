<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {

    use Notifiable;

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

    public function roles() {
        return $this->belongsToMany(Roles::class, 'roles_has_users', 'users_id', 'roles_id')->withTimestamps();
    }

    public function isAdmin() {
        if ($this->roles()->where('name', 'Admin')->exists())
            return true;
        return false;
    }


    public function cart() {
        return $this->hasOne('App\Cart2');
    }

   
    public function addresses() {
        return $this->hasMany(Address::class);
    }

}
