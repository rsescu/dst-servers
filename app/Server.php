<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    protected $primaryKey = 'server_id';

    public function isOfGame()
    {
        return $this->belongsTo('App\Game');
    }

    public function admins()
    {
        $this->belongsToMany('App\User', 'admins', 'server_id', 'user_id');
    }

    public function ownedBy(){
        $this->belongsTo('App\User', 'owners', 'user_id');
    }
}
