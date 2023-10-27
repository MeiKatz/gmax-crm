<?php

namespace App\Models;

use App\Models\Invoice\Concerns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    use Concerns\HasActions;
    use Concerns\HasAttributes;
    use Concerns\HasRelations;
    use Concerns\HasScopes;

    const STATUS_UNPAID    = 1;
    const STATUS_PARTIALLY_PAID = 2;
    const STATUS_PAID      = 3;
    const STATUS_REFUNDED  = 4;
    const STATUS_CANCELLED = 5;

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'totalamount' => 0,
        'paidamount' => 0,
        'invostatus' => 1, // unpaid
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'is_cancelled',
        'is_overdue',
        'is_paid',
        'is_partially_paid',
        'is_refunded',
        'is_unpaid',
    ];

    protected static function booting() {
        self::creating(function ( $model ) {
            $today = date('Y-m-d');

            if ( empty( $model->invodate ) ) {
                $model->invodate = $today;
            }

            if ( empty( $model->duedate ) ) {
                $model->duedate = $today;
            }
        });
    }

    /**
     * @return array<string,int>
     */
    public static function getCounts() {
        $results = (
            self::groupBy('invostatus')
                ->selectRaw('COUNT(*) AS count, invostatus AS status')
                ->pluck(
                    'count',
                    'status'
                )
        );

        return [
            'unpaid'    => $results[ self::STATUS_UNPAID ]    ?? 0,
            'partially_paid' => $results[ self::STATUS_PARTIALLY_PAID ] ?? 0,
            'paid'      => $results[ self::STATUS_PAID ]      ?? 0,
            'refunded'  => $results[ self::STATUS_REFUNDED ]  ?? 0,
            'cancelled' => $results[ self::STATUS_CANCELLED ] ?? 0,
        ];
    }
}
