<?php
namespace App\Transformers;

use App\Actor;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

/**
 * Class ActorTransformer
 *
 * @package Transformers
 */
class ActorTransformer extends TransformerAbstract
{

    /**
     * @param  Actor $actor
     * @return array
     */
    public function transform(Actor $actor)
    {
        $image = $actor->images->first();
        $dob = $actor->dob;
        return [
            'id' => (int) $actor->id,
            'name' => $actor->name,
            'dob' => $dob,
            'age' => Carbon::parse($dob)->age,
            'bio' => $actor->bio,
            'image' => empty($image)? null: url("/images/{$image->path}")
        ];
    }

}
