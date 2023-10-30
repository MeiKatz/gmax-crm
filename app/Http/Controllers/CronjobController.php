<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;

class CronjobController extends Controller {
  /**
   * Handle the incoming request.
   *
   * @return \Illuminate\Http\Response
   */
  public function __invoke() {
    Artisan::call('schedule:run');
  }
}
