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
                'name'      => 'Robert',
                'email'     => 'r.sescu@gmail.com',
                'password'  => Hash::make('test'),
            ]
        ];
        DB::table('users')->insert($users);
    }
}
