<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller {
  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Notification  $notification
   * @return \Illuminate\Http\Response
   */
  public function destroy(Notification $notification) {
    $notification->update([
      'status' => 0,
    ]);

    return redirect()->back()->with([
      'success' => 'Notification updated',
    ]);
  }
}
