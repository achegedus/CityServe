<?php

namespace App\Http\Controllers;

use App\Models\Church;
use App\Transformers\ChurchTransformer;
use EllipseSynergie\ApiResponse\Contracts\Response;
use Illuminate\Http\Request;

class ChurchController extends Controller
{
    protected $response;

    /**
     * ChurchController constructor.
     * @param Response $response
     */
    public function __construct(Response $response)
    {
        $this->response = $response;
    }


    /**
     * Return church collection
     */
    public function index()
    {
        // get all churches
        $churches = Church::all();

        // return a collection of churches
        return $this->response->withCollection($churches, new ChurchTransformer());
    }


    public function show($id)
    {
        //Get the task
        $task = Church::find($id);
        if (!$task) {
            return $this->response->errorNotFound('Church Not Found');
        }
        // Return a single task
        return $this->response->withItem($task, new ChurchTransformer());
    }


    public function update($id, Request $request)
    {
        //Get the church
        $church = Church::find($request->church_id);
        if (!$church) {
            return $this->response->errorNotFound('Church Not Found');
        }

        try {
            $this->authorize('update', $church);
        } catch (\Exception $ex) {
            return $this->response->errorForbidden('Not authorized to update a church');
        }

        $church->id = $request->input('church_id');
        $church->name = $request->input('name');
        $church->address = $request->input('address');
        $church->address2 = $request->input('address2');
        $church->city = $request->input('city');
        $church->state = $request->input('state');
        $church->zipcode = $request->input('zipcode');

        if($church->save()) {
            return $this->response->withItem($church, new  ChurchTransformer());
        } else {
            return $this->response->errorInternalError('Could not updated/created a church');
        }
    }


    public function store(Request $request)
    {
        $church = new Church;

        try {
            $this->authorize('create', $church);
        } catch (\Exception $ex) {
            return $this->response->errorForbidden('Not authorized to create a church');
        }

        $church->id = $request->input('church_id');
        $church->name = $request->input('name');
        $church->address = $request->input('address');
        $church->address2 = $request->input('address2');
        $church->city = $request->input('city');
        $church->state = $request->input('state');
        $church->zipcode = $request->input('zipcode');

        if($church->save()) {
            return $this->response->withItem($church, new  ChurchTransformer());
        } else {
            return $this->response->errorInternalError('Could not updated/created a church');
        }
    }
}
