<?php

namespace App\Models\Invoice\Concerns;

use App\Models\Client;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

trait HasScopes {
  /**
   * Scope a query to only include recurring invoices.
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @param  bool  $isRecurring
   * @return void
   */
  public function scopeRecurring(
    QueryBuilder $query,
    bool $isRecurring = true
  ): void {
    $query->where(
      'recorring',
      $isRecurring ? 1 : 0
    );
  }

  /**
   * Scope a query to only include unpaid invoices.
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return void
   */
  public function scopeUnpaid(
    QueryBuilder $query
  ): void {
    $query->where(
      'invostatus',
      self::STATUS_PAID
    );
  }

  /**
   * Scope a query to only include partially paid invoices.
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return void
   */
  public function scopePartiallyPaid(
    QueryBuilder $query
  ): void {
    $query->where(
      'invostatus',
      self::STATUS_PARTIALLY_PAID
    );
  }

  /**
   * Scope a query to only include paid invoices.
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return void
   */
  public function scopePaid(
    QueryBuilder $query
  ): void {
    $query->where(
      'invostatus',
      self::STATUS_PAID
    );
  }

  /**
   * Scope a query to only include refunded invoices.
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return void
   */
  public function scopeRefunded(
    QueryBuilder $query
  ): void {
    $query->where(
      'invostatus',
      self::STATUS_REFUNDED
    );
  }

  /**
   * Scope a query to only include cancelled invoices.
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return void
   */
  public function scopeCancelled(
    QueryBuilder $query
  ): void {
    $query->where(
      'invostatus',
      self::STATUS_CANCELLED
    );
  }

  /**
   * Scope a query to only include invoices of a specific client.
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @param  \App\Models\Client|int  $client
   * @return void
   */
  public function scopeForClient(
    QueryBuilder $query,
    Client|int $client
  ): void {
    if ( $client instanceof Client ) {
      $clientId = $client->id;
    } else {
      $clientId = $client;
    }

    $query->where(
      'client_id',
      $clientId
    );
  }
}
