<?php

namespace App\Models\User\Concerns;

use App\Models\Invoice;
use App\Models\PaymentReceipt;
use App\Models\ProjectUpdate;
use App\Models\Task;
use App\Models\TaskItem;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasRelations {
  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function createdInvoices(): HasMany {
    return $this->hasMany(
      Invoice::class,
      'creator_id'
    );
  }

  public function created_invoices(): HasMany {
    return $this->createdInvoices();
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function createdPaymentReceipts(): HasMany {
    return $this->hasMany(
      PaymentReceipt::class,
      'creator_id'
    );
  }

  public function created_payment_receipts(): HasMany {
    return $this->createdPaymentReceipts();
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function createdProjectUpdates(): HasMany {
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
  public function createdTasks(): HasMany {
    return $this->hasMany(
      Task::class,
      'creator_id'
    );
  }

  public function created_tasks(): HasMany {
    return $this->createdTasks();
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function createdTaskItems(): HasMany {
    return $this->hasMany(
      TaskItem::class,
      'creator_id'
    );
  }

  public function created_task_items(): HasMany {
    return $this->createdTaskItems();
  }
}
