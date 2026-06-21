<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Saare tasks dikhana (homepage / list)
    public function index()
    {
        $tasks = Task::orderBy('created_at', 'desc')->get();
        return view('tasks.index', compact('tasks'));
    }

    // Naya task banane ka form dikhana
    public function create()
    {
        return view('tasks.create');
    }

    // Form se aaya hua naya task database mein save karna
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
        ]);

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'is_completed' => false,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
    }

    // Ek task ko edit karne ka form dikhana
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    // Edit form se aaya data update karna
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
        ]);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }

    // Task ko complete/incomplete toggle karna
    public function toggle(Task $task)
    {
        $task->update(['is_completed' => !$task->is_completed]);
        return redirect()->route('tasks.index');
    }

    // Task delete karna
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
    }
}
