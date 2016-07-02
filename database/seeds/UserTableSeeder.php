<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        $users = [
            [
                'user_id'   => 1,
                'name'      => 'Robert',
                'email'     => 'r.sescu@gmail.com',
                'password'  => Hash::make('test'),
                'role_id'   => 1,
            ]
        ];
        DB::table('users')->insert($users);
    }
}
