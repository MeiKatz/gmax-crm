<?php

namespace App\Models;

use App\Casts\Money;
use App\Models\Concerns\SerializesMoney;
use App\Models\Contracts\HasCurrency;
use App\Models\Project\Concerns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model implements HasCurrency
{
    use HasFactory;
    use SerializesMoney;
    use Concerns\HasAttributes;
    use Concerns\HasRelations;
    use Concerns\HasScopes;

    const STATUS_NOT_STARTED = 1;
    const STATUS_IN_PROGRESS = 2;
    const STATUS_IN_REVIEW   = 3;
    const STATUS_ON_HOLD     = 4;
    const STATUS_COMPLETED   = 5;
    const STATUS_CANCELLED   = 6;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'amount' => Money::class,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'amount',
        'client_id',
        'deadline_at',
        'description',
        'name',
        'starts_at',
        'status',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'is_cancelled',
        'is_completed',
        'is_in_progress',
        'is_in_review',
        'is_not_started',
        'is_on_hold',
    ];

    /**
     * @return array
     */
    public function toArray() {
        return $this->serializeMoneyInArray(
            parent::toArray()
        );
    }

    /**
     * @return array<string,int>
     */
    public static function getCounts(): array {
        $results = (
            self::groupBy('status')
                ->selectRaw('COUNT(*) AS count')
                ->pluck(
                    'count',
                    'status'
                )
        );

        return [
            'not_started' => $results[ self::STATUS_NOT_STARTED ] ?? 0,
            'in_progress' => $results[ self::STATUS_IN_PROGRESS ] ?? 0,
            'in_review'   => $results[ self::STATUS_IN_REVIEW ]   ?? 0,
            'on_hold'     => $results[ self::STATUS_ON_HOLD ]     ?? 0,
            'completed'   => $results[ self::STATUS_COMPLETED ]   ?? 0,
            'cancelled'   => $results[ self::STATUS_CANCELLED ]   ?? 0,
        ];
    }
}
