<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupType extends Model
{
    //
    protected $fillable = ['name'];
    public $timestamps = false;


    // Relationships
    public function groups()
    {
        return $this->hasMany('App\Models\Group');
    }
}
