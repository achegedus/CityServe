<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
        return $this->morphedByMany('App\Models\Group', 'volunteer')->withPivot('number_of_volunteers', 'leader');;
    }

    public function users()
    {
        return $this->morphedByMany('App\Models\User', 'volunteer');
    }

    public function volunteers_registered()
    {
        $users_count = 0;

        foreach ($this->groups as $group) {
            $users_count = $users_count + $group->pivot->number_of_volunteers;
        }

        return $users_count;
    }
}
