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
      ProjectStatus::NOT_STARTED->value
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
      ProjectStatus::IN_PROGRESS->value
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
      ProjectStatus::IN_REVIEW->value
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
      ProjectStatus::ON_HOLD->value
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
      ProjectStatus::COMPLETED->value
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
      ProjectStatus::CANCELLED->value
    );
  }
}
