<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use Spatie\QueryBuilder\QueryBuilder;
use App\Models\Project;
use App\Models\ProjectTask;
use App\Models\ProjectNote;
use App\Models\ProjectUpdate;
use App\Models\User;
use App\Models\Invoice;
use App\Models\TaskTodo;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\ExpenseManager;


class ProjectController extends Controller
{
    
    public function listofprojects(Request $request)
    { 
        $client = Client::all();
        $projects = QueryBuilder::for(Project::class)
        ->allowedFilters(['projectname','client','status'])
        ->orderBy('id','desc')->paginate(15);       
        return view('app.listofprojects')->with(['projects' =>$projects])->with(['clients'=> $client]);     
    }

    public function createnewproject(Request $request)
    {   
        $project =new Project();
        $project->projectname=$request->projectname;
        $project->client =$request->client;
        $project->description =$request->description;
        $project->startdate =$request->startdate;
        $project->deadline =$request->deadline;
        $project->status =1;
        $project->save();        
        $lastid = $project->id;
        $project =new ProjectNote();
        $project->pjid=$lastid;
        $project->admin = Auth::id();  
        $project->note ='Add Something';
        $project->save();

        return redirect('/projects')->with('success', 'Project Created');  
    }

    public function deleteproject(Request $request)
    {
     $project = Project::findOrFail($request->id);
     $project->delete();
     return redirect('/projects')->with('success', 'Project Deleted');  
    }

    public function viewproject(Request $request)
    {         
        $client = Client::all();
        $project = Project::findOrFail($request->id);
        $projectupdates = ProjectUpdate::where('projectid',$request->id)->orderby('id','desc')->paginate(5);
        $startdate = Carbon::parse($project->startdate);
        $deadline = Carbon::parse($project->deadline);
        $totaldays =   $startdate->diffInDays($deadline);           
        $today = Carbon::now();
        $balancedays = $today->diffInDays($deadline);  
         if($totaldays==0){ $totaldays=1; }
        $percentage = $balancedays * 100 / $totaldays;

        $counts=[];
        $counts['income']=Invoice::where('projectid',$request->id)->sum('paidamount');
        $counts['expense']=ExpenseManager::where('prid',$request->id)->sum('amount');
        $counts['balance']= $counts['income'] - $counts['expense'];
        
        $invoices = Invoice::where('type',2)->where('projectid',$request->id)->orderby('id','desc')->paginate(3);

        return view('app.projectview')->with(['project' =>$project])->with(['prid' =>$request->id])->with(['percentage' =>$percentage])
        ->with(['balancedays' =>$balancedays])->with(['invoices' =>$invoices])->with(['projectupdates' =>$projectupdates])->with('counts', $counts); 
    }

    public function viewtasks(Request $request)
    { 
        $client = Client::all();
        $users = User::all();
        $task = ProjectTask::where('prid',$request->id)->paginate(30);
        return view('app.projectviewtasks')->with(['tasks' =>$task])->with(['prid' =>$request->id])->with(['users' =>$users]);     
    }

    public function viewnote(Request $request)
    { 
        $client = Client::all();
        $note = ProjectNote::where('pjid',$request->id)->first();
        return view('app.projectviewnote')->with(['note' =>$note])->with(['prid' =>$request->id]);      
    }
    

    public function createprjcttask(Request $request)
    {   
        $project =new ProjectTask();
        $project->prid=$request->prid;
        $project->aid = Auth::id();  
        $project->task =$request->task;
        $project->assignedto =$request->assignedto;
        $project->type =$request->type;
        $project->status =1;
        $project->save();    

        //send notification 
        if($request->assignedto){
            $notif =new Notification();
            $notif->fromid =Auth::id();  
            $notif->toid =$request->assignedto;
            $notif->message ='New Project Task Assigned #'.$project->id;
            $notif->link ='/mytasks/view/'.$project->id;
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

    public function updatenote(Request $request)
    {   
        $project = ProjectNote::findOrFail($request->id);
        $project->admin = Auth::id();  
        $project->note =$request->note;
        $project->save();     
        return redirect()->back()->with('success', 'Note Updated');
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

    
    public function updateproject(Request $request)
    {   
        $project = Project::findOrFail($request->id);
        $project->projectname =$request->projectname;      
        $project->startdate =$request->startdate;
        $project->deadline =$request->deadline;     
        $project->save();     
        return redirect()->back()->with('success', 'Project Updated');
    }

    public function updateprojectdescript(Request $request)
    {   
        $project = Project::findOrFail($request->id);
        $project->description =$request->description;   
        $project->save();     
        return redirect()->back()->with('success', 'Project Updated');
    }

    
    public function projectstatuschange(Request $request)
    {   
        $project = Project::findOrFail($request->id);
        $project->status =$request->status;     
        $project->save();     
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
        $updates = new ProjectUpdate();
        $updates->projectid =$request->projectid;   
        $updates->taskid =$request->taskid;   
        $updates->auth =Auth::id();  
        $updates->message =$request->message;     
        $updates->save();     
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
