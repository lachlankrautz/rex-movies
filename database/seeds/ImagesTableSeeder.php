<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = Carbon::now();

        Db::table('images')->insert([
            'path' => 'barbara_harris.jpg',
            'deleted_at' => null,
            'created_at' => $time,
            'updated_at' => $time
        ]);
        Db::table('images')->insert([
            'path' => 'beyond_the_black_rainbow.jpg',
            'deleted_at' => null,
            'created_at' => $time,
            'updated_at' => $time
        ]);
        Db::table('images')->insert([
            'path' => 'eva_bourne.jpg',
            'deleted_at' => null,
            'created_at' => $time,
            'updated_at' => $time
        ]);
        Db::table('images')->insert([
            'path' => 'freaky_friday.jpg',
            'deleted_at' => null,
            'created_at' => $time,
            'updated_at' => $time
        ]);
        Db::table('images')->insert([
            'path' => 'javier_bardem.jpg',
            'deleted_at' => null,
            'created_at' => $time,
            'updated_at' => $time
        ]);
        Db::table('images')->insert([
            'path' => 'jodie_foster.jpg',
            'deleted_at' => null,
            'created_at' => $time,
            'updated_at' => $time
        ]);
        Db::table('images')->insert([
            'path' => 'john_astin.jpg',
            'deleted_at' => null,
            'created_at' => $time,
            'updated_at' => $time
        ]);
        Db::table('images')->insert([
            'path' => 'josh_brolin.jpg',
            'deleted_at' => null,
            'created_at' => $time,
            'updated_at' => $time
        ]);
        Db::table('images')->insert([
            'path' => 'michael_rogers.jpg',
            'deleted_at' => null,
            'created_at' => $time,
            'updated_at' => $time
        ]);
        Db::table('images')->insert([
            'path' => 'no_country_for_old_men.jpg',
            'deleted_at' => null,
            'created_at' => $time,
            'updated_at' => $time
        ]);
        Db::table('images')->insert([
            'path' => 'tommy_lee_jones.jpg',
            'deleted_at' => null,
            'created_at' => $time,
            'updated_at' => $time
        ]);
    }
}
