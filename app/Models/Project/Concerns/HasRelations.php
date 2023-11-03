<?php

namespace App\Models\Project\Concerns;

use App\Models\Client;
use App\Models\ExpenseManager;
use App\Models\Invoice;
use App\Models\ProjectNote;
use App\Models\ProjectUpdate;
use App\Models\Task;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait HasRelations {
  /**
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function client(): BelongsTo {
    return $this->belongsTo(
      Client::class
    );
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function expenses(): HasMany {
    return $this->hasMany(
      ExpenseManager::class
    );
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function invoices(): HasMany {
    return $this->hasMany(
      Invoice::class
    );
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasOne
   */
  public function note(): HasOne {
    return $this->hasOne(
      ProjectNote::class
    );
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function updates() {
    return $this->hasMany(
      ProjectUpdate::class
    );
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function tasks() {
    return $this->hasMany(
      Task::class
    );
  }
}
