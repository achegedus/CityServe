<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //
    protected $guarded = ['id', 'created_at', 'updated_at'];


    // Relationships

    public function category()
    {
        return $this->belongsTo('App\Models\ProjectCategory');
    }

    public function volunteers()
    {
        // TODO: figure out the volunteer relationship
    }
}
