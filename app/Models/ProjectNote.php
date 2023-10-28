<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectNote extends Model
{
    use HasFactory;

    public function admindata()
	{
        return  $this->belongsTo(User::class, 'admin', 'id');
    }

    public function project() {
        return $this->belongsTo(
            Project::class
        );
    }
}
