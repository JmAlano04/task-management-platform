<?php

namespace App\Http\Controllers;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class CreatorController extends Controller
{
    //
     public function index()
    {   
        $perPage = request()->get('perPage', 10);
        $tasks = Task::with(['creator', 'taker'])
                    ->where( 'status' , '=' , 'In_progress')
                    ->orderBy('created_at', 'desc')
                    ->paginate($perPage);

        
        return view('dashboard.dashboard', compact('tasks'));
    }
}
