<?php

namespace App\Http\Controllers;

use App\Models\Church;
use App\Transformers\ChurchTransformer;
use Cyvelnet\Laravel5Fractal\Facades\Fractal;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class ChurchController extends Controller
{

    /**
     * Return church collection
     */
    public function index()
    {
        // get all churches
        $churches = Church::all();

        // return a collection of churches
        return Fractal::collection($churches, new ChurchTransformer());
    }


    public function show($id)
    {
        // get the church
        $church = Church::find($id);

        // check if it exists
        if (!$church) {
            return response()->json([
                'error' => [
                    'message' => 'That church was not found.',
                    'code' => 100
                ]
            ], 404);
        }

        // response
        return Fractal::collection($church, new ChurchTransformer());
    }


    public function update(Church $church, Request $request)
    {
        try {
            $this->authorize('update', $church);
        } catch (\Exception $ex) {
            return response()->json([
                'error' => [
                    'message' => 'Not authorized to update a church.',
                    'code' => 100
                ]
            ], 500);
        }

        $church->name = $request->input('name');
        $church->address = $request->input('address');
        $church->address2 = $request->input('address2');
        $church->city = $request->input('city');
        $church->state = $request->input('state');
        $church->zipcode = $request->input('zipcode');

        // save church
        if($church->save()) {
            return Fractal::collection($church, new ChurchTransformer());
        } else {
            return response()->json([
                'error' => [
                    'message' => 'Could not update church.',
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
                    'message' => 'Not authorized to create a church.',
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

        $church = new Church;

        $church->name = $request->input('name');
        $church->address = $request->input('address');
        $church->address2 = $request->input('address2');
        $church->city = $request->input('city');
        $church->state = $request->input('state');
        $church->zipcode = $request->input('zipcode');

        // save church
        if($church->save()) {
            return Fractal::collection($church, new ChurchTransformer());
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
