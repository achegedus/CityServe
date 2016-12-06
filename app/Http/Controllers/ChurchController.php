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
}
