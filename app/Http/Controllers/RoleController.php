<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Transformers\RoleTransformer;
use Cyvelnet\Laravel5Fractal\Facades\Fractal;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    //

    public function index()
    {
        // get all churches
        $roles = Role::all();

        // return a collection of churches
        return Fractal::collection($roles, new RoleTransformer());
    }
}
