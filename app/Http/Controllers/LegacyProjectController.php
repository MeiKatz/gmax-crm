<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Project;
use App\Models\ProjectTask;
use App\Models\ProjectUpdate;
use App\Models\User;
use App\Models\TaskTodo;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class LegacyProjectController extends Controller
{
    public function viewtasks(Request $request)
    { 
        $client = Client::all();
        $users = User::all();
        $project = Project::findOrFail( $request->id );
        $task = $project->tasks()->paginate(30);

        return view('app.projectviewtasks')->with(['tasks' =>$task])->with(['project_id' =>$request->id])->with(['users' =>$users]);
    }

    public function createprjcttask(Request $request)
    {   
        $project = Project::findOrFail( $request->project_id );
        $projectTask = $project->tasks()->create([
            'aid' => Auth::id(),
            'task' => $request->task,
            'assignedto' => $request->assignedto,
            'type' => $request->type,
            'status' => 1,
        ]);

        //send notification 
        if($request->assignedto){
            $notif =new Notification();
            $notif->fromid =Auth::id();  
            $notif->toid =$request->assignedto;
            $notif->message ='New Project Task Assigned #'.$projectTask->id;
            $notif->link ='/mytasks/view/'.$projectTask->id;
            $notif->style =$request->type;
            $notif->type ='task';
            $notif->status =1;
            $notif->save();  
        }

        return redirect()->back()->with('success', 'Task Created');
    }

    public function notificationupdate(Request $request)
    {   
        $project = Notification::findOrFail($request->id);
        $project->status =0;
        $project->save();     
        return redirect()->back()->with('success', 'Notification Updated');
    }

    public function projecttaskupdate(Request $request)
    {   
        $project = ProjectTask::findOrFail($request->id);
        $project->status =$request->status;
        $project->save();     
        return redirect()->back()->with('success', 'Task Updated');
    }

    public function deletetasks(Request $request)
    {
     $project = ProjectTask::findOrFail($request->id);
     $project->delete();
     return redirect()->back()->with('success', 'Task Deleted');
    }

    public function updateprojectdescript(Request $request)
    {   
        $project = Project::findOrFail($request->id);
        $project->update([
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Project Updated');
    }

    
    public function projectstatuschange(Request $request)
    {   
        $project = Project::findOrFail($request->id);
        $project->update([
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Status Updated');
    }

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


    public function viewtask(Request $request)
    {   
        $task = ProjectTask::where('assignedto',Auth::id())->where('id',$request->id)->firstOrFail();
        $todos = TaskTodo::where('taskid',$request->id)->orderby('id','desc')->get();
        $taskcomments =  ProjectUpdate::where('taskid',$request->id)->orderby('id','desc')->paginate(7);
        return view('app.viewtask')->with(['task' =>$task])->with(['todos' =>$todos])->with(['taskcomments' =>$taskcomments]);   
    }

       
    public function addtasktodo(Request $request)
    {   
        $updates = new TaskTodo();
        $updates->taskid =$request->taskid;   
        $updates->task =$request->task;   
        $updates->auth =Auth::id();  
        $updates->status =0;     
        $updates->save();     
        return redirect()->back()->with('success', 'Task ToDo Added');
    }





    public function addprojectupdates(Request $request)
    {   
        $project = Project::findOrFail( $request->project_id );
        $project->updates()->create([
            'taskid' => $request->taskid,
            'auth' => Auth::id(),
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', 'Comment Added');
    }

    public function editprojectupdates(Request $request)
    {   
        $updates = ProjectUpdate::find($request->id);
        $updates->message =$request->message;     
        $updates->save();     
        return redirect()->back()->with('success', 'Comment Updated');
    }


    public function deleteupdates(Request $request)
    {
     $project = ProjectUpdate::findOrFail($request->id);
     $project->delete();
     return redirect()->back()->with('success', ' Update Deleted');
    }
}
