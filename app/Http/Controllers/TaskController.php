<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function maRoute(){
        return view('maroute');
    }

    public function maRouteParam(int $id){
        //log($request);
        return "j'ais ".$id." ans"; //view('maroute');
    }
    
    public function index(){
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    public function create(){
        return view('tasks.create');
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Task::create($request->all());
        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }
}