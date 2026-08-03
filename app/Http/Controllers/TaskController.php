<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = auth()->user()->tasks()->where('is_completed', false)->orderByRaw('due_date IS NULL')->orderBy('due_date', 'asc')->get();
        $done_tasks = auth()->user()->tasks()->where('is_completed', true)->orderBy('updated_at', 'asc')->get();
        return view('dashboard', compact('tasks', 'done_tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:32',
            'description' => 'nullable',
            'due_date' => 'nullable|date'
        ]);

        auth()->user()->tasks()->create($validated);

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Task $task)
    {
        // $task->update(['is_completed' => true]);
        $task->update(['is_completed' => !$task->is_completed]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return back();
    }
}
