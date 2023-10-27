<?php

namespace App\Models\Invoice\Concerns;

trait HasAttributes {
  /**
   * @return bool
   */
  public function getIsTaxableAttribute() {
    return $this->taxable == 1;
  }

  /**
   * @return int
   */
  public function getTotalAmountAttribute() {
    return $this->items()->sum('total');
  }

  /**
   * @return bool
   */
  public function getIsUnpaidAttribute() {
    return $this->invostatus === self::STATUS_UNPAID;
  }

  /**
   * @return bool
   */
  public function getIsPartiallyPaidAttribute() {
    return $this->invostatus === self::STATUS_PARTIALLY_PAID;
  }

  /**
   * @return bool
   */
  public function getIsPaidAttribute() {
    return $this->invostatus === self::STATUS_PAID;
  }

  /**
   * @return bool
   */
  public function getIsRefundedAttribute() {
    return $this->invostatus === self::STATUS_REFUNDED;
  }

  /**
   * @return bool
   */
  public function getIsCancelledAttribute() {
    return $this->invostatus === self::STATUS_CANCELLED;
  }

  /**
   * @return bool
   */
  public function getIsOverdueAttribute() {
    $today = date('Y-m-d');

    if ( $this->duedate >= $today ) {
      return false;
    }

    return ( $this->is_unpaid || $this->is_partially_paid );
  }
}
