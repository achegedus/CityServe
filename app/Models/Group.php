<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    //
    protected $fillable = ['name', 'members', 'group_type_id', 'person_id'];


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
