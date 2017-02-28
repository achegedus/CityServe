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
        return $this->morphedByMany('App\Models\Group', 'volunteer');
    }

    public function users()
    {
        return $this->morphedByMany('App\Models\User', 'volunteer');
    }

//    public function volunteers()
//    {
//        $users_count = DB::table('project_user')
//            ->select(DB::raw('sum (volunteer_count) as count'))
//            ->where('project_id', '=', $this->id)
//            ->first();
//
//        return (int)$users_count->count;
//    }
}
