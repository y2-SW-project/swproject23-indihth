<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

     // Once a user gets to the home page this function will
     // redirect to the correct index route depending on their user role
    public function index()
    {
        // verify they are logged in
        $user = Auth::user();
        $home = 'home';

        // Redirects to the admin index if admin
        if($user->hasRole('admin')){
            $home = 'admin.goals.index';
        }
        // Redirects to the user index if user
        else if ($user->hasRole('user')){
            $home = 'user.goals.index';
        }
        return redirect()->route($home);
    }

    public function indexUsers()
    {
        // verify they are logged in
        $user = Auth::user();
        $home = 'home';

        // Redirects to the admin index if admin
        if($user->hasRole('admin')){
            $home = 'admin.users.index';
        }
        // Redirects to the user index if user
        else if ($user->hasRole('user')){
            $home = 'user.users.index';
        }
        return redirect()->route($home);
    }
}
