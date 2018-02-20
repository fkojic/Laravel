<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Odobrenje extends Model
{
    public $table = "odobrenja";
	protected $fillable = [
        'odobren', 'automobili_id'
    ];

}
