<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class NoteController extends Controller {
  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Project  $project
   * @return \Illuminate\Http\Response
   */
  public function show(Project $project) {
    return view('projects.note')->with([
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
    ]);

    return redirect()->back()->with([
      'success' => 'Note Updated',
    ]);
  }
}
