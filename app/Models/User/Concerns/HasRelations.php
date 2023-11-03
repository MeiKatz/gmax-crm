<?php

namespace App\Models\User\Concerns;

use App\Models\Invoice;
use App\Models\PaymentReceipt;
use App\Models\ProjectUpdate;
use App\Models\Task;
use App\Models\TaskItem;

trait HasRelations {
  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function createdInvoices() {
    return $this->hasMany(
      Invoice::class,
      'creator_id'
    );
  }

  public function created_invoices() {
    return $this->createdInvoices();
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function createdPaymentReceipts() {
    return $this->hasMany(
      PaymentReceipt::class,
      'creator_id'
    );
  }

  public function created_payment_receipts() {
    return $this->createdPaymentReceipts();
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function createdProjectUpdates() {
    return $this->hasMany(
      ProjectUpdate::class,
      'creator_id'
    );
  }

  public function created_project_updates() {
    return $this->createdProjectUpdates();
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function createdTasks() {
    return $this->hasMany(
      Task::class,
      'creator_id'
    );
  }

  public function created_tasks() {
    return $this->createdTasks();
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function createdTaskItems() {
    return $this->hasMany(
      TaskItem::class,
      'creator_id'
    );
  }

  public function created_task_items() {
    return $this->createdTaskItems();
  }
}
