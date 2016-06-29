<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $primaryKey = 'user_id';
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

    public function administersServers()
    {
        return $this->belongsToMany('App\Server', 'admins', 'user_id', 'server_id');
    }

    public function ownsServer(){
        return $this->hasMany('App\Server', 'server_id', 'user_id');
    }
}
