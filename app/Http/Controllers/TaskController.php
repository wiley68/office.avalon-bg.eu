<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Inertia\Inertia;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'status' => 'sometimes|integer|in:0,1',
            'search' => 'sometimes|string|max:256',
        ]);

        $search = trim($validated['search'] ?? '');
        $status = (int)($validated['status'] ?? 0);

        $tasks = Task::query()
            ->where('status', $status)
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhereRaw("LOWER(FROM_BASE64(`value`)) LIKE ?", ["%" . strtolower($search) . "%"]);
                });
            })
            ->get();

        foreach ($tasks as &$task) {
            if (isset($task['value'])) {
                $task['value'] = base64_decode($task['value']);
            }
        }
        return Inertia::render('Tasks/Index', [
            'tasks' => $tasks,
            'status' => $status,
            'search' => $search,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:256',
            'value' => 'nullable|string',
            'status' => 'required|integer|in:0,1',
        ]);

        $validated['value'] = base64_encode($validated['value']);
        Task::create($validated);

        return redirect()->back()->with('success', 'Task created successfully.');
    }

    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:256',
            'value' => 'nullable|string',
            'status' => 'required|integer|in:0,1',
        ]);

        $validated['value'] = base64_encode($validated['value']);
        $task->update($validated);

        return redirect()->back()->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->back()->with('success', 'Task deleted successfully.');
    }
}
