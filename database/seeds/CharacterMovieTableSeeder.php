<?php

use App\Character;
use App\Movie;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CharacterMovieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = Carbon::now();

        // Start: Beyond the Black Rainbow
        $rainbow = Movie::where('name', '=', 'Beyond the Black Rainbow')->firstOrFail()->id;
        Db::table('character_movie')->insert([
            'movie_id' => $rainbow,
            'character_id' => Character::where('name', '=', 'Barry Nye')->firstOrFail()->id,
            'deleted_at' => null,
            'created_at' => $time,
            'updated_at' => $time
        ]);
        Db::table('character_movie')->insert([
            'movie_id' => $rainbow,
            'character_id' => Character::where('name', '=', 'Elena')->firstOrFail()->id,
            'deleted_at' => null,
            'created_at' => $time,
            'updated_at' => $time
        ]);
        Db::table('character_movie')->insert([
            'movie_id' => $rainbow,
            'character_id' => Character::where('name', '=', 'Dr. Mercurio Arboria')->firstOrFail()->id,
            'deleted_at' => null,
            'created_at' => $time,
            'updated_at' => $time
        ]);
        // End: Beyond the Black Rainbow

        // Start: Freaky friday
        $freaky = Movie::where('name', '=', 'Freaky Friday')->firstOrFail()->id;
        Db::table('character_movie')->insert([
            'movie_id' => $freaky,
            'character_id' => Character::where('name', '=', 'Mrs. Andrews')->firstOrFail()->id,
            'deleted_at' => null,
            'created_at' => $time,
            'updated_at' => $time
        ]);
        Db::table('character_movie')->insert([
            'movie_id' => $freaky,
            'character_id' => Character::where('name', '=', 'Annabel')->firstOrFail()->id,
            'deleted_at' => null,
            'created_at' => $time,
            'updated_at' => $time
        ]);
        Db::table('character_movie')->insert([
            'movie_id' => $freaky,
            'character_id' => Character::where('name', '=', 'Mr. Andrews')->firstOrFail()->id,
            'deleted_at' => null,
            'created_at' => $time,
            'updated_at' => $time
        ]);
        // End: Freaky friday

        // Start: No country for old men
        $no_country = Movie::where('name', '=', 'No Country for Old Men')->firstOrFail()->id;
        Db::table('character_movie')->insert([
            'movie_id' => $no_country,
            'character_id' => Character::where('name', '=', 'Ed Tom Bell')->firstOrFail()->id,
            'deleted_at' => null,
            'created_at' => $time,
            'updated_at' => $time
        ]);
        Db::table('character_movie')->insert([
            'movie_id' => $no_country,
            'character_id' => Character::where('name', '=', 'Anton Chigurh')->firstOrFail()->id,
            'deleted_at' => null,
            'created_at' => $time,
            'updated_at' => $time
        ]);
        Db::table('character_movie')->insert([
            'movie_id' => $no_country,
            'character_id' => Character::where('name', '=', 'Llewelyn Moss')->firstOrFail()->id,
            'deleted_at' => null,
            'created_at' => $time,
            'updated_at' => $time
        ]);
        // End: No country for old men
    }
}
