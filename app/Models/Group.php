<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    //
    protected $fillable = ['name', 'members', 'group_type_id', 'person_id'];


    // Relationships
    public function group_type()
    {
        return $this->belongsTo('App\Models\GroupType');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function projects()
    {
        return $this->morphToMany('App\Models\Project', 'volunteer');
    }

}
