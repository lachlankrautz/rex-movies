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
        $this->call(UsersTableSeeder::class);
        $this->call(MoviesTableSeeder::class);
        $this->call(ActorsTableSeeder::class);
        $this->call(CharacterTableSeeder::class);
        $this->call(GenresTableSeeder::class);
        $this->call(ImagesTableSeeder::class);
        $this->call(ImageMovieTableSeeder::class);
        $this->call(ActorImageTableSeeder::class);
        $this->call(GenreMovieTableSeeder::class);
        $this->call(CharacterMovieTableSeeder::class);
    }
}
