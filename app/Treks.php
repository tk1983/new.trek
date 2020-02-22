<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Treks extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
