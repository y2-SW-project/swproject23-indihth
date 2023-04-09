<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
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
            ->whereNot('id', 1)     // Don't include admin user, always id of 1
            ->paginate(8);

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

        return view('admin.users.show')->with('user', $user);
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
        // dd($countries);

        return view('admin.users.edit')->with(compact('user', 'languages', 'countries'));
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
            // 'country' => 'required',
            'language' => 'required',
            // 'image' => 'file'
        ]);

        // if($request->hasFile('image')){
        //     dd("has file");
        //     $filename = $request->image->getClientOriginalName();
        //     $request->image->storeAs('images',$filename,'public');
        //     Auth()->user()->update(['image'=>$filename]);
        // }

        if ($request->hasfile('image')) {
            $user_image = request()->file('image');    // Using request() instead of passing $request into function from form. request() is a helper function that can be called from anywhere
            $extension = $user_image->getClientOriginalExtension();     // Gets file extension
            $filename = date('Y-m-d-His') . '_' . request()->input('name') . '.' . $extension;  // Creates unique filename
            $path = $user_image->storeAs('public/images', $filename);   // Stores the image in the public images under new filename


            $user->update([
                'user_image' => $filename
            ]);
        }
        // dd((int)$request->country_id);
        $user->update([
            'name' => $request->name,
            'about_me' => $request->about_me,
            'country_id' => (int)$request->country_id,
            'language' => $request->language
        ]);


        return to_route('admin.users.show', $user->id)->with('toast_success', 'User Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        $user->delete();

        return to_route('admin.users.index')->with('toast_success', 'User Deleted Successfully!');
    }
}
