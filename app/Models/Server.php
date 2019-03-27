<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];


    // Relationships
    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }

    public function church()
    {
        return $this->belongsTo('App\Models\Church');
    }
}
