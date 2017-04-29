<?php

namespace App\Http\Controllers;

use App\Models\Coordinator;
use App\Transformers\CoordinatorTransformer;
use Cyvelnet\Laravel5Fractal\Facades\Fractal;
use Illuminate\Http\Request;

class CoordinatorController extends ApiController
{
    //

    public function index()
    {
        // get all churches
        $coordinators = Coordinator::all();

        // return a collection of churches
        return Fractal::collection($coordinators, new CoordinatorTransformer());
    }
}
