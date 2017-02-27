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
        return $this->hasMany('App\Models\Group');
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }

    public function volunteers()
    {
        $users_count = DB::table('project_user')
            ->select(DB::raw('sum (volunteer_count) as count'))
            ->where('project_id', '=', $this->id)
            ->first();

        return (int)$users_count->count;
    }
}
