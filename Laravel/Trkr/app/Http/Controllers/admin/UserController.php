<?php

namespace App\Http\Controllers\Admin;

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
        $user->authorizeRoles('admin'); // Checking if the user is an admin

        // Gets users except for admin, should replace with check for role
        // $users = User::whereNot('name', 'Glenn Sturgis')
        $users = User::latest('updated_at')
        ->with('goals')
        ->paginate(5);

        // $goals = $users->goals;
        // dd($goals);
        // $users = Role::where('name', 'user')->first()->users()->get();
        // dd($users);

        // Returns the goals index view and passes the goals variable with the logged in users' goals
        return view('admin.users.index')->with('users', $users);
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
        $userAuth->authorizeRoles('admin');

        // $userDis = User::where('id', $id)->get();
        // dd($user);

        return view('admin.users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
}
