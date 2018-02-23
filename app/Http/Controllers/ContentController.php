<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Project;
use App\Transformers\ContentTransformer;
use App\Transformers\StatsTransformer;
use Cyvelnet\Laravel5Fractal\Facades\Fractal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ContentController extends ApiController
{
    //

    public function index()
    {
        $contents = Content::all();

        return Fractal::collection($contents, new ContentTransformer());
    }


    public function stats()
    {
        $firstofyear = Carbon::createFromDate(null, 1, 1);

        $volunteers_needed_count = Project::where('created_at', '>', $firstofyear)->get()->sum('numVolunteers');
        $volunteers_signed_up = DB::table('volunteers')->select(DB::raw('sum(number_of_volunteers) as totalVols'))->where('created_at', '>', $firstofyear)->first();
        $project_count = Project::where('created_at', '>', $firstofyear)->get()->count();

        if (!$volunteers_signed_up->totalVols) {
            $volunteers_signed_up->totalVols = 0;
        }

        $thisStat = new \stdClass();
        $thisStat->totalVolsNeeded = $volunteers_needed_count;
        $thisStat->totalVolsRegistered = $volunteers_signed_up->totalVols;
        $thisStat->project_count = $project_count;

        return Fractal::item($thisStat, new StatsTransformer());
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
