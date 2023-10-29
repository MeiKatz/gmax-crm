<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\TaskTodo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller {
  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Task  $task
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request, Task $task) {
    $task->todos()->create([
      'task' => $request->task,
      'creator_id' => Auth::id(),
      'status' => 0,
    ]);

    return redirect()->back()->with([
      'success' => 'Todo list item added',
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\TaskTodo  $todoListItem
   * @return \Illuminate\Http\Response
   */
  public function update(
    Request $request,
    TaskTodo $todoListItem
  ) {
    $todoListItem->status = $request->status;
    $todoListItem->save();

    return redirect()->back()->with([
      'success' => 'Status updated',
    ]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\TaskTodo  $todoListItem
   * @return \Illuminate\Http\Response
   */
  public function destroy(TaskTodo $todoListItem) {
    $todoListItem->delete();

    return redirect()->back()->with([
      'success' => 'Status updated',
    ]);
  }
}
