<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Transformers\ProjectTransformer;
use Cyvelnet\Laravel5Fractal\Facades\Fractal;
use Illuminate\Http\Request;

/**
 * Class ProjectController
 * @package App\Http\Controllers
 */
class ProjectController extends ApiController
{

    /**
     * @return mixed
     */
    public function index()
    {
        // get all churches
        $projects = Project::all();

        // return a collection of churches
        return Fractal::collection($projects, new ProjectTransformer());
    }


    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        // get the church
        $project = Project::find($id);

        // check if it exists
        if (!$project) {
            return response()->json([
                'error' => [
                    'message' => 'That project was not found.',
                    'code' => 100
                ]
            ], 404);
        }

        // response
        return Fractal::collection($project, new ProjectTransformer());
    }


    /**
     * @param Project $project
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Project $project, Request $request)
    {
        try {
            $this->authorize('update', $project);
        } catch (\Exception $ex) {
            return response()->json([
                'error' => [
                    'message' => 'Not authorized to update a project.',
                    'code' => 100
                ]
            ], 500);
        }

        // save church
        if( $project->update($request->all())) {
            return Fractal::collection($project, new ProjectTransformer());
        } else {
            return response()->json([
                'error' => [
                    'message' => 'Could not update project.',
                    'code' => 100
                ]
            ], 500);
        }
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $this->authorize('create');
        } catch (\Exception $ex) {
            return response()->json([
                'error' => [
                    'message' => 'Not authorized to create a project.',
                    'code' => 100
                ]
            ], 500);
        }

        $this->validate($request, [
            'name' => 'required|max:64',
            'address' => 'required',
            'city' => 'required|max:64',
            'state' => 'required|max:2',
            'zipcode' => 'required|max:9'
        ]);

        $project = Project::create($request->all());

        // save church
        if ($project) {
            return Fractal::collection($project, new ProjectTransformer());
        } else {
            return response()->json([
                'error' => [
                    'message' => 'Could not create church.',
                    'code' => 100
                ]
            ], 500);
        }
    }
}
