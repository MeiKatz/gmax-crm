<?php

namespace App\Models;

use App\Models\Concerns\HasCurrencyAttribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentGateway extends Model
{
    use HasFactory;
    use HasCurrencyAttribute;
}
