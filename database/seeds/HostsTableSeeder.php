<?php

use Illuminate\Database\Seeder;

class HostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hosts')->delete();
        $hosts = [
            [
                'host_id'   => 1,
                'server_id' => 1,
                'name'      => 'Azure VM',
                'external_ip'  => '40.114.196.95',
            ]
        ];
        DB::table('hosts')->insert($hosts);
    }
}
