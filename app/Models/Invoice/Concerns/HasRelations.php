<?php

namespace App\Models\Invoice\Concerns;

use App\Models\Client;
use App\Models\InvoiceItem;
use App\Models\PaymentReceipt;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasRelations {
  /**
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function client(): BelongsTo {
    return $this->belongsTo(
      Client::class
    );
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function project(): BelongsTo {
    return $this->belongsTo(
      Project::class,
      'id'
    );
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function items(): HasMany {
    return $this->hasMany(
      InvoiceItem::class,
      'invoice_id'
    );
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function payments(): HasMany {
    return $this->hasMany(
      PaymentReceipt::class,
      'invoice_id'
    );
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function creator(): BelongsTo {
    return $this->belongsTo(
      User::class,
      'creator_id'
    );
  }
}
