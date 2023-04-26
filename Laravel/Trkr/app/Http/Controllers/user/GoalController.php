<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Goal;
use App\Models\Interest;
use App\Models\Role;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;

class GoalController extends Controller
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

        // Authorise user first
        if ($goal->user->id != Auth::id()) {
            //403 error forbidden
            return abort(403);
        }

        // Fetch goals in order of when they were created and limited to 5 per page
        $goals = Goal::where('user_id', Auth::id())
            ->latest('updated_at')
            ->with('tasks')
            ->with('user')
            ->paginate(5);

        // Returns the goals index view and passes the goals variable with the logged in users' goals
        return view('user.goals.index')->with('goals', $goals);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $user->authorizeRoles('user');

        // Gets all users that have role 'user', no admins returned
        $partners = User::whereNot('id', $user->id)
            ->with('roles')
            ->whereHas('roles', function (Builder $query) {
                $query->where('name', 'user');
            })
            ->limit(8)
            ->get();

        // Fetch goals in order of when they were created and limited to 5 per page
        $goals = Goal::where('user_id', Auth::id())->get();
        $languages = ['German', 'Spanish', 'French', 'Italian'];
        $countries = Country::all();
        $interests = Interest::all();

        return view('user.goals.create')->with(compact('goals', 'languages', 'partners', 'countries', 'interests', 'user'));
        // return view('user.goals.create')->with('goals', $goals)->with('languages', $languages);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        $user = User::where('id', (int)$request->user)->get();
        // dd($user);

        $userAuth = Auth::user();
        $userAuth->authorizeRoles('user');

        // dd($request);

        $request->validate([
            'title' => 'required|max:50',
            'description' => 'required',
            // Issue with validating select option, 
            'about_me' => 'required',
            'country_id' => 'required',
            'language' => 'required',
        ]);

        Goal::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'language' => $request->language
        ]);

        return to_route('home.dashboard')->with('toast_success', 'Goal Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function show(Goal $goal)
    {
        $user = Auth::user();
        $user->authorizeRoles('user');

        // Authorise user first
        if ($goal->user->id != Auth::id()) {
            //403 error forbidden
            return abort(403);
        }

        $toDo = Task::where('status', 0)->where('goal_id', $goal->id)->get();
        $done = Task::where('status', 1)->where('goal_id', $goal->id)->get();
        $user = Auth::user();   // Not needed. test removing

        // Put url into session data to redirect back after editing task
        Session::put('url', request()->fullUrl());

        return view('user.goals.show', with(["goal" => $goal, "toDo" => $toDo, "done" => $done, "user" => $user]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function edit(Goal $goal)
    {

        $userAuth = Auth::user();
        $userAuth->authorizeRoles('user');

        // Authorise user first
        if ($goal->user->id != Auth::id()) {
            //403 error forbidden
            return abort(403);
        }

        // TODO Create a languages table, easier to manage and update
        $languages = ['German', 'Spanish', 'French', 'Italian'];

        return view('user.goals.edit')->with('goal', $goal)->with('languages', $languages);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Goal $goal)
    {
        // dd("update");
        $userAuth = Auth::user();
        $userAuth->authorizeRoles('user');

        // Authorise user first
        if ($goal->user->id != Auth::id()) {
            //403 error forbidden
            return abort(403);
        }

        // TODO: Add validation on 'language' to confirm it's a valid option
        $request->validate([
            'title' => 'required|max:50',
            'description' => 'required',
            'language' => 'required'
        ]);

        $goal->update([
            'title' => $request->title,
            'description' => $request->description,
            'language' => $request->language
        ]);

        // If the user comes from Dashboard, session data will exist for it, so redirect there
        if (session('url')) {
            $url = session('url');
            $request->session()->forget('url');
            return redirect($url);
        }

        return to_route('user.goals.show', $goal)->with('toast_success', 'Goal Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Goal $goal)
    {
        // dd("delete");
        $userAuth = Auth::user();
        $userAuth->authorizeRoles('user');

        // Authorise user first
        if ($goal->user->id != Auth::id()) {
            //403 error forbidden
            return abort(403);
        }

        $goal->delete();

        return to_route('user.goals.index');
    }
}
