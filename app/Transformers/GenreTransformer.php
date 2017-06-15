<?php
namespace App\Transformers;

use App\Actor;
use App\Character;
use App\Genre;
use App\Movie;
use League\Fractal\TransformerAbstract;

/**
 * Class GenreTransformer
 *
 * @package Transformers
 */
class GenreTransformer extends TransformerAbstract
{

    /**
     * @param  Genre $genre
     * @return array
     */
    public function transform(Genre $genre)
    {
        $movies = $genre->movies;
        return [
            'id' => (int) $genre->id,
            'name' => $genre->name,
            'movies' => $movies->map(function (Movie $movie) {
                return [ 'id' => $movie->id, 'name' => $movie->name ];
            }),
            'actors' => $movies->flatMap(function (Movie $movie) {
                return $movie->characters->map(function (Character $character) {
                    $actor = $character->actor;
                    if (empty($actor)) {
                        return null;
                    }
                    return [
                        'id' => $actor->id,
                        'name' => $actor->name
                    ];
                });
            })
        ];
    }

}
