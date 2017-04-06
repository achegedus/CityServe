<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Transformers\GroupTransformer;
use Cyvelnet\Laravel5Fractal\Facades\Fractal;
use Illuminate\Http\Request;

class GroupController extends ApiController
{
    /**
     * Return church collection
     */
    public function index()
    {
        // get all churches
        $groups = Group::with('group_type')->get();

        // return a collection of churches
        return Fractal::includes(['group_type'])->collection($groups, new GroupTransformer());
    }


    public function show($id)
    {
        // get the church
        $group = Group::find($id);

        // check if it exists
        if (!$group) {
            return response()->json([
                'error' => [
                    'message' => 'That group was not found.',
                    'code' => 100
                ]
            ], 404);
        }

        // response
        return Fractal::item($group, new GroupTransformer());
    }


    public function update(Group $group, Request $request)
    {
        $user = $request->user();

        if (!$user->can('update', Group::class)) {
            $this->respondNotAuthorized('Not authorized to update a group.');
        }

        $group->name = $request->input('name');
        $group->members = $request->input('members');
        $group->group_type_id = $request->input('group_type_id');
        $group->person_id = $request->input('person_id');

        // save church
        if($group->save()) {
            return Fractal::collection($group, new GroupTransformer());
        } else {
            return response()->json([
                'error' => [
                    'message' => 'Could not update group.',
                    'code' => 100
                ]
            ], 500);
        }
    }


    public function store(Request $request)
    {
        $user = $request->user();

        if (!$user->can('create', Group::class)) {
            $this->respondNotAuthorized('Not authorized to create a group.');
        }

        $this->validate($request, [
            'name' => 'required|max:64',
            'members' => 'required|numeric',
            'group_type_id' => 'required',
        ]);

        $group = new Group();

        $group->name = $request->input('name');
        $group->members = $request->input('members');
        $group->group_type_id = $request->input('group_type_id')['id'];
        $group->user_id = $user->id;
        $group->project_id = $request->input('project_id');

        // save group
        if($group->save()) {
            return Fractal::item($group, new GroupTransformer());
        } else {
            $this->respondInternalError('Could not create group.');
        }
    }
}
