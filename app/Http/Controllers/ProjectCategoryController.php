<?php

namespace App\Http\Controllers;

use App\Models\ProjectCategory;
use App\Transformers\ProjectCategoryTransformer;
use Cyvelnet\Laravel5Fractal\Facades\Fractal;
use Illuminate\Http\Request;

class ProjectCategoryController extends ApiController
{
    public function index()
    {
        // get all churches
        $cats = ProjectCategory::all();

        // return a collection of churches
        return Fractal::collection($cats, new ProjectCategoryTransformer());
    }
}
