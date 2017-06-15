<?php

use App\Movie;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ImageMovieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = Carbon::now();
        $data_images = Db::table('images')->get();
        $image = [];
        foreach ($data_images as $data_image) {
            $image[$data_image->path] = $data_image->id;
        }

        Db::table('image_movie')->insert([
            'movie_id' => Movie::where('name', '=', 'Beyond the Black Rainbow')->firstOrFail()->id,
            'image_id' => $image['beyond_the_black_rainbow.jpg'],
            'deleted_at' => null,
            'created_at' => $time,
            'updated_at' => $time
        ]);
        Db::table('image_movie')->insert([
            'movie_id' => Movie::where('name', '=', 'Freaky Friday')->firstOrFail()->id,
            'image_id' => $image['freaky_friday.jpg'],
            'deleted_at' => null,
            'created_at' => $time,
            'updated_at' => $time
        ]);
        Db::table('image_movie')->insert([
            'movie_id' => Movie::where('name', '=', 'No Country for Old Men')->firstOrFail()->id,
            'image_id' => $image['no_country_for_old_men.jpg'],
            'deleted_at' => null,
            'created_at' => $time,
            'updated_at' => $time
        ]);
    }
}
