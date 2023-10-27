<?php

namespace App\Models\Invoice\Concerns;

trait HasActions {
  /**
   * @return void
   */
  public function cancel() {
    $this->markAsCancelled();
    $this->save();
  }

  /**
   * @return void
   */
  public function markAsUnpaid() {
    $this->invostatus = self::STATUS_UNPAID;
  }

  /**
   * @return void
   */
  public function markAsPartiallyPaid() {
    $this->invostatus = self::STATUS_PARTIALLY_PAID;
  }

  /**
   * @return void
   */
  public function markAsPaid() {
    $this->invostatus = self::STATUS_PAID;
  }

  /**
   * @return void
   */
  public function markAsRefunded() {
    $this->invostatus = self::STATUS_REFUNDED;
  }

  /**
   * @return void
   */
  public function markAsCancelled() {
    $this->invostatus = self::STATUS_CANCELLED;
  }
}
