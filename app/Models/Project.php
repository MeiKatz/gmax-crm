<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    const STATUS_NOT_STARTED = 1;
    const STATUS_IN_PROGRESS = 2;
    const STATUS_IN_REVIEW   = 3;
    const STATUS_ON_HOLD     = 4;
    const STATUS_COMPLETED   = 5;
    const STATUS_CANCELLED   = 6;

    public function clientdata()
	{
        return  $this->belongsTo(Client::class, 'client', 'id');
        
    }
}
