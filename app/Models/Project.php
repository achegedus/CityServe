<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //

    // Relationships
    public function requester()
    {
        return $this->belongsTo('App\Models\Requester');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\ProjectCategory');
    }

    public function volunteers()
    {
        // TODO: figure out the volunteer relationship
    }
}
