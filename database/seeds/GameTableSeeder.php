<?php

use Illuminate\Database\Seeder;

class GameTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('games')->delete();
        $games = [
            [
                'game_id'   => 1,
                'name'      => "Don't Starve Together",
                'icon_location'  => 'resources/assets/images/Dont_Starve_Together_Logo.png',
            ]
        ];
        DB::table('games')->insert($games);
    }
}
