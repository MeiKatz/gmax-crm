<?php

namespace App\Models\Task\Concerns;

use App\Models\User;
use App\Models\TaskItem;
use App\Models\Project;
use App\Models\ProjectUpdate;

trait HasRelations {
  public function creator() {
    return $this->belongsTo(
      User::class,
      'creator_id'
    );
  }

  public function assigned() {
    return $this->belongsTo(
      User::class,
      'assignedto',
      'id'
    );
  }

  public function items() {
    return $this->hasMany(
      TaskItem::class
    );
  }

  public function updates() {
    return $this->hasMany(
      ProjectUpdate::class
    );
  }

  public function project() {
    return $this->belongsTo(
      Project::class
    );
  }
}
