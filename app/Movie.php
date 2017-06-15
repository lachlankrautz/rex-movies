<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movie extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'rating', 'description'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [ ];

    public function genres()
    {
        return $this->belongsToMany('App\\Genre');
    }

    public function characters()
    {
        return $this->belongsToMany('App\\Character');
    }

    public function images()
    {
        return $this->belongsToMany('App\\Image');
    }

}
