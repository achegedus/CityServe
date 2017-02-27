<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'church_id', 'address', 'city', 'state', 'zipcode', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Relationships

    /**
     * The roles that belong to the user.
     */
    public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    }

    public function projects()
    {
        return $this->belongsToMany('App\Models\Project');
    }

    public function selected_roles()
    {
        $out = [];
        foreach ($this->roles as $role) {
            $thisRole = ['id' => $role->id, 'name' => $role->name];
            $out[] = $thisRole;
        }
        return $out;
    }


    public function church()
    {
        return $this->belongsTo('App\Models\Church');
    }


    // Methods

    public function isAdmin()
    {
        if ($this->isSuperAdmin() || $this->isReviewer())
            return true;
        else
            return false;
    }

    public function isSuperAdmin()
    {
        if ($this->roles->where('name', 'SuperAdmin')->first())
            return true;
        else
            return false;
    }

    public function isChurchContact()
    {
        if ($this->roles->where('name', 'ChurchContact')->first())
            return true;
        else
            return false;
    }

    public function isVolunteer()
    {
        if ($this->roles->where('name', 'Volunteer')->first())
            return true;
        else
            return false;
    }

    public function isVolunteerGroupContact()
    {
        if ($this->roles->where('name', 'VolunteerGroupContact')->first())
            return true;
        else
            return false;
    }

    public function isReviewer()
    {
        if ($this->roles->where('name', 'Reviewer')->first())
            return true;
        else
            return false;
    }

}
