<?php

namespace App\Models\Invoice\Concerns;

use App\Models\Client;
use App\Models\InvoiceItem;
use App\Models\PaymentReceipt;
use App\Models\Project;

trait HasRelations {
  /**
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function client() {
    return $this->belongsTo(
      Client::class,
      'userid',
      'id'
    );
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function project() {
    return $this->belongsTo(
      Project::class,
      'projectid',
      'id'
    );
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function items() {
    return $this->hasMany(
      InvoiceItem::class,
      'invoiceid'
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
}
