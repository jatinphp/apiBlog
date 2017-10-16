<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;

class TasksController extends Controller
{
    function __construct()
    {
    }
    function index(){
        $tasks = Task::all();
        return view('tasks.index',compact('tasks'));
    }
    function show(Task $task){
        $tasks = $task;
        return view('tasks.show',compact('tasks'));
    }
}
