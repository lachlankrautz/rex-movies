<?php
namespace App\Http\Controllers;
use App\Actor;
use App\Transformers\ActorTransformer;
use Illuminate\Http\Request;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class ActorController extends Controller
{
    /** @var Manager $fractal*/
    private  $fractal;

    /**
     * ActorController constructor.
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
        $actors = Actor::get();
        if (sizeof($actors) == 0) {
            return response()->json([ 'errors' => [ 'no actors found' ] ], 404);
        }

        $resource = new Collection($actors, new ActorTransformer());
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
        $dob = $request->input('dob', null);
        $bio = $request->input('bio');

        if (empty($name) || empty($bio)) {
            return response()->json([ 'errors' => [ 'Unprocessable  entity' ] ], 422);
        }

        $actor = Actor::firstOrCreate([
            'name' => $name,
            'dob' => $dob,
            'bio' => $bio,
        ]);
        echo print_r($_FILES, true);
        $resource = new Item($actor, new ActorTransformer());
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
        $actor = $this->get_actor($id);
        if ($actor === null) {
            return response()->json([ 'errors' => [ 'actor not found' ] ], 404);
        }

        $resource = new Item($actor, new ActorTransformer());
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
        $actor = $this->get_actor($id);
        if ($actor === null) {
            return response()->json([ 'errors' => [ 'actor not found' ] ], 404);
        }

        $name = $request->input('name');
        $dob = $request->input('dob', null);
        $bio = $request->input('bio');

        if (empty($name) || empty($bio)) {
            return response()->json([ 'errors' => [ 'Unprocessable  entity' ] ], 422);
        }

        $changes = false;
        if ($name != $actor->name) {
            $actor->name = $name;
            $changes = true;
        }
        if ($bio != $actor->bio) {
            $actor->bio = $bio;
            $changes = true;
        }
        if ($dob != $actor->dob) {
            $actor->dob = $dob;
            $changes = true;
        }
        if ($changes) {
            $actor->save();
        }

        $resource = new Item($actor, new ActorTransformer());
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
        $actor = $this->get_actor($id);
        if ($actor === null) {
            return response()->json([ 'errors' => [ 'actor not found' ] ], 404);
        }

        $actor->delete();
        return response()->json([ 'messages' => [ 'actor deleted' ] ], 200);
    }

    /**
     * @param  int $id
     * @return null|Actor
     */
    private function get_actor ($id) {
        $actor = Actor::find($id);
        if (empty($actor)) {
            return null;
        }
        return $actor;
    }

}
