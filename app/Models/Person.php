<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];


    // Relationships

    public function group()
    {
        return $this->belongsTo('App\Models\Group');
    }

    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }

    public function church()
    {
        return $this->belongsTo('App\Models\Church');
    }
}
