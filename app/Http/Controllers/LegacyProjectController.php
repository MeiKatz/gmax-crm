<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProjectTask;
use App\Models\TaskTodo;
use Illuminate\Support\Facades\Auth;

class LegacyProjectController extends Controller
{
    public function mytasks(Request $request)
    {   
        $task = ProjectTask::where('assignedto',Auth::id())->orderby('id','desc')->paginate(20);
        return view('app.mytasks')->with(['tasks' =>$task]);   
    } 
    
    public function taskcomplete(Request $request)
    {   
        $project = ProjectTask::findOrFail($request->id);
        $project->status =2;     
        $project->save();     
        return redirect()->back()->with('success', 'Status Updated');
    }

    public function todostatusupdate(Request $request)
    {   
        $project = TaskTodo::findOrFail($request->id);
        $project->status = $request->status;     
        $project->save();     
        return redirect()->back()->with('success', 'Status Updated');
    }

    public function tasktododelete(Request $request)
    {   
        $project = TaskTodo::findOrFail($request->id);
         $project->delete();
        return redirect()->back()->with('success', 'Status Updated');
    }
       
    public function addtasktodo(Request $request)
    {   
        $updates = new TaskTodo();
        $updates->task_id =$request->task_id;
        $updates->task =$request->task;   
        $updates->creator_id =Auth::id();
        $updates->status =0;     
        $updates->save();     
        return redirect()->back()->with('success', 'Task ToDo Added');
    }
}
