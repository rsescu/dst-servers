<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();
        $users = [
            [
                'role_id'      => 1,
                'description'  => "Admin",
            ],[
                'role_id'      => 2,
                'description'  => "Regular",
            ]
        ];
        DB::table('roles')->insert($users);
    }
}
