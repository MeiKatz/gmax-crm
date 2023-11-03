<?php

namespace App\Models\User\Concerns;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasAttributes {
  /**
   * @return \Illuminate\Database\Eloquent\Casts\Attribute
   */
  protected function isAdmin(): Attribute {
    return Attribute::get(
      fn ( $value, array $attributes ) => (
        $attributes['usertype'] == self::USER_TYPE_ADMIN
      )
    );
  }

  /**
   * @return \Illuminate\Database\Eloquent\Casts\Attribute
   */
  protected function isStaff(): Attribute {
    return Attribute::get(
      fn ( $value, array $attributes ) => (
        $attributes['usertype'] != self::USER_TYPE_ADMIN
      )
    );
  }
}
