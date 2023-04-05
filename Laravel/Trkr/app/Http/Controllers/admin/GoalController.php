<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Goal;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;


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
        $user->authorizeRoles('admin'); // Checking if the user is an admin

        // Fetch goals from all users in order of when they were created and limited to 5 per page
        $goals = Goal::latest('updated_at')
            ->with('tasks')
            ->with('user')
            ->paginate(5);

        // Alert::success('Success Title', 'Success Message');

        // Returns the goals index view and passes the goals variable with the logged in users' goals
        return view('admin.goals.index')->with('goals', $goals);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        // Fetch goals in order of when they were created and limited to 5 per page
        $goals = Goal::where('user_id', Auth::id())->get();
        $languages = ['German', 'Spanish', 'French', 'Italian'];

        return view('admin.goals.create')->with('goals', $goals)->with('languages', $languages);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        $request->validate([
            'title' => 'required|max:50',
            'description' => 'required',
            // Issue with validating select option, 
            'language' => 'required'
        ]);

        Goal::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'language' => $request->language
        ]);

        return to_route('admin.goals.index')->with('toast_success', 'Goal Created Successfully!');
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
        $user->authorizeRoles('admin');

        $toDo = Task::where('status', 0)->where('goal_id', $goal->id)->get();
        $done = Task::where('status', 1)->where('goal_id', $goal->id)->get();

        return view('admin.goals.show', with(["goal" => $goal, "toDo" => $toDo, "done" => $done]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function edit(Goal $goal)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        // TODO Create a languages table, easier to manage and update
        $languages = ['German', 'Spanish', 'French', 'Italian'];

        return view('admin.goals.edit')->with('goal', $goal)->with('languages', $languages);
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
        $user = Auth::user();
        $user->authorizeRoles('admin');

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

        return to_route('admin.goals.show', $goal)->with('toast_success', 'Goal Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Goal $goal)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        $goal->delete();

        return to_route('admin.goals.index')->with('toast_success', 'Goal Deleted Successfully!');
    }
}
