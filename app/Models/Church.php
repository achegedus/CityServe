<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Church extends Model
{
    //

    public function contacts()
    {
        return $this->hasMany('App\Models\User');
    }

    public function people()
    {
        return $this->hasMany('App\Models\Person');
    }
}
