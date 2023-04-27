<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Goal;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

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
        $user->authorizeRoles('admin');
        // dd($id);
        // $goal = Goal::where('user_id', Auth::id())->get();
        // $task = Task::where('user_id', Auth::id())->get();
        $type = ['Reading', 'Writing', 'Listening', 'Speaking'];
        $goal_id = $id;

        return view('admin.tasks.create')->with('type', $type)->with('goal_id', $goal_id);
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
            'description' => 'required'

        ]);

        Task::create([
            'goal_id' => $request->goal_id,
            'status' => false,
            'title' => $request->title,
            'description' => $request->description
        ]);

        // If the user comes from Dashboard, session data will exist for it, so redirect there
        if (session('dashboard')) {
            $url = session('dashboard');
            $request->session()->forget('dashboard');
            return redirect($url);
        }

        return to_route('admin.goals.show', $request->goal_id)->with('toast_success', 'Task Created Successfully!');
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
        $user->authorizeRoles('admin');

        $type = ['Reading', 'Writing', 'Listening', 'Speaking'];
        // $goal_id = $id;

        return view('admin.tasks.edit')->with('task', $task)->with('type', $type);
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
        $user->authorizeRoles('admin');


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

        return to_route('admin.goals.show', $task->goal)->with('toast_success', 'Task Edited Successfully!');
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
        $user->authorizeRoles('admin');

        $task->delete();

        // If the user comes from Dashboard, session data will exist for it, so redirect there
        if (session('url')) {
            $url = session('url');
            request()->session()->forget('url');
            return redirect($url);
        }

        return to_route('admin.goals.show', $task->goal_id)->with('toast_success', 'Task Deleted Successfully!');
    }
}
