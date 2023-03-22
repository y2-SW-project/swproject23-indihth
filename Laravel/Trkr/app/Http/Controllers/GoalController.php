<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Fetch goals in order of when they were created and limited to 5 per page
        $goals = Goal::where('user_id', Auth::id())
        ->latest('updated_at')
        ->with('tasks')
        ->with('user')
        ->paginate(5);

        // Returns the goals index view and passes the goals variable with the logged in users' goals
        return view('goals.index')->with('goals', $goals);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         // Fetch goals in order of when they were created and limited to 5 per page
         $goals = Goal::where('user_id', Auth::id())->get();
         $languages = ['German', 'Spanish', 'French', 'Italian'];

        return view ('goals.create')->with('goals', $goals)->with('languages', $languages);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:50',
            'description' => 'required'
        ]);

        Goal::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description
        ]);

        return to_route('goals.index');
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

        return view('goals.show')->with('goal', $goal);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function edit(Goal $goal)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Goal $goal)
    {
        //
    }
}
