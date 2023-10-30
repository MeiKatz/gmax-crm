<?php

namespace App\Models\User\Concerns;

trait HasAttributes {
  /**
   * @return bool
   */
  public function getIsAdminAttribute() {
    return $this->usertype == self::USER_TYPE_ADMIN;
  }

  /**
   * @return bool
   */
  public function getIsStaffAttribute() {
    return $this->usertype != self::USER_TYPE_ADMIN;
  }
}
