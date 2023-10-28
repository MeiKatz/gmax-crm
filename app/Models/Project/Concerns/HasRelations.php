<?php

namespace App\Models\Project\Concerns;

use App\Models\Client;
use App\Models\ExpenseManager;
use App\Models\Invoice;
use App\Models\ProjectNote;
use App\Models\ProjectTask;
use App\Models\ProjectUpdate;

trait HasRelations {
  /**
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function client() {
    return $this->belongsTo(
      Client::class
    );
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function expenses() {
    return $this->hasMany(
      ExpenseManager::class
    );
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function invoices() {
    return $this->hasMany(
      Invoice::class
    );
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasOne
   */
  public function note() {
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
      ProjectTask::class
    );
  }
}
