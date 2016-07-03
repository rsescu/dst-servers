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

    public static function serverCommands($ip, $command)
    {
        //TODO hardcoded - probably hold against host -> manager user and pass
        $user = env('VM_UNIX_USER', false);;
        $pass = env('VM_UNIX_PASS', false);;
        $ssh = new \phpseclib\Net\SSH2($ip);
        try {
            $ssh->login($user, $pass);
        }catch(\ErrorException $e) {
           return false;
        }
        $return = $ssh->exec($command);
        $ssh->disconnect();
        return $return;

    }

    public function index()
    {
        $user_id = \Auth::user()->user_id;
        $user = \App\User::find($user_id);
        $owned_servers = [];
        foreach($user->ownsServer as $key =>$server) {
            $owned_servers[$key] = new \stdClass();
            $owned_servers[$key]->name = $server->name;
            $owned_servers[$key]->game = $server->isOfGame->name;
            $owned_servers[$key]->host = $server->hostedOn->name;
        }
        //hostedOn->name
        $admin_to_servers = [];
        foreach($user->administersServers as $key =>$server) {
            $admin_to_servers[$key] = new \stdClass();
            $admin_to_servers[$key]->id = $server->server_id;
            $admin_to_servers[$key]->name = $server->name;
            $admin_to_servers[$key]->game = $server->isOfGame->name;
            $admin_to_servers[$key]->host = $server->hostedOn->name;
            $running = self::serverCommands($server->hostedOn->external_ip, "screen -list");

            if($running === false) {
                $admin_to_servers[$key]->status = 0;
            }
            elseif(preg_match('/No Sockets found in/', $running)) {
                $admin_to_servers[$key]->status = 1;
            }
            elseif(preg_match('/\d{3,6}\.(\d|\w)*\s*\(\d{2}\/\d{2}\/\d{4}\s\d{2}\:\d{2}\:\d{2}\s(PM|AM)\)/', $running)) {
                $admin_to_servers[$key]->status = 2;
            }
        }
        $data = [
            'owned_servers' => $owned_servers,
            'admined'       => $admin_to_servers
        ];
        return view("servers", $data);
    }

    public function startServer($serverId)
    {
        $server = Server::find($serverId);
        self::serverCommands($server->hostedOn->external_ip, $server->run_script);
        return \Redirect::to('servers');
    }

    //TODO kill specific
    public function stopServer($serverId)
    {
        $server = Server::find($serverId);
        self::serverCommands($server->hostedOn->external_ip,
            'screen -S DST_rby_cave -X stuff $\'\003\';screen -S DST_rby_master -X stuff $\'\003\'');
        sleep(2);
        self::serverCommands($server->hostedOn->external_ip, "killall screen");
        return \Redirect::to('servers');
    }


}
