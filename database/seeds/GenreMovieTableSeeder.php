<?php

use App\Movie;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class GenreMovieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = Carbon::now();
        $rainbow = Movie::where('name', '=', 'Beyond the Black Rainbow')->firstOrFail()->id;
        $freaky = Movie::where('name', '=', 'Freaky Friday')->firstOrFail()->id;
        $no_country = Movie::where('name', '=', 'No Country for Old Men')->firstOrFail()->id;

        $data_genres = Db::table('genres')->get();
        $genre = [];
        foreach ($data_genres as $data_genre) {
            $genre[$data_genre->name] = $data_genre->id;
        }

        Db::table('genre_movie')->insert([
            'genre_id' => $genre['Crime'],
            'movie_id' => $no_country,
            'deleted_at' => null,
            'created_at' => $time,
            'updated_at' => $time
        ]);
        Db::table('genre_movie')->insert([
            'genre_id' => $genre['Drama'],
            'movie_id' => $no_country,
            'deleted_at' => null,
            'created_at' => $time,
            'updated_at' => $time
        ]);
        Db::table('genre_movie')->insert([
            'genre_id' => $genre['Thriller'],
            'movie_id' => $no_country,
            'deleted_at' => null,
            'created_at' => $time,
            'updated_at' => $time
        ]);

        Db::table('genre_movie')->insert([
            'genre_id' => $genre['Comedy'],
            'movie_id' => $freaky,
            'deleted_at' => null,
            'created_at' => $time,
            'updated_at' => $time
        ]);
        Db::table('genre_movie')->insert([
            'genre_id' => $genre['Family'],
            'movie_id' => $freaky,
            'deleted_at' => null,
            'created_at' => $time,
            'updated_at' => $time
        ]);
        Db::table('genre_movie')->insert([
            'genre_id' => $genre['Fantasy'],
            'movie_id' => $freaky,
            'deleted_at' => null,
            'created_at' => $time,
            'updated_at' => $time
        ]);

        Db::table('genre_movie')->insert([
            'genre_id' => $genre['Sci-Fi'],
            'movie_id' => $rainbow,
            'deleted_at' => null,
            'created_at' => $time,
            'updated_at' => $time
        ]);
        Db::table('genre_movie')->insert([
            'genre_id' => $genre['Thriller'],
            'movie_id' => $rainbow,
            'deleted_at' => null,
            'created_at' => $time,
            'updated_at' => $time
        ]);
    }
}
