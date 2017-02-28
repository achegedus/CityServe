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

    public function volunteers_registered()
    {
        $users_count = DB::table('project_user')
            ->select(DB::raw('sum (volunteer_count) as count'))
            ->where('project_id', '=', $this->id)
            ->first();

        return $query->with(['voters' => function($q)
        {
            return $q->select(DB::raw('count(votables_id) as number_of_votes'))->groupBy('votables_id');
        }]);

        return (int)$users_count->count;
    }
}
