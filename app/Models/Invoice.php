<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    const STATUS_UNPAID    = 1;
    const STATUS_PARTIALLY_PAID = 2;
    const STATUS_PAID      = 3;
    const STATUS_REFUNDED  = 4;
    const STATUS_CANCELLED = 5;

    public function clientdata()
	{
        return  $this->belongsTo(Client::class, 'userid', 'id');
        
    }
    public function projectdata()
	{
        return  $this->belongsTo(Project::class, 'projectid', 'id');
        
    }
}
