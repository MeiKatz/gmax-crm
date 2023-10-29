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
        'auth',
        'file',
        'image',
        'message',
        'project_id',
        'taskid',
    ];

    public function addedby()
	{
        return  $this->belongsTo(User::class, 'auth', 'id');
        
    }

    public function project() {
        return $this->belongsTo(
            Project::class
        );
    }
}
