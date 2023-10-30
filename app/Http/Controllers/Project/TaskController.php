<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Project;
use App\Models\ProjectUpdate;
use App\Models\Task;
use App\Models\TaskItem;
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
    $tasks = (
      $project
        ->tasks()
        ->where('assigned_user_id', Auth::id())
        ->paginate(30)
    );

    return view('projects.tasks')->with([
      'project' => $project,
      'tasks' => $tasks,
      'users' => $users,
    ]);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Project  $project
   * @param  \App\Models\Task  $task
   * @return \Illuminate\Http\Response
   */
  public function show(
    Project $project,
    Task $task
  ) {
    if ( $task->assigned_user_id !== Auth::id() ) {
      abort(404);
    }

    $taskItems = TaskItem::where('task_id', $task->id)->orderby('id', 'desc')->get();
    $taskComments = ProjectUpdate::where('task_id', $task->id)->orderby('id', 'desc')->paginate(7);

    return view('app.viewtask')->with([
      'project' => $project,
      'task' => $task,
      'taskcomments' => $taskComments,
      'taskItems' => $taskItems,
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
    $task = $project->tasks()->create([
      'creator_id' => Auth::id(),
      'task' => $request->task,
      'assigned_user_id' => $request->assigned_user_id,
      'type' => $request->type,
      'status' => 1,
    ]);

    //send notification
    if ( $request->assigned_user_id ) {
      $notification = new Notification();
      $notification->fromid = Auth::id();
      $notification->toid = $request->assigned_user_id;
      $notification->message = 'New Project Task Assigned #' . $task->id;
      $notification->link = route('tasks.show', [ $task ]);
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
   * @param  \App\Models\Task  $task
   * @return \Illuminate\Http\Response
   */
  public function update(
    Request $request,
    Task $task,
  ) {
    if ( !in_array( Auth::id(), [
      $task->assigned_user_id,
      $task->creator_id
    ]) ) {
      abort(404);
    }

    $task->update([
      'status' => $request->status,
    ]);

    return redirect()->back()->with([
      'success' => 'Task Updated',
    ]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Task  $task
   * @return \Illuminate\Http\Response
   */
  public function destroy(Task $task) {
    $task->delete();

    return redirect()->back()->with([
      'success' => 'Task Deleted',
    ]);
  }
}
