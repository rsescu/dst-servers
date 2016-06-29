<?php

namespace App\Http\Controllers;

use App\Server;
use Illuminate\Http\Request;

use App\Http\Requests;

class ServerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user_id = \Auth::user()->user_id;
        $user = \App\User::find($user_id);
        $owned_servers = $user->ownsServer;
        $admin_to_servers = $user->administersServers;
        $data = [
            'owned_servers' => $owned_servers,
            'admined'       => $admin_to_servers
        ];
        return view("servers", $data);
    }

}
