<?php

namespace App\Models\Invoice\Concerns;

use App\Models\Invoice\Status as InvoiceStatus;

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
    $this->invostatus = InvoiceStatus::UNPAID;
  }

  /**
   * @return void
   */
  public function markAsPartiallyPaid() {
    $this->invostatus = InvoiceStatus::PARTIALLY_PAID;
  }

  /**
   * @return void
   */
  public function markAsPaid() {
    $this->invostatus = InvoiceStatus::PAID;
  }

  /**
   * @return void
   */
  public function markAsRefunded() {
    $this->invostatus = InvoiceStatus::REFUNDED;
  }

  /**
   * @return void
   */
  public function markAsCancelled() {
    $this->invostatus = InvoiceStatus::CANCELLED;
  }
}
