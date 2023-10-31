<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\TaskItem;
use Illuminate\Http\Request;

class ItemController extends Controller {
  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Task  $task
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request, Task $task) {
    $task->items()->create([
      'task' => $request->task,
      'creator_id' => auth()->user()->id,
      'status' => 0,
    ]);

    return redirect()->back()->with([
      'success' => 'Task item added',
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\TaskItem  $taskItem
   * @return \Illuminate\Http\Response
   */
  public function update(
    Request $request,
    TaskItem $taskItem
  ) {
    $taskItem->status = $request->status;
    $taskItem->save();

    return redirect()->back()->with([
      'success' => 'Task item updated',
    ]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\TaskItem  $taskItem
   * @return \Illuminate\Http\Response
   */
  public function destroy(TaskItem $taskItem) {
    $taskItem->delete();

    return redirect()->back()->with([
      'success' => 'Task item updated',
    ]);
  }
}
