<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

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

    public function creator() {
        return $this->belongsTo(
            User::class,
            'creator_id'
        );
    }
    public function assigned()
	{
        return  $this->belongsTo(User::class, 'assignedto', 'id');
        
    }

    public function items() {
        return $this->hasMany(
            TaskItem::class
        );
    }

    public function updates() {
        return $this->hasMany(
            ProjectUpdate::class
        );
    }

    public function project() {
        return $this->belongsTo(
            Project::class
        );
    }
}
