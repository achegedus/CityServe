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
        try {
            $this->authorize('update', $group);
        } catch (\Exception $ex) {
            return response()->json([
                'error' => [
                    'message' => 'Not authorized to update a group.',
                    'code' => 100
                ]
            ], 500);
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
        try {
            $this->authorize('create');
        } catch (\Exception $ex) {
            return response()->json([
                'error' => [
                    'message' => 'Not authorized to create a group.',
                    'code' => 100
                ]
            ], 500);
        }

        $this->validate($request, [
            'name' => 'required|max:64',
            'members' => 'required|numeric',
            'group_type_id' => 'required',
        ]);

        $group = new Group();

        $group->name = $request->input('name');
        $group->members = $request->input('members');
        $group->group_type_id = $request->input('group_type_id');
        $group->user_id = $request->input('user_id');

        // save group
        if($group->save()) {
            return Fractal::collection($group, new GroupTransformer());
        } else {
            return response()->json([
                'error' => [
                    'message' => 'Could not create group.',
                    'code' => 100
                ]
            ], 500);
        }
    }
}
