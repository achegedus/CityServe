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
class ProjectController extends Controller
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

        $project->requester_id = $request->input('requester_id');
        $project->event_contact_name = $request->input('event_contact_name');
        $project->event_contact_phone = $request->input('event_contact_phone');
        $project->address = $request->input('address');
        $project->secondary_address = $request->input('secondary_address');
        $project->city = $request->input('city');
        $project->state = $request->input('state');
        $project->zipcode = $request->input('zipcode');
        $project-> = $request->input('');


        'city' => $resource->city,
        'state' => $resource->state,
        'zipcode' => $resource->zipcode,
        'phone' => $resource->phone,
        'directions' => $resource->directions,
        'parking' => $resource->parking,
        'description' => $resource->description,
        'day' => $resource->day,
        'time' => (int) $resource->time,
        'numVolunteers' => (int) $resource->numVolunteers,
        'family' => (bool) $resource->family,
        'howUsed' => $resource->howUsed,
        'skills' => $resource->skills,
        'materialsRequesterWill' => $resource->materialsRequesterWill,
        'materialsRequesterCannot' => $resource->materialsRequesterCannot,
        'materialsCityServe' => $resource->materialsCityServe,
        'evaluated' => (bool) $resource->evaluated,
        'approved' => (bool) $resource->approved,
        'assigned' => (bool) $resource->assigned,
        'evaluator_id' => (int) $resource->evaluator_id,
        'category_id' => (int) $resource->category_id,
        'volunteers_needed' => (int) $resource->volunteers_needed,
        'notes' => $resource->notes,
        'coordinator_id' => (int) $resource->coordinator_id,
        'confirmed' => (bool) $resource->confirmed,
        'short_description' => $resource->short_description,
        'created_at' => $resource->created_at,
        'updated_at' => $resource->updated_at,

        $project->name = $request->input('name');
        $church->address = $request->input('address');
        $church->address2 = $request->input('address2');
        $church->city = $request->input('city');
        $church->state = $request->input('state');
        $church->zipcode = $request->input('zipcode');

        // save church
        if ($project->save()) {
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

        $project = new Project();

        $church->name = $request->input('name');
        $church->address = $request->input('address');
        $church->address2 = $request->input('address2');
        $church->city = $request->input('city');
        $church->state = $request->input('state');
        $church->zipcode = $request->input('zipcode');

        // save church
        if ($project->save()) {
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
