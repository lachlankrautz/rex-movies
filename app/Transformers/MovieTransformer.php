<?php
namespace App\Transformers;

use App\Character;
use App\Genre;
use App\Movie;
use League\Fractal\TransformerAbstract;

/**
 * Class MovieTransformer
 *
 * @package Transformers
 */
class MovieTransformer extends TransformerAbstract
{

    /**
     * @param  Movie $movie
     * @return array
     */
    public function transform(Movie $movie)
    {
        $image = $movie->images->first();
        return [
            'id' => (int) $movie->id,
            'name' => $movie->name,
            'genres' => $movie->genres->map(function (Genre $genre) {
                return [ 'id' => $genre->id, 'name' => $genre->name ];
            }),
            'cast' => $movie->characters->map(function (Character $character) {
                $actor = $character->actor;
                return [
                    'actor' => empty($actor)
                        ? null
                        : [ 'id' => $actor->id, 'name' => $actor->name ],
                    'character' => [ 'id' => $character->id,
                                     'name' => $character->name ]
                ];
            }),
            'rating' => number_format($movie->rating, 2),
            'description' => $movie->description,
            'image' => empty($image)? null: url("/images/{$image->path}")
        ];
    }

}
