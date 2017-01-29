<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    //

    // Relationships

    public function group()
    {
        return $this->belongsTo('App\Models\Group');
    }

    public function church()
    {
        return $this->belongsTo('App\Models\Church');
    }
}
