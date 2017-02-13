<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Transformers\UserTransformer;
use Cyvelnet\Laravel5Fractal\Facades\Fractal;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    /**
     * Return church collection
     */
    public function index()
    {
        try {
            $this->authorize('viewlist', User::class);
        } catch (\Exception $ex) {
            return response()->json([
                'error' => [
                    'message' => 'Not authorized to access this resource.',
                    'code' => 100
                ]
            ], 500);
        }

        // get all churches
        $users = User::all();

        // return a collection of churches
        return Fractal::collection($users, new UserTransformer());
    }


    public function show($id)
    {
        // get the church
        $user = User::find($id);

        // check if it exists
        if (!$user) {
            return response()->json([
                'error' => [
                    'message' => 'That user was not found.',
                    'code' => 100
                ]
            ], 404);
        }

        // response
        return Fractal::item($user, new UserTransformer());
    }


    public function update($id, Request $request)
    {
        $user = User::findOrFail($id);

        try {
            $this->authorize('update', $user);
        } catch (\Exception $ex) {
            return response()->json([
                'error' => [
                    'message' => 'Not authorized to update a user.',
                    'code' => 100
                ]
            ], 500);
        }


        // save church
        if($user->update($request->all())) {
            return Fractal::item($user, new UserTransformer());
        } else {
            return response()->json([
                'error' => [
                    'message' => 'Could not update user.',
                    'code' => 100
                ]
            ], 500);
        }
    }


    public function destroy($id) {
        $user = User::findOrFail($id);
        if ($user) {
            $user->delete();
            return response()->json([], 200);
        } else {
            return response()->json([
                'error' => [
                    'message' => 'User not found.',
                    'code' => 200
                ]
            ], 500);
        }

    }


    public function store(Request $request)
    {
        try {
            $this->authorize('create', User::class);
        } catch (\Exception $ex) {
            return response()->json([
                'error' => [
                    'message' => 'Not authorized to create a user.',
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

        $user = User::create($request->all());

        // save user
        if($user) {
            return Fractal::item($user, new UserTransformer());
        } else {
            return response()->json([
                'error' => [
                    'message' => 'Could not create user.',
                    'code' => 100
                ]
            ], 500);
        }
    }
}
