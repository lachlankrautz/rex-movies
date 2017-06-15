<?php
namespace App\Http\Controllers;
use App\Genre;
use App\Transformers\GenreTransformer;
use Illuminate\Http\Request;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class GenreController extends Controller
{
    /** @var Manager $fractal*/
    private  $fractal;

    /**
     * GenreController constructor.
     */
    public function __construct()
    {
        $this->fractal = new Manager();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $genres = Genre::get();
        if (sizeof($genres) == 0) {
            return response()->json([ 'errors' => [ 'no genres found' ] ], 404);
        }

        $resource = new Collection($genres, new GenreTransformer());
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

        if (empty($name)) {
            return response()->json([ 'errors' => [ 'Unprocessable  entity' ] ], 422);
        }

        $genre = Genre::firstOrCreate([
            'name' => $name,
        ]);
        $genre->movies()->sync($request->input('movies', []));
        $resource = new Item($genre, new GenreTransformer());
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
        $genre = $this->get_genre($id);
        if ($genre === null) {
            return response()->json([ 'errors' => [ 'genre not found' ] ], 404);
        }

        $resource = new Item($genre, new GenreTransformer());
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
        $genre = $this->get_genre($id);
        if ($genre === null) {
            return response()->json([ 'errors' => [ 'genre not found' ] ], 404);
        }

        $name = $request->input('name');

        if (empty($name)) {
            return response()->json([ 'errors' => [ 'Unprocessable  entity' ] ], 422);
        }

        $changes = false;
        if ($name != $genre->name) {
            $genre->name = $name;
            $changes = true;
        }
        if ($changes) {
            $genre->save();
        }
        $genre->movies()->sync($request->input('movies', []));

        $resource = new Item($genre, new GenreTransformer());
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
        $genre = $this->get_genre($id);
        if ($genre === null) {
            return response()->json([ 'errors' => [ 'genre not found' ] ], 404);
        }

        $genre->delete();
        return response()->json([ 'messages' => [ 'genre deleted' ] ], 200);
    }

    /**
     * @param  int $id
     * @return null|Genre
     */
    private function get_genre ($id) {
        $genre = Genre::find($id);
        if (empty($genre)) {
            return null;
        }
        return $genre;
    }

}
