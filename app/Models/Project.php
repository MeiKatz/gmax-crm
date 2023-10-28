<?php

namespace App\Models;

use App\Models\Project\Concerns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    use Concerns\HasAttributes;
    use Concerns\HasScopes;

    const STATUS_NOT_STARTED = 1;
    const STATUS_IN_PROGRESS = 2;
    const STATUS_IN_REVIEW   = 3;
    const STATUS_ON_HOLD     = 4;
    const STATUS_COMPLETED   = 5;
    const STATUS_CANCELLED   = 6;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'amount',
        'client_id',
        'deadline',
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

    public function client() {
        return $this->belongsTo(
            Client::class,
            'id'
        );
    }

    public function invoices() {
        return $this->hasMany(
            Invoice::class
        );
    }

    public function note() {
        return $this->hasOne(
            ProjectNote::class
        );
    }

    public function updates() {
        return $this->hasMany(
            ProjectUpdate::class
        );
    }

    public function tasks() {
        return $this->hasMany(
            ProjectTask::class
        );
    }
}
