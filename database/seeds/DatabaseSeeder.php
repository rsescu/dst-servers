<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(GameTableSeeder::class);
        $this->call(HostsTableSeeder::class);
        $this->call(ServerTableSeeder::class);
        $this->call(OwnerTableSeeder::class);
        $this->call(AdminTableSeeder::class);
    }
}
