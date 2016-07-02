<?php

namespace App;

use App\Helpers\AzureVmOperationsHandler;
use Illuminate\Database\Eloquent\Model;

class Host extends Model
{
    protected $primaryKey = 'host_id';

    public function servers()
    {
        return $this->hasMany('App\Server', 'server_id', 'host_id');
    }

}
