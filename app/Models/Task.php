<?php

namespace App\Models;

use App\Models\Task\Concerns;
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
        'assignedto',
        'creator_id',
        'project_id',
        'status',
        'task',
        'type',
    ];
}
