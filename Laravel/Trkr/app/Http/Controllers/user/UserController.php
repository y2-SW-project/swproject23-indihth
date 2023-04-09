<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();   // Checking if the user is logged in
        $user->authorizeRoles('user'); // Checking if the user is a regular user

        // Gets users except for admin, should replace with check for role
        // $users = User::whereNot('name', 'Glenn Sturgis')
        $users = User::latest('updated_at')
        ->whereNot('id', 1)     // Don't include admin user, always id of 1
        ->with('goals')
        ->paginate(5);

        // $goals = $users->goals;
        // dd($goals);
        // $users = Role::where('name', 'user')->first()->users()->get();
        // dd($users);

        // Returns the goals index view and passes the goals variable with the logged in users' goals
        return view('user.users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function show(User $user)
    {
        // Must change from $user to $userAuth as was interferring with passing the user id
        $userAuth = Auth::user();
        $userAuth->authorizeRoles('user');

        // $userDis = User::where('id', $id)->get();
        // dd($user->interests);

        return view('user.users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
}
