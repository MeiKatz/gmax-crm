<?php

namespace App\Models\Invoice;

enum Status: string {
  case UNPAID = 'unpaid';
  case PARTIALLY_PAID = 'partially paid';
  case PAID = 'paid';
  case REFUNDED = 'refunded';
  case CANCELLED = 'cancelled';
}
