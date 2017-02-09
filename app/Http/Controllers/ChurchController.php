<?php

namespace App\Http\Controllers;

use App\Models\Church;
use App\Transformers\ChurchTransformer;
use Cyvelnet\Laravel5Fractal\Facades\Fractal;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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


    public function update($id, Request $request)
    {
        $church = Church::findOrFail($id);

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


        // save church
        if($church->update($request->all())) {
            return Fractal::item($church, new ChurchTransformer());
        } else {
            return response()->json([
                'error' => [
                    'message' => 'Could not update church.',
                    'code' => 100
                ]
            ], 500);
        }
    }


    public function destroy($id) {
        $church = Church::findOrFail($id);
        if ($church) {
            $church->delete();
            return response()->json([], 200);
        } else {
            return response()->json([
                'error' => [
                    'message' => 'Church not found.',
                    'code' => 200
                ]
            ], 500);
        }

    }


    public function store(Request $request)
    {
        try {
            $this->authorize('create', Church::class);
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

        $church = Church::create($request->all());

        // save church
        if($church) {
            return Fractal::item($church, new ChurchTransformer());
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
