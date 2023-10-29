<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller {
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    $tasks = Task::where(
      'assignedto',
      Auth::id()
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
    if ( $task->assignedto !== Auth::id() ) {
      abort(404);
    }

    $todos = $task->todos()->orderby('id', 'desc')->get();
    $taskComments = $task->updates()->orderby('id', 'desc')->paginate(7);

    return view('app.viewtask')->with([
      'project' => $project,
      'task' => $task,
      'taskcomments' => $taskComments,
      'todos' => $todos,
    ]);
  }
}
