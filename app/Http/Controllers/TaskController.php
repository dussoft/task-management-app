<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /**
     * Display a listing of tasks.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $tasks = Task::orderBy('priority')->get();
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new task.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created task in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        Task::create($request->all());
        $this->updateTaskPriorities();
        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    /**
     * Show the form for editing the specified task.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\View\View
     */
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified task in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Task $task)
    {
        $task->update($request->all());
        $this->updateTaskPriorities();
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified task from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        $this->updateTaskPriorities();
        return response()->json(['success' => true, 'message' => 'Task deleted successfully']);
    }

    /**
     * Update the priorities of all tasks.
     *
     * @return void
     */
    private function updateTaskPriorities()
    {
        $tasks = Task::orderBy('priority')->get();
        $tasks->each(function ($task, $index) {
            $task->update(['priority' => $index + 1]);
        });
    }

    /**
     * Reorder the tasks based on the given task IDs.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function reorder(Request $request)
    {
        $taskIds = $request->input('taskIds');

        DB::transaction(function () use ($taskIds) {
            collect($taskIds)->each(function ($taskId, $index) {
                $task = Task::findOrFail($taskId);
                $task->priority = $index + 1;
                $task->save();
            });
        });

        return response()->json(['success' => true, 'message' => 'Tasks reordered successfully']);
    }
}
