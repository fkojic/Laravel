<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Automobili extends Model
{
	public $table = "automobili";
	protected $fillable = [
        'ime', 'cena', 'godiste', 'km', 'slika', 'user_id', 'kategorija_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */


    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }
}
