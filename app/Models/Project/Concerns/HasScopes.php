<?php

namespace App\Models\Project\Concerns;

use App\Models\Project\Status as ProjectStatus;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

trait HasScopes {
  /**
   * Scope a query to only include projects that are not started yet.
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return void
   */
  public function notStarted(
    QueryBuilder $query
  ): void {
    $query->where(
      'status',
      ProjectStatus::NOT_STARTED
    );
  }

  /**
   * Scope a query to only include projects that are in progress.
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return void
   */
  public function inProgress(
    QueryBuilder $query
  ): void {
    $query->where(
      'status',
      ProjectStatus::IN_PROGRESS
    );
  }

  /**
   * Scope a query to only include projects that in review.
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return void
   */
  public function inReview(
    QueryBuilder $query
  ): void {
    $query->where(
      'status',
      ProjectStatus::IN_REVIEW
    );
  }

  /**
   * Scope a query to only include projects that are on hold.
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return void
   */
  public function onHold(
    QueryBuilder $query
  ): void {
    $query->where(
      'status',
      ProjectStatus::ON_HOLD
    );
  }

  /**
   * Scope a query to only include projects that completed.
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return void
   */
  public function completed(
    QueryBuilder $query
  ): void {
    $query->where(
      'status',
      ProjectStatus::COMPLETED
    );
  }

  /**
   * Scope a query to only include projects that are cancelled.
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return void
   */
  public function cancelled(
    QueryBuilder $query
  ): void {
    $query->where(
      'status',
      ProjectStatus::CANCELLED
    );
  }
}
