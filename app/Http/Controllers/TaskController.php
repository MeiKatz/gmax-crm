<?php

namespace App\Http\Controllers;

use App\Models\ProjectTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller {
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    $projectTasks = ProjectTask::where(
      'assignedto',
      Auth::id()
    )->orderby('id', 'desc')->paginate(20);

    return view('app.mytasks')->with([
      'tasks' => $projectTasks,
    ]);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\ProjectTask  $projectTask
   * @return \Illuminate\Http\Response
   */
  public function show(ProjectTask $projectTask) {
    if ( $projectTask->assignedto !== Auth::id() ) {
      abort(404);
    }

    $todos = $projectTask->todos()->orderby('id', 'desc')->get();
    $taskComments = $projectTask->updates()->orderby('id', 'desc')->paginate(7);

    return view('app.viewtask')->with([
      'project' => $project,
      'task' => $projectTask,
      'taskcomments' => $taskComments,
      'todos' => $todos,
    ]);
  }
}
