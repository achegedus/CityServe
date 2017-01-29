<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    //

    // Relationships
    public function group()
    {
        return $this->belongsTo('App\Models\GroupType');
    }

    public function contact()
    {
        return $this->hasOne('App\Models\Person');
    }
}
