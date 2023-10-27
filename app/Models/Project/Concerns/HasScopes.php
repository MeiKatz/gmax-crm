<?php

namespace App\Models\Project\Concerns;

trait HasScopes {
  /**
   * Scope a query to only include projects that are not started yet.
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function notStarted( $query ) {
    return $query->where(
      'status',
      self::STATUS_NOT_STARTED
    );
  }

  /**
   * Scope a query to only include projects that are in progress.
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function inProgress( $query ) {
    return $query->where(
      'status',
      self::STATUS_IN_PROGRESS
    );
  }

  /**
   * Scope a query to only include projects that in review.
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function inReview( $query ) {
    return $query->where(
      'status',
      self::STATUS_IN_REVIEW
    );
  }

  /**
   * Scope a query to only include projects that are on hold.
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function onHold( $query ) {
    return $query->where(
      'status',
      self::STATUS_ON_HOLD
    );
  }

  /**
   * Scope a query to only include projects that completed.
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function completed( $query ) {
    return $query->where(
      'status',
      self::STATUS_COMPLETED
    );
  }

  /**
   * Scope a query to only include projects that are cancelled.
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function cancelled( $query ) {
    return $query->where(
      'status',
      self::STATUS_CANCELLED
    );
  }
}
