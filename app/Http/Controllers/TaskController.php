<?php

namespace App\Http\Controllers;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function taskManagement()
    {
        $perPage = request()->get('perPage', 10);

        $task = Task::with(['creator', 'taker'])
                    ->orderBy('created_at', 'desc')
                    ->paginate($perPage);

        $users = User::all();

        // Only tasks created by the currently logged-in user
        $taskForcreator = Task::with(['creator', 'taker'])
                            ->where('creator_id', auth::id())
                            ->orderBy('created_at', 'desc')
                            ->paginate($perPage);

        return view('admin.task-management', compact('task', 'users', 'taskForcreator'));
    }
    public function mytask()
    {
        $tasks = Task::with(['creator'])
            ->where('taker_id', auth::id())  
            ->orderBy('created_at', 'desc')
            ->get();

        return view('task.task-taker', compact('tasks'));

    }

    public function search(Request $request)
    {
    $query = $request->input('query');

    $task = Task::with(['creator', 'taker'])
        ->where('title', 'like', "%{$query}%")
        ->orWhere('description', 'like', "%{$query}%")
        ->orWhereHas('creator', function ($q) use ($query) {
            $q->where('name', 'like', "%{$query}%");
        })
        ->orWhereHas('taker', function ($q) use ($query) {
            $q->where('name', 'like', "%{$query}%");
        })
        ->get();

    $html = view('profile.partials.table.task-management', compact('task'))->render();

    return response()->json(['html' => $html]);
    }

    public function store(Request $request)
    {
        // Validate request
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'taker_id' => 'required|exists:users,id',
            'created_by_id' => 'required|exists:users,id', // match DB column
            'due_date' => 'required|date|after_or_equal:today',
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        // Create task
        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'taker_id' => $request->taker_id,
            'creator_id' => $request->created_by_id,
            'due_date' => $request->due_date,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Task created successfully!');
    }
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'taker_id' => $request->taker_id,
            'creator_id' => $request->created_by_id,
            'due_date' => $request->due_date,
            'status' => $request->status,
        ]);

        return redirect()->route('task-management')->with('success', 'task updated successfully!');
    }
    public function createTaskstore(Request $request)
    {
        // Validate request
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'taker_id' => 'required|exists:users,id',
            'created_by_id' => 'required|exists:users,id', // match DB column
            'due_date' => 'required|date|after_or_equal:today',
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        // Create task
        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'taker_id' => $request->taker_id,
            'creator_id' => $request->created_by_id,
            'due_date' => $request->due_date,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Task created successfully!');
    }
    public function createTaskUpdate(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'taker_id' => $request->taker_id,
            'creator_id' => $request->created_by_id,
            'due_date' => $request->due_date,
            'status' => $request->status,
        ]);

        return redirect()->route('createTask')->with('success', 'task updated successfully!');
    }

    public function destroy(Task $id)
    {
        $id->delete();

        return redirect()->route('task-management')
                        ->with('success', 'task deleted successfully.');
    }
     public function createTaskdestroy(Task $id)
    {
        $id->delete();

        return redirect()->route('createTask')
                        ->with('success', 'task deleted successfully.');
    }



     public function start(Task $task)
    {
        $task->status = 'in_progress';
        $task->save();

        return redirect()->back()->with('success', 'Task started successfully!');
    }

    // Complete task
    public function complete( Task $task)
    {
        $task->status = 'completed';


        $task->save();

        return redirect()->back()->with('success', 'Task completed successfully!');
    }
}
