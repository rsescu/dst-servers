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
        $users = [
            [
                'server_id' => 1,
                'game_id'   => 1,
                'name'      => 'Greii Greilor',
            ]
        ];
        DB::table('servers')->insert($users);
    }
}
