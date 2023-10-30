<?php

namespace App\Models\User\Concerns;

trait HasScopes {
  /**
   * Scope a query to only include admins.
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopeAdmin( $query ) {
    return $query->where(
      'usertype',
      self::USER_TYPE_ADMIN
    );
  }

  /**
   * Scope a query to only include users from staff.
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopeStaff( $query ) {
    return $query->whereNot(
      'usertype',
      self::USER_TYPE_ADMIN
    );
  }
}
