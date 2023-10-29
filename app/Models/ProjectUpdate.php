<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectUpdate extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'creator_id',
        'file',
        'image',
        'message',
        'project_id',
        'task_id',
    ];

    public function creator() {
        return $this->belongsTo(
            User::class,
            'creator_id'
        );
    }

    public function project() {
        return $this->belongsTo(
            Project::class
        );
    }
}
