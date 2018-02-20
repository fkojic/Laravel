<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategorije extends Model
{
	public $table = "kategorije";
    public function automobili()
    {
        return $this->belongsToMany('App\Automobili');
    }
}
