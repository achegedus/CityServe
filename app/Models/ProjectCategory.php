<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectCategory extends Model
{
    //
    protected $fillable = ['name'];

    // Relationships
    public function projects()
    {
        return $this->hasMany('App\Models\Project');
    }
}
