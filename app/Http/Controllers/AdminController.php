<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class AdminController extends Controller
{
    //
     public function index()
    {   
        $perPage = request()->get('perPage', 10); 
        $tasks = Task::with(['creator', 'taker'])
                    ->where( 'status' , '=' , 'In_progress')
                    ->orderBy('created_at', 'desc')
                    ->paginate($perPage);

        $totalTask = Task::all()->count();

        $totalCompleted = Task::where('status'  , '=', 'Completed' )->count();
        $totalPending = Task::where('status'  , '=', 'Pending' )->count();
        $totalIn_progress = Task::where('status'  , '=', 'In_progress' )->count();
            
    
        $assignedTaskCount = Task::where('creator_id', Auth::id())
                                ->whereNotNull('taker_id')
                                ->count();

        $overdueCount = Task::where('due_date', '<', Carbon::now())
                         ->where('status', '!=', 'completed')
                         ->count();

        $totalCreatorTasks = Task::where('creator_id')->count();

        
         $tasktaker = Task::with(['creator', 'taker'])
                    ->where('status', 'Pending')         
                    ->where('taker_id', Auth::id())          
                    ->orderBy('created_at', 'desc')
                    ->paginate($perPage);

        $takerCount = Task::with(['creator', 'taker'])         
                    ->where('taker_id', Auth::id())
                    ->count();
        $takerPending = Task::where('taker_id', Auth::id())->where('status', 'Pending')->count();
        $takerInProgress = Task::where('taker_id', Auth::id())->where('status', 'In_progress')->count();
        $takerCompleted = Task::where('taker_id', Auth::id())->where('status', 'Completed')->count();


        return view('dashboard.dashboard', compact('tasks', 'takerCompleted' ,'takerInProgress' ,'takerPending' ,'takerCount','tasktaker' ,'totalCreatorTasks' ,'overdueCount' , 'assignedTaskCount' , 'totalTask', 'totalCompleted' ,'totalPending', 'totalIn_progress'
       
        ));
    }

    public function filter(Request $request)
    {
        $role = $request->get('role');
        $perPage = $request->get('perPage', 10); 

        $usersQuery = User::query();

        if ($role) {
            $usersQuery->where('role', $role);
        }

        $users = $usersQuery->orderBy('created_at', 'desc')->paginate($perPage);

        return view('admin.manage-user-account', compact('users', 'role'));
    }



      public function manage()
    {
        $perPage = request()->get('perPage', 10); 
        $users = User::orderBy('id', 'desc')->paginate($perPage);
        return view('admin.manage-user-account', compact('users'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:admin,creator,taker',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'User created successfully!');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('manage-account')
                        ->with('success', 'User deleted successfully.');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => $request->filled('password') 
                ? Hash::make($request->password) 
                : $user->password,
        ]);
        return redirect()->back()->with('success', 'User updated successfully!');
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

        $html = view('profile.partials.table.manage-account', compact('task'))->render();

        return response()->json(['html' => $html]);
        }

}
