<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectTask extends Model
{
    use HasFactory;
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
        return  $this->hasMany(ProjectUpdates::class, 'taskid', 'id');
        
    }
}
