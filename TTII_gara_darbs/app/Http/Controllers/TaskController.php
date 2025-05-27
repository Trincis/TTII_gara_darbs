<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;
use App\Models\User;

class TaskController extends Controller
{
    // Rāda visu uzdevumu sarakstu
    public function index()
    {
        $tasks = Task::with('project', 'user')->get();
        return view('tasks.index', compact('tasks'));
    }

    // Forma jauna uzdevuma izveidei
    public function create()
    {
        $projects = Project::all();
        $users = User::all();
        return view('tasks.create', compact('projects', 'users'));
    }

    // Saglabā jaunu uzdevumu datubāzē
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'project_id' => 'required|exists:projects,id',
            'assigned_to' => 'required|exists:users,id',
            'description' => 'nullable',
            'deadline' => 'nullable|date',
        ]);

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => 'pending',
            'project_id' => $request->project_id,
            'assigned_to' => $request->assigned_to,
            'deadline' => $request->deadline,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Uzdevums izveidots!');
    }

    // Rāda vienu uzdevumu detalizēti
    public function show(string $id)
    {
        $task = Task::with('project', 'user', 'comments')->findOrFail($id);
        return view('tasks.show', compact('task'));
    }

    // Rediģēšanas forma
    public function edit(string $id)
    {
        $task = Task::findOrFail($id);
        $projects = Project::all();
        $users = User::all();
        return view('tasks.edit', compact('task', 'projects', 'users'));
    }

    // Atjauno uzdevumu
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'status' => 'required|in:pending,in_progress,completed',
            'description' => 'nullable',
            'project_id' => 'required|exists:projects,id',
            'assigned_to' => 'required|exists:users,id',
            'deadline' => 'nullable|date',
        ]);

        $task = Task::findOrFail($id);
        $task->update($request->all());

        return redirect()->route('tasks.index')->with('success', 'Uzdevums atjaunots!');
    }

    // Dzēš uzdevumu
    public function destroy(string $id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Uzdevums dzēsts!');
    }
}
