<?php

use Illuminate\Database\Seeder;

class ServerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('servers')->delete();
        $servers = [
            [
                'server_id' => 1,
                'game_id'   => 1,
                'host_id'   => 1,
                'user_id'   => 1,
                'name'      => 'Greii Greilor',
                'run_script'  => 'sh ~/run_dst_rby_cluster_tmux.sh',
            ]
        ];
        DB::table('servers')->insert($servers);
    }
}
