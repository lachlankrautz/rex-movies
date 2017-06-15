<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = Carbon::now();
        DB::table('users')->insert([
            'name' => 'joe.dirt',
            'email' => 'testing@gmail.com',
            'password' => bcrypt('secret'),
            'api_token' => str_random(60),
            'created_at' => $time,
            'updated_at' => $time
        ]);
    }
}
