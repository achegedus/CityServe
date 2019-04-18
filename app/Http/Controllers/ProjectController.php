<?php

namespace App\Http\Controllers;

use App\Mail\GroupSignup;
use App\Mail\IndividualSignup;
use App\Mail\ProjectCreated;
use App\Models\Group;
use App\Models\Project;
use App\Models\User;
use App\Models\Server;
use App\Transformers\GroupTransformer;
use App\Transformers\ProjectTransformer;
use App\Transformers\UserTransformer;
use App\Transformers\ServerTransformer;
use Cyvelnet\Laravel5Fractal\Facades\Fractal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use SebastianBergmann\CodeCoverage\Report\Xml\Report;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;

/**
 * Class ProjectController
 * @package App\Http\Controllers
 */
class ProjectController extends ApiController
{

    /**
     * @return mixed
     */
    public function index()
    {
        // $firstofyear = Carbon::createFromDate(null, 1, 1);

        // get all churches
        // $projects = Project::with('category')->where('created_at', '>', $firstofyear)->get();
        $projects = Project::with('category')->get();

        // return a collection of churches
        return Fractal::includes(['project_category'])->collection($projects, new ProjectTransformer());
    }


    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        // get the church
        $project = Project::find($id);

        // check if it exists
        if (!$project) {
            return response()->json([
                                        'error' => [
                                            'message' => 'That project was not found.',
                                            'code' => 100
                                        ]
                                    ], 404);
        }

        // response
        return Fractal::item($project, new ProjectTransformer());
    }


    /**
     * @param Request $request
     * @param $project_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $project_id)
    {
        $project = Project::find($project_id);

        if (!$project) {
            return $this->respondNotFound('Project does not exist.');
        }

        try {
            $this->authorize('create', Project::class);
        } catch (\Exception $ex) {
            $this->respondNotAuthorized('Not authorized to create a project.');
        }

        // save church
        if ($project->update($request->all())) {
            return Fractal::item($project, new ProjectTransformer());
        } else {
            return response()->json([
                                        'error' => [
                                            'message' => 'Could not update project.',
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
            $this->authorize('create', Project::class);
        } catch (\Exception $ex) {
            $this->respondNotAuthorized('Not authorized to create a project.');
        }

        $this->validate($request, [
            'requester_contact_name' => 'required',
            'requester_address' => 'required',
            'requester_city' => 'required',
            'requester_state' => 'required',
            'requester_zipcode' => 'required',
            'requester_phone' => 'required',
            'requester_email' => 'required',
            'event_contact_name' => 'required',
            'event_contact_phone' => 'required',
            'event_address' => 'required',
            'event_city' => 'required',
            'event_state' => 'required',
            'event_zipcode' => 'required',
            'event_phone' => 'required',
            'directions' => 'required',
            'parking' => 'required',
            'description' => 'required',
            'day' => 'required',
            'time' => 'required',
            'numVolunteers' => 'required',
            'howUsed' => 'required',
            'skills' => 'required',
            'materialsRequesterWill' => 'required',
            'materialsRequesterCannot' => 'required',
        ]);

        $project = Project::create($request->all());

        // save church
        if ($project) {
            // send mail
            Mail::to($project->requester_email)->send(new ProjectCreated($project));

            return Fractal::item($project, new ProjectTransformer());
        } else {
            $this->respondInternalError('Project was not created.');
        }
    }


    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id) {
        $project = Project::find($id);

        if ($project->approved) {
            $this->respondWithError('Project is approved, can not be deleted');
        } else if ($project) {
            $project->delete();
        } else {
            $this->respondNotFound('Project not found.');
        }
    }


    /**
     * @param $project_id
     * @return mixed
     */
    public function project_volunteers($project_id)
    {
        $users = Project::find($project_id)->users;

        if (!$users) {
            return $this->respondNotFound('No volunteers found.');
        }

        return Fractal::collection($users, new UserTransformer());
    }

    /**
     * @param $project_id
     * @return mixed
     */
    public function project_servers($project_id)
    {
        $users = Project::find($project_id)->servers;

        if (!$users) {
            return $this->respondNotFound('No servers found.');
        }

        return Fractal::collection($users, new ServerTransformer());
    }


    /**
     * @param $project_id
     * @param $user_id
     * @return mixed
     */
    public function store_project_volunteer(Request $request, $project_id)
    {
        $project = Project::find($project_id);

        if (!$project) {
            return $this->respondNotFound('Project does not exist.');
        }
        $user = $request->user();

        if (!$user) {
            return $this->respondNotFound('User does not exist.');
        }

        $project->users()->save($user, ['leader' => $request->willLead]);

        Mail::to($user->email)->send(new IndividualSignup($project, $user));

        $this->respondOk('Project saved');
    }

    /**
     * @param $project_id
     * @return mixed
     */
    public function store_project_server(Request $request, $project_id)
    {
        $project = Project::find($project_id);

        if (!$project) {
            return $this->respondNotFound('Project does not exist.');
        }

        $server = $project->servers()->create([
            'project_id' => $project_id,
            'name' => $request->name, 
            'email' => $request->email, 
            'phone' => $request->phone, 
            'number_of_volunteers' => $request->number_of_volunteers,
            'willing_to_lead' => $request->willing_to_lead, 
            'church_id' => $request->church_id, 
            'willing_to_lead' => $request->willing_to_lead]);

        Mail::to($server->email)->send(new IndividualSignup($project, $server));

        $this->respondOk('Project saved');
    }


    /**
     * @param $project_id
     * @param $user_id
     * @return mixed
     */
    public function delete_project_server($project_id, $server_id)
    {
        $project = Project::find($project_id);

        if (!$project) {
            return $this->respondNotFound('Project does not exist.');
        }

        $server = Server::find($server_id);

        if (!$server) {
            return $this->respondNotFound('Server does not exist.');
        }

        $server->delete();
    }


    /**
     * @param $project_id
     * @return mixed
     */
    public function project_groups($project_id)
    {
        $users = Project::find($project_id)->groups;

        if (!$users) {
            return $this->respondNotFound('No groups found.');
        }

        return Fractal::collection($users, new GroupTransformer());
    }


    /**
     * @param $project_id
     * @param $user_id
     * @return mixed
     */
    public function store_project_group($project_id, $group_id)
    {
        $project = Project::find($project_id);

        if (!$project) {
            return $this->respondNotFound('Project does not exist.');
        }

        $group = Group::find($group_id);

        if (!$group) {
            return $this->respondNotFound('Group does not exist.');
        }

        if ($project->groups()->save($group, ['number_of_volunteers' => $group->members, 'group_id' => $group->id])) {
            // send email
            Mail::to($group->user->email)->send(new GroupSignup($project, $group));

            $this->respondOk('Project saved');
        }
    }


    /**
     * @param $project_id
     * @param $user_id
     * @return mixed
     */
    public function delete_project_group($project_id, $group_id)
    {
        $project = Project::find($project_id);

        if (!$project) {
            return $this->respondNotFound('Project does not exist.');
        }

        $group = Group::find($group_id);

        if (!$group) {
            return $this->respondNotFound('Group does not exist.');
        }

        $project->groups()->detach($group);
    }


    public function open_projects(Request $request)
    {
        $category_id = $request->input('category', 'all');

        // $firstofyear = Carbon::createFromDate(null, 1, 1);

        if ($category_id == "all") {
            // get all churches
            $projects = Project::with('category')->where('approved', '=', 1)->get();//where('created_at', '>', $firstofyear)->get();
            $projects = $projects->reject(function($proj) {
                return ($proj->numVolunteers - $proj->volunteers_registered()) == 0;
            });
        } else {
            // get all churches
            $projects = Project::with('category')->where('approved', '=', 1)->where('category_id', '=', $category_id)->get();
            $projects = $projects->reject(function($proj) {
                return ($proj->numVolunteers - $proj->volunteers_registered()) == 0;
            });
        }

        // return a collection of churches
        return Fractal::includes(['project_category'])->collection($projects, new ProjectTransformer());
    }


    public function myProjects(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return $this->respondOk('User does not exist.');
        }

        // get all churches
        $projects = $user->all_projects();

        // return a collection of churches
        return Fractal::includes(['project_category'])->collection($projects, new ProjectTransformer());
    }


    public function printProjectSheets()
    {

        $projects = Project::with('category', 'servers', 'servers.church')->get();


        $pdf = PDF::loadView('pdf.project_sheets', ['projects'=>$projects]);
        $pdf->setPaper('a4', 'landscape');
        $pdf->setOptions(['dpi' => 96, 'defaultFont' => 'sans-serif']);

        return $pdf->stream('projectSheets.pdf');

    }

    public function printSingleProjectSheet($id)
    {

        $projects = Project::with('category', 'servers', 'servers.church')->where('id','=',$id)->get();


        $pdf = PDF::loadView('pdf.project_sheets', ['projects'=>$projects]);
        $pdf->setPaper('a4', 'landscape');
        $pdf->setOptions(['dpi' => 96, 'defaultFont' => 'sans-serif']);

        return $pdf->stream('projectSheets.pdf');

    }
}
