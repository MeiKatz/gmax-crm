<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectTask extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'aid',
        'assignedto',
        'project_id',
        'status',
        'task',
        'type',
    ];

    public function admindata()
	{
        return  $this->belongsTo(User::class, 'aid', 'id');
        
    }
    public function assigned()
	{
        return  $this->belongsTo(User::class, 'assignedto', 'id');
        
    }
    public function comments()
	{
        return  $this->hasMany(ProjectUpdate::class, 'taskid', 'id');
        
    }

    public function project() {
        return $this->belongsTo(
            Project::class
        );
    }
}
