<?php

namespace App\Models\Project\Concerns;

use App\Models\Concerns\HasCurrencyAttribute;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasAttributes {
  use HasCurrencyAttribute;

  /**
   * @return \Illuminate\Database\Eloquent\Casts\Attribute
   */
  protected function isNotStarted(): Attribute {
    return $this->newAttributeForStatus( self::STATUS_NOT_STARTED );
  }

  /**
   * @return \Illuminate\Database\Eloquent\Casts\Attribute
   */
  protected function isInProgress(): Attribute {
    return $this->newAttributeForStatus( self::STATUS_IN_PROGRESS );
  }

  /**
   * @return \Illuminate\Database\Eloquent\Casts\Attribute
   */
  protected function isInReview(): Attribute {
    return $this->newAttributeForStatus( self::STATUS_IN_REVIEW );
  }

  /**
   * @return \Illuminate\Database\Eloquent\Casts\Attribute
   */
  protected function isOnHold(): Attribute {
    return $this->newAttributeForStatus( self::STATUS_ON_HOLD );
  }

  /**
   * @return \Illuminate\Database\Eloquent\Casts\Attribute
   */
  protected function isCompleted(): Attribute {
    return $this->newAttributeForStatus( self::STATUS_COMPLETED );
  }

  /**
   * @return \Illuminate\Database\Eloquent\Casts\Attribute
   */
  protected function isCancelled(): Attribute {
    return $this->newAttributeForStatus( self::STATUS_CANCELLED );
  }

  /**
   * @param  int  $status
   * @return \Illuminate\Database\Eloquent\Casts\Attribute
   */
  private function newAttributeForStatus(
    int $status
  ): Attribute {
    return Attribute::get(
      fn ( $value, array $attributes ) => (
        $attributes['status'] == $status
      )
    );
  }
}
