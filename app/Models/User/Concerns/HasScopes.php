<?php

namespace App\Models\User\Concerns;

use Illuminate\Database\Eloquent\Builder as QueryBuilder;

trait HasScopes {
  /**
   * Scope a query to only include admins.
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return void
   */
  public function scopeAdmin(
    QueryBuilder $query
  ): void {
    $query->where(
      'usertype',
      self::USER_TYPE_ADMIN
    );
  }

  /**
   * Scope a query to only include users from staff.
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return void
   */
  public function scopeStaff(
    QueryBuilder $query
  ): void {
    $query->whereNot(
      'usertype',
      self::USER_TYPE_ADMIN
    );
  }
}
