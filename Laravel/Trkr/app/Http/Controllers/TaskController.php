<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        // dd($id);
        // $goal = Goal::where('user_id', Auth::id())->get();
        $task = Task::where('user_id', Auth::id())->get();
        $type = ['Reading', 'Writing', 'Listening', 'Speaking'];
        $goal_id = $id;
        // dd($id);
      
        // $task = Task::find($goal);
        // dd($task->goal);

        return view('tasks.create')->with('task', $task)->with('type', $type)->with('goal_id', $goal_id);
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

        Task::create([
            'user_id' => Auth::id(),
            'goal_id' => $request->goal_id,
            'title' => $request->title,
            'description' => $request->description
        ]);

        return to_route('goals.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $type = ['Reading', 'Writing', 'Listening', 'Speaking'];
        // $goal_id = $id;

        return view('tasks.edit')->with('task', $task)->with('type', $type);
        // return view('tasks.edit')->with('task', $task)->with('type', $type)->with('goal_id', $goal_id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $user = Auth::user();

        $request->validate([
            'title' => 'required|max:50',
            'description' => 'required'
        ]);

        Task::create([
            'user_id' => Auth::id(), 
            'goal_id' => $task->goal_id,    // Goal ID is the same as before edit
            'title' => $request->title,
            'description' => $request->description
        ]);

        return to_route('goals.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $user = Auth::user();

        $task->delete();

        return to_route('goals.index');
    }
}
