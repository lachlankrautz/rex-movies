<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = Carbon::now();

        Db::table('genres')->insert([
            'name' => 'Thriller',
            'deleted_at' => null,
            'created_at' => $time,
            'updated_at' => $time
        ]);

        Db::table('genres')->insert([
            'name' => 'Drama',
            'deleted_at' => null,
            'created_at' => $time,
            'updated_at' => $time
        ]);

        Db::table('genres')->insert([
            'name' => 'Crime',
            'deleted_at' => null,
            'created_at' => $time,
            'updated_at' => $time
        ]);

        Db::table('genres')->insert([
            'name' => 'Comedy',
            'deleted_at' => null,
            'created_at' => $time,
            'updated_at' => $time
        ]);

        Db::table('genres')->insert([
            'name' => 'Family',
            'deleted_at' => null,
            'created_at' => $time,
            'updated_at' => $time
        ]);

        Db::table('genres')->insert([
            'name' => 'Fantasy',
            'deleted_at' => null,
            'created_at' => $time,
            'updated_at' => $time
        ]);

        Db::table('genres')->insert([
            'name' => 'Sci-Fi',
            'deleted_at' => null,
            'created_at' => $time,
            'updated_at' => $time
        ]);
    }
}
