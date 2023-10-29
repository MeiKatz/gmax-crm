<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Project;
use App\Models\ProjectTask;
use App\Models\ProjectUpdate;
use App\Models\TaskTodo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller {
  /**
   * Display a listing of the resource.
   *
   * @param  \App\Models\Project  $project
   * @return \Illuminate\Http\Response
   */
  public function index(Project $project) {
    $users = User::all();
    $projectTasks = (
      $project
        ->tasks()
        ->where('assignedto', Auth::id())
        ->paginate(30)
    );

    return view('projects.tasks')->with([
      'project' => $project,
      'tasks' => $projectTasks,
      'users' => $users,
    ]);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Project  $project
   * @param  \App\Models\ProjectTask  $projectTask
   * @return \Illuminate\Http\Response
   */
  public function show(
    Project $project,
    ProjectTask $projectTask
  ) {
    if ( $projectTask->assignedto !== Auth::id() ) {
      abort(404);
    }

    $todos = TaskTodo::where('taskid', $projectTask->id)->orderby('id', 'desc')->get();
    $taskComments = ProjectUpdate::where('taskid', $projectTask->id)->orderby('id', 'desc')->paginate(7);

    return view('app.viewtask')->with([
      'project' => $project,
      'task' => $projectTask,
      'taskcomments' => $taskComments,
      'todos' => $todos,
    ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Project  $project
   * @return \Illuminate\Http\Response
   */
  public function store(
    Request $request,
    Project $project
  ) {
    $projectTask = $project->tasks()->create([
      'aid' => Auth::id(),
      'task' => $request->task,
      'assignedto' => $request->assignedto,
      'type' => $request->type,
      'status' => 1,
    ]);

    //send notification
    if ( $request->assignedto ) {
      $notification = new Notification();
      $notification->fromid = Auth::id();
      $notification->toid = $request->assignedto;
      $notification->message = 'New Project Task Assigned #' . $projectTask->id;
      $notification->link = '/mytasks/view/' . $projectTask->id;
      $notification->style = $request->type;
      $notification->type = 'task';
      $notification->status = 1;
      $notification->save();
    }

    return redirect()->back()->with([
      'success' => 'Task Created',
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\ProjectTask  $projectTask
   * @return \Illuminate\Http\Response
   */
  public function update(
    Request $request,
    ProjectTask $projectTask,
  ) {
    if ( !in_array( Auth::id(), [
      $projectTask->assignedto,
      $projectTask->aid
    ]) ) {
      abort(404);
    }

    $projectTask->update([
      'status' => $request->status,
    ]);

    return redirect()->back()->with([
      'success' => 'Task Updated',
    ]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\ProjectTask  $projectTask
   * @return \Illuminate\Http\Response
   */
  public function destroy(ProjectTask $projectTask) {
    $projectTask->delete();

    return redirect()->back()->with([
      'success' => 'Task Deleted',
    ]);
  }
}
