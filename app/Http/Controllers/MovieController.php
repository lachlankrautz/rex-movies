<?php

namespace App\Http\Controllers;

use App\Actor;
use App\Character;
use App\Movie;
use Illuminate\Http\Request;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use App\Transformers\MovieTransformer;

class MovieController extends Controller
{
    /** @var Manager $fractal*/
    private  $fractal;

    /**
     * MovieController constructor.
     */
    public function __construct()
    {
        $this->fractal = new Manager();
    }

    /**
     * Create character actor mappings and return the character ids
     *
     * @param  Request $request
     * @return \Illuminate\Support\Collection character ids
     */
    private function get_character_ids(Request $request)
    {
        return collect($request->input('cast', []))->map(function ($character) {
            if (empty($character['actor_id']) || empty($character['character_name'])) {
                return null;
            }
            $actor = Actor::find($character['actor_id']);
            if (empty($actor)) {
                return null;
            }
            return Character::firstOrCreate([
                'name' => $character['character_name'],
                'actor_id' => $actor->id
            ])->id;
        })->filter();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = Movie::get();
        if (sizeof($movies) == 0) {
            return response()->json([ 'errors' => [ 'no movies found' ] ], 404);
        }

        $resource = new Collection($movies, new MovieTransformer());
        return response()->json($this->fractal->createData($resource)->toArray());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movie = $this->get_movie($id);
        if ($movie === null) {
            return response()->json([ 'errors' => [ 'movie not found' ] ], 404);
        }

        $resource = new Item($movie, new MovieTransformer());
        return response()->json($this->fractal->createData($resource)->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $request->input('name');
        $rating = $request->input('rating', null);
        $description = $request->input('description');
        $genre_ids = $request->input('genres', []);

        if (empty($name) || empty($description) || !is_array($genre_ids)) {
            return response()->json([ 'errors' => [ 'Unprocessable  entity' ] ], 422);
        }

        $movie = Movie::firstOrCreate([
            'name' => $name,
            'rating' => $rating,
            'description' => $description,
        ]);
        $movie->genres()->sync($genre_ids);
        $movie->characters()->sync($this->get_character_ids($request));
        $resource = new Item($movie, new MovieTransformer());
        return response()->json($this->fractal->createData($resource)->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $movie = $this->get_movie($id);
        if ($movie === null) {
            return response()->json([ 'errors' => [ 'movie not found' ] ], 404);
        }

        $name = $request->input('name');
        $rating = $request->input('rating', null);
        $description = $request->input('description');
        $genre_ids = $request->input('genres', []);

        if (empty($name) || empty($description) || !is_array($genre_ids)) {
            return response()->json([ 'errors' => [ 'Unprocessable  entity' ] ], 422);
        }
        $movie->genres()->sync($genre_ids);
        $movie->characters()->sync($this->get_character_ids($request));

        $changes = false;
        if ($name != $movie->name) {
            $movie->name = $name;
            $changes = true;
        }
        if ($description != $movie->description) {
            $movie->description = $description;
            $changes = true;
        }
        if ($rating != $movie->rating) {
            $movie->rating = $rating;
            $changes = true;
        }
        if ($changes) {
            $movie->save();
        }

        $resource = new Item($movie, new MovieTransformer());
        return response()->json($this->fractal->createData($resource)->toArray());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = $this->get_movie($id);
        if ($movie === null) {
            return response()->json([ 'errors' => [ 'movie not found' ] ], 404);
        }

        $movie->delete();
        return response()->json([ 'messages' => [ 'movie deleted' ] ], 200);
    }

    /**
     * @param  int $id
     * @return null|Movie
     */
    private function get_movie ($id) {
        $movie = Movie::find($id);
        if (empty($movie)) {
            return null;
        }
        return $movie;
    }

}
