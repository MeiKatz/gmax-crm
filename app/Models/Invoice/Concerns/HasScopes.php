<?php

namespace App\Models\Invoice\Concerns;

use App\Models\Client;

trait HasScopes {
  /**
   * Scope a query to only include recurring invoices.
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @param  bool  $isRecurring
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopeRecurring( $query, $isRecurring = true ) {
    return $query->where(
      'recorring',
      $isRecurring ? 1 : 0
    );
  }

  /**
   * Scope a query to only include unpaid invoices.
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopeUnpaid( $query ) {
    return $query->where(
      'invostatus',
      self::STATUS_PAID
    );
  }

  /**
   * Scope a query to only include partially paid invoices.
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopePartiallyPaid( $query ) {
    return $query->where(
      'invostatus',
      self::STATUS_PARTIALLY_PAID
    );
  }

  /**
   * Scope a query to only include paid invoices.
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopePaid( $query ) {
    return $query->where(
      'invostatus',
      self::STATUS_PAID
    );
  }

  /**
   * Scope a query to only include refunded invoices.
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopeRefunded( $query ) {
    return $query->where(
      'invostatus',
      self::STATUS_REFUNDED
    );
  }

  /**
   * Scope a query to only include cancelled invoices.
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopeCancelled( $query ) {
    return $query->where(
      'invostatus',
      self::STATUS_CANCELLED
    );
  }

  /**
   * Scope a query to only include invoices of a specific client.
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @param  \App\Models\Client|int  $client
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function scopeForClient( $query, $client ) {
    if ( $client instanceof Client ) {
      $clientId = $client->id;
    } else {
      $clientId = $client;
    }

    return $query->where(
      'client_id',
      $clientId
    );
  }
}
