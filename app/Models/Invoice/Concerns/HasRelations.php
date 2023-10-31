<?php

namespace App\Models\Invoice\Concerns;

use App\Models\Client;
use App\Models\InvoiceItem;
use App\Models\PaymentReceipt;
use App\Models\Project;
use App\Models\User;

trait HasRelations {
  /**
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function client() {
    return $this->belongsTo(
      Client::class
    );
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function project() {
    return $this->belongsTo(
      Project::class,
      'id'
    );
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function items() {
    return $this->hasMany(
      InvoiceItem::class,
      'invoice_id'
    );
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function payments() {
    return $this->hasMany(
      PaymentReceipt::class,
      'invoiceid'
    );
  }

  public function creator() {
    return $this->belongsTo(
      User::class,
      'creator_id'
    );
  }
}
