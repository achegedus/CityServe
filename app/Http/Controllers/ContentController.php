<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Transformers\ContentTransformer;
use Cyvelnet\Laravel5Fractal\Facades\Fractal;
use Illuminate\Http\Request;

class ContentController extends ApiController
{
    //

    public function index()
    {
        $contents = Content::all();

        return Fractal::collection($contents, new ContentTransformer());
    }


    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        // get the church
        $contents = Content::find($id);

        // check if it exists
        if (!$contents) {
            $this->respondNotFound('Content was not found.');
        }

        // response
        return Fractal::item($contents, new ContentTransformer());
    }
}
