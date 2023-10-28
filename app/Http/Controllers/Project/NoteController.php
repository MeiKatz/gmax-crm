<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller {
  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Project  $project
   * @return \Illuminate\Http\Response
   */
  public function show(Project $project) {
    return view('app.projectviewnote')->with([
      'note' => $project->note,
      'project' => $project,
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Project  $project
   * @return \Illuminate\Http\Response
   */
  public function update(
    Request $request,
    Project $project
  ) {
    $projectNote = $project->note;
    $projectNote->update([
      'note' => $request->note,
      'admin' => Auth::id(),
    ]);

    return redirect()->back()->with([
      'success' => 'Note Updated',
    ]);
  }
}
