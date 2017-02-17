<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Transformers\PersonTransformer;
use Cyvelnet\Laravel5Fractal\Facades\Fractal;
use Illuminate\Http\Request;

class PersonController extends ApiController
{
    /**
     * @return mixed
     */
    public function index()
    {
        // get all churches
        $people = Person::all();

        // return a collection of churches
        return Fractal::collection($people, new PersonTransformer());
    }


    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        // get the church
        $person = Person::find($id);

        // check if it exists
        if (!$person) {
            return response()->json([
                'error' => [
                    'message' => 'That person was not found.',
                    'code' => 100
                ]
            ], 404);
        }

        // response
        return Fractal::collection($person, new PersonTransformer());
    }


    /**
     * @param Project $project
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Person $person, Request $request)
    {
        try {
            $this->authorize('update', $person);
        } catch (\Exception $ex) {
            return response()->json([
                'error' => [
                    'message' => 'Not authorized to update a person.',
                    'code' => 100
                ]
            ], 500);
        }

        // save church
        if( $person->update($request->all())) {
            return Fractal::collection($person, new PersonTransformer());
        } else {
            return response()->json([
                'error' => [
                    'message' => 'Could not update person.',
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
                    'message' => 'Not authorized to create a person.',
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

        $project = Person::create($request->all());

        // save church
        if ($project) {
            return Fractal::collection($project, new PersonTransformer());
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
