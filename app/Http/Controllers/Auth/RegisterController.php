<?php

namespace App\Http\Controllers\Auth;

use App\Models\Church;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;


    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $churches = Church::pluck('name', 'id');

        $list = [null => 'Select one'];
        $last = ['99' => 'Other'];
        $list = array_merge($list, $churches->toArray(), $last);

        return view('auth.register', ['churches' => $list]);
    }



    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required|max:2',
            'church_id' => 'required|integer',
            'zipcode' => 'required|digits:5'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'address' => $data['address'],
            'city' => $data['city'],
            'state' => $data['state'],
            'zipcode' =>  $data['zipcode'],
            'church_id' =>  $data['church_id'],
            'other_church' =>  $data['other_church'],
            'phone' => $data['phone'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
