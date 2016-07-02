<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    protected $primaryKey = 'server_id';

    public function isOfGame()
    {
        return $this->belongsTo('App\Game', 'game_id');
    }

    public function admins()
    {
        return $this->belongsToMany('App\User', 'admins', 'server_id', 'user_id');
    }

    public function ownedBy()
    {
        return $this->belongsTo('App\User');
    }

    public function hostedOn()
    {
        return $this->belongsTo('App\Host', 'host_id');
    }
}
