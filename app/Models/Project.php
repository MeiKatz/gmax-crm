<?php

namespace App\Models;

use App\Casts\Money;
use App\Models\Concerns\SerializesMoney;
use App\Models\Contracts\HasCurrency;
use App\Models\Project\Concerns;
use App\Models\Project\Status as ProjectStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model implements HasCurrency
{
    use HasFactory;
    use SerializesMoney;
    use Concerns\HasAttributes;
    use Concerns\HasRelations;
    use Concerns\HasScopes;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'amount' => Money::class,
        'status' => ProjectStatus::class,
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
            'not_started' => $results[ ProjectStatus::NOT_STARTED->value ] ?? 0,
            'in_progress' => $results[ ProjectStatus::IN_PROGRESS->value ] ?? 0,
            'in_review'   => $results[ ProjectStatus::IN_REVIEW->value ]   ?? 0,
            'on_hold'     => $results[ ProjectStatus::ON_HOLD->value ]     ?? 0,
            'completed'   => $results[ ProjectStatus::COMPLETED->value ]   ?? 0,
            'cancelled'   => $results[ ProjectStatus::CANCELLED->value ]   ?? 0,
        ];
    }
}
