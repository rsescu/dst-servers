<?php

use Illuminate\Database\Seeder;

class OwnerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('owners')->delete();
        $users = [
            [
                'user_id'      => 1,
                'server_id'    => 1,
            ]
        ];
        DB::table('owners')->insert($users);
    }
}
