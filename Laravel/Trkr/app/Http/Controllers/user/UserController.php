<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Interest;
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
        $user->authorizeRoles('user'); // Checking if the user is an admin

        // Gets users except for admin, should replace with check for role
        // $users = User::whereNot('name', 'Glenn Sturgis')
        $users = User::latest('updated_at')
            ->whereNot('id', 1)     // Don't include admin user, always id of 1
            ->paginate(9);

        // $users = $users->users;
        // dd($users);
        // $users = Role::where('name', 'user')->first()->users()->get();
        // dd($users);

        // Returns the users index view and passes the users variable with the logged in users' users
        return view('user.users.index')->with('users', $users);
    }

    public static function removePartner(User $user)
    {
        $userAuth = Auth::user(); 
        $userAuth->authorizeRoles('user');

        if ($userAuth->removePartner($user)) {
            $toast_success = 'Partner Removed Successfully!';
            dd("success remove partner");
        };

        $toast_error = 'Partner Updated Failed!';
        return view('user.users.show', $user)->with(compact('toast_error', 'user'));
    }

    public static function addPartner(User $user)
    {
        $userAuth = Auth::user(); 
        $userAuth->authorizeRoles('user');

        if ($userAuth->addPartner($user)) {
            $toast_success = 'Partner Added Successfully!';
            dd("success add partner");
        };

        $toast_error = 'Partner Updated Failed!';
        return view('user.users.show', $user)->with(compact('toast_error', 'user'));
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
        // dd($user);

        return view('user.users.show')->with('user', $user);
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
        $userAuth->authorizeRoles('user');

        // Authorise user first
        if ($user->id != Auth::id()) {
            //403 error forbidden
            return abort(403);
        }

        // TODO Create a languages table, easier to manage and update
        $languages = ['German', 'Spanish', 'French', 'Italian'];
        $countries = Country::all();
        $interests = Interest::all();
        $goal = $user->goals->first();

        return view('user.users.edit')->with(compact('user', 'languages', 'countries', 'interests', 'goal'));
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
        $userAuth->authorizeRoles('user');

        // Authorise user first
        if ($user->id != Auth::id()) {
            //403 error forbidden
            return abort(403);
        }

        // dd($request->interest_id);

        // TODO: Add validation on 'language' to confirm it's a valid option
        $request->validate([
            'name' => 'required|max:50',
            'about_me' => 'required',
            'country_id' => 'required',
            'language' => 'required',
            'image' => 'file'
        ]);

        // Check if a file was uploaded in the image field
        if ($request->hasfile('image')) {
            $user_image = request()->file('image');    // Using request() instead of passing $request into function from form. request() is a helper function that can be called from anywhere
            $extension = $user_image->getClientOriginalExtension();     // Gets file extension
            $filename = date('Y-m-d-His') . '_' . request()->input('name') . '.' . $extension;  // Creates unique filename
            $path = $user_image->storeAs('public/images', $filename);   // Stores the image in the public images under new filename

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

        // Update language in the Goal table
        foreach ($user->goals as $goal) {
            $goal->update([
                'language' => $request->language
            ]);
        }

        // Update interests - removes none selected and adds selected
        $user->interests()->sync($request->interest_id);

        $toast_success = 'User Updated Successfully!';

        return view('user.users.profile', $user)->with(compact('toast_success', 'user'));
    }
}
