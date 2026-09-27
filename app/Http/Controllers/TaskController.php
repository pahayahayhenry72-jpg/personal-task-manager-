<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->get('filter', 'all');

        $tasksQuery = Task::latest();

        if ($filter === 'pending') {
            $tasksQuery->where('status', 'Pending');
        }

        if ($filter === 'completed') {
            $tasksQuery->where('status', 'Completed');
        }

        $tasks = $tasksQuery->get();

        // Dashboard counts
        $allTasks = Task::all();

        $totalTasks = $allTasks->count();

        $pendingTasks = $allTasks
            ->where('status', 'Pending')
            ->count();

        $completedTasks = $allTasks
            ->where('status', 'Completed')
            ->count();

        $overdueTasks = $allTasks
            ->where('status', 'Pending')
            ->whereNotNull('due_date')
            ->where('due_date', '<', now()->toDateString())
            ->count();

        return view('tasks.index', compact(
            'tasks',
            'totalTasks',
            'pendingTasks',
            'completedTasks',
            'overdueTasks',
            'filter'
        ));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'task_name' => 'required|max:255',
            'description' => 'nullable',
            'due_date' => 'nullable|date',
        ]);

        Task::create([
            'task_name' => $request->task_name,
            'description' => $request->description,
            'status' => 'Pending',
            'due_date' => $request->due_date,
        ]);

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task added successfully!');
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'task_name' => 'required|max:255',
            'description' => 'nullable',
            'due_date' => 'nullable|date',
        ]);

        $task->update([
            'task_name' => $request->task_name,
            'description' => $request->description,
            'due_date' => $request->due_date,
        ]);

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task updated successfully!');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task deleted successfully!');
    }

    public function updateStatus(Task $task)
    {
        $task->update([
            'status' => $task->status === 'Pending'
                ? 'Completed'
                : 'Pending',
        ]);

        return redirect()->route('tasks.index');
    }
}
