<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Host extends Model
{
    protected $primaryKey = 'host_id';

    public function servers()
    {
        $this->hasMany('App\Server');
    }

}
