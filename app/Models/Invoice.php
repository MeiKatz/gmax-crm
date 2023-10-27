<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    const STATUS_UNPAID    = 1;
    const STATUS_PARTIALLY_PAID = 2;
    const STATUS_PAID      = 3;
    const STATUS_REFUNDED  = 4;
    const STATUS_CANCELLED = 5;

    public function isUnpaid() {
        return $this->invostatus === self::STATUS_UNPAID;
    }

    public function isPartiallyPaid() {
        return $this->invostatus === self::STATUS_PARTIALLY_PAID;
    }

    public function isPaid() {
        return $this->invostatus === self::STATUS_PAID;
    }

    public function isRefunded() {
        return $this->invostatus === self::STATUS_REFUNDED;
    }

    public function isCancelled() {
        return $this->invostatus === self::STATUS_CANCELLED;
    }

    public function isOverdue() {
        $today = date('Y-m-d');

        if ( $this->duedate >= $today ) {
            return false;
        }

        return ( $this->isUnpaid() || $this->isPartiallyPaid() );
    }

    public function client() {
        return $this->belongsTo(
            Client::class,
            'userid',
            'id'
        );
    }
    public function projectdata()
	{
        return  $this->belongsTo(Project::class, 'projectid', 'id');
        
    }
}
