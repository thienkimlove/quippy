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
        DB::table('user_clippeds')->insert([

//            ['name' => 'HairLee Coffee' ,'system_token' => '12345' ],
//            ['name' => 'Area Coffee' ,'system_token' => '12345' ],
//            ['name' => 'Ambition Coffee' ,'system_token' => '12345' ],


            ['name' => 'HairLee Clipped', 'latitudine' => 1000, 'longitudine' => 2000, 'user_id' => 1],
            ['name' => 'Ambition Clipped', 'latitudine' => 1000, 'longitudine' => 2000, 'user_id' => 2],
            ['name' => 'Area Clipped', 'latitudine' => 1000, 'longitudine' => 2000, 'user_id' => 3]
        ]);
    }

}
