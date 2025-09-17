<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    // Get all tasks
    public function index()
    {
        $tasks = Task::all();
        return response()->json($tasks, 200);
    }

    // Get single task by ID
    public function show($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }

        return response()->json($task, 200);
    }

    // Create a new task
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|string|in:pending,completed,in-progress',
        ]);

        try {
            $task = Task::create($validatedData);

            return response()->json([
                'message' => 'Task created successfully',
                'task' => $task
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Server Error: ' . $e->getMessage()
            ], 500);
        }
    }

    // Update a task
    public function update(Request $request, $id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }

        $validatedData = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|string|in:pending,completed,in-progress',
        ]);

        try {
            $task->update($validatedData);

            return response()->json([
                'message' => 'Task updated successfully',
                'task' => $task
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Server Error: ' . $e->getMessage()
            ], 500);
        }
    }

    // Delete a task
    public function destroy($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }

        try {
            $task->delete();
            return response()->json(['message' => 'Task deleted successfully'], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Server Error: ' . $e->getMessage()
            ], 500);
        }
    }
}
