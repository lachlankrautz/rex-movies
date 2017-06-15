<?php

use App\Actor;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ActorImageTableSeeder extends Seeder
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

        Db::table('actor_image')->insert([
            'actor_id' => Actor::where('name', '=', 'Barbara Harris')->firstOrFail()->id,
            'image_id' => $image['barbara_harris.jpg'],
            'deleted_at' => null,
            'created_at' => $time,
            'updated_at' => $time
        ]);
        Db::table('actor_image')->insert([
            'actor_id' => Actor::where('name', '=', 'Eva Bourne')->firstOrFail()->id,
            'image_id' => $image['eva_bourne.jpg'],
            'deleted_at' => null,
            'created_at' => $time,
            'updated_at' => $time
        ]);
        Db::table('actor_image')->insert([
            'actor_id' => Actor::where('name', '=', 'Javier Bardem')->firstOrFail()->id,
            'image_id' => $image['javier_bardem.jpg'],
            'deleted_at' => null,
            'created_at' => $time,
            'updated_at' => $time
        ]);
        Db::table('actor_image')->insert([
            'actor_id' => Actor::where('name', '=', 'Jodie Foster')->firstOrFail()->id,
            'image_id' => $image['jodie_foster.jpg'],
            'deleted_at' => null,
            'created_at' => $time,
            'updated_at' => $time
        ]);
        Db::table('actor_image')->insert([
            'actor_id' => Actor::where('name', '=', 'John Astin')->firstOrFail()->id,
            'image_id' => $image['john_astin.jpg'],
            'deleted_at' => null,
            'created_at' => $time,
            'updated_at' => $time
        ]);
        Db::table('actor_image')->insert([
            'actor_id' => Actor::where('name', '=', 'Josh Brolin')->firstOrFail()->id,
            'image_id' => $image['josh_brolin.jpg'],
            'deleted_at' => null,
            'created_at' => $time,
            'updated_at' => $time
        ]);
        Db::table('actor_image')->insert([
            'actor_id' => Actor::where('name', '=', 'Michael Rogers')->firstOrFail()->id,
            'image_id' => $image['michael_rogers.jpg'],
            'deleted_at' => null,
            'created_at' => $time,
            'updated_at' => $time
        ]);
        Db::table('actor_image')->insert([
            'actor_id' => Actor::where('name', '=', 'Tommy Lee Jones')->firstOrFail()->id,
            'image_id' => $image['tommy_lee_jones.jpg'],
            'deleted_at' => null,
            'created_at' => $time,
            'updated_at' => $time
        ]);
    }
}
