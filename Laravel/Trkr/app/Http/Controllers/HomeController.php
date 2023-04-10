<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
   
    public function indexGoals()
    {
        // verify they are logged in
        $user = Auth::user();
        $home = 'goals';

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

    public function dashboard()
    {
        $user = Auth::user();
        $home = 'home';

        $goal = Goal::where('user_id', $user->id)->get();

        // Using first() because goal is a M:N to user but only 1 Goal was seeded per user
        // Should loop through goals on dashboard view to enable displaying multiple goals later on
        $toDo = Task::where('status', 0)->where('goal_id', $goal->first()->id)->get();
        
        $done = Task::where('status', 1)
        ->where('goal_id', $goal->first()->id)
        ->latest('updated_at')
        ->get();
        // Put url into session data to redirect back after editing task
        Session::put('url', request()->fullUrl());

        // Redirects to the admin index if admin
        if($user->hasRole('admin')){
            $home = 'admin.dashboard';    // Send admin to own dashboard? Or don't show dashboard nav item
        }
        // Redirects to the user index if user
        else if ($user->hasRole('user')){
            $home = 'user.dashboard';
        }

        return view($home, with(["goal" =>$goal, "toDo" => $toDo, "done"=> $done, "user" => $user]));
    }

    public function profile()
    {
        // verify they are logged in
        $user = Auth::user();
        $home = 'home';

        // Redirects to the admin index if admin
        if($user->hasRole('admin')){
            $home = 'admin.users.profile';
        }
        // Redirects to the user index if user
        else if ($user->hasRole('user')){
            $home = 'user.users.profile';
        }
        return view($home)->with('user', $user);
    }
}
