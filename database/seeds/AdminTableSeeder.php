<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->delete();
        $users = [
            [
                'user_id'      => 1,
                'server_id'    => 1,
            ]
        ];
        DB::table('admins')->insert($users);
    }
}
