<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Client;
use App\Models\Project;
use Carbon\Carbon;
use Spatie\QueryBuilder\QueryBuilder;

class ProjectController extends Controller {
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    $clients = Client::all();
    $projects = (
      QueryBuilder::for( Project::class )
        ->allowedFilters([
          'name',
          'client',
          'status',
        ])
        ->orderBy('id', 'desc')
        ->paginate(15)
    );

    return view('projects.index')->with([
      'clients' => $clients,
      'projects' => $projects,
    ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \App\Http\Requests\CreateProjectRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(CreateProjectRequest $request) {
    $project = Project::create(
      $request->validated()
    );

    $project->note()->create([
      'creator_id' => auth()->user()->id,
      'note' => 'Add Something',
    ]);

    return redirect()->route('projects.index')->with([
      'success' => 'Project Created',
    ]);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Project  $project
   * @return \Illuminate\Http\Response
   */
  public function show(Project $project) {
    $clients = Client::all();
    $projectUpdates = (
      $project
        ->updates()
        ->orderby('id', 'desc')
        ->paginate(5)
    );

    $startDate = Carbon::parse( $project->starts_at );
    $deadline  = Carbon::parse( $project->deadline );
    $totalDays = $startDate->diffInDays( $deadline );
    $today = Carbon::now();
    $balanceDays = $today->diffInDays( $deadline );

    if ( $totalDays === 0 ) {
      $totalDays = 1;
    }

    $percentage = $balanceDays * 100 / $totalDays;

    $counts = [];

    $counts['income']  = $project->invoices()->sum('paidamount');
    $counts['expense'] = $project->expenses()->sum('amount');
    $counts['balance'] = $counts['income'] - $counts['expense'];

    $invoices = (
      $project
        ->invoices()
        ->where('type', 2)
        ->orderby('id','desc')
        ->paginate(3)
    );

    return view('projects.show')->with([
      'balanceDays' => $balanceDays,
      'counts' => $counts,
      'invoices' => $invoices,
      'percentage' => $percentage,
      'project' => $project,
      'projectUpdates' => $projectUpdates,
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Http\Requests\UpdateProjectRequest  $request
   * @param  \App\Models\Project  $project
   * @return \Illuminate\Http\Response
   */
  public function update(
    UpdateProjectRequest $request,
    Project $project
  ) {
    $project->update(
      $request->validated()
    );

    return redirect()->back()->with([
      'success' => 'Project Updated',
    ]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Project  $project
   * @return \Illuminate\Http\Response
   */
  public function destroy(Project $project) {
    $project->delete();

    return redirect()->route('projects.index')->with([
      'success' => 'Project Deleted',
    ]);
  }
}
