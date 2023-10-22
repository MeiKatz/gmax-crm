<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectUpdate extends Model
{
    use HasFactory;

    public function addedby()
	{
        return  $this->belongsTo(User::class, 'auth', 'id');
        
    }
}
