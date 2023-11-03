<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller {
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    $tasks = Task::where(
      'assigned_user_id',
      auth()->user()->id
    )->orderby('id', 'desc')->paginate(20);

    return view('app.mytasks')->with([
      'tasks' => $tasks,
    ]);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Task  $task
   * @return \Illuminate\Http\Response
   */
  public function show(Task $task) {
    if ( auth()->user()->isNot( $task->assigned_user ) ) {
      abort(404);
    }

    $taskItems = $task->items()->orderby('id', 'desc')->get();
    $taskComments = $task->updates()->orderby('id', 'desc')->paginate(7);

    return view('app.viewtask')->with([
      'project' => $task->project,
      'task' => $task,
      'taskcomments' => $taskComments,
      'taskItems' => $taskItems,
    ]);
  }
}
