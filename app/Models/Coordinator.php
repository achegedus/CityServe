<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coordinator extends Model
{
    //

    protected $fillable = ['name', 'phone', 'email'];


    public function project()
    {
        return $this->hasMany('App\Models\Project');
    }

}
