<?php

namespace App\Http\Controllers;

use App\Models\Church;
use App\Transformers\ChurchTransformer;
use Cyvelnet\Laravel5Fractal\Facades\Fractal;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChurchController extends ApiController
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


    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        // get the church
        $church = Church::find($id);

        // check if it exists
        if (!$church) {
            $this->respondNotFound('Church was not found.');
        }

        // response
        return Fractal::item($church, new ChurchTransformer());
    }


    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, Request $request)
    {
        $church = Church::findOrFail($id);

        try {
            $this->authorize('update', $church);
        } catch (\Exception $ex) {
            $this->respondNotAuthorized('Not authorized to update a church.');
        }

        // save church
        if($church->update($request->all())) {
            return Fractal::item($church, new ChurchTransformer());
        } else {
            $this->respondInternalError('Church was not updated.');
        }
    }


    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id) {
        $church = Church::find($id);

        if ($church) {
            $church->delete();
        } else {
            $this->respondNotFound('Church not found.');
        }

    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $this->authorize('create', Church::class);
        } catch (\Exception $ex) {
            $this->respondNotAuthorized('Not authorized to create a church.');
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
            $this->respondInternalError('Church was not created.');
        }
    }
}
