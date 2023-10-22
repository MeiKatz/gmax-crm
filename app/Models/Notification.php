<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    public function added()
	{
        return  $this->belongsTo(User::class, 'fromid', 'id');
        
    }
}
