<?php

namespace App\Models\Project\Concerns;

trait HasAttributes {
  /**
   * @return bool
   */
  public function getIsNotStartedAttribute() {
    return $this->status == self::STATUS_NOT_STARTED;
  }

  /**
   * @return bool
   */
  public function getIsInProgressAttribute() {
    return $this->status == self::STATUS_IN_PROGRESS;
  }

  /**
   * @return bool
   */
  public function getIsInReviewAttribute() {
    return $this->status == self::STATUS_IN_REVIEW;
  }

  /**
   * @return bool
   */
  public function getIsOnHoldAttribute() {
    return $this->status == self::STATUS_ON_HOLD;
  }

  /**
   * @return bool
   */
  public function getIsCompletedAttribute() {
    return $this->status == self::STATUS_COMPLETED;
  }

  /**
   * @return bool
   */
  public function getIsCancelledAttribute() {
    return $this->status == self::STATUS_CANCELLED;
  }
}
