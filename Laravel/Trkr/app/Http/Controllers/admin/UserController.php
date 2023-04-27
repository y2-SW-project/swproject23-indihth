<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Interest;
use App\Models\Role;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
            ->whereNot('id', 1)     // Don't include admin user, always id of 1
            ->paginate(6);

        // $users = $users->users;
        // dd($users);
        // $users = Role::where('name', 'user')->first()->users()->get();
        // dd($users);

        // Returns the users index view and passes the users variable with the logged in users' users
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

        // return view('admin.users.show')->with('user', $user);

        $home = 'home';

        $goal = $user->goals->first();
       

        $partner = $user->partners->first();

        // Put url into session data to redirect back after editing goal or task
        Session::put('url', request()->fullUrl());

        if ($goal) {
            $done = Task::where('status', 1)->where('goal_id', $goal->id)->get();
            return view('admin.users.show')->with(compact('goal', 'done', 'user', 'partner'));
        } 

        return view('admin.users.show')->with(compact('goal', 'user', 'partner'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit(User $user)
    {
        $userAuth = Auth::user();
        $userAuth->authorizeRoles('admin');
        // TODO Create a languages table, easier to manage and update

        $languages = ['German', 'Spanish', 'French', 'Italian'];
        $countries = Country::all();
        $interests = Interest::all();
        $goal = $user->goals->first();

        return view('admin.users.edit')->with(compact('user', 'languages', 'countries', 'interests', 'goal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $userAuth = Auth::user();
        $userAuth->authorizeRoles('admin');

        // dd($request->image);

        // TODO: Add validation on 'language' to confirm it's a valid option
        $request->validate([
            'name' => 'required|max:50',
            'about_me' => 'required',
            'country_id' => 'required',
            'user_image' => 'file'
        ]);


        // Check if a file was uploaded in the image field
        if ($request->hasfile('user_image')) {
            $user_image = request()->file('user_image');    // Using request() instead of passing $request into function from form. request() is a helper function that can be called from anywhere
            $extension = $user_image->getClientOriginalExtension();     // Gets file extension
            $filename = date('Y-m-d-His') . '_' . request()->input('name') . '.' . $extension;  // Creates unique filename
            $path = $user_image->storeAs('public/images/users', $filename);   // Stores the image in the public images under new filename

            // Update user image with new filename
            $user->update([
                'user_image' => $filename
            ]);
        }

        // Update user
        $user->update([
            'name' => $request->name,
            'about_me' => $request->about_me,
            'country_id' => (int)$request->country_id
        ]);

        // Update interests - removes none selected and adds selected
        $user->interests()->sync($request->interest_id);

        $toast_success = 'Profile Updated Successfully!';

        return to_route('admin.users.show', $user->id)->with(compact('toast_success', 'user'));

        // return to_route('admin.users.show', $user->id)->with('toast_success', 'User Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $userAuth = Auth::user();
        $userAuth->authorizeRoles('admin');

        $user->delete();

        return to_route('admin.users.index')->with('toast_success', 'User Deleted Successfully!');
    }
}
