<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Transformers\UserTransformer;
use Cyvelnet\Laravel5Fractal\Facades\Fractal;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends ApiController
{

    /**
     * Return church collection
     */
    public function index()
    {
        try {
            $this->authorize('viewlist', User::class);
        } catch (\Exception $ex) {
            return $this->respondNotAuthorized();
        }

        // get all churches
        $users = User::with('church')->get();

        // return a collection of churches
        return Fractal::includes(['church', 'roles'])->collection($users, new UserTransformer());
    }


    public function getVolunteers()
    {
        try {
            $this->authorize('viewlist', User::class);
        } catch (\Exception $ex) {
            return $this->respondNotAuthorized();
        }

        // get all churches
        $users = User::with('church')->whereHas('roles', function($query) { $query->where('role_id','=',4); })->get();

        // return a collection of churches
        return Fractal::includes(['church', 'roles'])->collection($users, new UserTransformer());
    }


    /**
     * Returns current user profile
     *
     * @param Request $request
     * @return mixed
     */
    public function profile(Request $request)
    {
        // get the church
        $user = $request->user();

        // response
        return Fractal::item($user, new UserTransformer());
    }


    public function show($id)
    {
        // get the church
        $user = User::with('church', 'roles')->find($id);

        // check if it exists
        if (!$user) {
            return $this->respondNotFound('User does not exist.');
        }

        // response
        return Fractal::includes(['church', 'roles'])->item($user, new UserTransformer());
    }


    public function update($id, Request $request)
    {
        $user = User::find($id);

        // check if it exists
        if (!$user) {
            return $this->respondNotFound('User does not exist.');
        }

        try {
            $this->authorize('update', $user);
        } catch (\Exception $ex) {
            return $this->respondNotAuthorized();
        }

        $this->validate($request, [
            'first_name' => 'required|max:64',
            'last_name' => 'required|max:64',
            'address' => 'required',
            'city' => 'required|max:64',
            'state' => 'required|max:2',
            'zipcode' => 'required|max:9',
            'phone' => 'required'
        ]);

        // save church
        if($user->update($request->all())) {
            if ($request->password != null && $request->password != "") {
                $user->password = bcrypt($request->password);
                $user->save();
            }

            if ($roles = $request->input('roles')) {
                $listRoles = array_pluck($roles, 'id');
                $user->roles()->sync($listRoles);
            } else {
                $user->roles()->detach();
            }
            return Fractal::includes(['church', 'roles'])->item($user, new UserTransformer());
        } else {
            return $this->respondWithError('Could not update user.');
        }
    }


    public function destroy($id) {
        $user = User::find($id);

        // check if it exists
        if (!$user) {
            return $this->respondNotFound('User does not exist.');
        }

        try {
            $this->authorize('delete', $user);
        } catch (\Exception $ex) {
            return $this->respondNotAuthorized();
        }

        $user->delete();
        return $this->respondOk();
    }


    public function store(Request $request)
    {
        try {
            $this->authorize('create', User::class);
        } catch (\Exception $ex) {
            return $this->respondNotAuthorized();
        }

        $this->validate($request, [
            'first_name' => 'required|max:64',
            'last_name' => 'required|max:64',
            'address' => 'required',
            'city' => 'required|max:64',
            'state' => 'required|max:2',
            'zipcode' => 'required|max:9',
            'phone' => 'required',
            'password' => 'required'
        ]);

        if ($request->password != null && $request->password != "") {
            $request->password = bcrypt($request->password);
        }

        $user = User::create($request->all());

        // save user
        if($user) {
            return Fractal::item($user, new UserTransformer());
        } else {
            return $this->respondWithError('Could not create user.');
        }
    }
}
