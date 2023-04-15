<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Goal;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
        $user = Auth::user();
        $user->authorizeRoles('user');
        // dd($id);
        // $goal = Goal::where('user_id', Auth::id())->get();
        // $task = Task::where('user_id', Auth::id())->get();
        $type = ['Reading', 'Writing', 'Listening', 'Speaking'];
        $goal_id = $id;
        // dd($id);

        // $task = Task::find($goal);
        // dd($task->goal);

        return view('user.tasks.create')->with('type', $type)->with('goal_id', $goal_id);
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
        $user->authorizeRoles('user');

        $request->validate([
            'title' => 'required|max:50',
            'description' => 'required'

        ]);

        Task::create([
            'goal_id' => $request->goal_id,
            'status' => false,
            'title' => $request->title,
            'description' => $request->description
        ]);

        // If the user comes from Dashboard, session data will exist for it, so redirect there
        if (session('url')) {
            // Stores the session data url in variable
            $url = session('url');

            // Removes the data from session
            // Without, controller will redirect to url from goals view too
            $request->session()->forget('url');

            // Redirect using session data stored in variable
            return redirect($url);
        }

        return to_route('user.goals.show', $request->goal_id);
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
        $user = Auth::user();
        $user->authorizeRoles('user');

        $type = ['Reading', 'Writing', 'Listening', 'Speaking'];

        return view('user.tasks.edit')->with('task', $task)->with('type', $type);
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
        $user->authorizeRoles('user');

        // dd($request->boolean('status'));
        $user = Auth::user();

        $request->validate([
            'title' => 'required|max:50',
            'description' => 'required'
        ]);

        $task->update([
            'goal_id' => $task->goal_id,    // Goal ID is the same as before edit
            'status' => $request->boolean('status'),
            'title' => $request->title,
            'description' => $request->description
        ]);

        // If the user comes from Dashboard, session data will exist for it, so redirect there
        if (session('url')) {
            $url = session('url');
            $request->session()->forget('url');
            return redirect($url);
        } 

        return to_route('user.goals.show', $task->goal);
        // return to_route('user.goals.show', $task->goal);
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
        $user->authorizeRoles('user');

        $task->delete();

        // If the user comes from Dashboard, session data will exist for it, so redirect there
        if (session('url')) {
            $url = session('url');
            request()->session()->forget('url');
            return redirect($url);
        }

        return to_route('user.goals.show', $task->goal_id);
    }
}
