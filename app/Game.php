<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $primaryKey = 'game_id';

    public function servers(){
        $this->hasMany('App\Server');
    }
}
