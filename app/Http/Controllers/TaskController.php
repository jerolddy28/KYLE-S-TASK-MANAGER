<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::query()
            ->orderByRaw("CASE WHEN status = 'pending' THEN 0 ELSE 1 END")
            ->orderBy('due_date')
            ->latest()
            ->get();

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Task::create($this->validatedTask($request));

        return $this->tasksRedirect('Task added to your list.');
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
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $task->update($this->validatedTask($request));

        return $this->tasksRedirect('Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return $this->tasksRedirect('Task deleted.');
    }

    private function tasksRedirect(string $message): RedirectResponse
    {
        $response = new RedirectResponse('/tasks');
        session()->flash('success', $message);

        return $response;
    }

    /**
     * @return array<string, mixed>
     */
    private function validatedTask(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:120'],
            'description' => ['nullable', 'string', 'max:2000'],
            'status' => ['required', 'in:pending,completed'],
            'due_date' => ['nullable', 'date'],
        ]);
    }
}
