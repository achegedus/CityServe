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
            $this->authorize('create', Project::class);
        } catch (\Exception $ex) {
            $this->respondNotAuthorized('Not authorized to create a project.');
        }

        $this->validate($request, [
            'requester_contact_name' => 'required',
            'requester_address' => 'required',
            'requester_city' => 'required',
            'requester_state' => 'required',
            'requester_zipcode' => 'required',
            'requester_phone' => 'required',
            'requester_email' => 'required',
            'event_contact_name' => 'required',
            'event_contact_phone' => 'required',
            'event_address' => 'required',
            'event_city' => 'required',
            'event_state' => 'required',
            'event_zipcode' => 'required',
            'event_phone' => 'required',
            'directions' => 'required',
            'parking' => 'required',
            'description' => 'required',
            'day' => 'required',
            'time' => 'required',
            'numVolunteers' => 'required',
            'howUsed' => 'required',
            'skills' => 'required',
            'materialsRequesterWill' => 'required',
            'materialsRequesterCannot' => 'required',
        ]);

        $project = Project::create($request->all());

        // save church
        if($project) {
            return Fractal::item($project, new ProjectTransformer());
        } else {
            $this->respondInternalError('Project was not created.');
        }
    }
}
