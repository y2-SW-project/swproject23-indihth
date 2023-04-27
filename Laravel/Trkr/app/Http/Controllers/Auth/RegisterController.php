<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\UserController;
use App\Models\Country;
use App\Models\Interest;
use App\Models\Role;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

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
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = route('user.users.edit', $user);
    // protected $redirectTo = '/user/users/edit';
    protected $redirectTo = RouteServiceProvider::HOME;

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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // Image storage
        $user_image = request()->file('user_image');    // Using request() instead of passing $request into function from form. request() is a helper function that can be called from anywhere
        $extension = $user_image->getClientOriginalExtension();     // Gets file extension
        $filename = date('Y-m-d-His') . '_' . request()->input('name') . '_' . $extension;  // Creates unique filename
        $path = $user_image->storeAs('public/images/users', $filename);   // Stores the image in the public images under new filename

        // $country_id = (int)$data['country_id'];

        // Replace 'return' with user variable
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'user_image' => $filename
            // 'level' => $data['level'],
            // 'about_me' => $data['about_me'],
            // 'country_id' => $country_id
        ]);

        // Assigns the 'user' role to all users created via the registration form
        $role_user = Role::where('name', 'user')->first();
        $user->roles()->attach($role_user);

        // Assign random partner, that's not the admin
        $users = User::whereNot('id', 1)->get(); 
        $randomUser = $users->random();
        $user->addPartner($randomUser);

        $languages = ['German', 'Spanish', 'French', 'Italian'];
        $countries = Country::all();
        $interests = Interest::all();

        // return view('user.users.createProfile')
        // ->with('data', $user)
        // return redirect()->route('user.users.edit', $user)->with(compact('languages', 'countries', 'interests'));
        
         // Put url into session data to redirect back to after editing task
         Session::put('finishProfile', request()->fullUrl());

        // Returns the User object with it's assigned role
        return $user;
    }
}
