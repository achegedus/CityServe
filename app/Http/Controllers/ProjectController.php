<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Project;
use App\Models\User;
use App\Transformers\GroupTransformer;
use App\Transformers\ProjectTransformer;
use App\Transformers\UserTransformer;
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
        $projects = Project::with('category')->get();

        // return a collection of churches
        return Fractal::includes(['project_category'])->collection($projects, new ProjectTransformer());
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
        return Fractal::item($project, new ProjectTransformer());
    }


    /**
     * @param Request $request
     * @param $project_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $project_id)
    {
        $project = Project::find($project_id);

        if (!$project) {
            return $this->respondNotFound('Project does not exist.');
        }

        try {
            $this->authorize('create', Project::class);
        } catch (\Exception $ex) {
            $this->respondNotAuthorized('Not authorized to create a project.');
        }

        // save church
        if( $project->update($request->all())) {
            return Fractal::item($project, new ProjectTransformer());
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


    /**
     * @param $project_id
     * @return mixed
     */
    public function project_volunteers($project_id)
    {
        $users = Project::find($project_id)->users;

        if (!$users) {
            return $this->respondNotFound('No volunteers found.');
        }

        return Fractal::collection($users, new UserTransformer());
    }


    /**
     * @param $project_id
     * @param $user_id
     * @return mixed
     */
    public function store_project_volunteer($project_id, $user_id)
    {
        $project = Project::find($project_id);

        if (!$project) {
            return $this->respondNotFound('Project does not exist.');
        }

        $user = User::find($user_id);

        if (!$user) {
            return $this->respondNotFound('User does not exist.');
        }

        $project->users()->save($user);
    }


    /**
     * @param $project_id
     * @param $user_id
     * @return mixed
     */
    public function delete_project_volunteer($project_id, $user_id)
    {
        $project = Project::find($project_id);

        if (!$project) {
            return $this->respondNotFound('Project does not exist.');
        }

        $user = User::find($user_id);

        if (!$user) {
            return $this->respondNotFound('User does not exist.');
        }

        $project->users()->detach($user);
    }


    /**
     * @param $project_id
     * @return mixed
     */
    public function project_groups($project_id)
    {
        $users = Project::find($project_id)->groups;

        if (!$users) {
            return $this->respondNotFound('No groups found.');
        }

        return Fractal::collection($users, new GroupTransformer());
    }


    /**
     * @param $project_id
     * @param $user_id
     * @return mixed
     */
    public function store_project_group($project_id, $group_id)
    {
        $project = Project::find($project_id);

        if (!$project) {
            return $this->respondNotFound('Project does not exist.');
        }

        $group = Group::find($group_id);

        if (!$group) {
            return $this->respondNotFound('Group does not exist.');
        }

        $project->groups()->save($group);
    }


    /**
     * @param $project_id
     * @param $user_id
     * @return mixed
     */
    public function delete_project_group($project_id, $group_id)
    {
        $project = Project::find($project_id);

        if (!$project) {
            return $this->respondNotFound('Project does not exist.');
        }

        $group = User::find($group_id);

        if (!$group) {
            return $this->respondNotFound('Group does not exist.');
        }

        $project->groups()->detach($group);
    }
}
