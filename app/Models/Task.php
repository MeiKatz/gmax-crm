<?php

namespace App\Models;

use App\Models\Task\Concerns;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    use Concerns\HasRelations;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'assigned_user_id',
        'creator_id',
        'project_id',
        'status',
        'task',
        'type',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'is_assigned',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function isAssigned(): Attribute {
        return Attribute::get(
            fn ( $value, array $attributes ) => (
                $attributes['assigned_user_id'] !== null
            )
        );
    }
}
