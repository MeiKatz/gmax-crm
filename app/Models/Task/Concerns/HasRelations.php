<?php

namespace App\Models\Task\Concerns;

use App\Models\User;
use App\Models\TaskItem;
use App\Models\Project;
use App\Models\ProjectUpdate;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasRelations {
  /**
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function creator(): BelongsTo {
    return $this->belongsTo(
      User::class,
      'creator_id'
    );
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function assignedUser(): BelongsTo {
    return $this->belongsTo(
      User::class,
      'assigned_user_id'
    );
  }

  public function assigned_user(): BelongsTo {
    return $this->assignedUser();
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function items(): HasMany {
    return $this->hasMany(
      TaskItem::class
    );
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function updates(): HasMany {
    return $this->hasMany(
      ProjectUpdate::class
    );
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function project(): BelongsTo {
    return $this->belongsTo(
      Project::class
    );
  }
}
