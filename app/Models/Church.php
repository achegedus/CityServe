<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Church extends Model
{
    //
    protected $fillable = ['address', 'address2', 'city', 'state', 'zipcode', 'name', 'url', 'phone'];


    public function contacts()
    {
        return $this->hasMany('App\Models\User');
    }

    public function servers()
    {
        return $this->hasMany('App\Models\Server');
    }
}
