<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Church extends Model
{
    //
    protected $fillable = ['address', 'address2', 'city', 'state', 'zipcode', 'name', 'url'];


    public function contacts()
    {
        return $this->hasMany('App\Models\User');
    }

    public function people()
    {
        return $this->hasMany('App\Models\Person');
    }
}
