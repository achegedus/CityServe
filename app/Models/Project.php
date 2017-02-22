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

    public function groups()
    {
        return $this->hasMany('App\Models\Group');
    }

    public function people()
    {
        return $this->hasMany('App\Models\Person');
    }

    public function volunteers()
    {
//        return count($this->people) + count($this->groups);
        return count($this->groups);
    }
}
