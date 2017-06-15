<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class MoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = Carbon::now();

        Db::table('movies')->insert([
            'name' => 'No Country for Old Men',
            'rating' => '8.1',
            'description' => 'Llewelyn Moss stumbles upon dead bodies, $2 million and a hoard of heroin in a Texas desert, but methodical killer Anton Chigurh comes looking for it, with local sheriff Ed Tom Bell hot on his trail. The roles of prey and predator blur as the violent pursuit of money and justice collide.',
            'deleted_at' => null,
            'created_at' => $time,
            'updated_at' => $time
        ]);

        Db::table('movies')->insert([
            'name' => 'Freaky Friday',
            'rating' => '6.3',
            'description' => 'School girl Annabel is hassled by her mother, and Mrs. Andrews is annoyed with her daughter, Annabel. They both think that the other has an easy life. On a normal Friday morning, both complain about each other and wish they could have the easy life of their daughter/mother for just one day and their wishes come true as a bit of magic puts Annabel in Mrs. Andrews’ body and vice versa. They both have a Freaky Friday.',
            'deleted_at' => null,
            'created_at' => $time,
            'updated_at' => $time
        ]);

        Db::table('movies')->insert([
            'name' => 'Beyond the Black Rainbow',
            'rating' => '6.0',
            'description' => 'Deep within the mysterious Arboria Institute, a disturbed and beautiful girl is held captive by a doctor in search of inner peace. Her mind controlled by a sinister technology. Silently, she waits for her next session with deranged therapist Dr. Barry Nyle. If she hopes to escape, she must journey through the darkest reaches of The Institute, but Nyle wonʼt easily part with his most gifted and dangerous creation.',
            'deleted_at' => null,
            'created_at' => $time,
            'updated_at' => $time
        ]);

    }
}
