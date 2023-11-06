<?php

namespace App\Models\Project\Concerns;

use App\Models\Concerns\HasCurrencyAttribute;
use App\Models\Project\Status as ProjectStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasAttributes {
  use HasCurrencyAttribute;

  /**
   * @return \Illuminate\Database\Eloquent\Casts\Attribute
   */
  protected function isNotStarted(): Attribute {
    return $this->newAttributeForStatus( ProjectStatus::NOT_STARTED );
  }

  /**
   * @return \Illuminate\Database\Eloquent\Casts\Attribute
   */
  protected function isInProgress(): Attribute {
    return $this->newAttributeForStatus( ProjectStatus::IN_PROGRESS );
  }

  /**
   * @return \Illuminate\Database\Eloquent\Casts\Attribute
   */
  protected function isInReview(): Attribute {
    return $this->newAttributeForStatus( ProjectStatus::IN_REVIEW );
  }

  /**
   * @return \Illuminate\Database\Eloquent\Casts\Attribute
   */
  protected function isOnHold(): Attribute {
    return $this->newAttributeForStatus( ProjectStatus::ON_HOLD );
  }

  /**
   * @return \Illuminate\Database\Eloquent\Casts\Attribute
   */
  protected function isCompleted(): Attribute {
    return $this->newAttributeForStatus( ProjectStatus::COMPLETED );
  }

  /**
   * @return \Illuminate\Database\Eloquent\Casts\Attribute
   */
  protected function isCancelled(): Attribute {
    return $this->newAttributeForStatus( ProjectStatus::CANCELLED );
  }

  /**
   * !! Cannot define the return value because otherwise
   * Laravel will recognize this function as an attribute. !!
   *
   * @param  \App\Project\Status  $status
   * @return \Illuminate\Database\Eloquent\Casts\Attribute
   */
  private function newAttributeForStatus(
    ProjectStatus $status
  ) {
    return Attribute::get(
      fn () => (
        $this->status === $status
      )
    );
  }
}
