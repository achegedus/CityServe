<?php

namespace App\Http\Controllers;

use App\Models\Evaluator;
use App\Transformers\EvaluatorTransformer;
use Cyvelnet\Laravel5Fractal\Facades\Fractal;
use Illuminate\Http\Request;

class EvaluatorController extends ApiController
{
    //

    public function index()
    {
        // get all churches
        $coordinators = Evaluator::all();

        // return a collection of churches
        return Fractal::collection($coordinators, new EvaluatorTransformer());
    }
}
