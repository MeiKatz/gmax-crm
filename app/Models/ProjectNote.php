<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectNote extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'creator_id',
        'note',
        'project_id',
    ];

    public function admindata()
	{
        return  $this->belongsTo(User::class, 'creator_id', 'id');
    }

    public function project() {
        return $this->belongsTo(
            Project::class
        );
    }
}
