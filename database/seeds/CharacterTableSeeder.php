<?php

use App\Actor;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CharacterTableSeeder extends Seeder
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
        Db::table('characters')->insert([
            'name' => 'Barry Nye',
            'actor_id' => Actor::where('name', '=', 'Michael Rogers')->firstOrFail()->id,
            'deleted_at' => null,
            'created_at' => $time,
            'updated_at' => $time
        ]);
        Db::table('characters')->insert([
            'name' => 'Elena',
            'actor_id' => Actor::where('name', '=', 'Eva Bourne')->firstOrFail()->id,
            'deleted_at' => null,
            'created_at' => $time,
            'updated_at' => $time
        ]);
        Db::table('characters')->insert([
            'name' => 'Dr. Mercurio Arboria',
            'actor_id' => Actor::where('name', '=', 'Scott Hylands')->firstOrFail()->id,
            'deleted_at' => null,
            'created_at' => $time,
            'updated_at' => $time
        ]);
        // End Beyond the Black Rainbow

        // Start: Freaky friday
        Db::table('characters')->insert([
            'name' => 'Mrs. Andrews',
            'actor_id' => Actor::where('name', '=', 'Barbara Harris')->firstOrFail()->id,
            'deleted_at' => null,
            'created_at' => $time,
            'updated_at' => $time
        ]);
        Db::table('characters')->insert([
            'name' => 'Annabel',
            'actor_id' => Actor::where('name', '=', 'Jodie Foster')->firstOrFail()->id,
            'deleted_at' => null,
            'created_at' => $time,
            'updated_at' => $time
        ]);
        Db::table('characters')->insert([
            'name' => 'Mr. Andrews',
            'actor_id' => Actor::where('name', '=', 'John Astin')->firstOrFail()->id,
            'deleted_at' => null,
            'created_at' => $time,
            'updated_at' => $time
        ]);
        // End: Freaky friday

        // Start: No country for old men
        Db::table('characters')->insert([
            'name' => 'Ed Tom Bell',
            'actor_id' => Actor::where('name', '=', 'Tommy Lee Jones')->firstOrFail()->id,
            'deleted_at' => null,
            'created_at' => $time,
            'updated_at' => $time
        ]);
        Db::table('characters')->insert([
            'name' => 'Anton Chigurh',
            'actor_id' => Actor::where('name', '=', 'Javier Bardem')->firstOrFail()->id,
            'deleted_at' => null,
            'created_at' => $time,
            'updated_at' => $time
        ]);
        Db::table('characters')->insert([
            'name' => 'Llewelyn Moss',
            'actor_id' => Actor::where('name', '=', 'Josh Brolin')->firstOrFail()->id,
            'deleted_at' => null,
            'created_at' => $time,
            'updated_at' => $time
        ]);
        // End: No country for old men
    }
}
