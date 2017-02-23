<?php

namespace App\Http\Controllers;

use App\Models\GroupType;
use App\Transformers\GroupTransformer;
use App\Transformers\GroupTypeTransformer;
use Cyvelnet\Laravel5Fractal\Facades\Fractal;
use Illuminate\Http\Request;

class GroupTypeController extends ApiController
{
    /**
     * Return church collection
     */
    public function index()
    {
        // get all churches
        $groups = GroupType::all();

        // return a collection of churches
        return Fractal::collection($groups, new GroupTypeTransformer());
    }


    public function show($id)
    {
        // get the church
        $group_type = GroupType::find($id);

        // check if it exists
        if (!$group_type) {
            $this->respondNotFound('Group type does not exist');
        }

        // response
        return Fractal::item($group_type, new GroupTypeTransformer());
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
            'address' => 'required',
            'city' => 'required|max:64',
            'state' => 'required|max:2',
            'zipcode' => 'required|max:9'
        ]);

        $group = new Group();

        $group->name = $request->input('name');
        $group->members = $request->input('members');
        $group->group_type_id = $request->input('group_type_id');
        $group->person_id = $request->input('person_id');

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
